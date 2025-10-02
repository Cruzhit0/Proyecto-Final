<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="fas fa-users me-2"></i> Listado Diario de Huéspedes
        </h2>
        <a href="<?= base_url('index.php/checkin') ?>" class="btn btn-success">
            <i class="fas fa-plus me-2"></i> Nuevo Check-in
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-body">
            <form method="get" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="fecha" class="form-label">Seleccionar Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?= $fecha ?>" max="<?= date('Y-m-d') ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-2"></i> Filtrar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php if (empty($estancias)): ?>
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle me-2"></i>
            No hay huéspedes registrados para esta fecha.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre Completo</th>
                        <th>Documento</th>
                        <th>Habitación</th>
                        <th>Tipo</th>
                        <th>Check-in</th>
                        <th>Check-out Estimado</th>
                        <th>Origen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($estancias as $e): ?>
                        <tr>
                            <td><?= esc($e->huesped_nombres . ' ' . $e->huesped_apellidos) ?></td>
                            <td><?= esc($e->doc_identidad) ?></td>
                            <td>H<?= esc($e->numero_habitacion) ?></td>
                            <td><?= esc($e->tipo_habitacion) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($e->fecha_checkin)) ?></td>
                            <td><?= date('d/m/Y', strtotime($e->fecha_fin)) ?></td>
                            <td>
                                <?= esc($e->pais ?? 'N/A') ?>
                                <?php if (isset($e->ciudad) && !empty($e->ciudad)): ?>
                                - <?= esc($e->ciudad) ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
</div>

<?= $this->endSection() ?>