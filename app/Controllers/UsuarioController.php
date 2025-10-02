<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuarioModel;

class UsuarioController extends Controller
{
    protected $usuarioModel;

public function __construct()
{
    $this->usuarioModel = new UsuarioModel();

    if (!session()->has('usuario')) {
        return redirect()->to('/login')->with('error', 'Debes iniciar sesión para acceder.');
    }

    $usuario = session()->get('usuario');
    if ($usuario->rol !== 'admin') {
        // ✅ Mostrar página de acceso denegado
        echo view('errores/acceso_denegado');
        exit(); // Detener ejecución
    }
}

    // ▶️ LISTAR USUARIOS
    public function index()
    {
        $data = [
            'titulo'   => 'Hotéis Viña del Sur - Gestión de Usuarios',
            'usuarios' => $this->usuarioModel->orderBy('nombres_completos', 'ASC')->findAll(),
        ];

        return view('usuarios/listar_usuarios', $data);
    }

    // ▶️ MOSTRAR FORMULARIO (crear o editar)
    public function form($id = null)
    {
        $usuario = null;
        if ($id) {
            $usuario = $this->usuarioModel->find($id);
            if (!$usuario) {
                return redirect()->to('/usuarios')->with('error', 'Usuario no encontrado.');
            }
        }

        $data = [
            'titulo'  => $id ? 'Editar Usuario' : 'Nuevo Usuario',
            'usuario' => $usuario,
            'roles'   => ['admin' => 'Administrador', 'recepcion' => 'Recepción', 'limpieza' => 'Limpieza', 'usuario' => 'Usuario'],
            'estados' => ['activo' => 'Activo', 'inactivo' => 'Inactivo'],
        ];

        return view('usuarios/form_usuario', $data);
    }

    // ▶️ GUARDAR (crear o actualizar)
   // ▶️ GUARDAR (crear o actualizar)
public function guardar()
{
    $id = $this->request->getPost('id');

    // Reglas de validación (más estrictas)
    $rules = [
        'nombre' => [
            'label' => 'Nombre de usuario',
            'rules' => 'required|min_length[3]|max_length[20]|is_unique[usuario.nombre,id,' . ($id ?: '') . ']',
            'errors' => [
                'required' => 'El {field} es obligatorio.',
                'min_length' => 'El {field} debe tener al menos 3 caracteres.',
                'max_length' => 'El {field} no puede exceder 20 caracteres.',
                'is_unique' => 'Este {field} ya está en uso.',
            ]
        ],
        'nombres_completos' => [
            'label' => 'Nombre completo',
            'rules' => 'required|min_length[3]|max_length[100]',
            'errors' => [
                'required' => 'El {field} es obligatorio.',
                'min_length' => 'El {field} debe tener al menos 3 caracteres.',
                'max_length' => 'El {field} no puede exceder 100 caracteres.',
            ]
        ],
        'rol' => [
            'label' => 'Rol',
            'rules' => 'required|in_list[admin,recepcion,limpieza,usuario]',
            'errors' => [
                'required' => 'El {field} es obligatorio.',
                'in_list' => 'El {field} seleccionado no es válido.',
            ]
        ],
        'estado' => [
            'label' => 'Estado',
            'rules' => 'required|in_list[activo,inactivo]',
            'errors' => [
                'required' => 'El {field} es obligatorio.',
                'in_list' => 'El {field} seleccionado no es válido.',
            ]
        ],
    ];

    // Validar email solo si se envía
    if ($this->request->getPost('email')) {
        $rules['email'] = [
            'label' => 'Email',
            'rules' => 'valid_email|is_unique[usuario.email,id,' . ($id ?: '') . ']',
            'errors' => [
                'valid_email' => 'El formato del {field} no es válido.',
                'is_unique' => 'Este {field} ya está registrado.',
            ]
        ];
    }

    // Validar contraseña solo si se está creando o cambiando
    if (!$id || $this->request->getPost('password')) {
        $rules['password'] = [
            'label' => 'Contraseña',
            'rules' => 'required|min_length[6]',
            'errors' => [
                'required' => 'La {field} es obligatoria.',
                'min_length' => 'La {field} debe tener al menos 6 caracteres.',
            ]
        ];
    }

    // Ejecutar validación
    if (!$this->validate($rules)) {
        // Devuelve al formulario con errores
        return redirect()->back()->withInput()->with('validation', $this->validator);
    }

    // Preparar datos para guardar
    $data = [
        'nombre'           => $this->request->getPost('nombre'),
        'nombres_completos'=> $this->request->getPost('nombres_completos'),
        'email'            => $this->request->getPost('email') ?: null,
        'telefono'         => $this->request->getPost('telefono') ?: null,
        'rol'              => $this->request->getPost('rol'),
        'estado'           => $this->request->getPost('estado'),
    ];

    // Encriptar contraseña si se envía
    $password = $this->request->getPost('password');
    if ($password) {
        $data['pass'] = password_hash($password, PASSWORD_DEFAULT);
    }

    // Guardar
    if ($id) {
        $this->usuarioModel->update($id, $data);
        $mensaje = 'Usuario actualizado correctamente.';
    } else {
        $this->usuarioModel->insert($data);
        $mensaje = 'Usuario creado correctamente.';
    }

    return redirect()->to('/usuarios')->with('mensaje', $mensaje);
}

    // ▶️ ELIMINAR (desactivar)
    public function eliminar($id)
    {
        $this->usuarioModel->update($id, ['estado' => 'inactivo']);
        return redirect()->to('/usuarios')->with('mensaje', 'Usuario desactivado correctamente.');
    }
}