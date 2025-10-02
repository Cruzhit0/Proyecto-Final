<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservaModel extends Model
{
    protected $table = 'reserva';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'usuario_id',
        'habitacion_id', // ← ¡FALTABA! ¡CRÍTICO!
        'fecha_inicio',
        'fecha_fin',
        'cantidad_personas',
        'estado',
        'monto_total',
        'descuento_aplicado',
        'metodo_pago',
        'fecha_reserva',
        'fecha_confirmacion',
        'fecha_pago',
        'notas_admin'
    ];
    protected $useTimestamps = false;
    protected $returnType = 'object'; // ← Siempre devuelve objetos

    /**
     * Obtener reservas con detalles: usuario + habitación + tipo_habitacion
     * Si se pasa $id, devuelve un solo objeto. Si no, devuelve array de objetos.
     */
   public function obtenerConDetalles($id = null)
{
    $builder = $this->db->table('reserva r')
        ->select('
            r.*,
            u.nombres_completos as nombre_usuario,
            u.email as usuario_email,
            h.numero_habitacion,
            h.piso,
            th.nombre as tipo_habitacion,
            th.precio_noche,
            hs.nombres as huesped_nombres,
            hs.apellidos as huesped_apellidos,
            hs.doc_identidad
        ')
        ->join('usuario u', 'u.id = r.usuario_id', 'left')
        ->join('habitacion h', 'h.id = r.habitacion_id', 'left')
        ->join('tipo_habitacion th', 'th.id = h.tipo_habitacion_id', 'left')
        ->join('huesped hs', 'hs.usuario_id = r.usuario_id', 'left');

    if ($id) {
        $builder->where('r.id', $id);
        $reserva = $builder->get()->getRow();

        if (!$reserva) return null;

        // Cargar servicios
        $servicios = $this->db->table('reserva_servicio rs')
            ->select('rs.*, s.nombre as servicio_nombre, s.unidad_medida')
            ->join('servicio s', 's.id = rs.servicio_id', 'left')
            ->where('rs.reserva_id', $reserva->id)
            ->get()->getResult();
        $reserva->servicios = $servicios;

        // Verificar si hay estancia (para check-out tardío)
        $estancia = $this->db->table('estancia e')
            ->where('e.reserva_id', $reserva->id)
            ->get()->getRow();

        $reserva->estancia = $estancia;

        // Calcular recargo por check-out tardío (si aplica)
        $horaLimiteCheckout = '12:00:00'; // Configurable
        $recargoCheckOutTardio = 0.00;
        $aplicaRecargo = false;

        if ($estancia && $estancia->fecha_checkout) {
            $fechaCheckout = new \DateTime($estancia->fecha_checkout);
            $horaCheckout = $fechaCheckout->format('H:i:s');
            $fechaCheckoutSinHora = $fechaCheckout->format('Y-m-d');

            // Fecha esperada de checkout (fecha_fin de la reserva)
            $fechaEsperadaCheckout = new \DateTime($reserva->fecha_fin . ' ' . $horaLimiteCheckout);

            // Si se pasó de la hora límite del día de checkout esperado
            if ($fechaCheckout > $fechaEsperadaCheckout) {
                $aplicaRecargo = true;
                // Cobrar un día adicional
                $recargoCheckOutTardio = $reserva->tipo_habitacion_precio_noche ?? $reserva->precio_noche;
            }
        }

        $reserva->recargo_check_out_tardio = $recargoCheckOutTardio;
        $reserva->aplica_recargo_checkout = $aplicaRecargo;

        // Obtener pagos (simulado: en este sistema, el pago está en la misma reserva)
        // En sistemas más avanzados, tendrías una tabla 'pago' separada
        $reserva->pago = [
            'metodo' => $reserva->metodo_pago,
            'fecha' => $reserva->fecha_pago,
            'monto_pagado' => $reserva->monto_total - ($reserva->recargo_check_out_tardio ?? 0),
            'descuento_aplicado' => $reserva->descuento_aplicado,
        ];

        return $reserva;
    }

    // Listado múltiple (sin tantos detalles)
    return $builder->orderBy('r.fecha_reserva', 'DESC')->get()->getResult();
}

    /**
     * Verifica si existe solapamiento de fechas para una habitación (reservas activas o pendientes)
     * ¡Este es el método principal para validar disponibilidad!
     */
    public function existeSolapamiento($habitacionId, $fechaInicio, $fechaFin)
    {
        return $this->where('habitacion_id', $habitacionId)
            ->whereIn('estado', ['confirmada', 'pendiente']) // Solo reservas activas
            ->groupStart()
                ->where('fecha_inicio <', $fechaFin)   // La reserva existente empieza antes del fin solicitado
                ->where('fecha_fin >', $fechaInicio)   // La reserva existente termina después del inicio solicitado
            ->groupEnd()
            ->countAllResults() > 0;
    }

    /**
     * [DEPRECATED] Usar existeSolapamiento() en su lugar.
     * Verificar si la habitación está disponible en el rango de fechas.
     * Se mantiene por compatibilidad, pero redirige al nuevo método.
     */
    public function estaHabitacionDisponible($habitacionId, $fechaInicio, $fechaFin)
    {
        return !$this->existeSolapamiento($habitacionId, $fechaInicio, $fechaFin);
    }

    /**
     * Placeholder: Verificar disponibilidad de servicio por horario
     * Implementar lógica usando tabla `disponibilidad_servicio`
     * Por ahora siempre retorna true.
     */
    public function estaServicioDisponible($servicioId, $fechaUso, $horaInicio, $duracionMinutos)
    {
        // TODO: Implementar validación contra `disponibilidad_servicio`
        // Considerar: día de la semana, horario, intervalos, etc.
        return true;
    }
}