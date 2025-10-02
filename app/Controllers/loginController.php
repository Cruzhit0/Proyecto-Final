<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class LoginController extends Controller
{
    protected $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
    }

    // Muestra el formulario de login (responde a GET /login)
    public function index()
    {
        $data['error'] = session()->getFlashdata('error');
        return view('usuarios/iniciar_sesion', $data);
    }

    // Procesa el login (responde a POST /login/autenticar)
    public function autenticar()
    {
         $nombre = $this->request->getPost('nombre');
    $contrasena = $this->request->getPost('contrasena');

    $usuario = $this->usuarioModel->login($nombre, $contrasena);



     

        if ($usuario) {
              // ✅ Guardar en sesión de CodeIgniter (NO usar $_SESSION)
        session()->set('usuario', $usuario);
        session()->set('isLoggedIn', true); // Opcional, para más control
            // Actualiza última conexión
            $this->usuarioModel->actualizarUltimaConexion($usuario->id);

            // Crea sesión
            session()->set([
                'id' => $usuario->id,
                'nombre_usuario' => $usuario->nombre,
                'nombres_completos' => $usuario->nombres_completos,
                'rol' => $usuario->rol,
                'isLoggedIn' => true
            ]);

            // Redirige según rol
            switch ($usuario->rol) {
                case 'admin':
                    return redirect()->to('/panel/admin');
                case 'recepcion':
                    return redirect()->to('/panel/admin');
                case 'limpieza':
                    return redirect()->to('/panel/admin');
                default:
                    return redirect()->to('/panel');
            }
        } else {
            // Login fallido
            return redirect()->back()->with('error', 'Usuario o contraseña incorrectos, o cuenta inactiva.');
        }
    }
}




