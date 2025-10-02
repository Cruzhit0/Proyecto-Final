<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-users"></i> Gestión de Usuarios</h2>
        <a href="<?= base_url('index.php/usuarios/form') ?>" class="btn btn-success">
            <i class="fas fa-plus"></i> Nuevo Usuario
        </a>
    </div>

    <!-- Mensajes Flash -->
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

    <!-- Tabla de Usuarios -->
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark" style="background: linear-gradient(135deg, #8B0000, #6D071A); color: white;">
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Nombre Completo</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Última Conexión</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= $usuario->id ?></td>
                    <td><code><?= esc($usuario->nombre) ?></code></td>
                    <td><?= esc($usuario->nombres_completos) ?></td>
                    <td><?= $usuario->email ? esc($usuario->email) : '<span class="text-muted">No asignado</span>' ?></td>
                    <td><?= $usuario->telefono ? esc($usuario->telefono) : '<span class="text-muted">No asignado</span>' ?></td>
                    <td>
                        <span class="badge bg-<?= $usuario->rol == 'admin' ? 'danger' : ($usuario->rol == 'recepcion' ? 'primary' : ($usuario->rol == 'limpieza' ? 'warning' : 'secondary')) ?>">
                            <?= ucfirst($usuario->rol) ?>
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-<?= $usuario->estado == 'activo' ? 'success' : 'secondary' ?>">
                            <?= $usuario->estado == 'activo' ? 'Activo' : 'Inactivo' ?>
                        </span>
                    </td>
                    <td>
                        <?= $usuario->ultima_conexion ? date('d/m/Y H:i', strtotime($usuario->ultima_conexion)) : '<span class="text-muted">Nunca</span>' ?>
                    </td>
                    <td>
                        <a href="<?= base_url("index.php/usuarios/form/{$usuario->id}") ?>" 
                           class="btn btn-sm btn-warning me-1" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?= base_url("index.php/usuarios/eliminar/{$usuario->id}") ?>" 
                           class="btn btn-sm btn-danger" title="Desactivar"
                           onclick="return confirm('¿Está seguro de desactivar este usuario?')">
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