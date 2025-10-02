<?php
namespace App\Models;

use CodeIgniter\Model;

class ReservaServicioModel extends Model
{
    protected $table = 'reserva_servicio';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'reserva_id', 'servicio_id', 'cantidad', 'duracion_horas', 'subtotal'
    ];
    protected $returnType = 'object';
}