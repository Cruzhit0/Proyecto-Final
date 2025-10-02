<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="container-fluid mt-4">
    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-0">
                <i class="fas fa-building me-2"></i> Gestión de Habitaciones
            </h2>
            <small class="text-muted">Administra el inventario de habitaciones del hotel</small>
        </div>
       <a href="<?= base_url('index.php/panel/habitaciones/nueva') ?>" class="btn btn-success btn-lg shadow-sm">
    <i class="fas fa-plus-circle me-2"></i> Nueva Habitación
</a>
    </div>

    <!-- Alertas -->
    <?php if (session()->has('mensaje')): ?>
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
            <i class="fas fa-check-circle fs-4 text-success me-3"></i>
            <div class="flex-grow-1">
                <strong>¡Operación exitosa!</strong> <?= session('mensaje') ?>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
            <i class="fas fa-exclamation-triangle fs-4 text-danger me-3"></i>
            <div class="flex-grow-1">
                <strong>Error:</strong> <?= session('error') ?>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Grid de Habitaciones -->
    <div class="row g-4">
        <?php if (!empty($habitaciones)): ?>
            <?php foreach ($habitaciones as $h): ?>
                <?php
                    // Clases de estilo según estado
                    $bgClass = 'bg-white';
                    $borderClass = 'border-0';
                    $textClass = 'text-dark';
                    switch ($h->estado) {
                        case 'disponible':
                            $bgClass = 'bg-success-subtle';
                            $textClass = 'text-success';
                            break;
                        case 'ocupada':
                            $bgClass = 'bg-danger-subtle';
                            $textClass = 'text-danger';
                            break;
                        case 'mantenimiento':
                        case 'reservada':
                            $bgClass = 'bg-light';
                            $textClass = 'text-muted opacity-75';
                            break;
                    }
                ?>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="card h-100 shadow-sm <?= $bgClass ?> border-0 rounded-4 hover-lift position-relative overflow-hidden transition-all">
                        <!-- Badge de Estado (superior izquierda) -->
                        <div class="position-absolute top-0 start-0 m-3 z-2">
                            <span class="badge rounded-pill px-3 py-2 fs-6 fw-bold text-uppercase
                                <?= $h->estado === 'disponible' ? 'bg-success text-white' : 
                                   ($h->estado === 'ocupada' ? 'bg-danger text-white' : 
                                   ($h->estado === 'reservada' ? 'bg-warning text-dark' : 'bg-secondary text-white')) ?>">
                                <?= ucfirst($h->estado) ?>
                            </span>
                        </div>

                        <!-- Contenido Principal -->
                        <div class="card-body p-4 position-relative">
                            <!-- ID de Habitación (inferior derecha) -->
                            <!-- Número de habitación en círculo guindo (llamativo) -->
<div class="position-absolute bottom-0 end-0 m-3 z-2">
    <div class="d-flex align-items-center justify-content-center rounded-circle bg-danger text-white fw-bold"
         style="width: 42px; height: 42px; font-size: 1rem; background-color: #8B0000; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        H<?= $h->numero_habitacion ?>
    </div>
</div>

                            <!-- Encabezado: Número + Precio -->
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h3 class="card-title mb-0 display-6 fw-bold <?= $textClass ?>">
                                        H<?= esc($h->numero_habitacion) ?>
                                    </h3>
                                    <p class="text-muted mb-1 small">
                                        <i class="fas fa-tag me-1"></i> <?= esc($h->tipo_nombre ?? 'Sin tipo') ?>
                                    </p>
                                </div>
                                <div class="text-end">
                                    <div class="display-6 fw-bold text-primary">
                                        Bs. <?= number_format($h->precio_noche ?? 0, 0) ?>
                                    </div>
                                    <small class="text-muted">/ noche</small>
                                </div>
                            </div>

                            <!-- Características -->
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-users me-1 text-muted fs-7"></i>
                                        <small>
                                            <strong class="ms-1"><?= $h->capacidad_maxima ?? 2 ?> pers.</strong>
                                        </small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-layer-group me-1 text-muted fs-7"></i>
                                        <small>
                                            <strong class="ms-1"><?= $h->piso ?? 'N/A' ?></strong>
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Descripción del tipo -->
                            <?php if (!empty($h->descripcion_tipo)): ?>
                                <div class="bg-white bg-opacity-75 p-3 rounded-3 mb-3">
                                    <small class="text-muted d-block mb-1 fw-bold">Características:</small>
                                    <p class="mb-0 small text-muted"><?= esc($h->descripcion_tipo) ?></p>
                                </div>
                            <?php endif; ?>

                            <!-- Botón de Edición -->
                            <div class="d-grid mt-3">
                                <a href="<?= base_url("index.php/panel/habitaciones/editar/{$h->id}") ?>" class="btn btn-outline-secondary btn-sm rounded-3">
                                    <i class="fas fa-edit me-2"></i> Editar Detalles
                                </a>
                            </div>
                        </div>

                        <!-- Observaciones (Footer) -->
                        <?php if (!empty($h->observaciones)): ?>
                            <div class="card-footer bg-white bg-opacity-50 py-3 px-4 border-0">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-info-circle me-2 text-muted"></i>
                                    <small class="text-muted flex-grow-1"><?= esc($h->observaciones) ?></small>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Mensaje cuando no hay habitaciones -->
            <div class="col-12">
                <div class="text-center py-5 bg-light rounded-4">
                    <i class="fas fa-bed display-1 text-muted mb-3"></i>
                    <h4 class="text-muted fw-bold">No hay habitaciones registradas</h4>
                    <p class="text-muted mb-4">Comienza creando tu primera habitación para gestionar reservas.</p>
                    <a href="<?= base_url('index.php/habitaciones/form') ?>" class="btn btn-primary btn-lg px-5">
                        <i class="fas fa-plus me-2"></i> Crear Habitación
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Estilos Personalizados -->
<style>
.hover-lift {
    transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}
.hover-lift:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
}
.card {
    transition: all 0.3s ease;
    border: 1px solid rgba(0,0,0,0.03);
}
.card:hover {
    border-color: #007bff;
}
.badge {
    letter-spacing: 0.5px;
}
.display-6 {
    font-size: 1.5rem;
    font-weight: 700;
}
.fs-7 {
    font-size: 0.85rem;
}
.transition-all {
    transition: all 0.3s ease;
}
.z-2 {
    z-index: 2;
}
</style>

<?= $this->endSection() ?>