<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-gradient text-white py-3" style="background: linear-gradient(135deg, #dc3545, #c82333);">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-sign-out-alt me-2"></i> Check-out de Huéspedes
                    </h4>
                </div>
                <div class="card-body p-4">

                    <?php if (empty($estancias)): ?>
                        <div class="alert alert-info text-center py-4">
                            <i class="fas fa-bed me-2"></i>
                            <strong>No hay huéspedes activos para hacer check-out.</strong>
                        </div>
                    <?php else: ?>
                        <div class="row g-4">
                            <?php foreach ($estancias as $e): ?>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="card border-left-danger shadow-sm h-100">
                                        <div class="card-body d-flex flex-column">
                                            <div class="mb-3">
                                                <h5 class="card-title mb-2"><?= esc($e->huesped_nombres . ' ' . $e->huesped_apellidos) ?></h5>
                                                <p class="card-text mb-1">
                                                    <i class="fas fa-door-open me-2"></i> H<?= $e->numero_habitacion ?> (<?= $e->tipo_habitacion ?>)
                                                </p>
                                                <p class="card-text mb-1">
                                                    <i class="fas fa-clock me-2"></i> Check-in: <?= date('d/m/Y H:i', strtotime($e->fecha_checkin)) ?>
                                                </p>
                                            </div>
                                            <div class="mt-auto">
                                                <a href="<?= base_url("index.php/checkout/detalle/{$e->id}") ?>" class="btn btn-outline-danger w-100">
                                                    <i class="fas fa-sign-out-alt me-2"></i> Procesar Check-out
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>