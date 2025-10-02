<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CheckoutModel;
use App\Models\EstanciaModel;

class CheckoutController extends Controller
{
    protected $checkoutModel;
    protected $estanciaModel;

    public function __construct()
    {
        $this->checkoutModel = new CheckoutModel();
        $this->estanciaModel = new EstanciaModel();

        if (!session()->has('usuario')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión.');
        }
    }

    // ▶️ Listado de huéspedes para check-out
    public function index()
    {
        $estancias = $this->estanciaModel->obtenerEstanciasActivasConDetalles();
        $data = [
            'titulo' => 'Check-out de Huéspedes',
            'estancias' => $estancias,
            'usuario' => session()->get('usuario'),
        ];
        return view('checkout/seleccion_estancia', $data);
    }

    // ▶️ Detalle de consumos y formulario de pago
    public function detalle($estanciaId)
    {
        $detalle = $this->checkoutModel->obtenerDetalleCheckout($estanciaId);
        if (!$detalle) {
            return redirect()->to('/checkout')->with('error', 'Estancia no encontrada.');
        }

        $data = [
            'titulo' => 'Detalle de Check-out - H' . $detalle->numero_habitacion,
            'detalle' => $detalle,
            'usuario' => session()->get('usuario'),
        ];
        return view('checkout/detalle_checkout', $data);
    }

    // ▶️ Procesar pago y finalizar check-out
    public function procesar($estanciaId)
    {
        $metodoPago = $this->request->getPost('metodo_pago');
        $montoPagado = (float) $this->request->getPost('monto_pagado');

        if (!in_array($metodoPago, ['efectivo', 'tarjeta', 'transferencia'])) {
            return redirect()->back()->with('error', 'Método de pago no válido.');
        }

        try {
            if ($this->checkoutModel->procesarCheckout($estanciaId, $metodoPago, $montoPagado)) {
                return redirect()->to("/checkout/recibo/{$estanciaId}")
                    ->with('mensaje', 'Check-out procesado correctamente. ¡Gracias por su estadía!');
            } else {
                throw new \Exception('No se pudo procesar el check-out.');
            }
        } catch (\Exception $e) {
            log_message('error', 'Error en check-out: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    // ▶️ Mostrar recibo
    public function recibo($estanciaId)
    {
        $detalle = $this->checkoutModel->obtenerDetalleCheckout($estanciaId);
        if (!$detalle) {
            return redirect()->to('/checkout')->with('error', 'Recibo no encontrado.');
        }

        $recibo = $this->db->table('recibo')->where('estancia_id', $estanciaId)->get()->getRow();
        if (!$recibo) {
            return redirect()->to('/checkout')->with('error', 'Recibo no generado.');
        }

        $data = [
            'titulo' => 'Recibo de Check-out #' . $recibo->numero_recibo,
            'detalle' => $detalle,
            'recibo' => $recibo,
            'usuario' => session()->get('usuario'),
        ];

        // Si se pide versión imprimible
        if ($this->request->getGet('imprimir') === '1') {
            return view('checkout/recibo_checkout_print', $data);
        }

        return view('checkout/recibo_checkout', $data);
    }
}