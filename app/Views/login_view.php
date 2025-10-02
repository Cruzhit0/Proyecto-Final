<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Hotel Viña del Sur</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('css/estilos.css') ?>">
  <link rel="icon" href="<?= base_url('img/icono.png') ?>" type="image/png">
  
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      color: #333;
    }

    .login-container {
      background: rgba(255, 255, 255, 0.95);
      padding: 50px;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 450px;
      text-align: center;
      backdrop-filter: blur(10px);
    }

    .login-container h2 {
      color: #2a623d;
      margin-bottom: 30px;
      font-weight: 700;
      font-size: 2rem;
    }

    .form-group {
      margin-bottom: 25px;
      text-align: left;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #555;
    }

    .form-group input {
      width: 100%;
      padding: 14px;
      border: 2px solid #ddd;
      border-radius: 10px;
      font-size: 16px;
      transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-group input:focus {
      border-color: #2a623d;
      outline: none;
      box-shadow: 0 0 0 3px rgba(42, 98, 61, 0.1);
    }

    .btn-login {
      width: 100%;
      padding: 16px;
      background: #2a623d;
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 18px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
    }

    .btn-login:hover {
      background: #1e4d2b;
      transform: translateY(-2px);
    }

    .error {
      background: #ffebee;
      color: #c62828;
      padding: 15px;
      border-radius: 10px;
      margin-bottom: 25px;
      font-size: 15px;
      border-left: 4px solid #c62828;
    }

    .brand {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 15px;
      margin-bottom: 30px;
    }

    .brand img {
      height: 60px;
    }

    .brand h1 {
      font-size: 1.8rem;
      color: #2a623d;
      margin: 0;
    }

    .slogan {
      font-size: 1rem;
      color: #6c757d;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <div class="brand">
      <img src="<?= base_url('img/vina.png') ?>" alt="Logo Hotel Viña del Sur">
      <div>
        <h1>Hotel Viña del Sur</h1>
        <div class="slogan">Tarija · Confort & Tradición</div>
      </div>
    </div>

    <h2>Acceso al Sistema</h2>

    <?php if (session()->has('error')): ?>
        <div class="error">
            <i class="fa fa-exclamation-circle"></i> <?= esc(session('error')) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= base_url('login/autenticar') ?>">
      <div class="form-group">
        <label for="nombre"><i class="fa fa-user"></i> Usuario</label>
        <input type="text" id="nombre" name="nombre" required autofocus placeholder="Ej: carlos_recep">
      </div>
      <div class="form-group">
        <label for="pass"><i class="fa fa-lock"></i> Contraseña</label>
        <input type="password" id="pass" name="pass" required placeholder="••••••••">
      </div>
      <button type="submit" class="btn-login">
        <i class="fa fa-sign-in-alt"></i> Ingresar
      </button>
    </form>
  </div>

</body>
</html>