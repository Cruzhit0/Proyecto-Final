<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-lg" style="border-radius: 28px; overflow: hidden;">
                <!-- Header de la tarjeta -->
                <div class="card-header text-white py-4" style="background: linear-gradient(135deg, #8B0000, #6D071A); border-bottom: 4px solid #D26969;">
                    <h4 class="mb-0 text-center">
                        <i class="fas fa-concierge-bell me-2"></i>
                        <?= $servicio ? 'Editar Servicio' : 'Nuevo Servicio' ?>
                    </h4>
                </div>

                <!-- Cuerpo del formulario -->
                <div class="card-body p-5">
                    <form action="<?= base_url('index.php/servicios/guardar') ?>" method="POST" novalidate>

                        <!-- Campo oculto para ID (solo si es edición) -->
                        <?php if ($servicio): ?>
                            <input type="hidden" name="id" value="<?= $servicio->id ?>">
                        <?php endif; ?>

                        <!-- Validación de errores globales -->
                        <?php if (isset($validation)): ?>
                            <div class="alert alert-danger border-0 shadow-sm mb-4" style="background: #ffebee; color: #c62828; border-left: 5px solid #d32f2f;">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Corrige los siguientes errores:</strong>
                                <ul class="mb-0 mt-2">
                                    <?= $validation->listErrors() ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Nombre del Servicio -->
                        <div class="mb-4">
                            <label for="nombre" class="form-label fw-bold text-dark" style="font-size: 1.1rem;">
                                <i class="fas fa-tag me-2" style="color: #8B0000;"></i> Nombre del Servicio <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   class="form-control form-control-lg <?= isset($validation) && $validation->hasError('nombre') ? 'is-invalid' : '' ?>"
                                   id="nombre"
                                   name="nombre"
                                   placeholder="Ej: Sauna Premium, Salón de Eventos..."
                                   value="<?= old('nombre', $servicio->nombre ?? '') ?>"
                                   required
                                   style="border: 3px solid #D26969; border-radius: 18px; padding: 15px 20px; font-size: 1.05rem; box-shadow: 0 4px 12px rgba(139,0,0,0.1); transition: all 0.3s ease;"
                                   onfocus="this.style.borderColor='#8B0000'; this.style.boxShadow='0 6px 16px rgba(139,0,0,0.2)';"
                                   onblur="this.style.borderColor='#D26969'; this.style.boxShadow='0 4px 12px rgba(139,0,0,0.1)';">
                            <?php if (isset($validation) && $validation->hasError('nombre')): ?>
                                <div class="invalid-feedback d-flex align-items-center mt-2" style="font-size: 0.95rem; font-weight: 500;">
                                    <i class="fas fa-times-circle me-2" style="color: #d32f2f;"></i>
                                    <?= $validation->getError('nombre') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Descripción -->
                        <div class="mb-4">
                            <label for="descripcion" class="form-label fw-bold text-dark" style="font-size: 1.1rem;">
                                <i class="fas fa-align-left me-2" style="color: #8B0000;"></i> Descripción
                            </label>
                            <textarea class="form-control form-control-lg"
                                      id="descripcion"
                                      name="descripcion"
                                      rows="4"
                                      placeholder="Describe el servicio: capacidad, características, restricciones..."
                                      style="border: 3px solid #D26969; border-radius: 18px; padding: 15px 20px; font-size: 1.05rem; box-shadow: 0 4px 12px rgba(139,0,0,0.1); transition: all 0.3s ease;"
                                      onfocus="this.style.borderColor='#8B0000'; this.style.boxShadow='0 6px 16px rgba(139,0,0,0.2)';"
                                      onblur="this.style.borderColor='#D26969'; this.style.boxShadow='0 4px 12px rgba(139,0,0,0.1)';"><?= old('descripcion', $servicio->descripcion ?? '') ?></textarea>
                        </div>

                        <!-- Precio y Unidad en una fila -->
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="precio_unitario" class="form-label fw-bold text-dark" style="font-size: 1.1rem;">
                                    <i class="fas fa-dollar-sign me-2" style="color: #8B0000;"></i> Precio Unitario (BOB) <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-3 border-end-0" style="border-color: #D26969; border-radius: 18px 0 0 18px; font-size: 1.1rem; font-weight: bold;">Bs.</span>
                                    <input type="number"
                                           step="0.01"
                                           class="form-control form-control-lg border-3 <?= isset($validation) && $validation->hasError('precio_unitario') ? 'is-invalid' : '' ?>"
                                           id="precio_unitario"
                                           name="precio_unitario"
                                           placeholder="0.00"
                                           value="<?= old('precio_unitario', $servicio->precio_unitario ?? '0.00') ?>"
                                           required
                                           min="0"
                                           style="border: 3px solid #D26969; border-radius: 0 18px 18px 0; padding: 15px 20px; font-size: 1.05rem; box-shadow: 0 4px 12px rgba(139,0,0,0.1); transition: all 0.3s ease;"
                                           onfocus="this.style.borderColor='#8B0000'; this.style.boxShadow='0 6px 16px rgba(139,0,0,0.2)';"
                                           onblur="this.style.borderColor='#D26969'; this.style.boxShadow='0 4px 12px rgba(139,0,0,0.1)';">
                                </div>
                                <?php if (isset($validation) && $validation->hasError('precio_unitario')): ?>
                                    <div class="invalid-feedback d-flex align-items-center mt-2" style="font-size: 0.95rem; font-weight: 500;">
                                        <i class="fas fa-times-circle me-2" style="color: #d32f2f;"></i>
                                        <?= $validation->getError('precio_unitario') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-6">
                                <label for="unidad_medida" class="form-label fw-bold text-dark" style="font-size: 1.1rem;">
                                    <i class="fas fa-ruler-combined me-2" style="color: #8B0000;"></i> Unidad de Medida <span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-lg border-3 <?= isset($validation) && $validation->hasError('unidad_medida') ? 'is-invalid' : '' ?>"
                                        id="unidad_medida"
                                        name="unidad_medida"
                                        required
                                        style="border: 3px solid #D26969; border-radius: 18px; padding: 15px 20px; font-size: 1.05rem; box-shadow: 0 4px 12px rgba(139,0,0,0.1); transition: all 0.3s ease;"
                                        onfocus="this.style.borderColor='#8B0000'; this.style.boxShadow='0 6px 16px rgba(139,0,0,0.2)';"
                                        onblur="this.style.borderColor='#D26969'; this.style.boxShadow='0 4px 12px rgba(139,0,0,0.1)';">
                                    <option value="">-- Seleccione una unidad --</option>
                                    <option value="noche" <?= old('unidad_medida', $servicio->unidad_medida ?? '') == 'noche' ? 'selected' : '' ?>>Por Noche</option>
                                    <option value="hora" <?= old('unidad_medida', $servicio->unidad_medida ?? '') == 'hora' ? 'selected' : '' ?>>Por Hora</option>
                                    <option value="sesion" <?= old('unidad_medida', $servicio->unidad_medida ?? '') == 'sesion' ? 'selected' : '' ?>>Por Sesión</option>
                                    <option value="plato" <?= old('unidad_medida', $servicio->unidad_medida ?? '') == 'plato' ? 'selected' : '' ?>>Por Plato</option>
                                </select>
                                <?php if (isset($validation) && $validation->hasError('unidad_medida')): ?>
                                    <div class="invalid-feedback d-flex align-items-center mt-2" style="font-size: 0.95rem; font-weight: 500;">
                                        <i class="fas fa-times-circle me-2" style="color: #d32f2f;"></i>
                                        <?= $validation->getError('unidad_medida') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Checkbox Activo -->
                        <div class="mb-4 form-check form-switch">
                            <input type="checkbox"
                                   class="form-check-input"
                                   id="activo"
                                   name="activo"
                                   style="width: 3rem; height: 1.8rem;"
                                   <?= old('activo', $servicio->activo ?? 1) ? 'checked' : '' ?>>
                            <label class="form-check-label fw-bold text-dark" for="activo" style="font-size: 1.1rem;">
                                <i class="fas fa-toggle-on me-2" style="color: #8B0000;"></i> Servicio Activo
                            </label>
                        </div>

                        <!-- Botones de acción -->
                        <div class="d-flex gap-3 justify-content-center mt-5">
                            <button type="submit" class="btn btn-lg px-5 py-3" style="background: linear-gradient(135deg, #8B0000, #6D071A); color: white; border: none; border-radius: 60px; font-weight: 700; font-size: 1.1rem; box-shadow: 0 6px 20px rgba(139,0,0,0.4); transition: all 0.3s cubic-bezier(0.2, 0.8, 0.3, 1);">
                                <i class="fas fa-save me-2"></i> Guardar Servicio
                            </button>
                            <a href="<?= base_url('index.php/servicios') ?>" class="btn btn-lg px-5 py-3" style="background: linear-gradient(135deg, #D26969, #A52A2A); color: white; border: none; border-radius: 60px; font-weight: 700; font-size: 1.1rem; box-shadow: 0 6px 20px rgba(165,42,42,0.3); transition: all 0.3s cubic-bezier(0.2, 0.8, 0.3, 1);">
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