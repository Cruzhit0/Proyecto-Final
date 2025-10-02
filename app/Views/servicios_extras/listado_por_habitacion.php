<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-gradient text-white py-3" style="background: linear-gradient(135deg, #6D071A, #8B0000);">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-list-ul me-2"></i> Consumos por Habitación
                        </h5>
                        <form method="get" class="d-flex">
                            <input type="date" class="form-control form-control-sm me-2" name="fecha" value="<?= $fecha ?>" max="<?= date('Y-m-d') ?>">
                            <button type="submit" class="btn btn-light btn-sm">Filtrar</button>
                        </form>
                    </div>
                </div>
                <div class="card-body p-4">

                    <?php if (empty($consumosPorHabitacion)): ?>
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle me-2"></i>
                            No hay consumos registrados para esta fecha.
                        </div>
                    <?php else: ?>
                        <?php foreach ($consumosPorHabitacion as $habitacion => $consumos): ?>
                            <div class="mb-5">
                                <h4 class="border-bottom pb-2 mb-3" style="color: #6D071A; border-color: #f8d7da;">
                                    <i class="fas fa-door-open me-2"></i> Habitación H<?= $habitacion ?>
                                </h4>

                                <div class="table-responsive">
                                    <table class="table table-hover table-sm">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Fecha/Hora</th>
                                                <th>Servicio</th>
                                                <th>Cantidad</th>
                                                <th>Precio Unit.</th>
                                                <th>Subtotal</th>
                                                <th>Registrado por</th>
                                                <th>Notas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $totalHabitacion = 0; ?>
                                            <?php foreach ($consumos as $c): ?>
                                                <tr>
                                                    <td class="small"><?= date('d/m H:i', strtotime($c->fecha_hora_consumo)) ?></td>
                                                    <td><strong><?= esc($c->servicio) ?></strong></td>


                                                    <td class="text-center">
                                                        <?php if (in_array($c->unidad_medida, ['hora', 'sesion'])): ?>
                                                            <!-- Servicios por tiempo -->
                                                            <div class="d-flex flex-column align-items-center">
                                                                <small class="text-muted">Horas</small>
                                                                <span class="badge bg-info px-2 py-1" style="font-size: 0.9rem;">
                                                                    <?= $c->duracion_horas ?> h
                                                                </span>
                                                            </div>
                                                        <?php else: ?>
                                                            <!-- Servicios por cantidad (plato, noche, etc.) -->
                                                            <div class="d-flex flex-column align-items-center">
                                                                <small class="text-muted">Cant.</small>
                                                                <span class="badge bg-primary px-2 py-1" style="font-size: 0.9rem;">
                                                                    <?= $c->cantidad ?>
                                                                </span>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>

                                                    <td class="text-end fw-bold text-success">
                                                        Bs. <?= number_format($c->precio_unitario, 2) ?>
                                                    </td>
                                                    <td class="text-end fw-bold">
                                                        Bs. <?= number_format($c->subtotal, 2) ?>
                                                    </td>
                                                    <td class="small"><?= esc($c->registrado_por) ?></td>
                                                    <td class="small text-muted"><?= esc($c->observaciones ?? '-') ?></td>
                                                </tr>
                                                <?php $totalHabitacion += $c->subtotal; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr class="table-success">
                                                <td colspan="4" class="text-end fw-bold">TOTAL HABITACIÓN:</td>
                                                <td class="text-end fw-bold">Bs. <?= number_format($totalHabitacion, 2) ?></td>
                                                <td colspan="2"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table th {
        font-weight: 600;
        background: #f8f9fa;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .table td {
        vertical-align: middle;
        font-size: 0.95rem;
    }
    .badge {
        font-size: 0.85rem;
        font-weight: 500;
    }
</style>

<?= $this->endSection() ?>