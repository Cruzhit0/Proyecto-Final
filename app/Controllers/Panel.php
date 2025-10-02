<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\HabitacionModel;
use App\Models\TipoHabitacionModel;

class Panel extends BaseController
{
    // Muestra el panel de administrador
    public function admin()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión primero.');
        }

        $data = [
            'titulo' => 'Panel de Administrador - Viña del Sur',
            'usuario' => session()->get('nombres_completos'),
            'rol' => session()->get('rol')
        ];

        echo view('panel/admin', $data);
    }

    public function logout()
    {
        session()->destroy();
        setcookie(session_name(), '', time() - 3600, '/');

        return redirect()->to('/')
        ->with('info', 'Has cerrado sesión correctamente. ¡Gracias por visitarnos!');
    }

    public function habitaciones()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión primero.');
        }

        $model = new HabitacionModel();
        $habitaciones = $model->getHabitacionesConTipo();

        $data = [
            'titulo' => 'Gestión de Habitaciones - Hotel Viña del Sur',
            'usuario' => session()->get('nombres_completos'),
            'rol' => session()->get('rol'),
            'habitaciones' => $habitaciones
        ];

        echo view('panel/habitaciones', $data);
    }

    public function nuevaHabitacion()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $tipoModel = new TipoHabitacionModel();
        $tipos = $tipoModel->where('activo', 1)->findAll();

        $data = [
            'titulo' => 'Nueva Habitación - Hotel Viña del Sur',
            'usuario' => session()->get('nombres_completos'),
            'rol' => session()->get('rol'),
            'tipos' => $tipos,
            'validation' => null
        ];

        echo view('panel/habitacion_form', $data);
    }

    public function guardarHabitacion()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $model = new HabitacionModel();
        $tipoModel = new TipoHabitacionModel();

        $numero = $this->request->getPost('numero_habitacion');
        $tipoId = $this->request->getPost('tipo_habitacion_id');

  // Validar unicidad usando el modelo
        // Sanitizar y validar número de habitación
        $numero = trim($numero);
        if (empty($numero)) {
            return redirect()->back()->withInput()->with('error', 'El número de habitación es obligatorio.');
        }

// Validar unicidad usando el modelo (forma correcta en CI4)
        $existe = $model->where('numero_habitacion', $numero)->first();

        if ($existe) {
            return redirect()->back()->withInput()->with('error', 'Ya existe una habitación con ese número.');
        }

        $data = [
            'numero_habitacion'  => $numero,
            'tipo_habitacion_id' => $tipoId,
            'piso'               => $this->request->getPost('piso'),
            'estado'             => $this->request->getPost('estado') ?: 'disponible',
            'observaciones'      => $this->request->getPost('observaciones'),
        ];

        if ($model->insert($data, false)) {
            return redirect()->to(base_url('panel/habitaciones'))
            ->with('mensaje', 'Habitación creada correctamente.');
        } else {
            $tipos = $tipoModel->where('activo', 1)->findAll();
            return view('panel/habitacion_form', [
                'titulo' => 'Nueva Habitación - Hotel Viña del Sur',
                'usuario' => session()->get('nombres_completos'),
                'rol' => session()->get('rol'),
                'tipos' => $tipos,
                'validation' => $model->errors(),
                'habitacion' => $data
            ]);
        }
    }

    public function editarHabitacion($id = null)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $model = new HabitacionModel();
        $tipoModel = new TipoHabitacionModel();

        $habitacion = $model->getHabitacionConTipo($id);
        if (!$habitacion) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $tipos = $tipoModel->where('activo', 1)->findAll();

        $data = [
            'titulo' => 'Editar Habitación - Hotel Viña del Sur',
            'usuario' => session()->get('nombres_completos'),
            'rol' => session()->get('rol'),
            'habitacion' => $habitacion,
            'tipos' => $tipos,
            'validation' => null
        ];

        echo view('panel/habitacion_form', $data);
    }

    public function actualizarHabitacion($id = null)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $model = new HabitacionModel();
        $tipoModel = new TipoHabitacionModel();

        $data = [
            'numero_habitacion'  => $this->request->getPost('numero_habitacion'),
            'tipo_habitacion_id' => $this->request->getPost('tipo_habitacion_id'),
            'piso'               => $this->request->getPost('piso'),
            'estado'             => $this->request->getPost('estado'),
            'observaciones'      => $this->request->getPost('observaciones'),
        ];

        if ($model->update($id, $data)) {
            return redirect()->to(base_url('panel/habitaciones'))
            ->with('mensaje', 'Habitación actualizada correctamente.');
        } else {
            $habitacion = $model->getHabitacionConTipo($id);
            $tipos = $tipoModel->where('activo', 1)->findAll();

            return view('panel/habitacion_form', [
                'titulo' => 'Editar Habitación - Hotel Viña del Sur',
                'usuario' => session()->get('nombres_completos'),
                'rol' => session()->get('rol'),
                'habitacion' => $habitacion,
                'tipos' => $tipos,
                'validation' => $model->errors() ?: []
            ]);
        }
    }

    public function eliminarHabitacion($id = null)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $model = new HabitacionModel();
        $model->delete($id);

        return redirect()->to(base_url('panel/habitaciones'))
        ->with('mensaje', 'Habitación eliminada correctamente.');
    }
}