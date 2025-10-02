<?php

namespace App\Models;

use CodeIgniter\Model;

class HabitacionModel extends Model
{
    protected $table = 'habitacion';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'numero_habitacion',
        'tipo_habitacion_id',
        'piso',
        'estado',
        'observaciones'
    ];
    protected $returnType = 'object';
    protected $useTimestamps = false;

    // Validaciones
   protected $validationRules = [
    'numero_habitacion'  => [
        'rules'  => 'required|max_length[10]',
        'errors' => [
            'required'   => 'El número de habitación es obligatorio.',
            'max_length' => 'El número no debe exceder los 10 caracteres.',
        ],
    ],
    'tipo_habitacion_id' => 'required|integer|greater_than[0]',
    'piso'               => 'permit_empty|integer',
    'estado'             => "in_list[disponible,ocupada,mantenimiento,reservada]",
];

    protected $validationMessages = [
        'numero_habitacion' => [
            'required'   => 'El número de habitación es obligatorio.',
            'is_unique'  => 'Ya existe una habitación con ese número.',
            'max_length' => 'El número no debe exceder los 10 caracteres.',
        ],
        'tipo_habitacion_id' => [
            'required'     => 'Debe seleccionar un tipo de habitación.',
            'integer'      => 'Tipo inválido.',
            'greater_than' => 'Tipo inválido.',
        ],
        'estado' => [
            'in_list' => 'Estado no válido.',
        ],
    ];

    protected $skipValidation = false;

    // ▶️ Relación con tipo_habitacion
    public function getHabitacionesConTipo()
    {
        return $this->select('
            habitacion.*,
            tipo_habitacion.nombre as tipo_nombre,
            tipo_habitacion.descripcion as descripcion_tipo,
            tipo_habitacion.capacidad_maxima,
            tipo_habitacion.precio_noche
        ')
        ->join('tipo_habitacion', 'tipo_habitacion.id = habitacion.tipo_habitacion_id', 'left')
        ->findAll();
    }

    public function getHabitacionConTipo($id)
    {
        return $this->select('
            habitacion.*,
            tipo_habitacion.nombre as tipo_nombre,
            tipo_habitacion.descripcion as descripcion_tipo,
            tipo_habitacion.capacidad_maxima,
            tipo_habitacion.precio_noche
        ')
        ->join('tipo_habitacion', 'tipo_habitacion.id = habitacion.tipo_habitacion_id', 'left')
        ->find($id);
    }

    // ▶️ Obtener habitaciones disponibles en rango de fechas
    public function obtenerDisponiblesPorFechas($fechaInicio, $fechaFin)
    {
        $fechaInicio = date('Y-m-d', strtotime($fechaInicio));
        $fechaFin = date('Y-m-d', strtotime($fechaFin));

        $subquery = $this->db->table('reserva r')
            ->select('r.habitacion_id')
            ->where('r.fecha_inicio <', $fechaFin)
            ->where('r.fecha_fin >', $fechaInicio)
            ->getCompiledSelect();

        $builder = $this->db->table('habitacion h')
            ->select('
                h.*,
                th.nombre as tipo_nombre,
                th.descripcion as descripcion_tipo,
                th.capacidad_maxima,
                th.precio_noche
            ')
            ->join('tipo_habitacion th', 'th.id = h.tipo_habitacion_id', 'left')
            ->where('h.estado', 'disponible')
            ->where("h.id NOT IN ($subquery)", null, false)
            ->orderBy('h.id', 'ASC');

        return $builder->get()->getResult();
    }

    // ▶️ Verificar si una habitación específica está disponible en rango de fechas
    public function estaDisponibleEnFechas($habitacionId, $fechaInicio, $fechaFin)
    {
        $query = "
        SELECT COUNT(*) as total
        FROM reserva r
        WHERE r.habitacion_id = ?
        AND r.estado IN ('confirmada', 'pendiente')
        AND (
            (? BETWEEN r.fecha_inicio AND DATE_SUB(r.fecha_fin, INTERVAL 1 DAY)) OR
            (? BETWEEN r.fecha_inicio AND DATE_SUB(r.fecha_fin, INTERVAL 1 DAY)) OR
            (r.fecha_inicio BETWEEN ? AND DATE_SUB(?, INTERVAL 1 DAY)) OR
            (r.fecha_fin BETWEEN ? AND DATE_SUB(?, INTERVAL 1 DAY))
        )
        ";

        $result = $this->db->query($query, [
            $habitacionId,
            $fechaInicio, $fechaFin,
            $fechaInicio, $fechaFin,
            $fechaInicio, $fechaFin
        ])->getRow();

        return $result->total == 0;
    }
}