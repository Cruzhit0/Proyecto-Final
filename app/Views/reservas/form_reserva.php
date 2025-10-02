<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card border-0 shadow-lg" style="border-radius: 28px; overflow: hidden;">
                <div class="card-header text-white py-4" style="background: linear-gradient(135deg, #8B0000, #6D071A); border-bottom: 4px solid #D26969;">
                    <h4 class="mb-0 text-center">
                        <i class="fas fa-calendar-plus me-2"></i> Nueva Reserva
                    </h4>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form action="<?= base_url('index.php/reservas/guardar') ?>" method="POST" id="formReserva">

                        <?php if (isset($validation)): ?>
                            <div class="alert alert-danger border-0 shadow-sm mb-4" style="background: #ffebee; color: #c62828; border-left: 5px solid #d32f2f;">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Corrige los siguientes errores:</strong>
                                <ul class="mb-0 mt-2">
                                    <?= $validation->listErrors() ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Fechas -->
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="fecha_inicio" class="form-label fw-bold text-dark" style="font-size: 1.05rem;">
                                    <i class="fas fa-calendar me-2" style="color: #8B0000;"></i> Fecha de Inicio <span class="text-danger">*</span>
                                </label>
                                <input type="date" 
                                       class="form-control" 
                                       id="fecha_inicio" 
                                       name="fecha_inicio" 
                                       required
                                       style="border: 2px solid #D26969; border-radius: 12px; padding: 12px 15px; font-size: 1rem; box-shadow: 0 3px 8px rgba(139,0,0,0.1);"
                                       onfocus="this.style.borderColor='#8B0000'; this.style.boxShadow='0 5px 12px rgba(139,0,0,0.2)';"
                                       onblur="this.style.borderColor='#D26969'; this.style.boxShadow='0 3px 8px rgba(139,0,0,0.1)';"
                                       onchange="cargarHabitaciones()">
                            </div>

                            <div class="col-md-6">
                                <label for="fecha_fin" class="form-label fw-bold text-dark" style="font-size: 1.05rem;">
                                    <i class="fas fa-calendar-check me-2" style="color: #8B0000;"></i> Fecha de Fin <span class="text-danger">*</span>
                                </label>
                                <input type="date" 
                                       class="form-control" 
                                       id="fecha_fin" 
                                       name="fecha_fin" 
                                       required
                                       style="border: 2px solid #D26969; border-radius: 12px; padding: 12px 15px; font-size: 1rem; box-shadow: 0 3px 8px rgba(139,0,0,0.1);"
                                       onfocus="this.style.borderColor='#8B0000'; this.style.boxShadow='0 5px 12px rgba(139,0,0,0.2)';"
                                       onblur="this.style.borderColor='#D26969'; this.style.boxShadow='0 3px 8px rgba(139,0,0,0.1)';"
                                       onchange="cargarHabitaciones()">
                            </div>
                        </div>

                        <!-- Habitación -->
                        <div class="mb-4">
                            <label for="habitacion_id" class="form-label fw-bold text-dark" style="font-size: 1.05rem;">
                                <i class="fas fa-door-open me-2" style="color: #8B0000;"></i> Habitación <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" 
                                    id="habitacion_id" 
                                    name="habitacion_id" 
                                    required
                                    style="border: 2px solid #D26969; border-radius: 12px; padding: 12px 15px; font-size: 1rem; box-shadow: 0 3px 8px rgba(139,0,0,0.1);"
                                    onfocus="this.style.borderColor='#8B0000'; this.style.boxShadow='0 5px 12px rgba(139,0,0,0.2)';"
                                    onblur="this.style.borderColor='#D26969'; this.style.boxShadow='0 3px 8px rgba(139,0,0,0.1)';">
                                <option value="">-- Seleccione fechas primero --</option>
                            </select>
                        </div>

                        <!-- Cantidad de Personas -->
                        <div class="mb-4">
                            <label for="cantidad_personas" class="form-label fw-bold text-dark" style="font-size: 1.05rem;">
                                <i class="fas fa-users me-2" style="color: #8B0000;"></i> Cantidad de Personas
                            </label>
                            <input type="number" 
                                   class="form-control" 
                                   id="cantidad_personas" 
                                   name="cantidad_personas" 
                                   value="1" 
                                   min="1" 
                                   max="10"
                                   style="border: 2px solid #D26969; border-radius: 12px; padding: 12px 15px; font-size: 1rem; box-shadow: 0 3px 8px rgba(139,0,0,0.1);"
                                   onfocus="this.style.borderColor='#8B0000'; this.style.boxShadow='0 5px 12px rgba(139,0,0,0.2)';"
                                   onblur="this.style.borderColor='#D26969'; this.style.boxShadow='0 3px 8px rgba(139,0,0,0.1)';">
                        </div>

                        <!-- Servicios Adicionales -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark" style="font-size: 1.05rem;">
                                <i class="fas fa-concierge-bell me-2" style="color: #8B0000;"></i> Servicios Adicionales
                            </label>
                            <div class="row g-3">
                                <?php foreach ($servicios as $servicio): ?>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               name="servicios[<?= $servicio->id ?>]" 
                                               value="1" 
                                               id="servicio_<?= $servicio->id ?>">
                                        <label class="form-check-label" for="servicio_<?= $servicio->id ?>">
                                            <strong><?= esc($servicio->nombre) ?></strong> - Bs. <?= number_format($servicio->precio_unitario, 2) ?> / <?= $servicio->unidad_medida ?>
                                        </label>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Notas -->
                        <div class="mb-4">
                            <label for="notas" class="form-label fw-bold text-dark" style="font-size: 1.05rem;">
                                <i class="fas fa-sticky-note me-2" style="color: #8B0000;"></i> Notas / Solicitudes Especiales
                            </label>
                            <textarea class="form-control" 
                                      id="notas" 
                                      name="notas" 
                                      rows="3"
                                      style="border: 2px solid #D26969; border-radius: 12px; padding: 12px 15px; font-size: 1rem; box-shadow: 0 3px 8px rgba(139,0,0,0.1);"
                                      onfocus="this.style.borderColor='#8B0000'; this.style.boxShadow='0 5px 12px rgba(139,0,0,0.2)';"
                                      onblur="this.style.borderColor='#D26969'; this.style.boxShadow='0 3px 8px rgba(139,0,0,0.1)';"></textarea>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex gap-3 justify-content-center mt-4">
                            <button type="submit" class="btn px-4 py-2" style="background: linear-gradient(135deg, #8B0000, #6D071A); color: white; border: none; border-radius: 50px; font-weight: 600; font-size: 1.1rem; box-shadow: 0 4px 15px rgba(139,0,0,0.35);">
                                <i class="fas fa-save me-2"></i> Crear Reserva
                            </button>
                            <a href="<?= base_url('index.php/reservas') ?>" class="btn px-4 py-2" style="background: linear-gradient(135deg, #D26969, #A52A2A); color: white; border: none; border-radius: 50px; font-weight: 600; font-size: 1.1rem; box-shadow: 0 4px 15px rgba(165,42,42,0.25);">
                                <i class="fas fa-times me-2"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $urlCargarHabitaciones = base_url("index.php/reservas/cargarHabitaciones"); ?>

