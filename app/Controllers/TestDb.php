<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class TestDb extends Controller
{
    public function index()
    {
        try {
            $db = Database::connect();
            // Ejecutar una consulta simple
            $query = $db->query("SELECT DATABASE() AS db");
            $row = $query->getRow();

            echo "✅ Conexión exitosa a la base de datos: " . $row->db;
        } catch (\Exception $e) {
            echo "❌ Error de conexión: " . $e->getMessage();
        }
    }
}
