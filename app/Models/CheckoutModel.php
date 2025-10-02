<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckoutModel extends Model
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    // Obtener detalle completo de la estancia para check-out
    public function obtenerDetalleCheckout($estanciaId)
    {
        $builder = $this->db->table('estancia e')
            ->select('
                e.id as estancia_id,
                e.reserva_id,
                e.huesped_id,
                e.fecha_checkin,
                r.fecha_inicio,
                r.fecha_fin,
                h.numero_habitacion,
                th.nombre as tipo_habitacion,
                th.precio_noche,
                hu.nombres as huesped_nombres,
                hu.apellidos as huesped_apellidos,
                hu.doc_identidad
            ')
            ->join('reserva r', 'r.id = e.reserva_id')
            ->join('habitacion h', 'h.id = r.habitacion_id')
            ->join('tipo_habitacion th', 'th.id = h.tipo_habitacion_id')
            ->join('huesped hu', 'hu.id = e.huesped_id')
            ->where('e.id', $estanciaId);

        $estancia = $builder->get()->getRow();

        if (!$estancia) {
            return null;
        }

        // Calcular noches
        $fechaInicio = new \DateTime($estancia->fecha_inicio);
        $fechaFin = new \DateTime($estancia->fecha_fin);
        $noches = max(1, $fechaInicio->diff($fechaFin)->days);

        $estancia->noches = $noches;
        $estancia->monto_base = $estancia->precio_noche * $noches;

        // Servicios reservados (antes del check-in)
        $estancia->servicios_reservados = $this->db->table('reserva_servicio rs')
            ->select('s.nombre, rs.cantidad, rs.duracion_horas, rs.subtotal, rs.fecha_hora_uso')
            ->join('servicio s', 's.id = rs.servicio_id')
            ->where('rs.reserva_id', $estancia->reserva_id)
            ->get()->getResult();

        // Consumos durante estancia
        $estancia->consumos_estancia = $this->db->table('consumo_estancia ce')
            ->select('s.nombre, ce.cantidad, ce.duracion_horas, ce.subtotal, ce.fecha_hora_consumo, u.nombres_completos as registrado_por')
            ->join('servicio s', 's.id = ce.servicio_id')
            ->join('usuario u', 'u.id = ce.registrado_por')
            ->where('ce.estancia_id', $estanciaId)
            ->orderBy('ce.fecha_hora_consumo', 'ASC')
            ->get()->getResult();

        // Totales
        $totalReservados = array_sum(array_column($estancia->servicios_reservados, 'subtotal'));
        $totalConsumos = array_sum(array_column($estancia->consumos_estancia, 'subtotal'));

        $estancia->total_reservados = $totalReservados;
        $estancia->total_consumos = $totalConsumos;
        $estancia->monto_total = $estancia->monto_base + $totalReservados + $totalConsumos;

        // Pagos previos (monto de la reserva)
        $reserva = $this->db->table('reserva')->where('id', $estancia->reserva_id)->get()->getRow();
        $estancia->pagos_previos = $reserva ? $reserva->monto_total : 0;
        $estancia->saldo_pendiente = max(0, $estancia->monto_total - $estancia->pagos_previos);

        return $estancia;
    }

    // Procesar check-out
    public function procesarCheckout($estanciaId, $metodoPago, $montoPagado)
    {
        $this->db->transStart();

        try {
            $estancia = $this->db->table('estancia')->where('id', $estanciaId)->get()->getRow();
            if (!$estancia) {
                throw new \Exception('Estancia no encontrada.');
            }

            $reserva = $this->db->table('reserva')->where('id', $estancia->reserva_id)->get()->getRow();
            if (!$reserva) {
                throw new \Exception('Reserva no encontrada.');
            }

            // Actualizar estancia
            $this->db->table('estancia')->where('id', $estanciaId)->update([
                'fecha_checkout' => date('Y-m-d H:i:s'),
                'estado' => 'checkout',
                'monto_final' => $montoPagado
            ]);

            // Actualizar habitación → limpieza
            $this->db->table('habitacion')->where('id', $reserva->habitacion_id)->update([
                'estado' => 'limpieza'
            ]);

            // Actualizar reserva → finalizada
            $this->db->table('reserva')->where('id', $estancia->reserva_id)->update([
                'estado' => 'finalizada'
            ]);

            // Generar recibo
            $numeroRecibo = 'REC-' . date('Y') . '-' . str_pad($estanciaId, 5, '0', STR_PAD_LEFT);
            $this->db->table('recibo')->insert([
                'estancia_id' => $estanciaId,
                'numero_recibo' => $numeroRecibo,
                'monto_total' => $montoPagado,
                'metodo_pago' => $metodoPago,
                'fecha_emision' => date('Y-m-d H:i:s')
            ]);

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \Exception('Error en la transacción.');
            }

            return true;

        } catch (\Exception $e) {
            $this->db->transRollback();
            throw $e;
        }
    }
}