<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\EstanciaModel;
use App\Models\ReservaModel;
use App\Models\HabitacionModel;
use App\Models\HuespedModel;
use App\Models\UsuarioModel;
use App\Models\LugarOrigenModel;

class CheckinController extends Controller
{
    protected $estanciaModel;
    protected $reservaModel;
    protected $habitacionModel;
    protected $huespedModel;
    protected $usuarioModel;
    protected $lugarOrigenModel;
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->estanciaModel = new EstanciaModel();
        $this->reservaModel = new ReservaModel();
        $this->habitacionModel = new HabitacionModel();
        $this->huespedModel = new HuespedModel();
        $this->usuarioModel = new UsuarioModel();
        $this->lugarOrigenModel = new LugarOrigenModel();

        if (!session()->has('usuario')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión.');
        }
    }


   //  Mostrar formulario de check-in
    public function index()
    {
    // Cargar habitaciones disponibles con tipo
        $habitaciones = $this->db->table('habitacion h')
        ->select('h.id, h.numero_habitacion, th.nombre as tipo_nombre')
        ->join('tipo_habitacion th', 'th.id = h.tipo_habitacion_id', 'left')
        ->where('h.estado', 'disponible')
        ->orderBy('h.numero_habitacion', 'ASC')
        ->get()->getResult();

        $data = [
            'titulo' => 'Registro de Check-in',
            'usuario' => session()->get('usuario'),
            'lugares_origen' => $this->lugarOrigenModel->findAll(),
        'habitaciones_disponibles' => $habitaciones, // ← ¡NUEVA VARIABLE!
    ];
    return view('checkin/form_checkin', $data);
}

    // ▶️ Buscar reserva por ID (para autocompletar datos)
public function buscarReserva($id)
{
    $reserva = $this->reservaModel->obtenerConDetalles($id);
    if (!$reserva || $reserva->estado !== 'confirmada') {
        return $this->response->setJSON(['error' => 'Reserva no encontrada o no confirmada.']);
    }

        // Obtener datos del huésped si existe
    $huesped = $this->db->table('huesped')->where('usuario_id', $reserva->usuario_id)->get()->getRow();

    return $this->response->setJSON([
        'success' => true,
        'reserva' => $reserva,
        'huesped' => $huesped
    ]);
}

    // ▶️ Registrar check-in

