<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hotel Viña del Sur | Tarija</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('css/estilos.css') ?>">
  <link rel="icon" href="<?= base_url('img/icono.png') ?>" type="image/png">
  
  
  <style>
    :root {
      --primary: #2a623d;
      --secondary: #f8f4e3;
      --accent: #e63946;
      --light: #ffffff;
      --dark: #1d3557;
      --gray: #6c757d;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f9f9f9;
      color: #333;
      line-height: 1.6;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 40px 20px;
    }

    .section-title {
      text-align: center;
      margin-bottom: 50px;
      color: var(--primary);
    }

    .section-title h2 {
      font-size: 2.5rem;
      font-weight: 700;
      letter-spacing: 1px;
    }

    .section-title p {
      font-size: 1.1rem;
      color: var(--gray);
      max-width: 700px;
      margin: 15px auto 0;
    }

    .rooms-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
      gap: 30px;
    }

    .room-card {
      background: var(--light);
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 5px 20px rgba(0,0,0,0.08);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .room-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    .room-img {
      height: 250px;
      overflow: hidden;
    }

    .room-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    .room-card:hover .room-img img {
      transform: scale(1.05);
    }

    .room-badge {
      position: absolute;
      top: 15px;
      right: 15px;
      background: var(--accent);
      color: white;
      padding: 5px 12px;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 600;
      z-index: 2;
    }

    .room-content {
      padding: 25px;
    }

    .room-type {
      font-size: 1.1rem;
      color: var(--primary);
      font-weight: 600;
      margin-bottom: 5px;
    }

    .room-name {
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 15px;
      color: var(--dark);
    }

    .room-details {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-bottom: 20px;
      flex-wrap: wrap;
    }

    .detail-item {
      display: flex;
      align-items: center;
      gap: 5px;
      font-size: 0.95rem;
      color: var(--gray);
    }

    .room-features {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 20px;
    }

    .feature {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      background: #f1f3f5;
      color: var(--gray);
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.85rem;
    }

    .room-price {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 20px;
    }

    .price {
      font-size: 1.6rem;
      font-weight: 700;
      color: var(--primary);
    }

    .price span {
      font-size: 1rem;
      font-weight: 400;
      color: var(--gray);
    }

    .btn-reserve {
      background: var(--primary);
      color: white;
      padding: 12px 25px;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s;
    }

    .btn-reserve:hover {
      background: #1e4d2b;
    }

    @media (max-width: 768px) {
      .rooms-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>


  
</head>
<body>

  <header class="nav" role="banner">
    <div class="container">
      <div class="brand">
        <img src="<?= base_url('img/vina.png') ?>" alt="Logo Hotel Viña del Sur">
        <div>
          <h1>Hotel Viña del Sur</h1>
          <div class="slogan">Tarija · Confort & Tradición</div>
        </div>
      </div>

      <nav class="menu" role="navigation" aria-label="Menú principal">
        <a href="#inicio">Inicio</a>
        <a href="#habitaciones">Habitaciones</a>
        <a href="#servicios">Servicios</a>
        <a href="#contacto">Contactos</a>


        <a href="<?= base_url('login') ?>" 
         style="
         display: inline-flex;
         align-items: center;
         gap: 8px;
         padding: 14px 28px;
         background: rgba(255, 255, 255, 0.15);
         backdrop-filter: blur(12px);
         -webkit-backdrop-filter: blur(12px);
         color: white;
         text-decoration: none;
         border-radius: 50px;
         border: 1px solid rgba(255, 255, 255, 0.25);
         box-shadow: 0 8px 32px rgba(0, 123, 255, 0.2);
         font-weight: 600;
         font-size: 1rem;
         letter-spacing: 0.5px;
         transition: all 0.35s cubic-bezier(0.215, 0.61, 0.355, 1);
         text-shadow: 0 1px 2px rgba(0,0,0,0.2);
         margin-left: 1rem;
         "
         onmouseover="this.style.transform='translateY(-3px) scale(1.05)'; this.style.boxShadow='0 12px 40px rgba(0, 123, 255, 0.35)'; this.style.background='rgba(255, 255, 255, 0.2)'; this.style.border='1px solid rgba(255, 255, 255, 0.35)';"
         onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 8px 32px rgba(0, 123, 255, 0.2)'; this.style.background='rgba(255, 255, 255, 0.15)'; this.style.border='1px solid rgba(255, 255, 255, 0.25)';">
         <i class="fas fa-lock" style="font-size: 1.1rem;"></i>
         Panel Admin
       </a>

       
     </nav>
     <button class="menu-toggle" aria-label="Menú móvil" onclick="toggleMenu()">☰</button>
   </div>
   <div class="menu-mobile" id="menuMobile">
    <a href="#inicio">Inicio</a>
    <a href="#habitaciones">Habitaciones</a>
    <a href="#servicios">Servicios</a>
    <a href="#contacto">Contactos</a>
    <a href="<?= base_url('login') ?>">Admin</a>
    
  </div>
</header>

<main>
  <section class="hero" id="inicio" aria-label="Imagen principal del hotel">
    <div class="bg" aria-hidden="true"></div>
    <div class="hero-inner">
      <div class="hero-copy">
        <div class="eyebrow">Bienvenidos</div>
        <h2>Descubre Tarija desde el confort de nuestro hotel</h2>
        <p>Habitaciones acogedoras, desayuno incluido y espacios para eventos. Ubicación céntrica y servicio familiar para que su estadía sea inolvidable.</p>
        <div class="hero-actions">
          <button class="btn-primary" onclick="openReservation()">Reserva Ahora</button>
          <a class="link-muted" href="#servicios">Conoce nuestros servicios →</a>
        </div>
      </div>

      <aside class="search-card" aria-label="Buscador de reservas">
        <form id="reservaForm" onsubmit="submitReservation(event)">
          <h3>Reserva tu estadía</h3>
          <div class="search-row">
            <div class="field">
              <label for="checkin">Check-in</label>
              <input id="checkin" name="checkin" type="date" required>
            </div>
            <div class="field">
              <label for="checkout">Check-out</label>
              <input id="checkout" name="checkout" type="date" required>
            </div>
          </div>
          <div class="search-row">
            <div class="field">
              <label for="guests">Huéspedes</label>
              <select id="guests" name="guests" required>
                <option value="1">1 huésped</option>
                <option value="2">2 huéspedes</option>
                <option value="3">3 huéspedes</option>
                <option value="4">4 huéspedes</option>
              </select>
            </div>
            <div class="field">
              <label for="type">Tipo de habitación</label>
              <select id="type" name="type" required>
                <option value="simple">Simple</option>
                <option value="doble">Doble</option>
                <option value="suite">Suite</option>
              </select>
            </div>
          </div>
          <button type="submit" class="btn-primary btn-block">Buscar Disponibilidad</button>
          <button type="button" class="btn-outline" onclick="openContact()">¿Necesitas ayuda?</button>
        </form>
      </aside>
    </div>
  </section>

  

  <section id="habitaciones" class="section" style="
  background: linear-gradient(135deg, #8b0000, #660000);
  padding: 6rem 0;
  position: relative;
  overflow: hidden;
  border-top: 4px solid #ff4d4d;
  border-bottom: 4px solid #cc0000;
  ">
  <!-- Decoración de fondo (opcional) -->
  <div style="
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: radial-gradient(circle at 30% 70%, rgba(255, 60, 60, 0.1), transparent 60%);
  pointer-events: none;
  z-index: 0;
  "></div>

  <div class="container-habitaciones" style="
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 2rem;
  position: relative;
  z-index: 1;
  ">

  <!-- Título con estilo premium y llamativo -->
  <div class="text-center mb-5">
    <h2 style="
    font-family: 'Playfair Display', Georgia, serif;
    font-weight: 900;
    font-size: 3.2rem;
    color: #ffffff;
    text-shadow: 3px 3px 6px rgba(0,0,0,0.4);
    letter-spacing: 1.5px;
    margin-bottom: 1rem;
    text-transform: uppercase;
    background: linear-gradient(to right, #ffcccc, #ffffff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    ">🔥 HABITACIONES</h2>
    <p class="lead" style="
    font-size: 1.4rem;
    color: #ffe6e6;
    max-width: 800px;
    margin: 0 auto;
    line-height: 1.7;
    font-weight: 300;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
    ">Elegancia, confort y detalles pensados para tu descanso. Cada espacio, una experiencia inolvidable.</p>
  </div>

  <!-- Grid de habitaciones -->
  <div class="habitacion-grid" style="
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
  gap: 3rem;
  margin-top: 4rem;
  justify-items: center;
  ">

  <!-- Habitación 1: Suite Premium (Más Popular) -->
  <div class="habitacion-card" style="
  background: #ffffff;
  border-radius: 24px;
  overflow: hidden;
  box-shadow: 0 12px 40px rgba(0,0,0,0.25);
  transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1.0);
  position: relative;
  width: 100%;
  max-width: 420px;
  transform: translateY(0);
  border: 3px solid transparent;
  background-clip: padding-box;
  " onmouseover="this.style.transform='translateY(-20px) scale(1.03)'; this.style.boxShadow='0 30px 60px rgba(139,0,0,0.4)'; this.style.border='3px solid #ff4d4d'; this.style.background='#fff9f9';"
  onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 12px 40px rgba(0,0,0,0.25)'; this.style.border='3px solid transparent'; this.style.background='#ffffff';">

  <div class="habitacion-img" style="position: relative; height: 280px; overflow: hidden;">
    <img src="img/dorm1.webp" 
    alt="Suite Premium" 
    style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s ease;"
    onmouseover="this.style.transform='scale(1.1)';" 
    onmouseout="this.style.transform='scale(1)';">
    <div class="habitacion-badge" style="
    position: absolute;
    top: 20px;
    right: 20px;
    background: linear-gradient(135deg, #ff4d4d, #cc0000);
    color: white;
    padding: 0.6rem 1.2rem;
    border-radius: 30px;
    font-weight: 800;
    font-size: 1rem;
    box-shadow: 0 6px 15px rgba(204, 0, 0, 0.4);
    z-index: 2;
    animation: pulse-habitacion 2s infinite;
    ">★ MÁS POPULAR</div>
  </div>

  <div class="habitacion-content" style="padding: 2.2rem;">
    <div class="habitacion-type" style="
    font-size: 1rem;
    color: #cc0000;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-bottom: 0.8rem;
    border-bottom: 2px dashed #ffcccc;
    padding-bottom: 0.5rem;
    display: inline-block;
    ">Suite Premium</div>
    <h3 class="habitacion-name" style="
    font-size: 1.8rem;
    font-weight: 800;
    color: #333;
    margin: 0 0 1.2rem 0;
    line-height: 1.3;
    ">Vista al Viñedo</h3>

    <div class="habitacion-details" style="display: flex; gap: 1.8rem; margin: 1.2rem 0; flex-wrap: wrap; font-weight: 600;">
      <div class="habitacion-detail-item" style="
      display: flex;
      align-items: center;
      gap: 0.6rem;
      color: #555;
      font-size: 1rem;
      "><i class="fa fa-user" style="color: #cc0000; font-size: 1.2rem;"></i> 2 Adultos + 1 Niño</div>
      <div class="habitacion-detail-item" style="
      display: flex;
      align-items: center;
      gap: 0.6rem;
      color: #555;
      font-size: 1rem;
      "><i class="fa fa-bed" style="color: #cc0000; font-size: 1.2rem;"></i> Cama King Size</div>
    </div>

    <div class="habitacion-features" style="
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin: 1.8rem 0;
    ">
    <div class="habitacion-feature" style="
    display: flex;
    align-items: center;
    gap: 0.6rem;
    color: #444;
    font-size: 0.95rem;
    font-weight: 600;
    padding: 0.5rem;
    background: #fff0f0;
    border-radius: 8px;
    border-left: 4px solid #ff6666;
    "><i class="fa fa-wifi" style="color: #cc0000; font-size: 1.1rem;"></i> Wi-Fi</div>
    <div class="habitacion-feature" style="
    display: flex;
    align-items: center;
    gap: 0.6rem;
    color: #444;
    font-size: 0.95rem;
    font-weight: 600;
    padding: 0.5rem;
    background: #fff0f0;
    border-radius: 8px;
    border-left: 4px solid #ff6666;
    "><i class="fa fa-coffee" style="color: #cc0000; font-size: 1.1rem;"></i> Desayuno</div>
    <div class="habitacion-feature" style="
    display: flex;
    align-items: center;
    gap: 0.6rem;
    color: #444;
    font-size: 0.95rem;
    font-weight: 600;
    padding: 0.5rem;
    background: #fff0f0;
    border-radius: 8px;
    border-left: 4px solid #ff6666;
    "><i class="fa fa-snowflake" style="color: #cc0000; font-size: 1.1rem;"></i> Aire Acond.</div>
    <div class="habitacion-feature" style="
    display: flex;
    align-items: center;
    gap: 0.6rem;
    color: #444;
    font-size: 0.95rem;
    font-weight: 600;
    padding: 0.5rem;
    background: #fff0f0;
    border-radius: 8px;
    border-left: 4px solid #ff6666;
    "><i class="fa fa-tv" style="color: #cc0000; font-size: 1.1rem;"></i> Smart TV</div>
  </div>

  <div class="habitacion-price" style="
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 2rem;
  padding-top: 1.5rem;
  border-top: 3px double #ffcccc;
  ">
  <div class="price" style="
  color: #cc0000;
  font-size: 2rem;
  font-weight: 900;
  text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
  ">Bs.220.-
  <span style="
  font-size: 0.95rem;
  color: #666;
  font-weight: 500;
  margin-left: 0.5rem;
  ">/ por noche</span>
</div>
<button class="btn-reservar-habitacion" style="
background: linear-gradient(135deg, #ff4d4d, #cc0000);
color: white;
border: none;
padding: 0.9rem 2rem;
border-radius: 50px;
font-weight: 700;
font-size: 1.1rem;
cursor: pointer;
transition: all 0.4s ease;
box-shadow: 0 5px 15px rgba(204, 0, 0, 0.3);
text-transform: uppercase;
letter-spacing: 0.5px;
" onmouseover="this.style.transform='translateY(-5px) scale(1.08)'; this.style.boxShadow='0 12px 25px rgba(204, 0, 0, 0.5)'; this.style.letterSpacing='1px';"
onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 5px 15px rgba(204, 0, 0, 0.3)'; this.style.letterSpacing='0.5px';">
Reservar Ahora
</button>
</div>
</div>
</div>

<!-- Habitación 2: Habitación Deluxe -->
<div class="habitacion-card" style="
background: #ffffff;
border-radius: 24px;
overflow: hidden;
box-shadow: 0 12px 40px rgba(0,0,0,0.25);
transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1.0);
position: relative;
width: 100%;
max-width: 420px;
transform: translateY(0);
border: 3px solid transparent;
background-clip: padding-box;
" onmouseover="this.style.transform='translateY(-20px) scale(1.03)'; this.style.boxShadow='0 30px 60px rgba(139,0,0,0.4)'; this.style.border='3px solid #ff4d4d'; this.style.background='#fff9f9';"
onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 12px 40px rgba(0,0,0,0.25)'; this.style.border='3px solid transparent'; this.style.background='#ffffff';">

<div class="habitacion-img" style="position: relative; height: 280px; overflow: hidden;">
  <img src="https://images.unsplash.com/photo-1566665797739-1674de7a421a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
  alt="Habitación Deluxe" 
  style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s ease;"
  onmouseover="this.style.transform='scale(1.1)';" 
  onmouseout="this.style.transform='scale(1)';">
</div>

<div class="habitacion-content" style="padding: 2.2rem;">
  <div class="habitacion-type" style="
  font-size: 1rem;
  color: #cc0000;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1.5px;
  margin-bottom: 0.8rem;
  border-bottom: 2px dashed #ffcccc;
  padding-bottom: 0.5rem;
  display: inline-block;
  ">Habitación Deluxe</div>
  <h3 class="habitacion-name" style="
  font-size: 1.8rem;
  font-weight: 800;
  color: #333;
  margin: 0 0 1.2rem 0;
  line-height: 1.3;
  ">Jardín Interior</h3>

  <div class="habitacion-details" style="display: flex; gap: 1.8rem; margin: 1.2rem 0; flex-wrap: wrap; font-weight: 600;">
    <div class="habitacion-detail-item" style="
    display: flex;
    align-items: center;
    gap: 0.6rem;
    color: #555;
    font-size: 1rem;
    "><i class="fa fa-user" style="color: #cc0000; font-size: 1.2rem;"></i> 2 Adultos</div>
    <div class="habitacion-detail-item" style="
    display: flex;
    align-items: center;
    gap: 0.6rem;
    color: #555;
    font-size: 1rem;
    "><i class="fa fa-bed" style="color: #cc0000; font-size: 1.2rem;"></i> 2 Camas Queen</div>
  </div>

  <div class="habitacion-features" style="
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1rem;
  margin: 1.8rem 0;
  ">
  <div class="habitacion-feature" style="
  display: flex;
  align-items: center;
  gap: 0.6rem;
  color: #444;
  font-size: 0.95rem;
  font-weight: 600;
  padding: 0.5rem;
  background: #fff0f0;
  border-radius: 8px;
  border-left: 4px solid #ff6666;
  "><i class="fa fa-wifi" style="color: #cc0000; font-size: 1.1rem;"></i> Wi-Fi</div>
  <div class="habitacion-feature" style="
  display: flex;
  align-items: center;
  gap: 0.6rem;
  color: #444;
  font-size: 0.95rem;
  font-weight: 600;
  padding: 0.5rem;
  background: #fff0f0;
  border-radius: 8px;
  border-left: 4px solid #ff6666;
  "><i class="fa fa-coffee" style="color: #cc0000; font-size: 1.1rem;"></i> Desayuno</div>
  <div class="habitacion-feature" style="
  display: flex;
  align-items: center;
  gap: 0.6rem;
  color: #444;
  font-size: 0.95rem;
  font-weight: 600;
  padding: 0.5rem;
  background: #fff0f0;
  border-radius: 8px;
  border-left: 4px solid #ff6666;
  "><i class="fa fa-snowflake" style="color: #cc0000; font-size: 1.1rem;"></i> Aire Acond.</div>
  <div class="habitacion-feature" style="
  display: flex;
  align-items: center;
  gap: 0.6rem;
  color: #444;
  font-size: 0.95rem;
  font-weight: 600;
  padding: 0.5rem;
  background: #fff0f0;
  border-radius: 8px;
  border-left: 4px solid #ff6666;
  "><i class="fa fa-bath" style="color: #cc0000; font-size: 1.1rem;"></i> Baño Premium</div>
</div>

<div class="habitacion-price" style="
display: flex;
justify-content: space-between;
align-items: center;
margin-top: 2rem;
padding-top: 1.5rem;
border-top: 3px double #ffcccc;
">
<div class="price" style="
color: #cc0000;
font-size: 2rem;
font-weight: 900;
text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
">Bs.190.-
<span style="
font-size: 0.95rem;
color: #666;
font-weight: 500;
margin-left: 0.5rem;
">/ por noche</span>
</div>
<button class="btn-reservar-habitacion" style="
background: linear-gradient(135deg, #ff4d4d, #cc0000);
color: white;
border: none;
padding: 0.9rem 2rem;
border-radius: 50px;
font-weight: 700;
font-size: 1.1rem;
cursor: pointer;
transition: all 0.4s ease;
box-shadow: 0 5px 15px rgba(204, 0, 0, 0.3);
text-transform: uppercase;
letter-spacing: 0.5px;
" onmouseover="this.style.transform='translateY(-5px) scale(1.08)'; this.style.boxShadow='0 12px 25px rgba(204, 0, 0, 0.5)'; this.style.letterSpacing='1px';"
onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 5px 15px rgba(204, 0, 0, 0.3)'; this.style.letterSpacing='0.5px';">
Reservar Ahora
</button>
</div>
</div>
</div>

<!-- Habitación 3: Suite Presidencial (Oferta Especial) -->
<div class="habitacion-card" style="
background: #ffffff;
border-radius: 24px;
overflow: hidden;
box-shadow: 0 12px 40px rgba(0,0,0,0.25);
transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1.0);
position: relative;
width: 100%;
max-width: 420px;
transform: translateY(0);
border: 3px solid transparent;
background-clip: padding-box;
" onmouseover="this.style.transform='translateY(-20px) scale(1.03)'; this.style.boxShadow='0 30px 60px rgba(139,0,0,0.4)'; this.style.border='3px solid #ff4d4d'; this.style.background='#fff9f9';"
onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 12px 40px rgba(0,0,0,0.25)'; this.style.border='3px solid transparent'; this.style.background='#ffffff';">

<div class="habitacion-img" style="position: relative; height: 280px; overflow: hidden;">
  <img src="img/dorm2.webp" 
  alt="Suite Presidencial" 
  style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s ease;"
  onmouseover="this.style.transform='scale(1.1)';" 
  onmouseout="this.style.transform='scale(1)';">
  <div class="habitacion-badge" style="
  position: absolute;
  top: 20px;
  right: 20px;
  background: linear-gradient(135deg, #4ecdc4, #007a7a);
  color: white;
  padding: 0.6rem 1.2rem;
  border-radius: 30px;
  font-weight: 800;
  font-size: 1rem;
  box-shadow: 0 6px 15px rgba(0, 122, 122, 0.4);
  z-index: 2;
  animation: glow-habitacion 2s infinite alternate;
  ">🔥 OFERTA ESPECIAL</div>
</div>

<div class="habitacion-content" style="padding: 2.2rem;">
  <div class="habitacion-type" style="
  font-size: 1rem;
  color: #cc0000;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1.5px;
  margin-bottom: 0.8rem;
  border-bottom: 2px dashed #ffcccc;
  padding-bottom: 0.5rem;
  display: inline-block;
  ">Suite Presidencial</div>
  <h3 class="habitacion-name" style="
  font-size: 1.8rem;
  font-weight: 800;
  color: #333;
  margin: 0 0 1.2rem 0;
  line-height: 1.3;
  ">Terraza Privada</h3>

  <div class="habitacion-details" style="display: flex; gap: 1.8rem; margin: 1.2rem 0; flex-wrap: wrap; font-weight: 600;">
    <div class="habitacion-detail-item" style="
    display: flex;
    align-items: center;
    gap: 0.6rem;
    color: #555;
    font-size: 1rem;
    "><i class="fa fa-user" style="color: #cc0000; font-size: 1.2rem;"></i> 3 Adultos</div>
    <div class="habitacion-detail-item" style="
    display: flex;
    align-items: center;
    gap: 0.6rem;
    color: #555;
    font-size: 1rem;
    "><i class="fa fa-bed" style="color: #cc0000; font-size: 1.2rem;"></i> King + Sofá Cama</div>
  </div>

  <div class="habitacion-features" style="
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1rem;
  margin: 1.8rem 0;
  ">
  <div class="habitacion-feature" style="
  display: flex;
  align-items: center;
  gap: 0.6rem;
  color: #444;
  font-size: 0.95rem;
  font-weight: 600;
  padding: 0.5rem;
  background: #fff0f0;
  border-radius: 8px;
  border-left: 4px solid #ff6666;
  "><i class="fa fa-wifi" style="color: #cc0000; font-size: 1.1rem;"></i> Wi-Fi</div>
  <div class="habitacion-feature" style="
  display: flex;
  align-items: center;
  gap: 0.6rem;
  color: #444;
  font-size: 0.95rem;
  font-weight: 600;
  padding: 0.5rem;
  background: #fff0f0;
  border-radius: 8px;
  border-left: 4px solid #ff6666;
  "><i class="fa fa-coffee" style="color: #cc0000; font-size: 1.1rem;"></i> Desayuno</div>
  <div class="habitacion-feature" style="
  display: flex;
  align-items: center;
  gap: 0.6rem;
  color: #444;
  font-size: 0.95rem;
  font-weight: 600;
  padding: 0.5rem;
  background: #fff0f0;
  border-radius: 8px;
  border-left: 4px solid #ff6666;
  "><i class="fa fa-spa" style="color: #cc0000; font-size: 1.1rem;"></i> Jacuzzi</div>
  <div class="habitacion-feature" style="
  display: flex;
  align-items: center;
  gap: 0.6rem;
  color: #444;
  font-size: 0.95rem;
  font-weight: 600;
  padding: 0.5rem;
  background: #fff0f0;
  border-radius: 8px;
  border-left: 4px solid #ff6666;
  "><i class="fa fa-glass-cheers" style="color: #cc0000; font-size: 1.1rem;"></i> Bar Privado</div>
</div>

<div class="habitacion-price" style="
display: flex;
justify-content: space-between;
align-items: center;
margin-top: 2rem;
padding-top: 1.5rem;
border-top: 3px double #ffcccc;
">
<div class="price" style="
color: #cc0000;
font-size: 2rem;
font-weight: 900;
text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
">Bs.320.-
<span style="
font-size: 0.95rem;
color: #666;
font-weight: 500;
margin-left: 0.5rem;
">/ por noche</span>
</div>
<button class="btn-reservar-habitacion" style="
background: linear-gradient(135deg, #ff4d4d, #cc0000);
color: white;
border: none;
padding: 0.9rem 2rem;
border-radius: 50px;
font-weight: 700;
font-size: 1.1rem;
cursor: pointer;
transition: all 0.4s ease;
box-shadow: 0 5px 15px rgba(204, 0, 0, 0.3);
text-transform: uppercase;
letter-spacing: 0.5px;
" onmouseover="this.style.transform='translateY(-5px) scale(1.08)'; this.style.boxShadow='0 12px 25px rgba(204, 0, 0, 0.5)'; this.style.letterSpacing='1px';"
onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 5px 15px rgba(204, 0, 0, 0.3)'; this.style.letterSpacing='0.5px';">
Reservar Ahora
</button>
</div>
</div>
</div>

</div>
</div>

<!-- Animaciones CSS personalizadas (solo para esta sección) -->
<style>
  @keyframes pulse-habitacion {
    0% { box-shadow: 0 0 0 0 rgba(255, 77, 77, 0.7); }
    70% { box-shadow: 0 0 0 15px rgba(255, 77, 77, 0); }
    100% { box-shadow: 0 0 0 0 rgba(255, 77, 77, 0); }
  }
  @keyframes glow-habitacion {
    from { box-shadow: 0 0 10px rgba(0, 122, 122, 0.5); }
    to { box-shadow: 0 0 25px rgba(78, 205, 196, 0.8), 0 0 40px rgba(78, 205, 196, 0.6); }
  }
</style>
</section>





<section id="servicios" class="section py-5" style="
position: relative;
background-image: url('web.jpg');
background-size: cover;
background-position: center;
background-attachment: fixed;
padding: 4rem 0;
">
<!-- Capa de atenuación oscura -->
<div style="
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
background: rgba(26, 14, 14, 0.75); /* Capa oscura semitransparente */
pointer-events: none;
z-index: 0;
"></div>

<!-- Contenido (ahora con z-index para estar encima del fondo) -->
<div class="container" style="
max-width: 1200px;
position: relative;
z-index: 1;
">

<!-- Título con efecto -->
<div class="text-center mb-5">
  <h2 style="
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  font-weight: 800;
  font-size: 2.5rem;
  color: #f8e9e9;
  text-shadow: 2px 2px 4px rgba(0,0,0,0.4);
  letter-spacing: 1px;
  position: relative;
  display: inline-block;
  ">
  🌟 Servicios
  <span style="
  position: absolute;
  bottom: -10px;
  left: 50%;
  transform: translateX(-50%);
  width: 80px;
  height: 4px;
  background: linear-gradient(90deg, #c97f7f, #a64c4c);
  border-radius: 2px;
  "></span>
</h2>
<p class="lead mt-3" style="
font-size: 1.2rem;
color: #f0d8d8;
max-width: 700px;
margin: 0 auto;
line-height: 1.6;
">Todo lo que necesitas para una estadía inolvidable. Diseñado con amor para tu comodidad y placer.</p>
</div>

<!-- Grid de servicios -->
<div class="services-grid" style="
display: grid;
grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
gap: 2rem;
margin-top: 3rem;
">

<!-- Aquí van tus 6 servicios (los 4 originales + los 2 nuevos que ya generé) -->
<!-- Servicio 1 -->
<div class="service-item" style="
background: #8b3a3a;
padding: 2rem;
border-radius: 16px;
box-shadow: 0 5px 15px rgba(0,0,0,0.3);
transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
text-align: center;
position: relative;
overflow: hidden;
border: 2px solid #6d2a2a;
" onmouseover="this.style.background='#7a3030'; this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 30px rgba(0,0,0,0.4)'; this.style.border='2px solid #5c2020';" 
onmouseout="this.style.background='#8b3a3a'; this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.3)'; this.style.border='2px solid #6d2a2a';">

<div style="
width: 80px;
height: 80px;
background: linear-gradient(135deg, #a64c4c, #8b3a3a);
border: 2px solid #6d2a2a;
border-radius: 50%;
display: flex;
align-items: center;
justify-content: center;
margin: 0 auto 1.5rem;
color: #ffffff;
font-size: 2rem;
box-shadow: 0 4px 12px rgba(0,0,0,0.2), inset 0 1px 2px rgba(255,255,255,0.1);
transition: all 0.3s ease;
" onmouseover="this.style.transform='scale(1.1) rotate(8deg)'; this.style.boxShadow='0 6px 18px rgba(0,0,0,0.3), inset 0 1px 2px rgba(255,255,255,0.2)'; this.style.border='2px solid #5c2020';" 
onmouseout="this.style.transform='scale(1) rotate(0deg)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.2), inset 0 1px 2px rgba(255,255,255,0.1)'; this.style.border='2px solid #6d2a2a';">
🍽️
</div>

<h3 style="
font-size: 1.5rem;
font-weight: 700;
color: #ffffff;
margin-bottom: 1rem;
">Restaurante</h3>
<p style="
color: #f8e9e9;
line-height: 1.6;
font-size: 1rem;
">Desayuno buffet incluido. Cena con platos típicos tarijeños preparados con ingredientes locales.</p>
</div>

<!-- Servicio 2 -->
<div class="service-item" style="
background: #8b3a3a;
padding: 2rem;
border-radius: 16px;
box-shadow: 0 5px 15px rgba(0,0,0,0.3);
transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
text-align: center;
position: relative;
overflow: hidden;
border: 2px solid #6d2a2a;
" onmouseover="this.style.background='#7a3030'; this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 30px rgba(0,0,0,0.4)'; this.style.border='2px solid #5c2020';" 
onmouseout="this.style.background='#8b3a3a'; this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.3)'; this.style.border='2px solid #6d2a2a';">

<div style="
width: 80px;
height: 80px;
background: linear-gradient(135deg, #a64c4c, #8b3a3a);
border: 2px solid #6d2a2a;
border-radius: 50%;
display: flex;
align-items: center;
justify-content: center;
margin: 0 auto 1.5rem;
color: #ffffff;
font-size: 2rem;
box-shadow: 0 4px 12px rgba(0,0,0,0.2), inset 0 1px 2px rgba(255,255,255,0.1);
transition: all 0.3s ease;
" onmouseover="this.style.transform='scale(1.1) rotate(8deg)'; this.style.boxShadow='0 6px 18px rgba(0,0,0,0.3), inset 0 1px 2px rgba(255,255,255,0.2)'; this.style.border='2px solid #5c2020';" 
onmouseout="this.style.transform='scale(1) rotate(0deg)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.2), inset 0 1px 2px rgba(255,255,255,0.1)'; this.style.border='2px solid #6d2a2a';">
🎉
</div>

<h3 style="
font-size: 1.5rem;
font-weight: 700;
color: #ffffff;
margin-bottom: 1rem;
">Salones de Eventos</h3>
<p style="
color: #f8e9e9;
line-height: 1.6;
font-size: 1rem;
">Capacidad para 100 personas. Ideal para bodas, reuniones corporativas y celebraciones inolvidables.</p>
</div>

<!-- Servicio 3 -->
<div class="service-item" style="
background: #8b3a3a;
padding: 2rem;
border-radius: 16px;
box-shadow: 0 5px 15px rgba(0,0,0,0.3);
transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
text-align: center;
position: relative;
overflow: hidden;
border: 2px solid #6d2a2a;
" onmouseover="this.style.background='#7a3030'; this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 30px rgba(0,0,0,0.4)'; this.style.border='2px solid #5c2020';" 
onmouseout="this.style.background='#8b3a3a'; this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.3)'; this.style.border='2px solid #6d2a2a';">

<div style="
width: 80px;
height: 80px;
background: linear-gradient(135deg, #a64c4c, #8b3a3a);
border: 2px solid #6d2a2a;
border-radius: 50%;
display: flex;
align-items: center;
justify-content: center;
margin: 0 auto 1.5rem;
color: #ffffff;
font-size: 2rem;
box-shadow: 0 4px 12px rgba(0,0,0,0.2), inset 0 1px 2px rgba(255,255,255,0.1);
transition: all 0.3s ease;
" onmouseover="this.style.transform='scale(1.1) rotate(8deg)'; this.style.boxShadow='0 6px 18px rgba(0,0,0,0.3), inset 0 1px 2px rgba(255,255,255,0.2)'; this.style.border='2px solid #5c2020';" 
onmouseout="this.style.transform='scale(1) rotate(0deg)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.2), inset 0 1px 2px rgba(255,255,255,0.1)'; this.style.border='2px solid #6d2a2a';">
🚗
</div>

<h3 style="
font-size: 1.5rem;
font-weight: 700;
color: #ffffff;
margin-bottom: 1rem;
">Traslados</h3>
<p style="
color: #f8e9e9;
line-height: 1.6;
font-size: 1rem;
">Servicio de taxi privado y tours guiados a viñedos, cascadas y lugares turísticos imperdibles.</p>
</div>

<!-- Servicio 4 -->
<div class="service-item" style="
background: #8b3a3a;
padding: 2rem;
border-radius: 16px;
box-shadow: 0 5px 15px rgba(0,0,0,0.3);
transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
text-align: center;
position: relative;
overflow: hidden;
border: 2px solid #6d2a2a;
" onmouseover="this.style.background='#7a3030'; this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 30px rgba(0,0,0,0.4)'; this.style.border='2px solid #5c2020';" 
onmouseout="this.style.background='#8b3a3a'; this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.3)'; this.style.border='2px solid #6d2a2a';">

<div style="
width: 80px;
height: 80px;
background: linear-gradient(135deg, #a64c4c, #8b3a3a);
border: 2px solid #6d2a2a;
border-radius: 50%;
display: flex;
align-items: center;
justify-content: center;
margin: 0 auto 1.5rem;
color: #ffffff;
font-size: 2rem;
box-shadow: 0 4px 12px rgba(0,0,0,0.2), inset 0 1px 2px rgba(255,255,255,0.1);
transition: all 0.3s ease;
" onmouseover="this.style.transform='scale(1.1) rotate(8deg)'; this.style.boxShadow='0 6px 18px rgba(0,0,0,0.3), inset 0 1px 2px rgba(255,255,255,0.2)'; this.style.border='2px solid #5c2020';" 
onmouseout="this.style.transform='scale(1) rotate(0deg)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.2), inset 0 1px 2px rgba(255,255,255,0.1)'; this.style.border='2px solid #6d2a2a';">
📶
</div>

<h3 style="
font-size: 1.5rem;
font-weight: 700;
color: #ffffff;
margin-bottom: 1rem;
">WiFi & Estacionamiento</h3>
<p style="
color: #f8e9e9;
line-height: 1.6;
font-size: 1rem;
">Internet de alta velocidad en todas las áreas y estacionamiento privado gratuito las 24 horas.</p>
</div>

<!-- Servicio 5 -->
<div class="service-item" style="
background: #8b3a3a;
padding: 2rem;
border-radius: 16px;
box-shadow: 0 5px 15px rgba(0,0,0,0.3);
transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
text-align: center;
position: relative;
overflow: hidden;
border: 2px solid #6d2a2a;
" onmouseover="this.style.background='#7a3030'; this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 30px rgba(0,0,0,0.4)'; this.style.border='2px solid #5c2020';" 
onmouseout="this.style.background='#8b3a3a'; this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.3)'; this.style.border='2px solid #6d2a2a';">

<div style="
width: 80px;
height: 80px;
background: linear-gradient(135deg, #a64c4c, #8b3a3a);
border: 2px solid #6d2a2a;
border-radius: 50%;
display: flex;
align-items: center;
justify-content: center;
margin: 0 auto 1.5rem;
color: #ffffff;
font-size: 2rem;
box-shadow: 0 4px 12px rgba(0,0,0,0.2), inset 0 1px 2px rgba(255,255,255,0.1);
transition: all 0.3s ease;
" onmouseover="this.style.transform='scale(1.1) rotate(8deg)'; this.style.boxShadow='0 6px 18px rgba(0,0,0,0.3), inset 0 1px 2px rgba(255,255,255,0.2)'; this.style.border='2px solid #5c2020';" 
onmouseout="this.style.transform='scale(1) rotate(0deg)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.2), inset 0 1px 2px rgba(255,255,255,0.1)'; this.style.border='2px solid #6d2a2a';">
💆‍♀️
</div>

<h3 style="
font-size: 1.5rem;
font-weight: 700;
color: #ffffff;
margin-bottom: 1rem;
">SPA & Bienestar</h3>
<p style="
color: #f8e9e9;
line-height: 1.6;
font-size: 1rem;
">Masajes relajantes, sauna y terapias con esencias locales para reconectar cuerpo y alma.</p>
</div>


<!-- Servicio 6 -->
<div class="service-item" style="
background: #8b3a3a;
padding: 2rem;
border-radius: 16px;
box-shadow: 0 5px 15px rgba(0,0,0,0.3);
transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
text-align: center;
position: relative;
overflow: hidden;
border: 2px solid #6d2a2a;
" onmouseover="this.style.background='#7a3030'; this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 30px rgba(0,0,0,0.4)'; this.style.border='2px solid #5c2020';" 
onmouseout="this.style.background='#8b3a3a'; this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.3)'; this.style.border='2px solid #6d2a2a';">

<div style="
width: 80px;
height: 80px;
background: linear-gradient(135deg, #a64c4c, #8b3a3a);
border: 2px solid #6d2a2a;
border-radius: 50%;
display: flex;
align-items: center;
justify-content: center;
margin: 0 auto 1.5rem;
color: #ffffff;
font-size: 2rem;
box-shadow: 0 4px 12px rgba(0,0,0,0.2), inset 0 1px 2px rgba(255,255,255,0.1);
transition: all 0.3s ease;
" onmouseover="this.style.transform='scale(1.1) rotate(8deg)'; this.style.boxShadow='0 6px 18px rgba(0,0,0,0.3), inset 0 1px 2px rgba(255,255,255,0.2)'; this.style.border='2px solid #5c2020';" 
onmouseout="this.style.transform='scale(1) rotate(0deg)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.2), inset 0 1px 2px rgba(255,255,255,0.1)'; this.style.border='2px solid #6d2a2a';">
🌄
</div>

<h3 style="
font-size: 1.5rem;
font-weight: 700;
color: #ffffff;
margin-bottom: 1rem;
">Terraza con Vista</h3>
<p style="
color: #f8e9e9;
line-height: 1.6;
font-size: 1rem;
">Disfruta de atardeceres únicos sobre los viñedos mientras degustas un vino de la casa.</p>
</div>



</div>

<!-- Botón CTA institucional -->
<div class="text-center mt-5">
  <a href="#contacto" style="
  display: inline-block;
  background: linear-gradient(135deg, #a64c4c, #7a3030);
  color: #ffffff;
  padding: 14px 36px;
  border-radius: 50px;
  text-decoration: none;
  font-weight: 700;
  font-size: 1.15rem;
  border: 2px solid #6d2a2a;
  box-shadow: 0 5px 15px rgba(118, 48, 48, 0.4);
  transition: all 0.3s ease;
  text-shadow: 0 1px 1px rgba(0,0,0,0.3);
  " onmouseover="this.style.transform='translateY(-3px) scale(1.05)'; this.style.boxShadow='0 8px 25px rgba(118, 48, 48, 0.6)'; this.style.border='2px solid #5c2020';"
  onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 5px 15px rgba(118, 48, 48, 0.4)'; this.style.border='2px solid #6d2a2a';">
  📞 ¡Reserva ahora y obtén un 10% de descuento!
</a>
</div>

</div>
</section>



<section id="contacto" class="section" style="
background: linear-gradient(135deg, #cc0000, #8b0000);
padding: 5rem 0;
position: relative;
overflow: hidden;
border-top: 4px solid #ff3333;
border-bottom: 4px solid #990000;
">
<!-- Fondo decorativo (opcional) -->
<div style="
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
background: radial-gradient(circle at top right, rgba(255, 60, 60, 0.2), transparent 60%);
pointer-events: none;
z-index: 0;
"></div>

<div class="container" style="
max-width: 1200px;
margin: 0 auto;
padding: 0 2rem;
position: relative;
z-index: 1;
">

<!-- Título con estilo premium -->
<div class="text-center mb-5">
  <h2 style="
  font-family: 'Montserrat', sans-serif;
  font-weight: 800;
  font-size: 2.8rem;
  color: #ffffff;
  text-shadow: 2px 2px 5px rgba(0,0,0,0.3);
  letter-spacing: 1.5px;
  margin-bottom: 1rem;
  position: relative;
  display: inline-block;
  ">📬 ¡Contáctanos!</h2>
  <span style="
  position: absolute;
  bottom: -12px;
  left: 50%;
  transform: translateX(-50%);
  width: 120px;
  height: 5px;
  background: linear-gradient(90deg, #ffcc00, #ff6600);
  border-radius: 3px;
  "></span>
  <p class="lead" style="
  font-size: 1.3rem;
  color: #fff;
  max-width: 700px;
  margin: 1.5rem auto 0;
  line-height: 1.7;
  font-weight: 300;
  text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
  ">Estamos para atenderte con una sonrisa. ¡Escríbenos, llámanos o visítanos!</p>
</div>

<!-- Grid de información de contacto -->
<div class="contact-grid" style="
display: grid;
grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
gap: 2.5rem;
margin: 4rem auto;
max-width: 1100px;
">

<!-- Dirección -->
<div style="
background: #ffffff;
border-radius: 20px;
padding: 2.2rem;
text-align: center;
box-shadow: 0 8px 25px rgba(0,0,0,0.15);
transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
border: 2px solid transparent;
position: relative;
overflow: hidden;
" onmouseover="this.style.transform='translateY(-12px) scale(1.03)'; this.style.boxShadow='0 20px 40px rgba(139,0,0,0.3)'; this.style.border='2px solid #ff6666';"
onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'; this.style.border='2px solid transparent';">

<div style="
width: 80px;
height: 80px;
background: linear-gradient(135deg, #ff6666, #cc0000);
border-radius: 50%;
display: flex;
align-items: center;
justify-content: center;
margin: 0 auto 1.5rem;
color: white;
font-size: 2rem;
box-shadow: 0 6px 15px rgba(204, 0, 0, 0.3);
transition: all 0.4s ease;
" onmouseover="this.style.transform='scale(1.15) rotate(15deg)';" 
onmouseout="this.style.transform='scale(1) rotate(0deg)';">
📍
</div>

<h3 style="
font-size: 1.6rem;
font-weight: 700;
color: #cc0000;
margin-bottom: 1rem;
text-transform: uppercase;
letter-spacing: 1px;
">📍 Dirección</h3>
<p style="
color: #333;
font-size: 1.15rem;
line-height: 1.6;
font-weight: 500;
">Calle Sucre #123<br><strong>Tarija, Bolivia</strong></p>
</div>

<!-- Teléfono -->
<div style="
background: #ffffff;
border-radius: 20px;
padding: 2.2rem;
text-align: center;
box-shadow: 0 8px 25px rgba(0,0,0,0.15);
transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
border: 2px solid transparent;
position: relative;
overflow: hidden;
" onmouseover="this.style.transform='translateY(-12px) scale(1.03)'; this.style.boxShadow='0 20px 40px rgba(139,0,0,0.3)'; this.style.border='2px solid #ff6666';"
onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'; this.style.border='2px solid transparent';">

<div style="
width: 80px;
height: 80px;
background: linear-gradient(135deg, #ff6666, #cc0000);
border-radius: 50%;
display: flex;
align-items: center;
justify-content: center;
margin: 0 auto 1.5rem;
color: white;
font-size: 2rem;
box-shadow: 0 6px 15px rgba(204, 0, 0, 0.3);
transition: all 0.4s ease;
" onmouseover="this.style.transform='scale(1.15) rotate(15deg)';" 
onmouseout="this.style.transform='scale(1) rotate(0deg)';">
📞
</div>

<h3 style="
font-size: 1.6rem;
font-weight: 700;
color: #cc0000;
margin-bottom: 1rem;
text-transform: uppercase;
letter-spacing: 1px;
">📞 Teléfono</h3>
<p style="
color: #333;
font-size: 1.15rem;
line-height: 1.6;
font-weight: 500;
">+591 700 12345<br><strong>Atención 24/7</strong></p>
</div>

<!-- Email -->
<div style="
background: #ffffff;
border-radius: 20px;
padding: 2.2rem;
text-align: center;
box-shadow: 0 8px 25px rgba(0,0,0,0.15);
transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
border: 2px solid transparent;
position: relative;
overflow: hidden;
" onmouseover="this.style.transform='translateY(-12px) scale(1.03)'; this.style.boxShadow='0 20px 40px rgba(139,0,0,0.3)'; this.style.border='2px solid #ff6666';"
onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'; this.style.border='2px solid transparent';">

<div style="
width: 80px;
height: 80px;
background: linear-gradient(135deg, #ff6666, #cc0000);
border-radius: 50%;
display: flex;
align-items: center;
justify-content: center;
margin: 0 auto 1.5rem;
color: white;
font-size: 2rem;
box-shadow: 0 6px 15px rgba(204, 0, 0, 0.3);
transition: all 0.4s ease;
" onmouseover="this.style.transform='scale(1.15) rotate(15deg)';" 
onmouseout="this.style.transform='scale(1) rotate(0deg)';">
✉️
</div>

<h3 style="
font-size: 1.6rem;
font-weight: 700;
color: #cc0000;
margin-bottom: 1rem;
text-transform: uppercase;
letter-spacing: 1px;
">✉️ Email</h3>
<p style="
color: #333;
font-size: 1.15rem;
line-height: 1.6;
font-weight: 500;
">reservas@vinadelsur.com<br><strong>Respuesta en 1 hora</strong></p>
</div>

</div>

<!-- Imagen del mapa estilizada -->
<div class="map-placeholder" style="
text-align: center;
margin-top: 4rem;
padding: 1.5rem;
">
<h3 style="
color: #ffffff;
font-size: 1.7rem;
font-weight: 700;
margin-bottom: 1.5rem;
text-shadow: 1px 1px 3px rgba(0,0,0,0.4);
">🗺️ Ubicación del Hotel</h3>
<div style="
display: inline-block;
border-radius: 20px;
overflow: hidden;
box-shadow: 0 12px 35px rgba(0,0,0,0.3);
transition: all 0.5s ease;
border: 4px solid #ff6666;
background: #fff;
" onmouseover="this.style.transform='scale(1.03) translateY(-8px)'; this.style.boxShadow='0 20px 50px rgba(139,0,0,0.4)'; this.style.border='4px solid #ff3333';"
onmouseout="this.style.transform='scale(1) translateY(0)'; this.style.boxShadow='0 12px 35px rgba(0,0,0,0.3)'; this.style.border='4px solid #ff6666';">
<img src="<?= base_url('img/web-6.jpg') ?>" 
alt="Mapa del Hotel Viña de Sur" 
style="width: 100%; max-width: 650px; height: auto; display: block; transition: transform 0.5s ease;"
onmouseover="this.style.transform='scale(1.05)';" 
onmouseout="this.style.transform='scale(1)';">
</div>
</div>

<!-- Botón CTA final -->
<div class="text-center mt-5">
  <a href="https://wa.me/59170012345" target="_blank" style="
  display: inline-block;
  background: linear-gradient(135deg, #25d366, #128c7e);
  color: white;
  padding: 16px 40px;
  border-radius: 50px;
  text-decoration: none;
  font-weight: 700;
  font-size: 1.25rem;
  box-shadow: 0 6px 20px rgba(37, 211, 102, 0.5);
  transition: all 0.3s ease;
  border: 2px solid #128c7e;
  margin-top: 2.5rem;
  text-shadow: 0 2px 3px rgba(0,0,0,0.2);
  letter-spacing: 0.5px;
  " onmouseover="this.style.transform='translateY(-6px) scale(1.07)'; this.style.boxShadow='0 12px 30px rgba(37, 211, 102, 0.7)'; this.style.letterSpacing='1px';"
  onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 6px 20px rgba(37, 211, 102, 0.5)'; this.style.letterSpacing='0.5px';">
  💬 ¡Escríbenos por WhatsApp ahora!
</a>
</div>

</div>
</section>


</main>

<footer class="footer">
  <div class="container">
    <p>© <span id="year"></span> Hotel Viña del Sur. Todos los derechos reservados.</p>
    <p class="footer-links">
      <a href="#">Términos y Condiciones</a> · 
      <a href="#">Política de Privacidad</a>
    </p>
  </div>
</footer>



<script>
  document.addEventListener("DOMContentLoaded", function() {
    const services = document.querySelectorAll('.service-item');
    services.forEach((service, index) => {
      service.style.opacity = "0";
      service.style.transform = "translateY(30px)";
      service.style.transition = "opacity 0.6s ease, transform 0.6s ease";
      setTimeout(() => {
        service.style.opacity = "1";
        service.style.transform = "translateY(0)";
      }, 300 * index);
    });
  });
</script>



<script>
  document.getElementById('year').textContent = new Date().getFullYear();

  function openReservation(){
    document.getElementById('checkin').focus();
    document.querySelector('.hero').scrollIntoView({behavior:'smooth'});
  }

  function openContact(){
    document.getElementById('contacto').scrollIntoView({behavior:'smooth'});
  }

  function submitReservation(e){
    e.preventDefault();
    const f = new FormData(e.target);
    alert(`✅ Reserva solicitada:\n\nCheck-in: ${f.get('checkin')}\nCheck-out: ${f.get('checkout')}\nHuéspedes: ${f.get('guests')}\nTipo: ${f.get('type')}\n\n¡Te contactaremos pronto!`);
  }

  function toggleMenu(){
    const menu = document.getElementById('menuMobile');
    menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
  }

    // Cerrar menú móvil al hacer clic en un enlace
  document.querySelectorAll('.menu-mobile a').forEach(link => {
    link.addEventListener('click', () => {
      document.getElementById('menuMobile').style.display = 'none';
    });
  });
</script>
</body>
</html>