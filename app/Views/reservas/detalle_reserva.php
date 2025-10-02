<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Reserva #<?= $reserva->id ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .page-header { border-bottom: 2px solid #007bff; margin-bottom: 30px; }
        .section { margin-bottom: 30px; }
        .label { font-weight: bold; color: #555; }
        .badge-status {
            font-size: 0.9em;
            padding: 0.4em 0.8em;
        }
        .btn-imprimir {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
        .btn-imprimir:hover { background: #218838; }
    </style>
</head>
<body class="container py-4">
    <div class="d-flex justify-content-between align-items-center page-header">
        <h2>Detalle de Reserva #<?= $reserva->id ?></h2>
        <a href="<?= base_url("reservas/detalle/{$reserva->id}?imprimir=1") ?>" target="_blank" class="btn-imprimir">
            🖨️ Imprimir
        </a>
    </div>

    <!-- Estado -->
    <div class="section">
        <span class="badge badge-status bg-<?= $reserva->estado == 'confirmada' ? 'success' : ($reserva->estado == 'cancelada' ? 'danger' : 'warning') ?>">
            <?= ucfirst($reserva->estado) ?>
        </span>
    </div>

    <!-- Información del Huésped -->
    <div class="section">
        <h4>👤 Huésped</h4>
        <p><span class="label">Nombre:</span> <?= esc($reserva->huesped_nombres . ' ' . $reserva->huesped_apellidos) ?></p>
        <p><span class="label">Documento:</span> <?= esc($reserva->doc_identidad ?? 'N/A') ?></p>
        <p><span class="label">Email:</span> <?= esc($reserva->usuario_email) ?></p>
    </div>

    <!-- Detalles de Habitación -->
    <div class="section">
        <h4>🏨 Habitación</h4>
        <p><span class="label">Número:</span> <?= esc($reserva->numero_habitacion) ?> (Piso <?= esc($reserva->piso ?? 'N/A') ?>)</p>
        <p><span class="label">Tipo:</span> <?= esc($reserva->tipo_habitacion) ?></p>
        <p><span class="label">Fechas:</span> <?= date('d/m/Y', strtotime($reserva->fecha_inicio)) ?> a <?= date('d/m/Y', strtotime($reserva->fecha_fin)) ?></p>
    </div>

    <!-- Servicios Reservados -->
    <div class="section">
        <h4>🛎️ Servicios Reservados</h4>
        <?php if (!empty($reserva->servicios)): ?>
            <table class="table table-sm table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Servicio</th>
                        <th>Cantidad</th>
                        <th>Duración</th>
                        <th>Subtotal (BOB)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reserva->servicios as $servicio): ?>
                        <tr>
                            <td><?= esc($servicio->servicio_nombre) ?></td>
                            <td><?= $servicio->cantidad ?></td>
                            <td><?= $servicio->duracion_horas ? $servicio->duracion_horas . ' horas' : 'N/A' ?></td>
                            <td><?= number_format($servicio->subtotal, 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-muted">No se han reservado servicios adicionales.</p>
        <?php endif; ?>
    </div>

    <!-- Pagos -->
    <div class="section">
        <h4>💳 Información de Pago</h4>
        <p><span class="label">Método:</span> <?= esc(ucfirst($reserva->pago['metodo'])) ?></p>
        <p><span class="label">Fecha de Pago:</span> <?= $reserva->pago['fecha'] ? date('d/m/Y H:i', strtotime($reserva->pago['fecha'])) : 'Pendiente' ?></p>
        <p><span class="label">Descuento Aplicado:</span> <?= $reserva->pago['descuento_aplicado'] ?>%</p>
        <p><span class="label">Monto Pagado:</span> <?= number_format($reserva->pago['monto_pagado'], 2) ?> BOB</p>
    </div>

    <!-- Check-out Tardío -->
    <?php if ($reserva->aplica_recargo_checkout): ?>
        <div class="section alert alert-warning">
            <h4>⚠️ Recargo por Check-out Tardío</h4>
            <p>El huésped realizó el check-out después de la hora límite (<?= $horaLimiteCheckout ?>).</p>
            <p><strong>Recargo aplicado:</strong> <?= number_format($reserva->recargo_check_out_tardio, 2) ?> BOB (1 día adicional)</p>
        </div>
    <?php endif; ?>

    <!-- Total Final -->
    <div class="section border-top pt-3">
        <h4>💰 Monto Total Final</h4>
        <h2 class="text-success">
            <?= number_format(($reserva->monto_total ?? 0) + ($reserva->recargo_check_out_tardio ?? 0), 2) ?> BOB
        </h2>
    </div>
</body>
</html>