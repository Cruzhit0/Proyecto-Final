<?php

namespace App\Models;

use CodeIgniter\Model;

class LugarOrigenModel extends Model
{
    protected $table = 'lugar_origen';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pais', 'ciudad', 'codigo_pais'];
    protected $returnType = 'object';
    protected $useTimestamps = false;
}