<!-- ... (head y estilos iguales a crear.php) ... -->

<form action="<?= base_url("panel/habitacionesTipo/update/{$tipo->id}") ?>" method="post">
    <input type="hidden" name="_method" value="PUT">

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre del Tipo <span class="text-danger">*</span></label>
        <input type="text" 
               class="form-control <?= isset($errors['nombre']) ? 'is-invalid' : '' ?>" 
               id="nombre" 
               name="nombre" 
               value="<?= esc($tipo->nombre) ?>" 
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
                  rows="3"><?= esc($tipo->descripcion) ?></textarea>
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