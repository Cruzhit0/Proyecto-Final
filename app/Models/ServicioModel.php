<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicioModel extends Model
{
    protected $table            = 'servicio';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false; // No usamos eliminación suave
    protected $allowedFields    = [
        'nombre',
        'descripcion',
        'precio_unitario',
        'unidad_medida',
        'activo'
    ];

    // Validaciones (opcional, también se puede hacer en el controlador)
    protected $validationRules = [
        'nombre' => 'required|min_length[3]|max_length[100]',
        'precio_unitario' => 'required|numeric|greater_than_equal_to[0]',
        'unidad_medida' => 'required|in_list[noche,hora,sesion,plato]',
    ];

    protected $validationMessages = [
        'nombre' => [
            'required' => 'El nombre es obligatorio.',
            'min_length' => 'El nombre debe tener al menos 3 caracteres.',
        ],
        'precio_unitario' => [
            'required' => 'El precio es obligatorio.',
            'numeric' => 'El precio debe ser un número válido.',
            'greater_than_equal_to' => 'El precio no puede ser negativo.',
        ],
        'unidad_medida' => [
            'required' => 'La unidad de medida es obligatoria.',
            'in_list' => 'Unidad de medida no válida.',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // No usamos timestamps porque tu tabla no los tiene
    protected $useTimestamps = false;
}