// ▶️ Registrar check-in
public function registrar()
{
    $reservaId = (int) $this->request->getPost('reserva_id');
    $habitacionId = (int) $this->request->getPost('habitacion_id');
    $nombres = trim($this->request->getPost('nombres'));
    $apellidos = trim($this->request->getPost('apellidos'));
    $docIdentidad = trim($this->request->getPost('doc_identidad'));
    $direccion = trim($this->request->getPost('direccion'));
    $lugarOrigenId = (int) $this->request->getPost('lugar_origen_id');
    $observaciones = trim($this->request->getPost('observaciones'));

    // Validar datos mínimos del huésped
    if (empty($nombres) || empty($apellidos) || empty($docIdentidad)) {
        return redirect()->back()->withInput()->with('error', 'Nombres, apellidos y documento son obligatorios.');
    }

    $this->db->transStart();

    try {
        $usuarioSession = session()->get('usuario');
        $usuarioId = $usuarioSession ? $usuarioSession->id : 1; // Fallback a ID 1 si no hay sesión

        // ▼▼▼ CASO 1: HUÉSPED CON RESERVA ▼▼▼
        if ($reservaId > 0) {
            $reserva = $this->reservaModel->find($reservaId);
            if (!$reserva || $reserva->estado !== 'confirmada') {
                throw new \Exception('Reserva no encontrada o no confirmada. Verifique el ID.');
            }

            $habitacionId = $reserva->habitacion_id;
            $habitacion = $this->habitacionModel->find($habitacionId);
            if (!$habitacion || $habitacion->estado !== 'reservada') {
                throw new \Exception('La habitación de la reserva no está en estado "reservada".');
            }

            // Obtener o crear huésped vinculado al usuario de la reserva
            $huesped = $this->db->table('huesped')->where('usuario_id', $reserva->usuario_id)->get()->getRow();
            if (!$huesped) {
                $huespedData = [
                    'usuario_id' => $reserva->usuario_id,
                    'nombres' => $nombres,
                    'apellidos' => $apellidos,
                    'doc_identidad' => $docIdentidad,
                    'direccion' => $direccion,
                    'lugar_origen_id' => $lugarOrigenId ?: null,
                    'fecha_conversion_a_huesped' => date('Y-m-d H:i:s')
                ];
                $this->huespedModel->insert($huespedData);
                $huespedId = $this->huespedModel->getInsertID();
            } else {
                $this->huespedModel->update($huesped->id, [
                    'nombres' => $nombres,
                    'apellidos' => $apellidos,
                    'doc_identidad' => $docIdentidad,
                    'direccion' => $direccion,
                    'lugar_origen_id' => $lugarOrigenId ?: null
                ]);
                $huespedId = $huesped->id;
            }

        // ▼▼▼ CASO 2: HUÉSPED SIN RESERVA (WALK-IN) ▼▼▼
        } else {
            if ($habitacionId <= 0) {
                throw new \Exception('Debe seleccionar una habitación para registrar el check-in.');
            }

            $habitacion = $this->habitacionModel->find($habitacionId);
            if (!$habitacion || $habitacion->estado !== 'disponible') {
                throw new \Exception('Habitación no disponible. Seleccione otra habitación.');
            }

            // Obtener tipo de habitación
            $tipoHabitacion = $this->db->table('tipo_habitacion')
                ->where('id', $habitacion->tipo_habitacion_id)
                ->get()->getRow();

            if (!$tipoHabitacion) {
                throw new \Exception('Tipo de habitación no encontrado. Contacte al administrador.');
            }

            // Crear reserva automática por 1 noche
            $fechaInicio = date('Y-m-d');
            $fechaFin = date('Y-m-d', strtotime('+1 day'));

            $reservaData = [
                'usuario_id' => $usuarioId, // ← ¡USUARIO DE LA SESIÓN!
                'habitacion_id' => $habitacionId,
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin,
                'cantidad_personas' => 1,
                'estado' => 'confirmada',
                'monto_total' => $tipoHabitacion->precio_noche,
                'metodo_pago' => 'efectivo',
                'fecha_reserva' => date('Y-m-d H:i:s'),
                'fecha_confirmacion' => date('Y-m-d H:i:s'),
                'fecha_pago' => date('Y-m-d H:i:s'),
            ];

            // Insertar reserva
            if (!$this->reservaModel->insert($reservaData)) {
                $errors = $this->reservaModel->errors();
                log_message('error', 'Errores de validación al crear reserva: ' . print_r($errors, true));
                throw new \Exception('Error al crear la reserva automática. Verifique los datos.');
            }

            $reservaId = $this->reservaModel->getInsertID();

            // Crear nuevo huésped
            $huespedData = [
                'usuario_id' => $usuarioId, // ← ¡MISMO USUARIO!
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'doc_identidad' => $docIdentidad,
                'direccion' => $direccion,
                'lugar_origen_id' => $lugarOrigenId ?: null,
                'fecha_conversion_a_huesped' => date('Y-m-d H:i:s')
            ];

            if (!$this->huespedModel->insert($huespedData)) {
                $errors = $this->huespedModel->errors();
                log_message('error', 'Errores de validación al crear huésped: ' . print_r($errors, true));
                throw new \Exception('Error al registrar los datos del huésped.');
            }

            $huespedId = $this->huespedModel->getInsertID();
        }

        // ▼▼▼ CREAR ESTANCIA ▼▼▼
        $estanciaData = [
            'reserva_id' => $reservaId,
            'huesped_id' => $huespedId,
            'fecha_checkin' => date('Y-m-d H:i:s'),
            'estado' => 'checkin',
            'monto_final' => $this->reservaModel->find($reservaId)->monto_total,
            'observaciones' => $observaciones
        ];

        if (!$this->estanciaModel->insert($estanciaData)) {
            throw new \Exception('Error al crear el registro de estancia.');
        }

        // ▼▼▼ ACTUALIZAR ESTADO DE HABITACIÓN ▼▼▼
        if (!$this->habitacionModel->update($habitacionId, ['estado' => 'ocupada'])) {
            throw new \Exception('Error al actualizar el estado de la habitación.');
        }

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            throw new \Exception('Error en la transacción. Intente nuevamente.');
        }

        return redirect()->to('/checkin/listado')
            ->with('mensaje', 'Check-in registrado correctamente. ¡Bienvenido al hotel!');

    } catch (\Exception $e) {
        $this->db->transRollback();
        log_message('error', 'Error DETALLADO en check-in: ' . $e->getMessage());
        return redirect()->back()->withInput()->with('error', $e->getMessage());
    }
}


    // ▶️ Listado diario de huéspedes en el hotel (para autoridades)
public function listado()
{
    $fecha = $this->request->getGet('fecha') ?: date('Y-m-d');
    $estancias = $this->estanciaModel->obtenerEstanciasActivasConDetalles($fecha);

    $data = [
        'titulo' => 'Listado Diario de Huéspedes - ' . date('d/m/Y', strtotime($fecha)),
        'estancias' => $estancias,
        'fecha' => $fecha,
        'usuario' => session()->get('usuario'),
    ];

    return view('checkin/listado_diario', $data);
}
}