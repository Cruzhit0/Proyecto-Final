<?= $this->extend('layouts/admin') ?>

<?= $this->section('styles') ?>
<style>
    /* === ESTILOS PARA SELECTS - HOTEL VIÑA DEL SUR === */
    select.form-select {
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        appearance: none !important;
        background-color: white !important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%238B0000' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e") !important;
        background-repeat: no-repeat !important;
        background-position: right 12px center !important;
        background-size: 16px 12px !important;
        border: 2px solid #D26969 !important;
        color: #4A0404 !important;
        transition: all 0.3s ease !important;
    }

    select.form-select:focus {
        border-color: #8B0000 !important;
        box-shadow: 0 0 0 0.2rem rgba(139, 0, 0, 0.25) !important;
        background-color: #FFF5F5 !important;
    }

    /* Opción seleccionada */
    select.form-select option:checked {
        background-color: #8B0000 !important;
        color: white !important;
    }

    /* Hover en opciones */
    select.form-select option:hover {
        background-color: #D26969 !important;
        color: white !important;
    }

    /* Estado de error */
    select.form-select.is-invalid {
        border-color: #d32f2f !important;
    }

    select.form-select.is-invalid:focus {
        box-shadow: 0 0 0 0.2rem rgba(211, 47, 47, 0.25) !important;
    }

    /* Forzar estilos en navegadores modernos */
    @supports (-webkit-appearance: none) {
        select.form-select {
            -webkit-appearance: none !important;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="card border-0 shadow-lg" style="border-radius: 28px; overflow: hidden;">
                <div class="card-header text-white py-4" style="background: linear-gradient(135deg, #8B0000, #6D071A); border-bottom: 4px solid #D26969;">
                    <h4 class="mb-0 text-center">
                        <i class="fas fa-user-plus me-2"></i>
                        <?= $usuario ? 'Editar Usuario' : 'Nuevo Usuario' ?>
                    </h4>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form action="<?= base_url('index.php/usuarios/guardar') ?>" method="POST" novalidate>
                        

                        <?php if ($usuario): ?>
                            <input type="hidden" name="id" value="<?= $usuario->id ?>">
                        <?php endif; ?>

                        <!-- ✅ MENSAJE DE ERROR GLOBAL (validación del servidor) -->
                        <?php if (isset($validation)): ?>
                            <div class="alert alert-danger border-0 shadow-sm mb-4" style="background: #ffebee; color: #c62828; border-left: 5px solid #d32f2f;">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong><i class="fas fa-times-circle me-1"></i> Errores en el formulario:</strong>
                                <ul class="mb-0 mt-2" style="font-size: 0.95rem; line-height: 1.6;">
                                    <?= $validation->listErrors() ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Fila 1: Nombre de Usuario y Contraseña -->
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label fw-bold text-dark" style="font-size: 1.05rem;">
                                    <i class="fas fa-user me-2" style="color: #8B0000;"></i> Nombre de Usuario <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       class="form-control <?= isset($validation) && $validation->hasError('nombre') ? 'is-invalid' : '' ?>"
                                       id="nombre"
                                       name="nombre"
                                       placeholder="ej: juan_recep"
                                       value="<?= old('nombre', $usuario->nombre ?? '') ?>"
                                       required
                                       style="border: 2px solid #D26969; border-radius: 12px; padding: 12px 15px; font-size: 1rem; box-shadow: 0 3px 8px rgba(139,0,0,0.1); transition: all 0.3s ease;"
                                       onfocus="this.style.borderColor='#8B0000'; this.style.boxShadow='0 5px 12px rgba(139,0,0,0.2)';"
                                       onblur="this.style.borderColor='#D26969'; this.style.boxShadow='0 3px 8px rgba(139,0,0,0.1)';">
                                <?php if (isset($validation) && $validation->hasError('nombre')): ?>
                                    <div class="invalid-feedback d-block mt-1" style="font-size: 0.9rem; font-weight: 500; color: #d32f2f;">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        <?= $validation->getError('nombre') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label fw-bold text-dark" style="font-size: 1.05rem;">
                                    <i class="fas fa-lock me-2" style="color: #8B0000;"></i> Contraseña <?= $usuario ? '' : '<span class="text-danger">*</span>' ?>
                                </label>
                                <input type="password"
                                       class="form-control <?= isset($validation) && $validation->hasError('password') ? 'is-invalid' : '' ?>"
                                       id="password"
                                       name="password"
                                       placeholder="<?= $usuario ? 'Cambiar contraseña' : 'Mínimo 6 caracteres' ?>"
                                       style="border: 2px solid #D26969; border-radius: 12px; padding: 12px 15px; font-size: 1rem; box-shadow: 0 3px 8px rgba(139,0,0,0.1); transition: all 0.3s ease;"
                                       onfocus="this.style.borderColor='#8B0000'; this.style.boxShadow='0 5px 12px rgba(139,0,0,0.2)';"
                                       onblur="this.style.borderColor='#D26969'; this.style.boxShadow='0 3px 8px rgba(139,0,0,0.1)';">
                                <?php if (isset($validation) && $validation->hasError('password')): ?>
                                    <div class="invalid-feedback d-block mt-1" style="font-size: 0.9rem; font-weight: 500; color: #d32f2f;">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        <?= $validation->getError('password') ?>
                                    </div>
                                <?php endif; ?>
                                <small class="form-text text-muted mt-1" style="font-size: 0.85rem;">
                                    <?= $usuario ? 'Dejar vacío para mantener actual' : 'Requerida para nuevos usuarios' ?>
                                </small>
                            </div>
                        </div>

                        <!-- Fila 2: Nombre Completo y Email -->
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="nombres_completos" class="form-label fw-bold text-dark" style="font-size: 1.05rem;">
                                    <i class="fas fa-id-card me-2" style="color: #8B0000;"></i> Nombre Completo <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       class="form-control <?= isset($validation) && $validation->hasError('nombres_completos') ? 'is-invalid' : '' ?>"
                                       id="nombres_completos"
                                       name="nombres_completos"
                                       placeholder="ej: Juan Pérez"
                                       value="<?= old('nombres_completos', $usuario->nombres_completos ?? '') ?>"
                                       required
                                       style="border: 2px solid #D26969; border-radius: 12px; padding: 12px 15px; font-size: 1rem; box-shadow: 0 3px 8px rgba(139,0,0,0.1); transition: all 0.3s ease;"
                                       onfocus="this.style.borderColor='#8B0000'; this.style.boxShadow='0 5px 12px rgba(139,0,0,0.2)';"
                                       onblur="this.style.borderColor='#D26969'; this.style.boxShadow='0 3px 8px rgba(139,0,0,0.1)';">
                                <?php if (isset($validation) && $validation->hasError('nombres_completos')): ?>
                                    <div class="invalid-feedback d-block mt-1" style="font-size: 0.9rem; font-weight: 500; color: #d32f2f;">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        <?= $validation->getError('nombres_completos') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label fw-bold text-dark" style="font-size: 1.05rem;">
                                    <i class="fas fa-envelope me-2" style="color: #8B0000;"></i> Email
                                </label>
                                <input type="email"
                                       class="form-control <?= isset($validation) && $validation->hasError('email') ? 'is-invalid' : '' ?>"
                                       id="email"
                                       name="email"
                                       placeholder="ej: email@ejemplo.com"
                                       value="<?= old('email', $usuario->email ?? '') ?>"
                                       style="border: 2px solid #D26969; border-radius: 12px; padding: 12px 15px; font-size: 1rem; box-shadow: 0 3px 8px rgba(139,0,0,0.1); transition: all 0.3s ease;"
                                       onfocus="this.style.borderColor='#8B0000'; this.style.boxShadow='0 5px 12px rgba(139,0,0,0.2)';"
                                       onblur="this.style.borderColor='#D26969'; this.style.boxShadow='0 3px 8px rgba(139,0,0,0.1)';">
                                <?php if (isset($validation) && $validation->hasError('email')): ?>
                                    <div class="invalid-feedback d-block mt-1" style="font-size: 0.9rem; font-weight: 500; color: #d32f2f;">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        <?= $validation->getError('email') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Fila 3: Teléfono, Rol y Estado -->
                        <div class="row g-4 mb-4">
                            <div class="col-md-4">
                                <label for="telefono" class="form-label fw-bold text-dark" style="font-size: 1.05rem;">
                                    <i class="fas fa-phone me-2" style="color: #8B0000;"></i> Teléfono
                                </label>
                                <input type="tel"
                                       class="form-control <?= isset($validation) && $validation->hasError('telefono') ? 'is-invalid' : '' ?>"
                                       id="telefono"
                                       name="telefono"
                                       placeholder="+591 70000000"
                                       value="<?= old('telefono', $usuario->telefono ?? '') ?>"
                                       style="border: 2px solid #D26969; border-radius: 12px; padding: 12px 15px; font-size: 1rem; box-shadow: 0 3px 8px rgba(139,0,0,0.1); transition: all 0.3s ease;"
                                       onfocus="this.style.borderColor='#8B0000'; this.style.boxShadow='0 5px 12px rgba(139,0,0,0.2)';"
                                       onblur="this.style.borderColor='#D26969'; this.style.boxShadow='0 3px 8px rgba(139,0,0,0.1)';">
                                <?php if (isset($validation) && $validation->hasError('telefono')): ?>
                                    <div class="invalid-feedback d-block mt-1" style="font-size: 0.9rem; font-weight: 500; color: #d32f2f;">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        <?= $validation->getError('telefono') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-4">
                                <label for="rol" class="form-label fw-bold text-dark" style="font-size: 1.05rem;">
                                    <i class="fas fa-user-tag me-2" style="color: #8B0000;"></i> Rol <span class="text-danger">*</span>
                                </label>
                                <select class="form-select border-2 <?= isset($validation) && $validation->hasError('rol') ? 'is-invalid' : '' ?>"
                                        id="rol"
                                        name="rol"
                                        required>
                                    <option value="">-- Seleccione Rol --</option>
                                    <?php foreach ($roles as $value => $label): ?>
                                        <option value="<?= $value ?>" <?= old('rol', $usuario->rol ?? '') == $value ? 'selected' : '' ?>>
                                            <?= $label ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($validation) && $validation->hasError('rol')): ?>
                                    <div class="invalid-feedback d-block mt-1" style="font-size: 0.9rem; font-weight: 500; color: #d32f2f;">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        <?= $validation->getError('rol') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-4">
                                <label for="estado" class="form-label fw-bold text-dark" style="font-size: 1.05rem;">
                                    <i class="fas fa-toggle-on me-2" style="color: #8B0000;"></i> Estado <span class="text-danger">*</span>
                                </label>
                                <select class="form-select border-2 <?= isset($validation) && $validation->hasError('estado') ? 'is-invalid' : '' ?>"
                                        id="estado"
                                        name="estado"
                                        required>
                                    <option value="">-- Seleccione --</option>
                                    <?php foreach ($estados as $value => $label): ?>
                                        <option value="<?= $value ?>" <?= old('estado', $usuario->estado ?? '') == $value ? 'selected' : '' ?>>
                                            <?= $label ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($validation) && $validation->hasError('estado')): ?>
                                    <div class="invalid-feedback d-block mt-1" style="font-size: 0.9rem; font-weight: 500; color: #d32f2f;">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        <?= $validation->getError('estado') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex gap-3 justify-content-center mt-4">
                            <button type="submit" class="btn px-4 py-2" style="background: linear-gradient(135deg, #8B0000, #6D071A); color: white; border: none; border-radius: 50px; font-weight: 600; font-size: 1.1rem; box-shadow: 0 4px 15px rgba(139,0,0,0.35); transition: all 0.3s ease;">
                                <i class="fas fa-save me-2"></i> Guardar Usuario
                            </button>
                            <a href="<?= base_url('index.php/usuarios') ?>" class="btn px-4 py-2" style="background: linear-gradient(135deg, #D26969, #A52A2A); color: white; border: none; border-radius: 50px; font-weight: 600; font-size: 1.1rem; box-shadow: 0 4px 15px rgba(165,42,42,0.25); transition: all 0.3s ease;">
                                <i class="fas fa-times me-2"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>