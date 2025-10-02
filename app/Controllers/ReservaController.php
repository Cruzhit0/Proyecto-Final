<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ReservaModel;
use App\Models\HabitacionModel;
use App\Models\ServicioModel;
use App\Models\ReservaServicioModel;
use App\Models\UsuarioModel;

class ReservaController extends Controller
{
    protected $reservaModel;
    protected $habitacionModel;
    protected $servicioModel;
    protected $reservaServicioModel;
    protected $usuarioModel;
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->reservaModel = new ReservaModel();
        $this->habitacionModel = new HabitacionModel();
        $this->servicioModel = new ServicioModel();
        $this->reservaServicioModel = new ReservaServicioModel();
        $this->usuarioModel = new UsuarioModel();

        // Verificar sesión
        if (!session()->has('usuario')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión.');
        }
    }

    // ▶️ LISTAR RESERVAS
    public function index()
    {
        $data = [
            'titulo'   => 'Gestión de Reservas',
            'reservas' => $this->reservaModel->obtenerConDetalles(),
        ];
        return view('reservas/listar_reservas', $data);
    }

    // ▶️ FORMULARIO NUEVA RESERVA
    public function form()
    {
        $data = [
            'titulo'    => 'Nueva Reserva',
            'servicios' => $this->servicioModel->where('activo', 1)->findAll(),
            'usuario'   => session()->get('usuario'), // Puede ser objeto o array, depende de cómo lo guardaste
        ];
        return view('reservas/form_reserva', $data);
    }

    // ▶️ CARGAR HABITACIONES DISPONIBLES (AJAX)
    public function cargarHabitaciones()
    {
        $data = $this->request->getJSON(true);
        $fechaInicio = $data['fecha_inicio'] ?? null;
        $fechaFin    = $data['fecha_fin'] ?? null;

        if (!$fechaInicio || !$fechaFin ||
            !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaInicio) ||
            !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaFin)) {
            return $this->response->setJSON(['error' => 'Fechas no válidas']);
        }

        if (strtotime($fechaInicio) >= strtotime($fechaFin)) {
            return $this->response->setJSON(['error' => 'Fecha inicio debe ser menor que fecha fin']);
        }

        $habitaciones = $this->habitacionModel->obtenerDisponiblesPorFechas($fechaInicio, $fechaFin);
        return $this->response->setJSON(['habitaciones' => $habitaciones]);
    }

    // ▶️ GUARDAR RESERVA (PASO 1: SIN PAGO)
    public function guardar()
    {
        // ✅ CORRECCIÓN PRINCIPAL: Acceder como OBJETO, no array
        $usuarioSession = session()->get('usuario');
        $usuarioId = $usuarioSession ? ($usuarioSession->id ?? null) : null;

        if (!$usuarioId) {
            return redirect()->to('/login')->with('error', 'Sesión inválida.');
        }

        $fechaInicio = $this->request->getPost('fecha_inicio');
        $fechaFin    = $this->request->getPost('fecha_fin');
        $habitacionId = (int)$this->request->getPost('habitacion_id');
        $cantidadPersonas = (int)$this->request->getPost('cantidad_personas') ?: 1;
        $notasAdmin = $this->request->getPost('notas_admin') ?: null;
        $servicios = $this->request->getPost('servicios') ?? [];

        // Validar fechas
        if (strtotime($fechaInicio) >= strtotime($fechaFin)) {
            return redirect()->back()->withInput()->with('error', 'La fecha de inicio debe ser menor que la fecha fin.');
        }

        // Validar habitación
        if ($habitacionId <= 0) {
            return redirect()->back()->withInput()->with('error', 'Seleccione una habitación válida.');
        }

        $habitacion = $this->habitacionModel->find($habitacionId);
        if (!$habitacion) {
            return redirect()->back()->withInput()->with('error', 'La habitación seleccionada no existe.');
        }

        // Verificar disponibilidad real (no solapamiento con otras reservas)
        $existeSolapamiento = $this->reservaModel->existeSolapamiento($habitacionId, $fechaInicio, $fechaFin);
        if ($existeSolapamiento) {
            return redirect()->back()->withInput()->with('error', 'La habitación no está disponible en esas fechas.');
        }

        // Calcular monto base: precio_noche * cantidad_noches
        $tipoHabitacion = $this->db->table('tipo_habitacion')
            ->where('id', $habitacion->tipo_habitacion_id)
            ->get()->getRow();

        if (!$tipoHabitacion) {
            return redirect()->back()->with('error', 'Error: tipo de habitación no encontrado.');
        }

        $dias = max(1, (strtotime($fechaFin) - strtotime($fechaInicio)) / (60 * 60 * 24));
        $montoBase = $tipoHabitacion->precio_noche * $dias;
        $montoTotal = $montoBase;

        // Iniciar transacción
        $this->db->transStart();

        try {
            // 1. Insertar reserva principal
            $reservaData = [
                'usuario_id'         => $usuarioId,
                'habitacion_id'      => $habitacionId,
                'fecha_inicio'       => $fechaInicio,
                'fecha_fin'          => $fechaFin,
                'cantidad_personas'  => $cantidadPersonas,
                'estado'             => 'pendiente',
                'monto_total'        => $montoTotal,
                'descuento_aplicado' => 0.00,
                'metodo_pago'        => 'sin pagar',
                'notas_admin'        => $notasAdmin,
                'fecha_reserva'      => date('Y-m-d H:i:s'),
            ];

            $this->reservaModel->insert($reservaData);
            $reservaId = $this->reservaModel->getInsertID();

            // 2. Si hay servicios, insertar en reserva_servicio
            if (!empty($servicios) && is_array($servicios)) {
                foreach ($servicios as $item) {
                    $servicioId = (int)($item['servicio_id'] ?? 0);
                    $cantidad = (int)($item['cantidad'] ?? 1);
                    $duracion = !empty($item['duracion_horas']) ? (float)$item['duracion_horas'] : null;

                    if ($servicioId <= 0) continue;

                    $servicio = $this->servicioModel->find($servicioId);
                    if (!$servicio) continue;

                    // Calcular subtotal
                    $subtotal = 0;
                    if (in_array($servicio->unidad_medida, ['hora', 'sesion']) && $duracion) {
                        $subtotal = $servicio->precio_unitario * $duracion;
                    } else {
                        $subtotal = $servicio->precio_unitario * $cantidad;
                    }

                    $this->reservaServicioModel->insert([
                        'reserva_id'      => $reservaId,
                        'servicio_id'     => $servicioId,
                        'cantidad'        => $cantidad,
                        'duracion_horas'  => $duracion,
                        'subtotal'        => $subtotal,
                    ]);

                    $montoTotal += $subtotal;
                }

                // Actualizar monto total de la reserva
                $this->reservaModel->update($reservaId, ['monto_total' => $montoTotal]);
            }

            // 3. Actualizar estado de la habitación a "reservada"
            $this->habitacionModel->update($habitacionId, ['estado' => 'reservada']);

            // Commit
            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \Exception('Error al guardar la reserva.');
            }

            return redirect()->to("/reservas/confirmar/{$reservaId}")
                ->with('mensaje', 'Reserva creada exitosamente. Proceda al pago.');

        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', 'Error al guardar reserva: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Error al procesar la reserva. Intente nuevamente.');
        }
    }

    // ▶️ CONFIRMAR RESERVA (pago del 50%)
    public function confirmar($id)
    {
        $reserva = $this->reservaModel->obtenerConDetalles($id);
        if (!$reserva || $reserva->estado !== 'pendiente') {
            return redirect()->to('/reservas')->with('error', 'Reserva no encontrada o ya confirmada.');
        }

        $data = [
            'titulo'      => 'Confirmar Reserva',
            'reserva'     => $reserva,
            'montoMinimo' => $reserva->monto_total * 0.5
        ];
        return view('reservas/confirmar_reserva', $data);
    }

    // ▶️ PROCESAR PAGO
    public function procesarPago($id)
    {
        $reserva = $this->reservaModel->find($id);
        if (!$reserva || $reserva->estado !== 'pendiente') {
            return redirect()->to('/reservas')->with('error', 'Reserva no encontrada o ya confirmada.');
        }

        $metodoPago = $this->request->getPost('metodo_pago');
        $montoPagado = (float)$this->request->getPost('monto_pagado');

        // Validar método de pago
        if (!in_array($metodoPago, ['tarjeta', 'efectivo', 'transferencia'])) {
            return redirect()->back()->with('error', 'Método de pago no válido.');
        }

        // Verificar monto mínimo (50%)
        $montoMinimo = $reserva->monto_total * 0.5;
        if ($montoPagado < $montoMinimo) {
            return redirect()->back()->with('error', 'Debe pagar al menos el 50% del total.');
        }

        // Aplicar descuento si paga dentro de 2 días de creada la reserva
        $descuento = 0;
        $diasDesdeReserva = (time() - strtotime($reserva->fecha_reserva)) / (60 * 60 * 24);
        if ($diasDesdeReserva <= 2) {
            $descuento = 2.00; // 2% de descuento
        }

        $nuevoMontoTotal = $reserva->monto_total * (1 - $descuento / 100);

        // Iniciar transacción
        $this->db->transStart();

        try {
            // Actualizar reserva
            $this->reservaModel->update($id, [
                'estado'             => 'confirmada',
                'metodo_pago'        => $metodoPago,
                'fecha_pago'         => date('Y-m-d H:i:s'),
                'fecha_confirmacion' => date('Y-m-d H:i:s'),
                'descuento_aplicado' => $descuento,
                'monto_total'        => $nuevoMontoTotal
            ]);

            // Crear registro en `huesped` si no existe ya para este usuario
            $huesped = $this->db->table('huesped')->where('usuario_id', $reserva->usuario_id)->get()->getRow();
            if (!$huesped) {
                // Obtener datos del usuario para llenar nombres/apellidos
                $usuario = $this->usuarioModel->find($reserva->usuario_id);
                $nombres = $usuario ? $usuario->nombres_completos : 'Invitado';
                $apellidos = '';

                // Si nombres_completos tiene espacio, dividir para nombres y apellidos
                if ($usuario && strpos($nombres, ' ') !== false) {
                    $partes = explode(' ', $nombres, 2);
                    $nombres = $partes[0];
                    $apellidos = $partes[1] ?? '';
                }

                $this->db->table('huesped')->insert([
                    'usuario_id'                  => $reserva->usuario_id,
                    'nombres'                     => $nombres,
                    'apellidos'                   => $apellidos,
                    'fecha_conversion_a_huesped'  => date('Y-m-d H:i:s')
                ]);
            }

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \Exception('Error al confirmar la reserva.');
            }

            return redirect()->to('/reservas')
                ->with('mensaje', 'Reserva confirmada correctamente. ¡Gracias por su pago!');

        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', 'Error al procesar pago: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al procesar el pago. Intente nuevamente.');
        }
    }

    // ▶️ MOSTRAR DETALLE DE RESERVA (CON IMPRESIÓN)
public function detalle($id)
{
    $reserva = $this->reservaModel->obtenerConDetalles($id);
    if (!$reserva) {
        return redirect()->to('/reservas')->with('error', 'Reserva no encontrada.');
    }

    $data = [
        'titulo'  => 'Detalle de Reserva #' . $reserva->id,
        'reserva' => $reserva,
    ];

    // Si se pide versión imprimible
    if ($this->request->getGet('imprimir') === '1') {
        return view('reservas/detalle_reserva_print', $data);
    }

    return view('reservas/detalle_reserva', $data);
}
}