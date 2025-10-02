<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="container mt-5 text-center">
    <div class="card border-0 shadow-lg" style="max-width: 600px; margin: 0 auto; border-radius: 28px; overflow: hidden;">
        <div class="card-header bg-danger text-white py-4">
            <h3><i class="fas fa-user-shield me-2"></i> Acceso Denegado</h3>
        </div>
        <div class="card-body p-5">
            <div class="display-1 text-danger mb-4">
                <i class="fas fa-ban"></i>
            </div>
            <h4 class="mb-4">¡Lo sentimos!</h4>
            <p class="lead mb-4">No tiene permisos para acceder a esta sección.</p>
            <p>Esta funcionalidad está reservada exclusivamente para <strong>Administradores</strong>.</p>
            <a href="<?= base_url('index.php/panel/admin') ?>" class="btn btn-lg" style="background: linear-gradient(135deg, #8B0000, #6D071A); color: white; border-radius: 60px; padding: 12px 36px; font-weight: 600;">
                <i class="fas fa-home me-2"></i> Regresar al Panel
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>