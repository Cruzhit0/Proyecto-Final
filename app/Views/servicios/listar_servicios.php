<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-concierge-bell"></i> Gestión de Servicios</h2>
        <a href="<?= base_url('servicios/form') ?>" class="btn btn-success">
            <i class="fas fa-plus"></i> Nuevo Servicio
        </a>
    </div>

    <!-- Mensajes Flash -->
    <?php if (session()->has('mensaje')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session('mensaje') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Tabla de Servicios -->
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio (BOB)</th>
                    <th>Unidad</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($servicios as $servicio): ?>
                <tr>
                    <td><?= $servicio->id ?></td>
                    <td><?= esc($servicio->nombre) ?></td>
                    <td><?= esc(substr($servicio->descripcion, 0, 50)) ?>...</td>
                    <td><?= number_format($servicio->precio_unitario, 2) ?></td>
                    <td><?= ucfirst($servicio->unidad_medida) ?></td>
                    <td>
                        <span class="badge bg-<?= $servicio->activo ? 'success' : 'secondary' ?>">
                            <?= $servicio->activo ? 'Activo' : 'Inactivo' ?>
                        </span>
                    </td>
                    <td>
                        <a href="<?= base_url("servicios/form/{$servicio->id}") ?>" 
                           class="btn btn-sm btn-warning me-1" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?= base_url("servicios/eliminar/{$servicio->id}") ?>" 
                           class="btn btn-sm btn-danger" title="Eliminar"
                           onclick="return confirm('¿Está seguro? Esta acción no se puede deshacer.')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>