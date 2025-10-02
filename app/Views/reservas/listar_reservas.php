<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-calendar-check"></i> Gestión de Reservas</h2>
        <a href="<?= base_url('index.php/reservas/form') ?>" class="btn btn-success">
            <i class="fas fa-plus"></i> Nueva Reserva
        </a>
    </div>

    <?php if (session()->has('mensaje')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: #e6c5b7; border-color: #d3a58d; color: #6d071a;">
        <i class="fas fa-check-circle me-2"></i>
        <?= session('mensaje') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (session()->has('error')): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert" style="background: #ffebee; border-color: #d32f2f; color: #c62828;">
    <i class="fas fa-exclamation-triangle me-2"></i>
    <?= session('error') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered">
        <thead class="table-dark" style="background: linear-gradient(135deg, #8B0000, #6D071A); color: white;">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Fechas</th>
                <th>Monto (BOB)</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservas as $reserva): ?>
                <tr>
                    <td><?= $reserva->id ?></td>
                    <td><?= esc($reserva->nombre_usuario) ?></td>
                    <td>
                        <?= date('d/m/Y', strtotime($reserva->fecha_inicio)) ?> - 
                        <?= date('d/m/Y', strtotime($reserva->fecha_fin)) ?>
                    </td>
                    <td>Bs. <?= number_format($reserva->monto_total, 2) ?></td>
                    <td>
                        <span class="badge bg-<?= $reserva->estado == 'confirmada' ? 'success' : ($reserva->estado == 'pendiente' ? 'warning' : 'secondary') ?>">
                            <?= ucfirst($reserva->estado) ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($reserva->estado == 'pendiente'): ?>
                            <a href="<?= base_url("index.php/reservas/confirmar/{$reserva->id}") ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-check"></i> Confirmar
                            </a>
                        <?php endif; ?>
                        
                        <a href="<?= base_url("index.php/reservas/detalle/{$reserva->id}") ?>" class="btn btn-sm btn-info" target="_blank" title="Ver detalle en nueva pestaña">
                            <i class="fas fa-eye"></i> Detalle
                        </a>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>

<?= $this->endSection() ?>