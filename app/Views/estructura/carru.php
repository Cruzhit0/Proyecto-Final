<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presentación Netley</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #1a1a1a;
            font-family: Arial, sans-serif;
            color: #ffffff;
            overflow: hidden;
        }
        .container {
            text-align: center;
        }
        .title {
            font-size: 4em;
            font-weight: bold;
            opacity: 0;
        }
        .subtitle {
            font-size: 1.5em;
            opacity: 0;
            margin-top: 10px;
            color: #cccccc;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title" id="title"></div>
        <div class="subtitle" id="subtitle"></div>
    </div>

    <script>
        // Texto a mostrar
        const titleText = "Netley";
        const subtitleText = "Impulsado por Innovación";

        // Elementos del DOM
        const titleElement = document.getElementById("title");
        const subtitleElement = document.getElementById("subtitle");

        // Función de efecto typewriter para el título
        function typeWriter(text, element, callback) {
            let i = 0;
            element.style.opacity = 1; // Hacer visible el título
            function type() {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(type, 150); // Velocidad de escritura
                } else {
                    callback(); // Llamar al siguiente paso cuando termine
                }
            }
            type();
        }

        // Función para mostrar el subtítulo con fade-in
        function showSubtitle() {
            subtitleElement.innerHTML = subtitleText;
            let opacity = 0;
            subtitleElement.style.opacity = 0;
            const fadeIn = setInterval(() => {
                opacity += 0.05;
                subtitleElement.style.opacity = opacity;
                if (opacity >= 1) clearInterval(fadeIn);
            }, 50); // Velocidad del fade-in
        }

        // Iniciar la animación
        typeWriter(titleText, titleElement, showSubtitle);
    </script>
</body>
</html>