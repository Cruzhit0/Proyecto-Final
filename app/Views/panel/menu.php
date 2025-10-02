<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Montserrat:wght@700&display=swap" rel="stylesheet">
  <style>
    /* Estilos generales */
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f9;
    }

    /* Jumbotron con fondo celeste claro */
    .jumbotron {
      margin-bottom: 0;
      background-color: #b9fdf7 ; /* Fondo celeste claro */
      background-size: cover;
      background-position: center;
      padding: 2% 0; /* Altura restaurada a la definición anterior */
      text-align: center;
      color: #ffffff;
      position: relative;
    }

    .jumbotron::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.2);
      z-index: 1;
    }

    .jumbotron h2 {
      font-family: 'Montserrat', sans-serif;
      font-weight: 700;
      font-size: clamp(1.5rem, 4vw, 2.5rem);
      letter-spacing: 2px;
      text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.7);
      text-transform: uppercase;
      margin: 10px 0;
      position: relative;
      z-index: 2;
      /* color: #fff; */ /* Línea anterior comentada */
      color: #000000; /* Restaurado a negro como estaba definido */
    }

    .jumbotron img {
      max-width: 120px;
      animation: fadeIn 1.5s ease-in-out;
      position: relative;
      z-index: 2;
    }

    /* Animación para el logo */
    @keyframes fadeIn {
      0% { opacity: 0; transform: translateY(-20px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    .logo {
      width: 100px;
      height: auto;
      animation: fadeIn 1s ease-in-out;
      margin: 0 auto;
      display: block;
    }

    /* Estilos responsivos para el logo */
    @media (min-width: 768px) {
      .logo { width: 140px; }
    }

    @media (min-width: 1024px) {
      .logo { width: 180px; }
    }

    /* Navbar - Estilo de la barra de navegación */
    .navbar {
      background: linear-gradient(90deg, #003087, #005cbf);
      padding: 0.5rem 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      position: sticky;
      top: 0;
      z-index: 1000;
      display: flex;
      align-items: center;
      justify-content: flex-start;
    }

    .navbar-header {
      display: flex;
      align-items: center;
      width: auto;
    }

    .navbar-brand a {
      color: #fff !important;
      text-decoration: none;
      padding: 0.5rem 1rem;
      font-weight: 600;
      font-size: 1rem;
      white-space: nowrap;
    }

    .navbar-toggle {
      display: none;
      background: none;
      border: none;
      color: #fff;
      font-size: 1.2rem;
      cursor: pointer;
      padding: 0.5rem;
      margin-left: 1rem;
    }

    .navbar-collapse {
      display: flex;
      align-items: center;
    }

    .navbar-nav {
      display: flex;
      align-items: center;
      margin: 0;
      padding: 0;
      list-style: none;
    }

    .navbar-nav li a {
      color: #fff !important;
      font-weight: 600;
      padding: 0.5rem 1rem;
      transition: all 0.3s ease;
      position: relative;
      text-decoration: none;
      white-space: nowrap;
    }

    .navbar-nav li a:hover {
      color: #ffd700 !important;
      transform: translateY(-2px);
    }

    .navbar-nav li a::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      background: #ffd700;
      bottom: 0;
      left: 50%;
      transition: all 0.3s ease;
      transform: translateX(-50%);
    }

    .navbar-nav li a:hover::after {
      width: 80%;
    }

    /* Estilo del sticker "NUEVO" */
    .nuevo-badge {
      background: linear-gradient(45deg, #ff3333, #ff6666);
      color: #ffff00;
      font-size: 0.7rem;
      font-weight: 700;
      text-transform: uppercase;
      padding: 0.3rem 0.6rem;
      border-radius: 10px;
      position: absolute;
      top: -8px;
      left: 70%;
      transform: translateX(-50%);
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      animation: shake 1.5s infinite;
      z-index: 10;
    }

    .menu-item {
      position: relative;
    }

    @keyframes shake {
      0% { transform: translateX(-50%) scale(1); }
      25% { transform: translateX(-50% - 2px) rotate(-1deg); }
      50% { transform: translateX(-50% + 2px) rotate(1deg); }
      75% { transform: translateX(-50% - 2px) rotate(-1deg); }
      100% { transform: translateX(-50%) scale(1); }
    }

    /* Estilo del botón "Usuario" */
    .navbar-nav li a .special {
      border: 2px solid #3e9efe;
      padding: 0.4rem 0.8rem;
      background: linear-gradient(45deg, #3e9efe, #6bb6ff);
      color: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease;
    }

    .navbar-nav li a .special:hover {
      background: linear-gradient(45deg, #2a7de1, #4a9cff);
      transform: scale(1.05) translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
      color: #ffd700;
    }

    /* Media Query para pantallas pequeñas */
    @media (max-width: 768px) {
      .navbar {
        padding: 0.3rem 1rem;
      }

      .navbar-toggle {
        display: block;
      }

      .navbar-collapse {
        display: none;
        width: 100%;
        position: absolute;
        top: 100%;
        left: 0;
        background: linear-gradient(90deg, #003087, #005cbf);
        z-index: 999;
      }

      .navbar-collapse.show {
        display: block;
      }

      .navbar-nav {
        flex-direction: column;
        align-items: flex-start;
        width: 100%;
      }

      .navbar-nav li {
        width: 100%;
      }

      .navbar-nav li a {
        display: block;
        width: 100%;
        padding: 0.8rem 1rem;
        text-align: left;
      }

      .nuevo-badge {
        left: auto;
        right: 1rem;
        transform: none;
      }
    }
  </style>
</head>
<body>
  <!-- Jumbotron -->
  <div class="jumbotron text-center">
    <img class="logo" src="<?php echo base_url();?>imgs/logo5.png" alt="Logo">
    <h2>Hotel Viña del Sur</h2>
  </div>

  <!-- Navbar -->
  <header class="main-header">
    <nav class="navbar navbar-fixed">
      <div class="navbar-header">
        <a href="<?php echo base_url();?>Inicio" class="navbar-brand"><b>Inicio</b></a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>
      
    </nav>
  </header>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const toggleButton = document.querySelector('.navbar-toggle');
      const navbarCollapse = document.querySelector('.navbar-collapse');
      toggleButton.addEventListener('click', function() {
        navbarCollapse.classList.toggle('show');
      });

      let currentDate = new Date();
      let currentDateString = currentDate.toISOString().split('T')[0];
      let storedStartDate = localStorage.getItem('nuevoStickerStartDate');
      let storedShowCount = localStorage.getItem('nuevoStickerShowCount');

      if (!storedStartDate) {
        localStorage.setItem('nuevoStickerStartDate', currentDateString);
        storedStartDate = currentDateString;
        storedShowCount = 0;
      }

      storedShowCount = storedShowCount ? parseInt(storedShowCount) : 0;
      let startDateObj = new Date(storedStartDate);
      let diffTime = currentDate - startDateObj;
      let diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));

      let sticker = document.querySelector('.nuevo-badge');
      if (diffDays < 1 && storedShowCount < 100) {
        sticker.style.display = 'block';
        storedShowCount++;
        localStorage.setItem('nuevoStickerShowCount', storedShowCount);
      } else {
        sticker.style.display = 'none';
      }
    });
  </script>
</body>
</html>