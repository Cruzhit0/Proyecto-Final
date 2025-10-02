<?php

namespace App\Models;

use CodeIgniter\Model;

class EstanciaModel extends Model
{
    protected $table = 'estancia';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'reserva_id',
        'huesped_id',
        'fecha_checkin',
        'fecha_checkout',
        'estado',
        'monto_final',
        'observaciones'
    ];
    protected $returnType = 'object';
    protected $useTimestamps = false;

    // Obtener estancias activas (checkin u ocupada) con datos del huésped y habitación
    public function obtenerEstanciasActivasConDetalles($fecha = null)
    {
        $fecha = $fecha ?: date('Y-m-d');

        return $this->db->table('estancia e')
        ->select('
            e.*,
            h.nombres as huesped_nombres,
            h.apellidos as huesped_apellidos,
            h.doc_identidad,
            h.direccion,
            r.fecha_inicio,
            r.fecha_fin,
            hab.numero_habitacion,
            th.nombre as tipo_habitacion,
            lo.pais,
            lo.ciudad
            ')
        ->join('huesped h', 'h.id = e.huesped_id')
        ->join('reserva r', 'r.id = e.reserva_id')
        ->join('habitacion hab', 'hab.id = r.habitacion_id')
        ->join('tipo_habitacion th', 'th.id = hab.tipo_habitacion_id')
        ->join('lugar_origen lo', 'lo.id = h.lugar_origen_id', 'left')
        ->whereIn('e.estado', ['checkin', 'ocupada'])
        ->where("DATE(e.fecha_checkin) <= '$fecha'")
        ->where("(e.fecha_checkout IS NULL OR DATE(e.fecha_checkout) > '$fecha')")
        ->orderBy('e.fecha_checkin', 'DESC')
        ->get()->getResult();
    }
}