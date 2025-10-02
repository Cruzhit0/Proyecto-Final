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
        .card-form {
            background: linear-gradient(150deg, #fff, #f8f9fa);
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            border: 1px solid rgba(109, 7, 26, 0.2);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body>
    <div class="content-overlay">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card-form p-4">
                        <h3 class="text-center text-danger mb-4">
                            <i class="fas fa-edit"></i> <?= $titulo ?>
                        </h3>

                        <!-- Errores de validación -->
                        <?php if (isset($errors) && count($errors) > 0): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Formulario de edición -->
                        <form action="<?= base_url("panel/habitacionesTipo/update/{$tipo->id}") ?>" method="post">
                        

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del Tipo <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control <?= isset($errors['nombre']) ? 'is-invalid' : '' ?>" 
                                       id="nombre" 
                                       name="nombre" 
                                       value="<?= esc($tipo->nombre) ?>" 
                                       placeholder="Ej: Suite Premium, Doble Estándar..."
                                       required>
                                <?php if (isset($errors['nombre'])): ?>
                                    <div class="invalid-feedback"><?= $errors['nombre'] ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control <?= isset($errors['descripcion']) ? 'is-invalid' : '' ?>" 
                                          id="descripcion" 
                                          name="descripcion" 
                                          rows="3" 
                                          placeholder="Descripción del tipo de habitación..."><?= esc($tipo->descripcion) ?></textarea>
                                <?php if (isset($errors['descripcion'])): ?>
                                    <div class="invalid-feedback"><?= $errors['descripcion'] ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="capacidad_maxima" class="form-label">Capacidad Máxima <span class="text-danger">*</span></label>
                                    <input type="number" 
                                           class="form-control <?= isset($errors['capacidad_maxima']) ? 'is-invalid' : '' ?>" 
                                           id="capacidad_maxima" 
                                           name="capacidad_maxima" 
                                           value="<?= $tipo->capacidad_maxima ?>" 
                                           min="1" 
                                           max="10" 
                                           required>
                                    <?php if (isset($errors['capacidad_maxima'])): ?>
                                        <div class="invalid-feedback"><?= $errors['capacidad_maxima'] ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="precio_noche" class="form-label">Precio por Noche (BOB) <span class="text-danger">*</span></label>
                                    <input type="number" 
                                           step="0.01" 
                                           class="form-control <?= isset($errors['precio_noche']) ? 'is-invalid' : '' ?>" 
                                           id="precio_noche" 
                                           name="precio_noche" 
                                           value="<?= $tipo->precio_noche ?>" 
                                           min="0.01" 
                                           required>
                                    <?php if (isset($errors['precio_noche'])): ?>
                                        <div class="invalid-feedback"><?= $errors['precio_noche'] ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       id="activo" 
                                       name="activo" 
                                       <?= $tipo->activo ? 'checked' : '' ?>>
                                <label class="form-check-label" for="activo">Activo (Visible en el sistema)</label>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="<?= base_url('panel/habitacionesTipo') ?>" class="btn btn-secondary me-md-2">
                                    <i class="fas fa-times"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Actualizar Tipo
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>