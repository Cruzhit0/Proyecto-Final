<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($titulo ?? 'Hotel Viña del Sur') ?></title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Estilos personalizados - Color Guindo -->
    <style>
        :root {
            --color-guindo: #8B0000;
            --color-guindo-light: #D26969;
            --color-guindo-dark: #6D071A;
            --text-color: #4A0404;
            --bg-overlay: rgba(139, 0, 0, 0.55);
        }

        body {
            background: url('<?= base_url('img/web-6.jpg') ?>') center/cover no-repeat fixed;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
        }

        .content-overlay {
            background: var(--bg-overlay);
            min-height: 100vh;
            padding: 60px 20px;
            border-radius: 15px;
            margin: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
        }

        /* Navbar superior */
        .navbar-brand {
            font-weight: 800;
            color: white !important;
            text-shadow: 0 1px 3px rgba(0,0,0,0.5);
        }

        .navbar {
            background: linear-gradient(135deg, var(--color-guindo), var(--color-guindo-dark));
            box-shadow: 0 4px 15px rgba(139, 0, 0, 0.3);
        }

        .btn-regresar {
            background: linear-gradient(135deg, var(--color-guindo-light), var(--color-guindo));
            color: white;
            border: none;
            border-radius: 60px;
            padding: 12px 24px;
            font-size: 1rem;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(139, 0, 0, 0.3);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-regresar:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 20px rgba(139, 0, 0, 0.5);
            background: linear-gradient(135deg, var(--color-guindo-dark), var(--color-guindo));
        }

        .btn-regresar i {
            transition: transform 0.3s ease;
        }

        .btn-regresar:hover i {
            transform: rotate(180deg);
        }

        .card-header {
            background: linear-gradient(135deg, var(--color-guindo), var(--color-guindo-dark));
            color: white;
            border-bottom: 3px solid var(--color-guindo-light);
        }

        .form-control:focus {
            border-color: var(--color-guindo);
            box-shadow: 0 0 0 0.2rem rgba(139, 0, 0, 0.25);
        }

        .invalid-feedback {
            color: #d32f2f;
        }

        .alert-success {
            background-color: #e6c5b7;
            border-color: #d3a58d;
            color: #6d071a;
        }

        .alert-danger {
            background-color: #d32f2f;
            border-color: #c62828;
            color: white;
        }
    </style>
</head>
<body>

<div class="content-overlay">
    <!-- Navbar superior -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url('panel') ?>">
                <i class="fas fa-hotel me-1"></i> Hotel Viña del Sur
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('panel/logout') ?>">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <?= $this->renderSection('content') ?>

    <!-- Botón Regresar al Panel -->
    <div class="text-center mt-4">
        <a href="<?= base_url('index.php/panel/admin') ?>" class="btn-regresar">
            <i class="fas fa-arrow-left"></i> Regresar al Panel
        </a>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>