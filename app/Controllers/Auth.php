<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Session\Session;

class Auth extends Controller
{
    public function logout()
    {
        // Obtener la sesión
        $session = session();

        // Destruir todos los datos de sesión
        $session->destroy();

        // Redirigir a la página principal (home)
        return redirect()->to(base_url('/'))->with('info', 'Has cerrado sesión correctamente.');
    }
}