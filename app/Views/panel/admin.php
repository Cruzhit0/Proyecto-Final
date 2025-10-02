<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Viña del Sur - Panel de Administración</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: url('<?= base_url('img/web-6.jpg') ?>') center/cover no-repeat fixed;
                min-height: 100vh;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }

            .content-overlay {
                background: rgba(0, 0, 0, 0.55); /* Overlay más oscuro para contraste premium */
                min-height: 100vh;
                padding: 60px 20px;
            }

            /* Banner de bienvenida con estilo ejecutivo */
            .welcome-banner {
                background: linear-gradient(135deg, #6D071A, #8B0000);
                color: white;
                border-radius: 30px;
                padding: 50px 40px;
                box-shadow: 
                0 10px 30px rgba(0,0,0,0.4),
                0 0 0 2px rgba(255,255,255,0.1),
                inset 0 1px 0 rgba(255,255,255,0.15);
                backdrop-filter: blur(12px);
                text-align: center;
                margin-bottom: 60px;
                position: relative;
                overflow: hidden;
            }

            .welcome-banner::before {
                content: "";
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
                animation: rotate 15s linear infinite;
                pointer-events: none;
            }

            @keyframes rotate {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }

            .welcome-banner h1 {
                font-weight: 800;
                font-size: 2.8rem;
                letter-spacing: 1.5px;
                margin-bottom: 5px;
                text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            }
            .welcome-banner h4 {
                font-weight: 300;
                opacity: 0.95;
                font-size: 1.2rem;
            }

            /* Tarjetas de administración - Estilo Premium */
            .admin-card {
                background: linear-gradient(150deg, #ffffff, #faf7f7);
                border-radius: 28px;
                padding: 40px 25px;
                text-align: center;
                transition: all 0.45s cubic-bezier(0.2, 0.8, 0.3, 1);
                box-shadow:
                0 8px 25px rgba(0,0,0,0.08),
                0 2px 4px rgba(0,0,0,0.05),
                0 0 0 1px rgba(139, 0, 0, 0.15);
                border: 2px solid rgba(139, 0, 0, 0.12);
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }

            .admin-card:hover {
                transform: translateY(-15px) scale(1.04);
                box-shadow:
                0 25px 50px rgba(109, 7, 26, 0.25),
                0 10px 20px rgba(0,0,0,0.1),
                0 0 0 1px rgba(139, 0, 0, 0.3);
                border-color: #8B0000;
            }

            .admin-card i {
                font-size: 3.2rem;
                margin-bottom: 25px;
                color: #6D071A;
                transition: all 0.35s ease;
                background: linear-gradient(135deg, #8B0000, #D26969);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                filter: drop-shadow(0 3px 6px rgba(139,0,0,0.15));
            }

            .admin-card:hover i {
                transform: scale(1.15) rotate(5deg);
                filter: drop-shadow(0 5px 12px rgba(139,0,0,0.25));
            }

            .admin-card h5 {
                font-weight: 700;
                color: #4A0404;
                margin-bottom: 30px;
                font-size: 1.35rem;
                letter-spacing: 0.8px;
                text-shadow: 0 1px 2px rgba(0,0,0,0.05);
            }

            /* Botones tipo botón real — no solo enlaces */
            .btn-admin {
                display: inline-block;
                background: linear-gradient(135deg, #D26969, #A52A2A);
                color: white;
                font-weight: 600;
                border: none;
                border-radius: 60px;
                padding: 16px 32px;
                font-size: 1rem;
                cursor: pointer;
                box-shadow:
                0 5px 15px rgba(165, 42, 42, 0.3),
                0 2px 4px rgba(0,0,0,0.1),
                inset 0 1px 0 rgba(255,255,255,0.2);
                transition: all 0.35s ease;
                text-decoration: none;
                width: 100%;
                margin-top: 10px;
                position: relative;
                overflow: hidden;
            }

            .btn-admin:hover {
                background: linear-gradient(135deg, #8B0000, #6D071A);
                transform: translateY(-3px) scale(1.05);
                box-shadow:
                0 10px 30px rgba(139, 0, 0, 0.4),
                0 4px 8px rgba(0,0,0,0.15),
                inset 0 1px 0 rgba(255,255,255,0.3);
            }

            .btn-admin:active {
                transform: scale(0.98);
                box-shadow: 0 3px 10px rgba(139, 0, 0, 0.3);
            }

            .btn-admin::after {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
                transition: left 0.7s;
            }

            .btn-admin:hover::after {
                left: 100%;
            }

            /* Botón de cierre de sesión — estilo ejecutivo */
            .btn-logout {
                background: linear-gradient(135deg, #8B0000, #6D071A);
                color: white;
                border: none;
                font-weight: 700;
                border-radius: 60px;
                padding: 18px 45px;
                font-size: 1.15rem;
                box-shadow:
                0 8px 25px rgba(139, 0, 0, 0.45),
                0 4px 8px rgba(0,0,0,0.2),
                inset 0 1px 0 rgba(255,255,255,0.2);
                transition: all 0.4s cubic-bezier(0.2, 0.8, 0.3, 1);
                cursor: pointer;
                text-decoration: none;
            }

            .btn-logout:hover {
                transform: scale(1.07) translateY(-5px);
                box-shadow:
                0 15px 40px rgba(109, 7, 26, 0.55),
                0 6px 12px rgba(0,0,0,0.25),
                inset 0 1px 0 rgba(255,255,255,0.3);
                background: linear-gradient(135deg, #6D071A, #4A0404);
            }

            .btn-logout:active {
                transform: scale(0.98);
            }

            /* Responsive: en pantallas grandes, scroll horizontal suave si hay espacio */
            @media (min-width: 1500px) {
                .cards-container {
                    overflow-x: auto;
                    padding: 10px 0 40px;
                    scrollbar-width: thin;
                    scrollbar-color: #8B0000 #f8f5f5;
                }
                .cards-container::-webkit-scrollbar {
                    height: 8px;
                }
                .cards-container::-webkit-scrollbar-track {
                    background: #f8f5f5;
                    border-radius: 10px;
                }
                .cards-container::-webkit-scrollbar-thumb {
                    background: #8B0000;
                    border-radius: 10px;
                }
                .card-wrapper {
                    display: inline-block;
                    vertical-align: top;
                    margin-right: 30px;
                    min-width: 280px;
                }
            }

            @media (max-width: 576px) {
                .welcome-banner h1 {
                    font-size: 2rem;
                }
                .admin-card {
                    padding: 30px 20px;
                }
                .admin-card i {
                    font-size: 2.5rem;
                }
            }
        </style>
    </head>
    <body>

        <div class="content-overlay">
            <div class="container">

                <!-- Banner de Bienvenida -->
                <div class="row justify-content-center mb-5">
                    <div class="col-12 col-md-11 col-lg-9">
                        <div class="welcome-banner">
                            <h1>🏨 Hotel Viña del Sur</h1>
                            <p class="opacity-90">Tarija · Sur de Bolivia</p>
                            <h4 class="mt-3">✅ Bienvenido, <strong><?= esc($usuario) ?></strong></h4>
                            <p class="mt-2"><i class="fas fa-user-shield me-2"></i> <strong>Rol:</strong> <?= esc($rol) ?></p>
                        </div>
                    </div>
                </div>

                <!-- Dashboard de Tarjetas -->
                <div class="row g-4 justify-content-center cards-container">

                    <!-- Usuarios -->
                    <div class="col-12 col-sm-6 col-md-4 col-xl-2 card-wrapper">
                        <div class="admin-card">
                            <i class="fas fa-users"></i>
                            <h5>Usuarios</h5>
                            <a href="<?= base_url('usuarios') ?>" class="btn-admin">
                                <i class="fas fa-cog me-2"></i> Configurar
                            </a>
                        </div>
                    </div>



                    <!-- Gestión de Tipos de Habitación -->
                    <div class="col-12 col-sm-6 col-md-4 col-xl-2 card-wrapper">
                        <div class="admin-card">
                            <i class="fas fa-star text-warning"></i>
                            <h5 class="mt-3">Habitaciónes Tipo</h5>
                            <a href="<?= base_url('panel/habitacionesTipo') ?>" class="btn-admin w-100 mt-2">
                                <i class="fas fa-cog me-2"></i> Configurar
                            </a>
                        </div>
                    </div>


                    <!-- Servicios -->
                    <div class="col-12 col-sm-6 col-md-4 col-xl-2 card-wrapper">
                        <div class="admin-card">
                            <i class="fas fa-concierge-bell"></i>
                            <h5>Servicios</h5>
                            <a href="<?= base_url('servicios') ?>" class="btn-admin">
                                <i class="fas fa-cog me-2"></i> Configurar
                            </a>

                        </div>
                    </div>

                    <!-- Habitaciones -->
                    <div class="col-12 col-sm-6 col-md-4 col-xl-2 card-wrapper">
                        <div class="admin-card">
                            <i class="fas fa-door-open"></i>
                            <h5>Habitaciones del Hotel</h5>
                            <a href="<?= base_url('panel/habitaciones') ?>" class="btn-admin">
                                <i class="fas fa-cog me-2"></i> Configurar
                            </a>
                        </div>
                    </div>

                    <!-- Reservas -->
                    <div class="col-12 col-sm-6 col-md-4 col-xl-2 card-wrapper">
                        <div class="admin-card">
                            <i class="fas fa-calendar-check"></i>
                            <h5>Reservas</h5>
                            <a href="<?= base_url('reservas') ?>" class="btn-admin">
                                <i class="fas fa-plus-circle me-2"></i> Gestionar
                            </a>
                        </div>
                    </div>

                    <!-- Check-in -->
                    <div class="col-12 col-sm-6 col-md-4 col-xl-2 card-wrapper">
                        <div class="admin-card" style="border-top: 5px solid #28a745; background: linear-gradient(150deg, #f8fff9, #e8f5ea);">
                            <i class="fas fa-sign-in-alt" style="color: #28a745;"></i>
                            <h5 style="color: #155724;">Check-in</h5>
                            <a href="<?= base_url('checkin') ?>" class="btn-admin" style="background: linear-gradient(135deg, #28a745, #218838);">
                                <i class="fas fa-door-open me-2"></i> Ingreso
                            </a>
                        </div>
                    </div>

                    <!-- Servicios Extras -->
                    <div class="col-12 col-sm-6 col-md-4 col-xl-2 card-wrapper">
                        <div class="admin-card" style="border-top: 5px solid #FF9800; background: linear-gradient(150deg, #fff8e1, #ffecb3);">



                          <i class="fas fa-utensils" style="color: #E65100; font-size: 3.2rem;"></i>
                          <h5 style="color: #E65100; font-weight: 700;">Servicios Extras</h5>
                          <a href="<?= base_url('servicios-extras') ?>" class="btn-admin" style="background: linear-gradient(135deg, #FF9800, #F57C00);">
                            <i class="fas fa-plus-circle me-2"></i> Registrar
                        </a>
                    </div>
                </div>

                <!-- Listado de Consumos por Habitación -->
                <div class="col-12 col-sm-6 col-md-4 col-xl-2 card-wrapper">
                    <div class="admin-card" style="border-top: 5px solid #6D071A; background: linear-gradient(150deg, #fff5f5, #f8d7da);">
                        <i class="fas fa-list-ul" style="color: #6D071A; font-size: 3.2rem;"></i>
                        <h5 style="color: #6D071A; font-weight: 700;">Consumos por Hab.</h5>
                        <a href="<?= base_url('servicios-extras/listado-por-habitacion') ?>" class="btn-admin" style="background: linear-gradient(135deg, #6D071A, #8B0000);">
                            <i class="fas fa-eye me-2"></i> Ver
                        </a>
                    </div>
                </div>


                <!-- Check-out -->
                <div class="col-12 col-sm-6 col-md-4 col-xl-2 card-wrapper">
                    <div class="admin-card" style="border-top: 5px solid #dc3545; background: linear-gradient(150deg, #fff5f5, #f8d7da);">
                        <i class="fas fa-sign-out-alt" style="color: #dc3545;"></i>
                        <h5 style="color: #721c24;">Check-out</h5>
                        <a href="<?= base_url('checkout') ?>" class="btn-admin" style="background: linear-gradient(135deg, #dc3545, #c82333);">
                            <i class="fas fa-door-closed me-2"></i> Salida
                        </a>
                    </div>
                </div>

                <!-- Configuración del sistema -->
                <div class="col-12 col-sm-6 col-md-4 col-xl-2 card-wrapper">
                    <div class="admin-card" style="border-top: 5px solid #c0c0c0; background: linear-gradient(135deg, #f0f0f0, #d0d0d0); ">
                        <i class="fas fa-cogs" style="color: #a9a9a9;"></i>
                        <h5 style="color: #333; margin: 1rem 0; font-weight: 500;">Configurar</h5>
                        <a href="<?= base_url('admin/configuracion') ?>" 
                         class="btn-admin" 
                         style="background: linear-gradient(135deg, #fafafa, #e0e0e0);"
                         onmouseover="this.style.backgroundColor='#bbb'; this.style.color='#222';" 
                         onmouseout="this.style.backgroundColor='#ccc'; this.style.color='#333';">
                         <i class="fas fa-sliders-h me-2"></i> Front
                     </a>
                 </div>
             </div>

         </div>

         <!-- Botón de Cierre de Sesión -->
         <div class="row justify-content-center mt-5">
            <div class="col-auto">
                <a href="<?= base_url('panel/logout') ?>" class="btn-logout">
                    <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
                </a>
            </div>
        </div>

    </div>
</div>

<!-- Bootstrap JS (opcional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>