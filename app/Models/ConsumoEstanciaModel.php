<?php

namespace App\Models;

use CodeIgniter\Model;

class ConsumoEstanciaModel extends Model
{
    protected $table = 'consumo_estancia';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'estancia_id', 'servicio_id', 'cantidad', 'duracion_horas',
        'fecha_hora_consumo', 'subtotal', 'registrado_por', 'observaciones'
    ];
    protected $returnType = 'object';
    protected $useTimestamps = false;



// Obtener consumos agrupados por habitación
    public function obtenerConsumosPorHabitacion($fecha = null)
    {
        $builder = $this->db->table('consumo_estancia ce')


        ->select('
            h.numero_habitacion,
            ce.fecha_hora_consumo,
            s.nombre as servicio,
            ce.cantidad,
            ce.duracion_horas,
            s.precio_unitario,
            s.unidad_medida,      
            ce.subtotal,
            ce.observaciones,
            u.nombres_completos as registrado_por
            ')
        ->join('estancia e', 'e.id = ce.estancia_id')
        ->join('reserva r', 'r.id = e.reserva_id')
        ->join('habitacion h', 'h.id = r.habitacion_id')
        ->join('servicio s', 's.id = ce.servicio_id')  
        ->join('usuario u', 'u.id = ce.registrado_por')
        ->orderBy('h.numero_habitacion, ce.fecha_hora_consumo', 'ASC');

        if ($fecha) {
            $builder->where('DATE(ce.fecha_hora_consumo)', $fecha);
        }

        return $builder->get()->getResult();
    }
}