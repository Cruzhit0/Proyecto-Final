<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Login extends Controller
{
    // Muestra el formulario de login
    public function index()
    {
        return view('login/index');
    }

   
}