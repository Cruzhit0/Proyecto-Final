<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-lg" style="border-radius: 28px; overflow: hidden;">
                <div class="card-header text-white py-4" style="background: linear-gradient(135deg, #8B0000, #6D071A); border-bottom: 4px solid #D26969;">
                    <h4 class="mb-0 text-center">
                        <i class="fas fa-credit-card me-2"></i> Confirmar Reserva #<?= $reserva->id ?> <!-- ✅ Cambiado a ->id -->
                    </h4>
                </div>

                <div class="card-body p-4 p-md-5">
                    <div class="alert alert-info border-0 shadow-sm" style="background: #e6f7ff; border-left: 5px solid #1890ff;">
                        <h5 class="mb-3"><i class="fas fa-info-circle me-2"></i> Detalles de la Reserva</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong><i class="fas fa-calendar me-2"></i> Fechas:</strong><br>
                                   <?= date('d/m/Y', strtotime($reserva->fecha_inicio)) ?> - <?= date('d/m/Y', strtotime($reserva->fecha_fin)) ?> <!-- ✅ ->fecha_inicio -->
                                </p>
                                <p><strong><i class="fas fa-user me-2"></i> Cliente:</strong><br>
                                   <?= esc($reserva->nombre_usuario) ?> <!-- ✅ ->nombre_usuario -->
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong><i class="fas fa-tag me-2"></i> Monto Total Original:</strong><br>
                                   Bs. <?= number_format($reserva->monto_total, 2) ?> <!-- ✅ ->monto_total -->
                                </p>
                                <p><strong><i class="fas fa-percentage me-2"></i> Descuento por Pronto Pago:</strong><br>
                                   ¡Hasta 2% si paga hoy!
                                </p>
                            </div>
                        </div>
                    </div>

                    <?php if (session()->has('error')): ?>
                        <div class="alert alert-danger border-0 shadow-sm mb-4" style="background: #ffebee; color: #c62828; border-left: 5px solid #d32f2f;">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <?= session('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url("index.php/reservas/procesarPago/{$reserva->id}") ?>" method="POST"> <!-- ✅ ->id -->
                        <div class="mb-4">
                            <label for="metodo_pago" class="form-label fw-bold text-dark" style="font-size: 1.05rem;">
                                <i class="fas fa-money-bill-wave me-2" style="color: #8B0000;"></i> Método de Pago <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" 
                                    id="metodo_pago" 
                                    name="metodo_pago" 
                                    required
                                    style="border: 2px solid #D26969; border-radius: 12px; padding: 12px 15px; font-size: 1rem; box-shadow: 0 3px 8px rgba(139,0,0,0.1);">
                                <option value="">-- Seleccione método de pago --</option>
                                <option value="tarjeta">Tarjeta de Crédito/Débito</option>
                                <option value="efectivo">Efectivo</option>
                                <option value="transferencia">Transferencia Bancaria</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="monto_pagado" class="form-label fw-bold text-dark" style="font-size: 1.05rem;">
                                <i class="fas fa-coins me-2" style="color: #8B0000;"></i> Monto a Pagar <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="background: #D26969; color: white; border: 2px solid #D26969; border-radius: 12px 0 0 12px;">Bs.</span>
                                <input type="number" 
                                       step="0.01" 
                                       class="form-control" 
                                       id="monto_pagado" 
                                       name="monto_pagado" 
                                       required 
                                       min="<?= number_format($montoMinimo, 2, '.', '') ?>" 
                                       value="<?= number_format($montoMinimo, 2, '.', '') ?>"
                                       style="border: 2px solid #D26969; border-radius: 0 12px 12px 0; padding: 12px 15px; font-size: 1rem; box-shadow: 0 3px 8px rgba(139,0,0,0.1);">
                            </div>
                            <small class="form-text text-muted mt-1">
                                Monto mínimo requerido: Bs. <?= number_format($montoMinimo, 2) ?> (50% del total)
                            </small>
                        </div>

                        <div class="alert alert-warning border-0 shadow-sm" style="background: #fff3cd; border-left: 5px solid #ffc107;">
                            <i class="fas fa-gift me-2"></i>
                            <strong>¡Oferta Especial!</strong> Si paga dentro de los próximos 2 días, recibirá un <strong>2% de descuento</strong> en el monto total.
                        </div>

                        <div class="d-flex gap-3 justify-content-center mt-4">
                            <button type="submit" class="btn px-4 py-2" style="background: linear-gradient(135deg, #8B0000, #6D071A); color: white; border: none; border-radius: 50px; font-weight: 600; font-size: 1.1rem; box-shadow: 0 4px 15px rgba(139,0,0,0.35);">
                                <i class="fas fa-check-circle me-2"></i> Confirmar Pago
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

<?= $this->endSection() ?>