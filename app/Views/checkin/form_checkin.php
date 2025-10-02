<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="container-fluid mt-3">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-9">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-sign-in-alt me-2"></i> Registro de Check-in
                    </h4>
                </div>
                <div class="card-body p-3">

                    <?php if (session()->has('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show small mb-3 p-2" role="alert">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            <?= session('error') ?>
                            <button type="button" class="btn-close p-1" data-bs-dismiss="alert" style="font-size: 0.8rem;"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('index.php/checkin/registrar') ?>" method="post" id="formCheckin">
                        <div class="row g-2">

                            <!-- Buscar Reserva -->
                            <div class="col-12">
                                <label class="form-label fw-bold small mb-1">ID de Reserva (si tiene):</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" 
                                           class="form-control" 
                                           id="reserva_id" 
                                           name="reserva_id" 
                                           placeholder="Ej: 1234"
                                           value="<?= old('reserva_id') ?>">
                                    <button type="button" class="btn btn-outline-primary btn-sm" id="btnBuscarReserva">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                <div id="reservaInfo" class="mt-2 p-2 bg-light rounded small d-none">
                                    <div class="fw-bold text-primary mb-1"><i class="fas fa-info-circle me-1"></i> Reserva Encontrada</div>
                                    <div id="reservaDetails" class="small"></div>
                                </div>
                            </div>

                            <!-- Datos del Huésped -->                            <div class="col-md-6">
                                <label for="nombres" class="form-label small fw-bold mb-1">Nombres <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control form-control-sm" 
                                       id="nombres" 
                                       name="nombres" 
                                       value="<?= old('nombres') ?>" 
                                       required>
                            </div>
                            <div class="col-md-6">
                                <label for="apellidos" class="form-label small fw-bold mb-1">Apellidos <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control form-control-sm" 
                                       id="apellidos" 
                                       name="apellidos" 
                                       value="<?= old('apellidos') ?>" 
                                       required>
                            </div>
                            <div class="col-md-6">
                                <label for="doc_identidad" class="form-label small fw-bold mb-1">Documento <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control form-control-sm" 
                                       id="doc_identidad" 
                                       name="doc_identidad" 
                                       value="<?= old('doc_identidad') ?>" 
                                       required>
                            </div>
                            <div class="col-md-6">
                                <label for="lugar_origen_id" class="form-label small fw-bold mb-1">Lugar de Origen</label>
                                <select class="form-select form-select-sm" id="lugar_origen_id" name="lugar_origen_id">
                                    <option value="">— Seleccione —</option>
                                    <?php foreach ($lugares_origen as $lugar): ?>
                                        <option value="<?= $lugar->id ?>" <?= old('lugar_origen_id') == $lugar->id ? 'selected' : '' ?>>
                                            <?= esc($lugar->pais) ?> <?= $lugar->ciudad ? ' - ' . $lugar->ciudad : '' ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="direccion" class="form-label small fw-bold mb-1">Dirección</label>
                                <input type="text" 
                                       class="form-control form-control-sm" 
                                       id="direccion" 
                                       name="direccion" 
                                       value="<?= old('direccion') ?>" 
                                       placeholder="Calle, número, ciudad">
                            </div>

                            <!-- Habitación (solo si no hay reserva) -->                            <div class="col-md-6" id="campoHabitacion" style="<?= old('reserva_id') ? 'display: none;' : '' ?>">
                                <label for="habitacion_id" class="form-label small fw-bold mb-1">Habitación <span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm" id="habitacion_id" name="habitacion_id">
                                    <option value="">— Seleccione una habitación disponible —</option>
                                    <?php foreach ($habitaciones_disponibles as $h): ?>
                                        <option value="<?= $h->id ?>" <?= old('habitacion_id') == $h->id ? 'selected' : '' ?>>
                                            H<?= $h->numero_habitacion ?> (<?= esc($h->tipo_nombre ?? 'N/A') ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="observaciones" class="form-label small fw-bold mb-1">Observaciones</label>
                                <textarea class="form-control form-control-sm" 
                                          id="observaciones" 
                                          name="observaciones" 
                                          rows="2" 
                                          placeholder="Ej: Alergia, cumpleaños, etc."><?= old('observaciones') ?></textarea>
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-between mt-3">
                            <a href="<?= base_url('index.php/checkin/listado') ?>" class="btn btn-outline-secondary btn-sm px-3">
                                <i class="fas fa-list me-1"></i> Listado
                            </a>
                            <button type="submit" class="btn btn-primary btn-sm px-4">
                                <i class="fas fa-sign-in-alt me-1"></i> Registrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('btnBuscarReserva').addEventListener('click', function() {
    const reservaId = document.getElementById('reserva_id').value;
    if (!reservaId) || !/^\d+$/.test(reservaId)) {
        alert('Ingrese un ID de reserva válido.');
        return;
    }

    fetch('<?= base_url('index.php/checkin/buscarReserva/') ?>' + reservaId)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                document.getElementById('reservaInfo').classList.add('d-none');
            } else {
                const res = data.reserva;
                const huesped = data.huesped;

                let html = `
                    <div><strong>Huésped:</strong> ${res.nombre_usuario}</div>
                    <div><strong>Hab:</strong> H${res.numero_habitacion}</div>
                    <div><strong>Fechas:</strong> ${res.fecha_inicio} a ${res.fecha_fin}</div>
                    <div><strong>Total:</strong> Bs. ${parseFloat(res.monto_total).toFixed(2)}</div>
                `;

                document.getElementById('reservaDetails').innerHTML = html;
                document.getElementById('reservaInfo').classList.remove('d-none');

                // Rellenar campos del huésped si existen
                if (huesped) {
                    document.getElementById('nombres').value = huesped.nombres || '';
                    document.getElementById('apellidos').value = huesped.apellidos || '';
                    document.getElementById('doc_identidad').value = huesped.doc_identidad || '';
                    document.getElementById('direccion').value = huesped.direccion || '';
                    if (huesped.lugar_origen_id) {
                        document.getElementById('lugar_origen_id').value = huesped.lugar_origen_id;
                    }
                }

                // Ocultar selector de habitación
                document.getElementById('campoHabitacion').style.display = 'none';
            }
        })
        .catch(err => {
            console.error(err);
            alert('Error al buscar la reserva.');
        });
});

// Si se borra el ID de reserva, mostrar selector de habitación
document.getElementById('reserva_id').addEventListener('input', function() {
    if (this.value.trim() === '') {
        document.getElementById('campoHabitacion').style.display = 'block';
        document.getElementById('reservaInfo').classList.add('d-none');
    } else {
        document.getElementById('campoHabitacion').style.display = 'none';
    }
});
</script>

<?= $this->endSection() ?>