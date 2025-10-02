<?php
namespace App\Models;

use CodeIgniter\Model;

class TipoHabitacionModel extends Model
{
    protected $table            = 'tipo_habitacion';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false; // Si usas eliminación lógica, cámbialo a true
    protected $allowedFields    = [
        'nombre',
        'descripcion',
        'capacidad_maxima',
        'precio_noche',
        'activo'
    ];

    protected $validationRules = [
        'nombre' => [
            'label' => 'Nombre',
            'rules' => 'required|min_length[3]|max_length[100]|is_unique[tipo_habitacion.nombre,id,{id}]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio.',
                'min_length' => 'El {field} debe tener al menos 3 caracteres.',
                'max_length' => 'El {field} no puede exceder los 100 caracteres.',
                'is_unique' => 'Ya existe un tipo de habitación con ese nombre.'
            ]
        ],
        'descripcion' => [
            'label' => 'Descripción',
            'rules' => 'permit_empty|string|max_length[500]',
        ],
        'capacidad_maxima' => [
            'label' => 'Capacidad Máxima',
            'rules' => 'required|integer|greater_than[0]',
            'errors' => [
                'required' => 'La capacidad es obligatoria.',
                'integer' => 'Debe ser un número entero.',
                'greater_than' => 'Debe ser mayor a 0.'
            ]
        ],
        'precio_noche' => [
            'label' => 'Precio por Noche',
            'rules' => 'required|decimal|greater_than_equal_to[0]',
            'errors' => [
                'required' => 'El precio es obligatorio.',
                'decimal' => 'Debe ser un número válido.',
                'greater_than_equal_to' => 'El precio no puede ser negativo.'
            ]
        ],
        'activo' => [
            'label' => 'Activo',
            'rules' => 'permit_empty|in_list[0,1]',
        ],
    ];

    protected $validationMessages = [];
    protected $skipValidation     = false;
}