<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recibo de Check-out - Hotel Viña del Sur</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            margin: 20px; 
            background: white; 
        }
        .container { max-width: 800px; margin: 0 auto; }
        .header { 
            text-align: center; 
            margin-bottom: 30px; 
            padding-bottom: 20px; 
            border-bottom: 3px double #2c3e50; 
        }
        .hotel-name { 
            font-size: 28px; 
            font-weight: 800; 
            color: #2c3e50; 
            letter-spacing: 1px; 
            margin: 0; 
        }
        .subtitle { 
            font-size: 16px; 
            color: #7f8c8d; 
            margin: 5px 0; 
        }
        .receipt-info { 
            background: #f8f9fa; 
            padding: 15px; 
            border-radius: 8px; 
            margin: 20px 0; 
            text-align: center; 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin: 25px 0; 
            font-size: 14px; 
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 12px; 
            text-align: left; 
        }
        th { 
            background-color: #2c3e50; 
            color: white; 
            font-weight: 600; 
        }
        .total-row { 
            background-color: #e8f5e8 !important; 
            font-weight: 700; 
        }
        .footer { 
            text-align: center; 
            margin-top: 50px; 
            padding-top: 20px; 
            border-top: 1px solid #eee; 
            color: #666; 
            font-size: 14px; 
        }
        .section { 
            margin-bottom: 30px; 
            padding: 20px; 
            background: #f8f9fa; 
            border-radius: 8px; 
        }
        .section-title { 
            font-weight: 700; 
            color: #2c3e50; 
            margin-bottom: 15px; 
            padding-bottom: 10px; 
            border-bottom: 2px solid #3498db; 
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <div class="header">
            <div class="hotel-name">HOTEL VIÑA DEL SUR</div>
            <div class="subtitle">Tarija · Bolivia</div>
            <div class="subtitle">¡Donde la hospitalidad es un arte!</div>
        </div>

        <div class="receipt-info">
            <strong>RECIBO N°:</strong> <?= $recibo->numero_recibo ?> · 
            <strong>FECHA:</strong> <?= date('d/m/Y H:i', strtotime($recibo->fecha_emision)) ?>
        </div>

        <div class="section">
            <div class="section-title">Datos del Huésped</div>
            <p><strong>Nombre:</strong> <?= esc($detalle->huesped_nombres . ' ' . $detalle->huesped_apellidos) ?></p>
            <p><strong>Documento:</strong> <?= esc($detalle->doc_identidad) ?></p>
            <p><strong>Habitación:</strong> H<?= $detalle->numero_habitacion ?> (<?= $detalle->tipo_habitacion ?>)</p>
            <p><strong>Estadía:</strong> <?= date('d/m/Y', strtotime($detalle->fecha_checkin)) ?> a <?= date('d/m/Y', strtotime($detalle->fecha_checkout)) ?> (<?= $detalle->noches ?> noches)</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Descripción del Servicio</th>
                    <th style="text-align: right;">Monto (Bs.)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Tarifa Base de Habitación (<?= $detalle->noches ?> noches)</strong></td>
                    <td style="text-align: right;"><?= number_format($detalle->monto_base, 2) ?></td>
                </tr>
                <?php foreach ($detalle->servicios_reservados as $sr): ?>
                    <tr>
                        <td><?= esc($sr->nombre) ?> <?= $sr->duracion_horas ? "({$sr->duracion_horas} horas)" : "(x{$sr->cantidad} unidades)" ?></td>
                        <td style="text-align: right;"><?= number_format($sr->subtotal, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php foreach ($detalle->consumos_estancia as $ce): ?>
                    <tr>
                        <td><?= esc($ce->nombre) ?> <?= $ce->duracion_horas ? "({$ce->duracion_horas} horas)" : "(x{$ce->cantidad} unidades)" ?><br>
                            <small>Registrado: <?= date('d/m/Y H:i', strtotime($ce->fecha_hora_consumo)) ?></small>
                        </td>
                        <td style="text-align: right;"><?= number_format($ce->subtotal, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td><strong>TOTAL PAGADO</strong></td>
                    <td style="text-align: right;"><strong>Bs. <?= number_format($recibo->monto_total, 2) ?></strong></td>
                </tr>
            </tfoot>
        </table>

        <div class="section">
            <div class="section-title">Detalles de Pago</div>
            <p><strong>Método de Pago:</strong> <?= ucfirst($recibo->metodo_pago) ?></p>
            <p><strong>Atendido por:</strong> <?= esc($usuario->nombres_completos ?? 'Sistema') ?></p>
        </div>

        <div class="footer">
            <p>¡Gracias por su estadía en Hotel Viña del Sur!</p>
            <p>Para consultas: info@vinadelsur.com · +591 XXX XXX</p>
            <p><?= date('Y') ?> © Hotel Viña del Sur - Sistema de Gestión Hotelera</p>
        </div>
    </div>
</body>
</html>