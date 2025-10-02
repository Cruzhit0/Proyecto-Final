<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?> - Hotel Viña del Sur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: url('<?= base_url('img/web-6.jpg') ?>') center/cover no-repeat fixed;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .content-overlay {
            background: rgba(0, 0, 0, 0.65);
            min-height: 100vh;
            padding: 60px 20px;
        }
        .card-panel {
            background: linear-gradient(150deg, #fff, #f8f9fa);
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            border: 1px solid rgba(109, 7, 26, 0.2);
            backdrop-filter: blur(10px);
        }
        .btn-action {
            width: 36px;
            height: 36px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 2px;
        }
        .table tbody tr.table-success td,
        .table tbody tr.table-danger td {
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="content-overlay">
        <div class="container">
            <!-- Encabezado -->
            <div class="row justify-content-center mb-4">
                <div class="col-12 col-md-10">
                    <div class="card-panel p-4 text-center">
                        <h2 class="text-danger mb-0">
                            <i class="fas fa-tags"></i> <?= $titulo ?>
                        </h2>
                        <p class="text-muted mb-0">Gestione los tipos de habitación del hotel</p>
                    </div>
                </div>
            </div>

            <!-- Alertas -->
            <?php if (session()->has('success')): ?>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (session()->has('error')): ?>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Botones -->
            <div class="row justify-content-center mb-4">
                <div class="col-12 col-md-10 text-end">
                    <a href="<?= base_url('panel/habitacionesTipo/crear') ?>" class="btn btn-success me-2">
                        <i class="fas fa-plus-circle"></i> Nuevo Tipo
                    </a>
                </div>
            </div>

            <!-- Tabla -->
            <div class="row justify-content-center">
                <div class="col-12 col-md-10">
                    <div class="card-panel p-4">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Cap.</th>
                                        <th>Precio (BOB)</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($tipos)): ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No hay tipos de habitación registrados.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($tipos as $tipo): ?>
                                            <!-- ✅ FILA COLOREADA SEGÚN ESTADO -->
                                            <tr class="<?= $tipo->activo ? 'table-success' : 'table-danger' ?>">
                                                <td class="fw-bold"><?= $tipo->id ?></td>
                                                <td><?= esc($tipo->nombre) ?></td>
                                                <td><?= esc(substr($tipo->descripcion, 0, 60)) . (strlen($tipo->descripcion) > 60 ? '...' : '') ?></td>
                                                <td class="text-center"><?= $tipo->capacidad_maxima ?></td>
                                                <td class="text-end"><?= number_format($tipo->precio_noche, 2) ?></td>
                                                <td class="text-center">
                                                    <?php if ($tipo->activo): ?>
                                                        <span class="badge bg-success">Activo</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger">Inactivo</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <!-- ✅ BOTONES EN LÍNEA -->
                                                    <a href="<?= base_url("panel/habitacionesTipo/editar/{$tipo->id}") ?>" 
                                                       class="btn btn-warning btn-action" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <?php if ($tipo->activo): ?>
                                                        <a href="<?= base_url("panel/habitacionesTipo/eliminar/{$tipo->id}") ?>" 
                                                           class="btn btn-danger btn-action" title="Desactivar"
                                                           onclick="return confirm('¿Está seguro de desactivar este tipo? No podrá asignarse a nuevas habitaciones.')">
                                                            <i class="fas fa-toggle-off"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="<?= base_url("panel/habitacionesTipo/activar/{$tipo->id}") ?>" 
                                                           class="btn btn-success btn-action" title="Activar"
                                                           onclick="return confirm('¿Activar este tipo de habitación?')">
                                                            <i class="fas fa-toggle-on"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botón Volver -->
            <div class="row justify-content-center mt-4">
                <div class="col-auto">
                    <a href="<?= base_url('index.php/panel/admin') ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Volver al Panel
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>