<script>
/*
  Versión robusta y con logging exhaustivo para depurar por qué no carga.
  Reemplaza la función anterior por esta.
*/
(function () {
  const url = '<?= $urlCargarHabitaciones ?>'; // ya definida en la vista
  const inicioEl = document.getElementById('fecha_inicio');
  const finEl    = document.getElementById('fecha_fin');
  const selectEl = document.getElementById('habitacion_id');

  if (!inicioEl || !finEl || !selectEl) {
    console.error('[RH] No se encontraron elementos. IDs esperados: fecha_inicio, fecha_fin, habitacion_id');
    return;
  }

  // Mostrar mensaje en el select
  function setSelectMessage(msg, disabled = false) {
    selectEl.disabled = !!disabled;
    selectEl.innerHTML = `<option value="">${msg}</option>`;
  }

  // Debounce para evitar llamadas repetidas
  function debounce(fn, ms = 250) {
    let t;
    return (...args) => {
      clearTimeout(t);
      t = setTimeout(() => fn(...args), ms);
    };
  }

  // Parseador tolerante: acepta YYYY-MM-DD, dd/mm/yyyy y algunos formatos libres
  function parseDateFromInput(raw) {
    if (!raw) return null;
    raw = raw.trim();
    // yyyy-mm-dd (HTML date)
    if (/^\d{4}-\d{2}-\d{2}$/.test(raw)) {
      const d = new Date(raw);
      return isNaN(d.getTime()) ? null : d;
    }
    // dd/mm/yyyy
    if (/^\d{2}\/\d{2}\/\d{4}$/.test(raw)) {
      const [dStr, mStr, yStr] = raw.split('/');
      const d = new Date(parseInt(yStr,10), parseInt(mStr,10) - 1, parseInt(dStr,10));
      return isNaN(d.getTime()) ? null : d;
    }
    // Fallback: intentar con constructor Date
    const d = new Date(raw);
    return isNaN(d.getTime()) ? null : d;
  }

  // Función principal
  async function cargarHabitaciones() {
    const rawInicio = inicioEl.value;
    const rawFin = finEl.value;

    console.debug('[RH] rawInicio:', rawInicio, ' rawFin:', rawFin);

    // Parsear
    const inicio = parseDateFromInput(rawInicio);
    const fin = parseDateFromInput(rawFin);

    console.debug('[RH] parsed inicio:', inicio, ' parsed fin:', fin);

    // Validaciones con mensajes explícitos para saber por qué falla
    if (!rawInicio && !rawFin) {
      setSelectMessage('-- Seleccione ambas fechas --', false);
      return;
    }
    if (!rawInicio) {
      setSelectMessage('⚠ Falta Fecha de Inicio', false);
      return;
    }
    if (!rawFin) {
      setSelectMessage('⚠ Falta Fecha de Fin', false);
      return;
    }
    if (!inicio) {
      setSelectMessage(`⚠ Fecha inicio inválida: "${rawInicio}"`, false);
      return;
    }
    if (!fin) {
      setSelectMessage(`⚠ Fecha fin inválida: "${rawFin}"`, false);
      return;
    }

    // Validar orden
    if (fin <= inicio) {
      setSelectMessage('⚠ La fecha de fin debe ser posterior a la fecha de inicio', false);
      return;
    }

    // Formato para servidor YYYY-MM-DD
    const isoInicio = inicio.toISOString().split('T')[0];
    const isoFin = fin.toISOString().split('T')[0];
    console.debug('[RH] Enviando al servidor:', { isoInicio, isoFin, url });

    // Mostrar cargando
    setSelectMessage('Cargando habitaciones...', true);

    try {
      const res = await fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ fecha_inicio: isoInicio, fecha_fin: isoFin })
      });

      console.debug('[RH] HTTP status:', res.status, ' content-type:', res.headers.get('content-type'));

      const text = await res.text(); // leemos como texto primero
      let data;
      try {
        data = JSON.parse(text);
      } catch (e) {
        console.error('[RH] No se pudo parsear JSON. Body:', text);
        setSelectMessage('Error: respuesta del servidor no es JSON', false);
        return;
      }

      console.debug('[RH] data recibido:', data);

      // Tolerancia a distintos nombres de propiedad
      const rooms = data.habitaciones || data.heabitaciones || data.rooms || [];

      if (data.error) {
        setSelectMessage(data.error, false);
        return;
      }

      if (!Array.isArray(rooms) || rooms.length === 0) {
        setSelectMessage('No hay habitaciones disponibles para esas fechas', false);
        return;
      }

      // Poblar select
      selectEl.disabled = false;
      selectEl.innerHTML = '<option value="">-- Seleccione una habitación --</option>';
      rooms.forEach(h => {
        const opt = document.createElement('option');
        // defensivamente extraer campos
        opt.value = h.id ?? h.habitacion_id ?? h.id_habitacion ?? '';
        const numero = h.numero_habitacion ?? h.numero ?? h.room_number ?? '';
        const tipo = h.tipo_nombre ?? h.tipo ?? h.room_type ?? '';
        const precio = h.precio_noche ?? h.precio ?? h.price ?? 0;
        opt.textContent = `${numero} - ${tipo} (Bs. ${parseFloat(precio).toFixed(2)}/noche)`;
        selectEl.appendChild(opt);
      });

    } catch (err) {
      console.error('[RH] Error de conexión o excepción:', err);
      setSelectMessage('Error de conexión', false);
    }
  }

  // Attach events (más confiable que inline onchange)
  const deb = debounce(cargarHabitaciones, 200);
  inicioEl.addEventListener('change', deb);
  finEl.addEventListener('change', deb);
  // also try input/blur for some datepickers
  inicioEl.addEventListener('blur', deb);
  finEl.addEventListener('blur', deb);

  // Si ya hay fechas al cargar la página, intenta cargar
  if (inicioEl.value && finEl.value) {
    cargarHabitaciones();
  }

  // Exponer para pruebas desde consola
  window.__cargarHabitacionesDebug = cargarHabitaciones;
  console.info('[RH] Script de carga de habitaciones inicializado. Usa __cargarHabitacionesDebug() desde consola para forzar.');
})();
</script>






<?= $this->endSection() ?>