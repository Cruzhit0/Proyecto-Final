<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Imprimir Reserva #<?= $reserva->id ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .hotel-name { font-size: 24px; font-weight: bold; color: #007bff; }
        .section { margin-bottom: 25px; }
        .label { font-weight: bold; display: inline-block; width: 180px; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f8f9fa; }
        .total { font-size: 20px; font-weight: bold; color: #28a745; text-align: right; margin-top: 20px; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #666; }
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <div class="hotel-name">Hotéis Viña del Sur</div>
        <div>DETALLE DE RESERVA #<?= $reserva->id ?></div>
        <div>Fecha de Emisión: <?= date('d/m/Y H:i') ?></div>
    </div>

    <div class="section">
        <div><span class="label">Estado:</span> <?= ucfirst($reserva->estado) ?></div>
        <div><span class="label">Huésped:</span> <?= esc($reserva->huesped_nombres . ' ' . $reserva->huesped_apellidos) ?></div>
        <div><span class="label">Documento:</span> <?= esc($reserva->doc_identidad ?? 'N/A') ?></div>
    </div>

    <div class="section">
        <div><span class="label">Habitación:</span> <?= esc($reserva->numero_habitacion) ?> (<?= esc($reserva->tipo_habitacion) ?>)</div>
        <div><span class="label">Fechas:</span> <?= date('d/m/Y', strtotime($reserva->fecha_inicio)) ?> a <?= date('d/m/Y', strtotime($reserva->fecha_fin)) ?></div>
    </div>

    <?php if (!empty($reserva->servicios)): ?>
        <div class="section">
            <strong>Servicios Reservados:</strong>
            <table>
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Cant.</th>
                        <th>Duración</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reserva->servicios as $servicio): ?>
                        <tr>
                            <td><?= esc($servicio->servicio_nombre) ?></td>
                            <td><?= $servicio->cantidad ?></td>
                            <td><?= $servicio->duracion_horas ? $servicio->duracion_horas . 'h' : '-' ?></td>
                            <td><?= number_format($servicio->subtotal, 2) ?> BOB</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <div class="section">
        <div><span class="label">Método de Pago:</span> <?= esc(ucfirst($reserva->pago['metodo'])) ?></div>
        <div><span class="label">Fecha de Pago:</span> <?= $reserva->pago['fecha'] ? date('d/m/Y H:i', strtotime($reserva->pago['fecha'])) : 'Pendiente' ?></div>
        <div><span class="label">Descuento:</span> <?= $reserva->pago['descuento_aplicado'] ?>%</div>
        <div><span class="label">Monto Pagado:</span> <?= number_format($reserva->pago['monto_pagado'], 2) ?> BOB</div>
    </div>

    <?php if ($reserva->aplica_recargo_checkout): ?>
        <div class="section">
            <div style="color: #d9534f; font-weight: bold;">
                ⚠️ Recargo por Check-out Tardío: +<?= number_format($reserva->recargo_check_out_tardio, 2) ?> BOB
            </div>
        </div>
    <?php endif; ?>

    <div class="total">
        TOTAL A PAGAR: <?= number_format(($reserva->monto_total ?? 0) + ($reserva->recargo_check_out_tardio ?? 0), 2) ?> BOB
    </div>

    <div class="footer">
        Gracias por su estadía. ¡Vuelva pronto!
        <br>
        <?= date('Y') ?> © Hotel Viña del Sur - Sistema de Gestión Hotelera
    </div>
</body>
</html>