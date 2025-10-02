<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Habitaciones - Hotel Viña del Sur</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

  <div class="container">
    <div class="section-title">
      <h2>Descubre Nuestras Habitaciones</h2>
      <p>Espacios diseñados para tu confort, con detalles que enamoran y vistas que inspiran. Encuentra la habitación perfecta para tu estadía en Viña del Sur.</p>
    </div>

    <div class="rooms-grid">

      <!-- Habitación 1 -->
      <div class="room-card">
        <div class="room-img">
          <img src="https://images.unsplash.com/photo-1590490339838-771b11a3f8a4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Suite Premium">
          <div class="room-badge">Más Popular</div>
        </div>
        <div class="room-content">
          <div class="room-type">Suite Premium</div>
          <h3 class="room-name">Vista al Viñedo</h3>
          <div class="room-details">
            <div class="detail-item"><i class="fa fa-user"></i> 2 Adultos + 1 Niño</div>
            <div class="detail-item"><i class="fa fa-bed"></i> Cama King Size</div>
          </div>
          <div class="room-features">
            <div class="feature"><i class="fa fa-wifi"></i> Wi-Fi</div>
            <div class="feature"><i class="fa fa-coffee"></i> Desayuno</div>
            <div class="feature"><i class="fa fa-snowflake"></i> Aire Acond.</div>
            <div class="feature"><i class="fa fa-tv"></i> Smart TV</div>
          </div>
          <div class="room-price">
            <div class="price">$120.000 <span>/ por noche</span></div>
            <button class="btn-reserve">Reservar Ahora</button>
          </div>
        </div>
      </div>

      <!-- Habitación 2 -->
      <div class="room-card">
        <div class="room-img">
          <img src="https://images.unsplash.com/photo-1566665797739-1674de7a421a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Habitación Deluxe">
        </div>
        <div class="room-content">
          <div class="room-type">Habitación Deluxe</div>
          <h3 class="room-name">Jardín Interior</h3>
          <div class="room-details">
            <div class="detail-item"><i class="fa fa-user"></i> 2 Adultos</div>
            <div class="detail-item"><i class="fa fa-bed"></i> 2 Camas Queen</div>
          </div>
          <div class="room-features">
            <div class="feature"><i class="fa fa-wifi"></i> Wi-Fi</div>
            <div class="feature"><i class="fa fa-coffee"></i> Desayuno</div>
            <div class="feature"><i class="fa fa-snowflake"></i> Aire Acond.</div>
            <div class="feature"><i class="fa fa-bath"></i> Baño Premium</div>
          </div>
          <div class="room-price">
            <div class="price">$90.000 <span>/ por noche</span></div>
            <button class="btn-reserve">Reservar Ahora</button>
          </div>
        </div>
      </div>

      <!-- Habitación 3 -->
      <div class="room-card">
        <div class="room-img">
          <img src="https://images.unsplash.com/photo-1611328623032-66b495538776?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Suite Presidencial">
          <div class="room-badge">Oferta Especial</div>
        </div>
        <div class="room-content">
          <div class="room-type">Suite Presidencial</div>
          <h3 class="room-name">Terraza Privada</h3>
          <div class="room-details">
            <div class="detail-item"><i class="fa fa-user"></i> 3 Adultos</div>
            <div class="detail-item"><i class="fa fa-bed"></i> King + Sofá Cama</div>
          </div>
          <div class="room-features">
            <div class="feature"><i class="fa fa-wifi"></i> Wi-Fi</div>
            <div class="feature"><i class="fa fa-coffee"></i> Desayuno</div>
            <div class="feature"><i class="fa fa-spa"></i> Jacuzzi</div>
            <div class="feature"><i class="fa fa-glass-cheers"></i> Bar Privado</div>
          </div>
          <div class="room-price">
            <div class="price">$220.000 <span>/ por noche</span></div>
            <button class="btn-reserve">Reservar Ahora</button>
          </div>
        </div>
      </div>

    </div>
  </div>

</body>
</html>