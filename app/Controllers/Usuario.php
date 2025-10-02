<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Usuario extends BaseController
{
    public function index()
    {
        $usuarioModel = new UsuarioModel();

        // Obtener todos los usuarios
        $data['usuarios'] = $usuarioModel->findAll();

        // Enviar datos a la vista
        return view('usuario/lista', $data);
    }
}
