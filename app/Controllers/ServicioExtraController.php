<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ConsumoEstanciaModel;
use App\Models\EstanciaModel;
use App\Models\ServicioModel;
use App\Models\UsuarioModel;

class ServicioExtraController extends Controller
{
    protected $consumoEstanciaModel;
    protected $estanciaModel;
    protected $servicioModel;
    protected $usuarioModel;

    public function __construct()
    {
        $this->consumoEstanciaModel = new ConsumoEstanciaModel();
        $this->estanciaModel = new EstanciaModel();
        $this->servicioModel = new ServicioModel();
        $this->usuarioModel = new UsuarioModel();

        if (!session()->has('usuario')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión.');
        }
    }

    // ▶️ Mostrar formulario para registrar consumo
    public function index()
    {
        // Obtener estancias activas (checkin/ocupada)
        $estancias = $this->estanciaModel->obtenerEstanciasActivasConDetalles();

        // Obtener servicios activos
        $servicios = $this->servicioModel->where('activo', 1)->findAll();

        $data = [
            'titulo' => 'Registrar Servicios Extras',
            'estancias' => $estancias,
            'servicios' => $servicios,
            'usuario' => session()->get('usuario'),
        ];

        return view('servicios_extras/form_consumo', $data);
    }

    // ▶️ Registrar consumo
    public function registrar()
    {
        $estanciaId = (int) $this->request->getPost('estancia_id');
        $servicioId = (int) $this->request->getPost('servicio_id');
        $cantidad = (int) $this->request->getPost('cantidad') ?: 1;
        $duracionHoras = !empty($this->request->getPost('duracion_horas')) ? (float) $this->request->getPost('duracion_horas') : null;
        $observaciones = $this->request->getPost('observaciones');
        $fechaHoraConsumo = $this->request->getPost('fecha_hora_consumo') ?: date('Y-m-d H:i:s');

        // Validar
        if ($estanciaId <= 0 || $servicioId <= 0) {
            return redirect()->back()->withInput()->with('error', 'Seleccione estancia y servicio válidos.');
        }

        // Obtener servicio
        $servicio = $this->servicioModel->find($servicioId);
        if (!$servicio) {
            return redirect()->back()->with('error', 'Servicio no encontrado.');
        }

        // Calcular subtotal
        $subtotal = 0;
        if (in_array($servicio->unidad_medida, ['hora', 'sesion']) && $duracionHoras) {
            $subtotal = $servicio->precio_unitario * $duracionHoras;
        } else {
            $subtotal = $servicio->precio_unitario * $cantidad;
        }

        // Registrar consumo
        $data = [
            'estancia_id' => $estanciaId,
            'servicio_id' => $servicioId,
            'cantidad' => $cantidad,
            'duracion_horas' => $duracionHoras,
            'fecha_hora_consumo' => $fechaHoraConsumo,
            'subtotal' => $subtotal,
            'registrado_por' => session()->get('usuario')->id,
            'observaciones' => $observaciones,
        ];

        if ($this->consumoEstanciaModel->insert($data)) {
            return redirect()->to('/servicios-extras')->with('mensaje', 'Consumo registrado correctamente.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Error al registrar el consumo.');
        }
    }


// ▶️ Listado de consumos por habitación
    public function listadoPorHabitacion()
    {
        $fecha = $this->request->getGet('fecha') ?: date('Y-m-d');
        $consumos = $this->consumoEstanciaModel->obtenerConsumosPorHabitacion($fecha);

    // Agrupar por habitación
        $consumosPorHabitacion = [];
        foreach ($consumos as $c) {
            $consumosPorHabitacion[$c->numero_habitacion][] = $c;
        }

        $data = [
            'titulo' => 'Consumos por Habitación - ' . date('d/m/Y', strtotime($fecha)),
            'consumosPorHabitacion' => $consumosPorHabitacion,
            'fecha' => $fecha,
            'usuario' => session()->get('usuario'),
        ];

        return view('servicios_extras/listado_por_habitacion', $data);
    }
    
}