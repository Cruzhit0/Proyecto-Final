<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-success text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-receipt me-2"></i> Recibo de Check-out
                        </h4>
                        <a href="<?= base_url("index.php/checkout/recibo/{$detalle->estancia_id}?imprimir=1") ?>" target="_blank" class="btn btn-light btn-sm">
                            <i class="fas fa-print me-1"></i> Imprimir
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h2 class="text-success mb-1">HOTEL VIÑA DEL SUR</h2>
                        <p class="text-muted mb-3">Tarija · Bolivia · 📞 +591 XXX XXX</p>
                        <div class="bg-light p-3 rounded">
                            <p class="mb-1"><strong>Recibo N°:</strong> <span class="fw-bold"><?= $recibo->numero_recibo ?></span></p>
                            <p class="mb-0"><strong>Fecha de Emisión:</strong> <?= date('d/m/Y H:i', strtotime($recibo->fecha_emision)) ?></p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="bg-light p-3 rounded">
                                <h6 class="text-primary mb-2">Huésped</h6>
                                <p class="mb-1"><strong>Nombre:</strong> <?= esc($detalle->huesped_nombres . ' ' . $detalle->huesped_apellidos) ?></p>
                                <p class="mb-0"><strong>Documento:</strong> <?= esc($detalle->doc_identidad) ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light p-3 rounded">
                                <h6 class="text-primary mb-2">Estadía</h6>
                                <p class="mb-1"><strong>Habitación:</strong> H<?= $detalle->numero_habitacion ?> (<?= $detalle->tipo_habitacion ?>)</p>
                                <p class="mb-0"><strong>Check-in/out:</strong> <?= date('d/m/Y', strtotime($detalle->fecha_checkin)) ?> - <?= date('d/m/Y', strtotime($detalle->fecha_checkout)) ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive mb-4">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th width="70%">Descripción</th>
                                    <th width="30%" class="text-end">Monto (Bs.)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Tarifa Base (<?= $detalle->noches ?> noches)</strong></td>
                                    <td class="text-end"><?= number_format($detalle->monto_base, 2) ?></td>
                                </tr>
                                <?php foreach ($detalle->servicios_reservados as $sr): ?>
                                    <tr>
                                        <td><?= esc($sr->nombre) ?> <?= $sr->duracion_horas ? "({$sr->duracion_horas}h)" : "(x{$sr->cantidad})" ?></td>
                                        <td class="text-end"><?= number_format($sr->subtotal, 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php foreach ($detalle->consumos_estancia as $ce): ?>
                                    <tr>
                                        <td><?= esc($ce->nombre) ?> <?= $ce->duracion_horas ? "({$ce->duracion_horas}h)" : "(x{$ce->cantidad})" ?><br>
                                            <small class="text-muted">Registrado: <?= date('d/m H:i', strtotime($ce->fecha_hora_consumo)) ?></small>
                                        </td>
                                        <td class="text-end"><?= number_format($ce->subtotal, 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="table-success">
                                    <td class="fw-bold fs-5">TOTAL PAGADO</td>
                                    <td class="text-end fw-bold fs-5">Bs. <?= number_format($recibo->monto_total, 2) ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="text-center p-3 bg-light rounded">
                        <p class="mb-1"><strong>Método de Pago:</strong> <?= ucfirst($recibo->metodo_pago) ?></p>
                        <p class="text-muted mb-0">¡Gracias por elegirnos! Esperamos verte pronto de nuevo. 🌿</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>