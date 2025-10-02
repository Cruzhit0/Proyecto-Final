<?php

namespace App\Models;

use CodeIgniter\Model;

class HuespedModel extends Model
{
    protected $table = 'huesped';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'usuario_id', 'nombres', 'apellidos', 'doc_identidad',
        'direccion', 'lugar_origen_id', 'fecha_nacimiento',
        'fecha_conversion_a_huesped'
    ];
    protected $returnType = 'object';
    protected $useTimestamps = false;
}