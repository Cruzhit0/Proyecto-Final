<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nombre', 'pass', 'rol', 'nombres_completos', 'email', 'telefono', 'estado', 'ultima_conexion'
    ];
    protected $returnType = 'object';

    // Método para autenticar usuario
    public function login($nombre, $contrasena)
    {
        // Busca usuario por nombre y que esté activo
        $usuario = $this->where('nombre', $nombre)
                        ->where('estado', 'activo')
                        ->first();

        // Verifica si existe y si la contraseña coincide
        if ($usuario && password_verify($contrasena, $usuario->pass)) {
            return $usuario;
        }

        return false;
    }

    // Actualiza la última conexión (opcional pero recomendado)
    public function actualizarUltimaConexion($id)
    {
        $this->update($id, ['ultima_conexion' => date('Y-m-d H:i:s')]);
    }
}