<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-gradient text-white py-3" style="background: linear-gradient(135deg, #2c3e50, #34495e);">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-file-invoice-dollar me-2"></i> Detalle de Check-out - H<?= $detalle->numero_habitacion ?>
                    </h4>
                </div>
                <div class="card-body p-4">

                    <!-- Datos del Huésped -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="bg-light p-3 rounded">
                                <h6 class="text-primary mb-3"><i class="fas fa-user me-2"></i> Datos del Huésped</h6>
                                <p class="mb-1"><strong>Nombre:</strong> <?= esc($detalle->huesped_nombres . ' ' . $detalle->huesped_apellidos) ?></p>
                                <p class="mb-1"><strong>Documento:</strong> <?= esc($detalle->doc_identidad) ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light p-3 rounded">
                                <h6 class="text-primary mb-3"><i class="fas fa-door-open me-2"></i> Datos de la Habitación</h6>
                                <p class="mb-1"><strong>Número:</strong> H<?= $detalle->numero_habitacion ?></p>
                                <p class="mb-1"><strong>Tipo:</strong> <?= esc($detalle->tipo_habitacion) ?></p>
                                <p class="mb-1"><strong>Check-in:</strong> <?= date('d/m/Y H:i', strtotime($detalle->fecha_checkin)) ?></p>
                                <p class="mb-0"><strong>Noches:</strong> <?= $detalle->noches ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Resumen de Consumos -->
                    <div class="bg-white border rounded p-4 mb-4">
                        <h5 class="mb-4 pb-2 border-bottom"><i class="fas fa-list-ul me-2"></i> Resumen de Consumos</h5>

                        <!-- Tarifa Base -->
                        <div class="row mb-3 align-items-center">
                            <div class="col-8">
                                <strong>Tarifa Base (<?= $detalle->noches ?> noches @ Bs. <?= number_format($detalle->precio_noche, 2) ?>/noche)</strong>
                            </div>
                            <div class="col-4 text-end">
                                <span class="badge bg-primary">Bs. <?= number_format($detalle->monto_base, 2) ?></span>
                            </div>
                        </div>

                        <!-- Servicios Reservados -->
                        <?php if (!empty($detalle->servicios_reservados)): ?>
                            <h6 class="mt-4 mb-3">Servicios Reservados</h6>
                            <?php foreach ($detalle->servicios_reservados as $sr): ?>
                                <div class="row mb-2 align-items-center">
                                    <div class="col-8">
                                        <strong><?= esc($sr->nombre) ?></strong>
                                        <?php if ($sr->duracion_horas): ?>
                                            <span class="badge bg-info ms-2"><?= $sr->duracion_horas ?>h</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary ms-2">x<?= $sr->cantidad ?></span>
                                        <?php endif; ?>
                                        <?php if ($sr->fecha_hora_uso): ?>
                                            <br><small class="text-muted">📅 <?= date('d/m H:i', strtotime($sr->fecha_hora_uso)) ?></small>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-4 text-end">
                                        <span class="badge bg-success">Bs. <?= number_format($sr->subtotal, 2) ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <!-- Consumos Durante Estancia -->
                        <?php if (!empty($detalle->consumos_estancia)): ?>
                            <h6 class="mt-4 mb-3">Consumos Durante Estancia</h6>
                            <?php foreach ($detalle->consumos_estancia as $ce): ?>
                                <div class="row mb-2 align-items-center">
                                    <div class="col-8">
                                        <strong><?= esc($ce->nombre) ?></strong>
                                        <?php if ($ce->duracion_horas): ?>
                                            <span class="badge bg-info ms-2"><?= $ce->duracion_horas ?>h</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary ms-2">x<?= $ce->cantidad ?></span>
                                        <?php endif; ?>
                                        <br><small class="text-muted">🕒 <?= date('d/m H:i', strtotime($ce->fecha_hora_consumo)) ?> · 🧑‍💼 <?= $ce->registrado_por ?></small>
                                    </div>
                                    <div class="col-4 text-end">
                                        <span class="badge bg-success">Bs. <?= number_format($ce->subtotal, 2) ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <hr class="my-4">

                        <!-- Totales -->
                        <div class="row mb-3 align-items-center">
                            <div class="col-8"><strong class="fs-5">Total a Pagar</strong></div>
                            <div class="col-4 text-end"><strong class="fs-5 text-success">Bs. <?= number_format($detalle->monto_total, 2) ?></strong></div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <div class="col-8">Pagos Previos</div>
                            <div class="col-4 text-end">Bs. <?= number_format($detalle->pagos_previos, 2) ?></div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <div class="col-8"><strong class="fs-5 text-danger">Saldo Pendiente</strong></div>
                            <div class="col-4 text-end"><strong class="fs-5 text-danger">Bs. <?= number_format($detalle->saldo_pendiente, 2) ?></strong></div>
                        </div>
                    </div>

                    <!-- Formulario de Pago -->
                    <form action="<?= base_url("index.php/checkout/procesar/{$detalle->estancia_id}") ?>" method="post" class="bg-light p-4 rounded">
                        <h5 class="mb-4"><i class="fas fa-credit-card me-2"></i> Procesar Pago</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="metodo_pago" class="form-label fw-bold">Método de Pago</label>
                                <select class="form-select form-select-lg" id="metodo_pago" name="metodo_pago" required>
                                    <option value="">Seleccione un método...</option>
                                    <option value="efectivo">Efectivo</option>
                                    <option value="tarjeta">Tarjeta</option>
                                    <option value="transferencia">Transferencia</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="monto_pagado" class="form-label fw-bold">Monto a Pagar (Bs.)</label>
                                <div class="input-group">
                                    <span class="input-group-text">Bs.</span>
                                    <input type="number" class="form-control form-control-lg" id="monto_pagado" name="monto_pagado" step="0.01" value="<?= number_format($detalle->saldo_pendiente, 2, '.', '') ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-3 mt-4">
                            <a href="<?= base_url('index.php/checkout') ?>" class="btn btn-outline-secondary btn-lg flex-fill">
                                <i class="fas fa-arrow-left me-2"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-danger btn-lg flex-fill">
                                <i class="fas fa-check-circle me-2"></i> Procesar Check-out
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>