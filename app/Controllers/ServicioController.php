<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ServicioModel;

class ServicioController extends Controller
{
    protected $servicioModel;

    public function __construct()
    {
        $this->servicioModel = new ServicioModel();
    }

    // ▶️ LISTAR SERVICIOS
    public function index()
    {
        $data = [
            'titulo'    => 'Hotéis Viña del Sur - Gestión de Servicios',
            'servicios' => $this->servicioModel->orderBy('nombre', 'ASC')->findAll(),
        ];

        return view('servicios/listar_servicios', $data);
    }

    // ▶️ MOSTRAR FORMULARIO (crear o editar)
    public function form($id = null)
    {
        $servicio = null;
        if ($id) {
            $servicio = $this->servicioModel->find($id);
            if (!$servicio) {
                return redirect()->to('/servicios')->with('error', 'Servicio no encontrado.');
            }
        }

        $data = [
            'titulo'   => $id ? 'Editar Servicio' : 'Nuevo Servicio',
            'servicio' => $servicio,
        ];

        return view('servicios/form_servicio', $data);
    }

    // ▶️ GUARDAR (crear o actualizar)
    public function guardar()
    {
        $id = $this->request->getPost('id');

        // Validar datos
        if (! $this->validate([
            'nombre' => 'required|min_length[3]|max_length[100]',
            'precio_unitario' => 'required|numeric|greater_than_equal_to[0]',
            'unidad_medida' => 'required|in_list[noche,hora,sesion,plato]',
        ])) {
            // Si hay errores, volver al formulario con inputs y errores
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Preparar datos
        $data = [
            'nombre'          => $this->request->getPost('nombre'),
            'descripcion'     => $this->request->getPost('descripcion'),
            'precio_unitario' => $this->request->getPost('precio_unitario'),
            'unidad_medida'   => $this->request->getPost('unidad_medida'),
            'activo'          => $this->request->getPost('activo') ? 1 : 0,
        ];

        if ($id) {
            // Actualizar
            $this->servicioModel->update($id, $data);
            $mensaje = 'Servicio actualizado correctamente.';
        } else {
            // Crear
            $this->servicioModel->insert($data);
            $mensaje = 'Servicio creado correctamente.';
        }

        return redirect()->to('/servicios')->with('mensaje', $mensaje);
    }

    // ▶️ ELIMINAR
    public function eliminar($id)
    {
        $this->servicioModel->delete($id);
        return redirect()->to('/servicios')->with('mensaje', 'Servicio eliminado correctamente.');
    }
}