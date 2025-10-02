
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Viña del Sur</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-image: url('img/web-6.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative;
        }

        /* Overlay oscuro para mejorar legibilidad */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Oscurece el fondo */
            z-index: -1;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.92); /* Blanco translúcido */
            backdrop-filter: blur(10px); /* Efecto glassmorphism */
            -webkit-backdrop-filter: blur(10px);
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 420px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        /* Borde sutil de color guindo en la parte superior */
        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #800040, #660033);
        }

        .logo {
            width: 140px;
            margin-bottom: 25px;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        h2 {
            margin-bottom: 35px;
            color: #2c2c2c;
            font-weight: 700;
            font-size: 28px;
            letter-spacing: 0.5px;
            position: relative;
            padding-bottom: 10px;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: #800040;
            border-radius: 2px;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 14px 16px;
            margin: 12px 0;
            border: 1px solid #e1e1e1;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 500;
            color: #333;
            background: #fafafa;
            transition: all 0.3s ease;
            outline: none;
        }

        .login-form input:focus {
            border-color: #800040;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(128, 0, 64, 0.1);
        }

        .login-form button {
            width: 100%;
            padding: 15px;
            margin: 25px 0 20px;
            background: linear-gradient(135deg, #800040, #660033);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(128, 0, 64, 0.3);
        }

        .login-form button:hover {
            background: linear-gradient(135deg, #660033, #4d0026);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(128, 0, 64, 0.4);
        }

        .login-form button:active {
            transform: translateY(0);
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            margin-top: 15px;
            width: 100%;
        }

        .options a {
            color: #800040;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .options a:hover {
            color: #660033;
            text-decoration: underline;
        }

        .options label {
            color: #555;
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
        }

        .options input[type="checkbox"] {
            cursor: pointer;
        }

        /* Animación sutil al cargar */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-container {
            animation: fadeInUp 1.5s ease-out;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-container {
                margin: 15px;
                padding: 40px 25px;
            }
            h2 {
                font-size: 24px;
            }
            .logo {
                width: 120px;
            }
        }


        .btn-volver {
            display: inline-block;
            padding: 10px 24px;
            margin-top: 25px;
            background: linear-gradient(135deg, #800040, #660033);
            color: white !important;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(128, 0, 64, 0.3);
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }

        .btn-volver:hover {
            background: linear-gradient(135deg, #660033, #4d0026);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(128, 0, 64, 0.4);
            text-decoration: none !important;
        }

        .btn-volver:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>

    <form method="post" action="<?php echo base_url(); ?>login/autenticar">

        <div class="login-container">
            <?php if (session()->getFlashdata('error')): ?>
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #f5c6cb; text-align: center;">
                <strong>Error:</strong> <?= session()->getFlashdata('error') ?>
            </div>
            <?php endif; ?>
            <div class="login-form">
                <img src="logo-vina-del-sur.png" alt="Viña del Sur" class="logo">
                <h2>Iniciar Sesión</h2>
                <input type="text" name="nombre" placeholder="Usuario" required autocomplete="username">
                <input type="password" name="contrasena" placeholder="Contraseña" required autocomplete="current-password">
                <button type="submit" class="btn-primary btn-block">Ingresar</button>
                <div class="options">
                    <label>
                        <input type="checkbox" name="recordarme"> Recordarme
                    </label>
                    <div style="text-align: center; margin-top: 30px;">
                        <a href="<?php echo base_url(); ?>" class="btn-volver">← Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

</body>
</html>