<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <!-- ▼▼▼ REDUCIDO DE col-lg-6 a col-md-6 ▼▼▼ -->
        <div class="col-12 col-md-6">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background: #ffffff; border: 1px solid rgba(0,0,0,0.05);">
                <!-- Header Minimalista -->
                <div class="px-4 py-3 border-bottom" style="background: linear-gradient(135deg, #2c3e50, #34495e);">
                    <h5 class="mb-0 text-white d-flex align-items-center">
                        <i class="fas fa-glass-cheers me-2" style="color: #FFD700; font-size: 1.2rem;"></i>
                        <span class="fw-light" style="font-size: 1.1rem;">Servicio Extra</span>
                    </h5>
                </div>

                <!-- Contenido Compacto -->
                <div class="p-4">

                    <!-- Mensajes -->
                    <?php if (session()->has('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show small p-2 mb-3" role="alert">
                            <i class="fas fa-exclamation-triangle me-1"></i> <?= session('error') ?>
                            <button type="button" class="btn-close p-1" data-bs-dismiss="alert" style="font-size: 0.7rem;"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->has('mensaje')): ?>
                        <div class="alert alert-success alert-dismissible fade show small p-2 mb-3" role="alert">
                            <i class="fas fa-check-circle me-1"></i> <?= session('mensaje') ?>
                            <button type="button" class="btn-close p-1" data-bs-dismiss="alert" style="font-size: 0.7rem;"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Formulario -->
                    <form action="<?= base_url('index.php/servicios-extras/registrar') ?>" method="post">
                        <div class="row g-3">

                            <!-- Estancia -->
                            <div class="col-12">
                                <label class="form-label small text-uppercase fw-bold text-primary mb-1" style="font-size: 0.85rem; letter-spacing: 1px;">Huésped</label>
                                <select class="form-select form-select-sm rounded-3 py-2" name="estancia_id" required style="font-size: 1rem; font-weight: 500;">
                                    <option value="">Seleccionar huésped activo...</option>
                                    <?php foreach ($estancias as $e): ?>
                                        <option value="<?= $e->id ?>">
                                            <?= esc("{$e->huesped_nombres} {$e->huesped_apellidos}") ?> • H<?= $e->numero_habitacion ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Servicio -->
                            <div class="col-12">
                                <label class="form-label small text-uppercase fw-bold text-primary mb-1" style="font-size: 0.85rem; letter-spacing: 1px;">Servicio</label>
                                <select class="form-select form-select-sm rounded-3 py-2" name="servicio_id" id="servicio_id" required style="font-size: 1rem; font-weight: 500;">
                                    <option value="">Seleccionar servicio...</option>
                                    <?php foreach ($servicios as $s): ?>
                                        <option value="<?= $s->id ?>" data-unidad="<?= $s->unidad_medida ?>" data-precio="<?= $s->precio_unitario ?>">
                                            <?= esc("{$s->nombre} • Bs. " . number_format($s->precio_unitario, 2)) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Cantidad / Duración -->
                            <div class="col-6" id="campoCantidad">
                                <label class="form-label small text-uppercase fw-bold text-primary mb-1" style="font-size: 0.85rem; letter-spacing: 1px;">Cantidad</label>
                                <input type="number" class="form-control form-control-sm rounded-3 py-2" name="cantidad" value="1" min="1" style="font-size: 1rem; font-weight: 500;">
                            </div>
                            <div class="col-6" id="campoDuracion" style="display:none;">
                                <label class="form-label small text-uppercase fw-bold text-primary mb-1" style="font-size: 0.85rem; letter-spacing: 1px;">Horas</label>
                                <input type="number" class="form-control form-control-sm rounded-3 py-2" name="duracion_horas" step="0.5" min="0.5" value="1.0" style="font-size: 1rem; font-weight: 500;">
                            </div>

                            <!-- Fecha/Hora -->
                            <div class="col-12">
                                <label class="form-label small text-uppercase fw-bold text-primary mb-1" style="font-size: 0.85rem; letter-spacing: 1px;">Cuándo</label>
                                <input type="datetime-local" class="form-control form-control-sm rounded-3 py-2" name="fecha_hora_consumo" value="<?= date('Y-m-d\TH:i') ?>" style="font-size: 1rem; font-weight: 500;">
                            </div>

                            <!-- Notas -->
                            <div class="col-12">
                                <label class="form-label small text-uppercase fw-bold text-primary mb-1" style="font-size: 0.85rem; letter-spacing: 1px;">Notas</label>
                                <textarea class="form-control form-control-sm rounded-3 py-2" name="observaciones" rows="2" placeholder="Ej: Sin hielo, sorpresa..." style="font-size: 1rem; font-weight: 500; resize: none;"></textarea>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn py-3 rounded-3 fw-bold" style="background: linear-gradient(135deg, #27ae60, #2ecc71); color: white; font-size: 1.1rem; letter-spacing: 0.5px;">
                                <i class="fas fa-check-circle me-2"></i> REGISTRAR SERVICIO
                            </button>
                            <a href="<?= base_url('index.php/panel/admin') ?>" class="btn btn-outline-secondary py-3 rounded-3 fw-bold" style="font-size: 1.1rem; letter-spacing: 0.5px;">
                                <i class="fas fa-times me-2"></i> CANCELAR
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-label {
    letter-spacing: 0.5px;
}
.form-select:focus, .form-control:focus {
    box-shadow: 0 0 0 3px rgba(46, 204, 113, 0.3);
    border-color: #2ecc71;
    transform: scale(1.01);
    transition: all 0.2s ease;
}
.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
</style>

<script>
document.getElementById('servicio_id').addEventListener('change', function() {
    const unidad = this.options[this.selectedIndex]?.getAttribute('data-unidad');
    const campoCantidad = document.getElementById('campoCantidad');
    const campoDuracion = document.getElementById('campoDuracion');

    if (unidad === 'hora' || unidad === 'sesion') {
        campoCantidad.style.display = 'none';
        campoDuracion.style.display = 'block';
    } else {
        campoCantidad.style.display = 'block';
        campoDuracion.style.display = 'none';
    }
});
</script>

<?= $this->endSection() ?>