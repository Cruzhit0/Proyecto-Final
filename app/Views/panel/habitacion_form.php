<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($titulo) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #6d071a, #8b0000);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px 0;
        }
        .form-container {
            background: rgba(255,255,255,0.97);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 15px 50px rgba(0,0,0,0.25);
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid rgba(139, 0, 0, 0.1);
        }
        .form-title {
            color: #8B0000;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 2rem;
            position: relative;
        }
        .form-title:after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: #8B0000;
            margin: 10px auto 0;
            border-radius: 2px;
        }
        .form-label {
            font-weight: 600;
            color: #555;
        }
        .form-control, .form-select {
            border-radius: 12px;
            padding: 12px 16px;
            border: 2px solid #f0f0f0;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #8B0000;
            box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.1);
        }
        .btn-save {
            background: linear-gradient(135deg, #28a745, #218838);
            color: white;
            border: none;
            padding: 14px 36px;
            font-size: 1.1rem;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
            transition: all 0.3s ease;
        }
        .btn-save:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.5);
        }
        .btn-back {
            background: linear-gradient(135deg, #6c757d, #495057);
            color: white;
            border: none;
            padding: 14px 36px;
            font-size: 1.1rem;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
            transition: all 0.3s ease;
        }
        .btn-back:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(108, 117, 125, 0.5);
        }
        .alert-danger {
            border-radius: 16px;
            border-left: 4px solid #dc3545;
        }
        .alert-danger ul {
            margin: 0;
            padding-left: 20px;
        }
        .alert-danger li {
            margin: 5px 0;
        }
        .required {
            color: #dc3545;
        }
        .invalid-feedback {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="form-title">
                <i class="fas fa-door-open me-2"></i>
                <?= isset($habitacion) ? 'Editar Habitación' : 'Registrar Nueva Habitación' ?>
            </h2>

            <?php if (isset($validation) && is_array($validation) && !empty($validation)): ?>
                <div class="alert alert-danger">
                    <strong><i class="fas fa-exclamation-triangle me-1"></i> Por favor corrige los siguientes errores:</strong>
                    <ul class="mb-0 mt-2">
                        <?php foreach ($validation as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- ▶️ FORMULARIO: RUTAS CORREGIDAS -->
            <form action="<?= isset($habitacion) 
                ? base_url("index.php/panel/habitaciones/actualizar/{$habitacion->id}") 
                : base_url('index.php/panel/habitaciones/guardar') ?>" method="post">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="numero_habitacion" class="form-label">Número de Habitación <span class="required">*</span></label>
                        <input type="text"
                               class="form-control <?= isset($validation) && array_key_exists('numero_habitacion', $validation) ? 'is-invalid' : '' ?>"
                               id="numero_habitacion"
                               name="numero_habitacion"
                               value="<?= esc(old('numero_habitacion', $habitacion->numero_habitacion ?? '')) ?>"
                               placeholder="Ej: 101, 205A, SUITE-1"
                               <?= isset($habitacion) ? 'readonly' : '' ?>
                               required>
                        <?php if (isset($validation) && array_key_exists('numero_habitacion', $validation)): ?>
                            <div class="invalid-feedback">
                                <?= esc($validation['numero_habitacion']) ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="tipo_habitacion_id" class="form-label">Tipo de Habitación <span class="required">*</span></label>
                        <select class="form-select <?= isset($validation) && array_key_exists('tipo_habitacion_id', $validation) ? 'is-invalid' : '' ?>"
                                id="tipo_habitacion_id"
                                name="tipo_habitacion_id"
                                required>
                            <option value="">— Seleccione un tipo —</option>
                            <?php foreach ($tipos as $tipo): ?>
                                <option value="<?= $tipo->id ?>"
                                    <?= (old('tipo_habitacion_id', $habitacion->tipo_habitacion_id ?? '') == $tipo->id) ? 'selected' : '' ?>>
                                    <?= esc($tipo->nombre) ?> - Bs. <?= number_format($tipo->precio_noche, 2) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($validation) && array_key_exists('tipo_habitacion_id', $validation)): ?>
                            <div class="invalid-feedback">
                                <?= esc($validation['tipo_habitacion_id']) ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <label for="piso" class="form-label">Piso</label>
                        <input type="number"
                               class="form-control"
                               id="piso"
                               name="piso"
                               value="<?= esc(old('piso', $habitacion->piso ?? '')) ?>"
                               placeholder="Ej: 1, 2, 3">
                    </div>

                    <div class="col-md-6">
                        <label for="estado" class="form-label">Estado <span class="required">*</span></label>
                        <select class="form-select"
                                id="estado"
                                name="estado"
                                required>
                            <option value="disponible" <?= (old('estado', $habitacion->estado ?? 'disponible') == 'disponible') ? 'selected' : '' ?>>Disponible</option>
                            <option value="ocupada" <?= (old('estado', $habitacion->estado ?? '') == 'ocupada') ? 'selected' : '' ?>>Ocupada</option>
                            <option value="mantenimiento" <?= (old('estado', $habitacion->estado ?? '') == 'mantenimiento') ? 'selected' : '' ?>>Mantenimiento</option>
                            <option value="reservada" <?= (old('estado', $habitacion->estado ?? '') == 'reservada') ? 'selected' : '' ?>>Reservada</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea class="form-control"
                                  id="observaciones"
                                  name="observaciones"
                                  rows="3"
                                  placeholder="Ej: Vista al mar, cerca de ascensor, sin ventana..."><?= esc(old('observaciones', $habitacion->observaciones ?? '')) ?></textarea>
                    </div>
                </div>

                <div class="d-flex gap-3 mt-4 justify-content-center">
                    <button type="submit" class="btn btn-save">
                        <i class="fas fa-save me-2"></i> Guardar Habitación
                    </button>
                    <a href="<?= base_url('index.php/panel/habitaciones') ?>" class="btn btn-back">
                        <i class="fas fa-times me-2"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>