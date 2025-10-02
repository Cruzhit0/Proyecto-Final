<?php
$error=$this->session->flashdata('error');
if ($error){
  ?>
  <script>
    alert('<?=$error;?>');
    mostrarmensaje('<?=$error;?>',4);
//1 info, 2 warning, 3 succes, 4 error
  </script>
  <?php
}
$this->session->set_flashdata('error', '');
?> 

<!--AQUI SE REALIZA LA PARTE DE LA VENTANA DE NOTIFICACION EN LA PARTE INFERIOR IZQUIERDA -->
<script>
  Push.create("SISTEMA NETLEY",{
    body:"Bienvenido al servicio de Sistema de Apoyo Legal ON-LINE\nAl usar este servicio, acepta nuestras condiciones y uso de cookies para ofrecerle un mejor servicio de navegación.",
    icon:"imgs/logo5.png",
    timeout:6000,
    vibrate:[100,100,100],
    onclick:function(){
      window.focus;
      this.close();
    }
  });
  var a=new Audio('myfile.mp3');
// a.play();
</script>



<style>
  body {
    font-family: Arial, sans-serif;
  }
  .video-modal {
    display: none;
    position: fixed;
    top: 50px;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    justify-content: center;
    align-items: center;
    z-index: 1000;
  }
  .video-modal-content {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    position: relative;
    width: 90%;
    max-width: 600px;
  }
  .video-modal-content iframe {
    width: 100%;
    height: 315px;
  }
  .video-close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #f00;
    color: #fff;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    font-size: 18px;
    cursor: pointer;
  }
  textarea::placeholder {
    color: #9c2d00; /* Color de placeholder en armonía con el fondo */
    font-style: italic;
  }
  input::placeholder {
    color: #9c2d00; /* Color de placeholder en armonía con el fondo */
    font-style: italic;
  }

  /* Estilo inicial */
  .form-control {
    background-color: #f9e5ef;
    border: 1px solid #17a2b8;
    transition: all 0.4s ease;
  }

/* Al enfocar */
.form-control:focus {
  background-color: #fff7f9;
  border: 1px solid #17a2b8;
  box-shadow: 0 0 10px rgba(128, 128, 128, 1); /* Cambiado a gris */
}

/* Si el campo está lleno */
.form-control.filled {
 background-color: #fff7f9;
 border: 1px solid #17a2b8;
 box-shadow: 0 0 10px rgba(128, 128, 128, 1); /* Cambiado a gris */
}
</style>

<style>
  /* Estilos generales para el contenedor */
  .contador {
    margin: 10px auto; /* Reducción de márgenes */
    padding: 10px;
    background-color: #fff7f9;
    border-radius: 8px;
    width: 100%; /* Ancho más reducido */
    max-width: 600px; /* Limitamos el ancho máximo */
    box-shadow: 0 8px 15px rgba(0, 0, 0.3, 0.3); /* Sombra ligera */
    font-family: 'Roboto', sans-serif;
  }

/* Estilos para la tabla */
#tablacontador {
  width: 100%;
  border-collapse: collapse;
  font-family: 'Roboto', sans-serif;
}

/* Efecto hover para las celdas de la tabla */
#tablacontador td:hover {
  font-size: 20px; /* Aumenta el tamaño de la fuente */
  color: black; /* Cambia el color de la fuente a verde de éxito */
  transform: scale(1.1); /* Aumenta el tamaño de la celda */
}

.visit-number {
  font-size: 15px;
  font-weight: bold;
  transition: transform 0.6s ease, font-size 0.6s ease;
}

</style>

<style>

  #chatbot-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
  }

  #chatbot-window {
    display: none;
    position: fixed;
    bottom: 80px;
    right: 20px;
    width: 320px;
    background: white;
    border-radius: 12px;
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
    padding: 15px;
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.4s ease, transform 0.4s ease;
  }
  #chatbot-window.active {
    opacity: 1;
    transform: translateY(0);
  }
  #chatbot-header {
    font-weight: bold;
    text-align: center;
    margin-bottom: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #007bff;
    color: white;
    padding: 10px;
    border-radius: 8px 8px 0 0;
  }
  #chatbot-close {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
    color: white;
  }
  #chatbot-input {
    width: calc(100% - 20px);
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 10px;
    font-size: 14px;
  }
  #chatbot-send {
    width: 100%;
    background: linear-gradient(135deg, #28a745, #1e7e34);
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    border-radius: 5px;
    font-size: 16px;
    transition: background 0.3s ease;
  }
  #chatbot-send:hover {
    background: linear-gradient(135deg, #1e7e34, #155d27);
  }


  #chatbot-button {
    font-size: 28px;
    background: linear-gradient(45deg, #ffD000, #00B600); /* Amarillo oro y rosa claro */
    border: none;
    color: #0000f7; 
    font-size: 22px;
    padding: 14px 20px;
    border-radius: 50px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease-in-out;
    font-weight: bold;
    letter-spacing: 1px;
    position: relative;
    overflow: hidden;
  }

  #chatbot-button:hover {
    background: linear-gradient(45deg, #2196F3, #4CAF50);
    transform: scale(1.3);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
  }

  #chatbot-button:active {
    transform: scale(0.95);
  }
</style>
<style>
  #chatbot-input {
    width: 100%;
    max-width: 500px; /* Ajusta según tu diseño */
    min-height: 50px; /* Altura mínima */
    padding: 10px;
    font-size: 16px;
    font-family: Arial, sans-serif;
    color: #333;
    background: #b9fdf7; /* Fondo claro */
    border: 2px solid #007bff; /* Borde atractivo */
    border-radius: 8px;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
    resize: none; /* Evita que el usuario cambie el tamaño */
    overflow: hidden; /* Evita barras de desplazamiento */
    cursor: default; /* Indica que no es editable */
  }

  #chatbot-input:focus {
    outline: none;
    border-color: #0056b3;
    box-shadow: 0 0 8px rgba(0, 91, 187, 0.5);
  }

  #submit:hover,
  :focus {
    color: #ffffff; /* boton enviar resplandesciente azul */
    background: #008cff;
    border: 1px solid #008cff;
    text-shadow: 0 0 5px #ffffff, 0 0 10px #ffffff, 0 0 20px #ffffff;
    box-shadow: 0 0 5px #008cff, 0 0 20px #008cff, 0 0 30px #008cff,
    0 0 30px #008cff;
  }
</style>

<style>
  #infoModal {
    display: none;
    position: fixed;
    z-index: 1000;
    top: 30%;
    left: 50%;
    transform: translate(-50%, -30%);
    background-color: white;
    padding: 20px;
    border: 2px solid #444;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
  }
  #overlay {
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0,0,0,0.5);
    z-index: 999;
  }
  #closeBtn {
    margin-top: 10px;
    padding: 6px 12px;
  }
</style>

<div class="container  show-top-margin separate-rows tall-rows" style="margin-left:3%; margin-top:10px;width:94%;">

 <div id="chatbot-container">
  <button id="chatbot-button" style="color: #1E90FF; ">🗨️</button>
  <div id="chatbot-window">
    <div id="chatbot-header">
      <span>Consultas Netley</span>
      <button id="chatbot-close">✖</button>
    </div>
    <textarea id="chatbot-input" readonly>Vea respuestas similares a la pregunta registrada en Netley...
    </textarea>
    <button id="chatbot-send">Banco de consultas</button>
  </div>
</div>

<div id="overlay"></div>
<div id="infoModal">
  <?php
    // Contenido que puedes controlar desde PHP
  echo "<h3>Información del Sistema</h3>";
  echo "<p>Has presionado la combinación secreta</p>";     
  echo "<br>Desarrollado por Raúl Churqui whatsapp 6230 4130  <br>";
  ?>
  <button id="closeBtn">Cerrar</button>
</div>

<script>
  let sequence = [];
  const targetSequence = ['j', 'r', 'c', 'c'];

  document.addEventListener('keydown', function(e) {
    sequence.push(e.key.toLowerCase());

    // Solo mantenemos los últimos 4
    if (sequence.length > 4) sequence.shift();

    if (sequence.join('') === targetSequence.join('')) {
      showModal();
    }
  });

  function showModal() {
    document.getElementById('overlay').style.display = 'block';
    document.getElementById('infoModal').style.display = 'block';
  }

  document.getElementById('closeBtn').addEventListener('click', function() {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('infoModal').style.display = 'none';
  });
</script>
<script>
  document.getElementById("chatbot-button").addEventListener("click", function() {
    let chatbotWindow = document.getElementById("chatbot-window");
    chatbotWindow.classList.toggle("active");
    chatbotWindow.style.display = chatbotWindow.classList.contains("active") ? "block" : "none";
  });

  document.getElementById("chatbot-close").addEventListener("click", function() {
    let chatbotWindow = document.getElementById("chatbot-window");
    chatbotWindow.classList.remove("active");
    setTimeout(() => chatbotWindow.style.display = "none", 400);
  });

  // Redireccionar al enlace del Banco de Consultas
  document.getElementById("chatbot-send").addEventListener("click", function() {
    
  });
</script>

<div class="row" style="margin-top:0px">
  <div class="box box-primary">  </div> 




  <div class="col-sm-4">
      <!-- desactivamos el enlace a una nueva consulta 
      <a href="<?php echo base_url();?>consultagController/crear"  style="width:100%">
      -->

      <div class="box box-solid btn-success" data-toggle="modal" data-target="#modal-default" style="cursor: pointer;">
        <div class="box-header">
          <h3 class="box-title" >
            <FONT COLOR="white">Consulta Online  -  Pagos QR 
              <span class="glyphicon glyphicon-qrcode"></span>
            </FONT>
          </h3>
        </div><!-- /.box-header -->
      </div><!-- /.box -->
      

      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Netley & Asociados. 
                 
                 
                 <br>
                 Apunta, escanea y paga!
               </h4> 

               <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-4">
                  <img src="<?php echo base_url().'personal/bnblogo.png';?>">
                </div>
                <div class="col-sm-4">
                  <img src="<?php echo base_url().'personal/netley1.png';?>">
                </div>

              </div>

              
              


            </div>
            <div class="modal-body">
              <center>
                <img src="<?php echo base_url().'personal/qrnetley.png';?>" style="width: 90%; height: 90%;">
              </center>
            </div>
               <!--  

              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
              </div>
            -->


          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <?php 
// Fecha actual
      $fecha_actual = date('Y-m-d');

// Verificamos si el contador ya existe para la fecha actual
      $conteo = $this->Inicio_model->getConteoDiario($fecha_actual);


// Si no existe, insertamos un nuevo registro
      if ($conteo === 0) {
        $this->Inicio_model->insertarConteo($fecha_actual);
    $conteo = 1;  // Empezamos con el conteo en 1
  } else {
    // Si existe, actualizamos el contador
    $conteo++;
    $this->Inicio_model->actualizarConteo($fecha_actual, $conteo);
  }

// Verificamos si hemos alcanzado el objetivo (por ejemplo, 100 visitas)
  $objetivo = 1;
  if ($this->Inicio_model->verificarObjetivo($fecha_actual, $objetivo)) {
    // Redirigimos a la página "Usuario Beneficiado"
     // header("Location: usuario_beneficiado.php");
     // exit();
  }
  ?>

  <div class="contador">
    <table id="tablacontador">
      <tr>
       <td class="visit-number" id="fechaHora" class="fecha-hora">Cargando...</td>
       <td class="visit-number">Visitas: 1</td>
     </tr>
   </table>
 </div> 

 <script>
  function actualizarFechaHora() {
    const ahora = new Date();
    const opcionesFecha = { year: 'numeric', month: 'long', day: 'numeric' };
    const fecha = ahora.toLocaleDateString('es-ES', opcionesFecha);
    const hora = ahora.toLocaleTimeString('es-ES');
    document.getElementById("fechaHora").innerText = `${fecha} - ${hora}`;
  }

  actualizarFechaHora();
  setInterval(actualizarFechaHora, 1000);
</script>

<table id="tablacuerpo1" class="table table-striped table-row-hover">
  <thead class="thead-dark">
    <tr>

    </tr>
  </thead>
  <tbody>
   <tr>
    <td>
      <div class="col-sm-12">
        <h4><b>TE ESCUCHAMOS Y ORIENTAMOS ONLINE SIN COSTO ALGUNO </b></h4>
      </div>
      <div class="box-body">
        <div class="card : d-flex flex-row flex-nowrap"  >
          <div class="card-body bg-light text-dark">
            <p style="font-size: 16px;text-align: justify;">
              <b>Netley & Asociados</b> está formado por profesionales altamente calificados que te escucharán y te brindarán toda la asesoría jurídica que usted necesita, de una  manera fácil y entendible; porque entender la leyes no es una tarea fácil, y es por eso que nosotros ofrecemos servicios jurídicos gratuitos.
            </p>
            <p style="font-size: 16px;text-align: justify;">
              Usted puede realizar consultas jurídicas vía online, que serán respondida y asesoradas por nuestros asesores legales. Para realizar una consulta jurídica, solo tiene que ingresar a la página web: <a href="<?php echo base_url();?>consultagController/crear">https://www.netley.bo</a> y escribir su consulta que es totalmente anónima, una vez realizada la consulta, nuestros profesionales analizarán el caso, y la respuesta será publicada en nuestra página web, como también será enviada a su correo electrónico.
            </p>
          </div>
        </div>     
      </div>
    </td>
  </tr>

</tbody> 
</table>  

<div class="box box-solid box-danger">
  <div class="box-header">
    <h3 class="box-title">Noticias</h3>
  </div><!-- /.box-header -->
</div><!-- /.box -->

<style>
  .noticia-item {
    display: none;
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 1s ease-in-out, transform 1s ease-in-out;
  }
  .noticia-activa {
    display: table-row;
    opacity: 1;
    transform: translateY(0);
  }
</style>

<table id="tablacuerpo1" class="table table-striped table-row-hover">
  <tbody>
    <?php if (count($noticia)): ?>
      <?php foreach ($noticia as $index => $item): ?>
        <tr class="noticia-item <?php echo $index === 0 ? 'noticia-activa' : ''; ?>" data-index="<?php echo $index; ?>">
          <td>
            <div class="col-sm-12">
              <h4><b><?php echo mb_strtoupper($item->titulo); ?> </b></h4>
              <span class="description"><h5> Publicado el <?php echo($item->fecha); ?> </h5> </span>
            </div>
            <div class="box-body">
              <div class="card" style="text-align:justify">
                <div class="contenedor">
                  <div class="marcoFotop">
                    <a href="<?php echo base_url() ?>Noticias/vernoticia/<?php echo $item->id ?>" style="color:green;">
                      <img src="<?php echo base_url().$item->ruta_s; ?>" alt="Netley." style="width:100%;height:auto;">
                    </a>
                  </div>
                </div>
                <div class="box-body">
                  <?php 
                  $splittedstring = explode(" ", $item->descripcion, 50);
                  echo implode(" ", array_slice($splittedstring, 0, 30)) . "...";
                  ?>
                  <br>
                  <p style="text-align:right">  
                    <a href="" style="color:green;">Leer más...</a>
                  </p>
                </div>
              </div>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php else: echo "<p>No hay noticias disponibles.</p>"; ?>
      <?php endif; ?>  
    </tbody> 
  </table>

  <script>
    $(document).ready(function() {
      let noticias = $(".noticia-item");
      let index = 0;

      function cambiarNoticia() {
        let actual = noticias.eq(index);
        index = (index + 1) % noticias.length;
        let siguiente = noticias.eq(index);
        
        actual.removeClass("noticia-activa");
        setTimeout(() => {
          siguiente.addClass("noticia-activa");
        }, 200);
      }

      // setInterval(cambiarNoticia, 40000);
    });
  </script>  


</div> 

<?php
// Obtener la IP del cliente
$ip_add = $_SERVER['REMOTE_ADDR'];

// Configuración para evitar riesgos si Geoplugin no responde o devuelve valores incorrectos
$vpais = "Desconocido";
$vciudad = "Desconocido";

// URL de Geoplugin
$parIP = "http://www.geoplugin.net/php.gp?ip=" . $ip_add;

try {
    // Solicitar datos a Geoplugin
  $response = @file_get_contents($parIP);
  if ($response) {
    $datosIP = @unserialize($response);
    if (is_array($datosIP)) {
            // Validar y asignar país
      if (!empty($datosIP["geoplugin_countryName"])) {
        $vpais = htmlspecialchars($datosIP["geoplugin_countryName"], ENT_QUOTES, 'UTF-8');
      }

            // Validar y asignar ciudad
      if (!empty($datosIP["geoplugin_city"])) {
        $vciudad = htmlspecialchars($datosIP["geoplugin_city"], ENT_QUOTES, 'UTF-8');
      }
    }
  }
} catch (Exception $e) {
    // Log del error (opcional)
  error_log("Error al obtener datos de Geoplugin: " . $e->getMessage());
}

// Mostrar resultados (solo para pruebas, eliminar en producción)
/*echo "IP del cliente: $ip_add<br>";
echo "País: $vpais<br>";
echo "Ciudad: $vciudad<br>";

*/
?>




<div class=col-sm-8>
  <div class=row>

    <form name="myForm" onsubmit="return validateForm()" method="post" action="<?php echo base_url() ?>consultagController/guardar">
      <div class="form-group col-sm-6">
        <div class="col-md">
          <div class="box box-solid box-primary">
            <div class="box-header">

              <h3 class="box-title">Haga su consulta gratuita  &nbsp;&nbsp; 
               <!--  <label style="background-color:#ffffff; color:#ffffff; padding:3px 3px; border-radius:8px;"> <?php // print_r($vcontarconsultas); ?>
             </label> -->
             <a href="https://www.facebook.com/netleybolivia/videos/184271956823438" target="_blank">
              <i class="fas fa-video" style="font-size: 1em; vertical-align: middle;"></i></a>
            </h3> 





            <small class="label pull-right bg-cyan">
              <?php echo $ip_add; ?>
            </small>
          </div><!-- /.box-header -->
          <div class="box-body">
           <p style="text-align: justify;">
            Si tiene dudas sobre derecho o temas legales no dude en escribir o llamar, estamos para  ayudarle. Su pregunta será respondida por orden de recepción y enviado a su correo electrónico o mediante llamada a su celular máximo en 3 días.
          </p>

          <img src="<?php echo base_url();?>imgs/iconos/whatsapp.png" width="24" height="24"> WhatsApp <b>71536460</b>
        </div><!-- /.box-body -->

      </div><!-- /.box -->
    </div>

    <script>
      const openVideoModal = document.getElementById('open-video-modal');
      const videoModal = document.getElementById('video-modal');
      const closeVideoModal = document.getElementById('close-video-modal');
      const videoIframe = document.getElementById('video-iframe');
    const originalVideoSrc = videoIframe.src; // Guardar el src original

    openVideoModal.addEventListener('click', function (event) {
      event.preventDefault();
        videoModal.style.display = 'flex'; // Mostrar el modal
        videoIframe.src = originalVideoSrc; // Reiniciar el video
      });

    closeVideoModal.addEventListener('click', function () {
        videoModal.style.display = 'none'; // Ocultar el modal
        videoIframe.src = ''; // Detener el video
      });

    window.addEventListener('click', function (event) {
      if (event.target === videoModal) {
            videoModal.style.display = 'none'; // Ocultar el modal
            videoIframe.src = ''; // Detener el video
          }
        });
      </script>



      <input type="hidden" name="pais" value="<?= $vpais ?>">
      <input type="hidden" name="ciudad" value="<?= $vciudad ?>">
      <input type="hidden" name="estado" value="Pendiente">

      <div class="card shadow-lg table-row-hover" style="background-color: #f0f8ff;  padding: 20px; border-radius: 10px;">
        <div class="card-header bg-primary text-white text-center">
          <h4 class="mb-0">CONSULTA GRATUITA</h4>
        </div>
        <div class="card-body bg-light">
          <!-- Campo de Consulta -->
          <div class="form-group mb-4">
            <label for="consulta" class="form-label fw-bold">Ingrese su consulta (*)</label>
            <textarea
            spellcheck="true"
            rows="4"
            maxlength="1500"
            name="consulta"
            id="consulta"
            pattern="[A-Za-z0-9\r\n\s.:;]+"
            title="Solo se permiten letras y números"
            placeholder="Ingrese su consulta detallada. Máximo 1500. NO INCLUYA REFERENCIAS PERSONALES. (jrcc)"
            class="form-control border-info p-3 rounded-3 shadow"
            required
            data-error="Ingrese su consulta"
            autofocus
            style="resize: none; background-color: #f9e5ef;color: #000;"></textarea>
          </div>

          <!-- Campos de Datos Personales -->
          <div class="form-group row mb-4">
            <label class="col-sm-5 col-form-label fw-bold">Nombre (*)</label>
            <div class="col-sm-7">
              <input type="text"
              name="nombres"
              minlength="2"
              maxlength="30"
              pattern="[A-Za-z]+( [A-Za-z]+)?"
              title="Solo letras"
              value="<?= isset($postulante) ? htmlspecialchars($postulante[0]->{'nombres'}) : '' ?>"
              class="form-control border-info text-uppercase p-2 rounded-3 shadow"
              style="background-color: #f9e5ef;color: #000;"
              required>
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-sm-5 col-form-label fw-bold">Apellido Paterno</label>
            <div class="col-sm-7">
              <input type="text"
              name="paterno"
              maxlength="30"
              pattern="[A-Za-z]+"
              title="Solo letras"
              value="<?= isset($postulante) ? htmlspecialchars($postulante[0]->{'paterno'}) : '' ?>"
              class="form-control border-info text-uppercase p-2 rounded-3 shadow"
              style="background-color: #f9e5ef;color: #000;">
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-sm-5 col-form-label fw-bold">Apellido Materno</label>
            <div class="col-sm-7">
              <input type="text"
              name="materno"
              maxlength="30"
              pattern="[A-Za-z]+"
              title="Solo letras"
              value="<?= isset($postulante) ? htmlspecialchars($postulante[0]->{'materno'}) : '' ?>"
              class="form-control border-info text-uppercase p-2 rounded-3 shadow"
              style="background-color: #f9e5ef;color: #000;">
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-sm-5 col-form-label fw-bold">E-mail (*)</label>
            <div class="col-sm-7">
              <input type="email"
              name="email"
              minlength="8"
              maxlength="45"
              pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}"
              title="Ingrese un correo válido"
              class="form-control border-info p-2 rounded-3 shadow"
              style="background-color: #f9e5ef;color: #000;"
              required>
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-sm-5 col-form-label fw-bold">Nº de Celular (*)</label>
            <div class="col-sm-7">
              <input type="tel"
              name="celular"
              pattern="[0-9]{8,11}"
              title="Ingrese un número de celular válido"
              maxlength="11"
              class="form-control border-info p-2 rounded-3 shadow"
              style="background-color: #f9e5ef;color: #000;"
              required
              onkeypress="if (event.keyCode < 48 || event.keyCode > 57) event.preventDefault();"
              value="<?= isset($postulante) ? htmlspecialchars($postulante[0]->{'celular'}) : '' ?>">
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-sm-5 col-form-label fw-bold">Nº de WhatsApp (*)</label>
            <div class="col-sm-7">
              <input type="tel"
              name="watss"
              pattern="[0-9]{8,11}"
              title="Ingrese un número válido"
              maxlength="11"
              class="form-control border-info p-2 rounded-3 shadow"
              style="background-color: #f9e5ef;color: #000;"
              required
              value="<?= isset($postulante) ? htmlspecialchars($postulante[0]->{'watss'}) : '' ?>"
              onkeypress="if (event.keyCode < 48 || event.keyCode > 57) event.preventDefault();">
            </div>
          </div>

          <!-- Campo de Captcha -->
          <div class="form-group row mb-4">
            <label class="col-sm-5 col-form-label fw-bold">Captcha</label>
            <div class="col-sm-7">
              <?= $captcha['image'] ?>
              <input type="hidden" name="captchaword" value="<?= htmlspecialchars($captcha['word']) ?>">
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-sm-5 col-form-label fw-bold">Escriba Captcha (*)</label>
            <div class="col-sm-7">
              <input type="text"
              name="captcha"
              class="form-control border-info p-2 rounded-3 shadow"
              style="background-color: #f9e5ef;color: #000;"
              title="Escriba los números de arriba"
              placeholder="Ingrese los números de arriba"
              required>
            </div>
          </div>
          <input type="hidden" name="zona" value="<?php if(isset($postulante)){  echo($postulante[0]->{'zona'}); }?>" >
          <input type="hidden" name="estado" value ="Pendiente">
          <input type="hidden" name="idabogado" value ="0">
          <input type="hidden" name="tipo" value ="Gratuita">
          <?php $startDate = date("Y-m-d");  ?>
          <input type="hidden" name="fechaconsultag" value ="<?php echo $startDate; ?>">
          <input type="hidden" name="ultimofyh" value ="<?php echo $startDate; ?>">
          <input type="hidden" name="plazo" value ="<?php echo $startDate; ?>">
          <input type="hidden" name="fechavisto" value ="<?php echo $startDate; ?>">
          <input type="hidden" name="fechaestimada" value ="<?php echo $startDate; ?>">
          <input type="hidden" name="fechaiguala" value ="<?php echo $startDate; ?>">
          <input type="hidden" name="especialidad" value ="">
          <input type="hidden" name="titulo" value ="">



          <div class="col-sm-12 text-center mt-4">

            <!-- Botón de Enviar -->
            <button type="submit" id="submit" class="btn btn-primary px-5 py-2 shadow-lg rounded-pill">
              Enviar consulta
            </button>

            <!-- Mensaje de Condiciones -->
            <div class="mt-3 text-info text-center">

              <a href="#" class="text-decoration-none">
                <h6>Al hacer clic en 'Enviar', acepta nuestras condiciones, incluso el uso de cookies.</h6>
              </a>
            </div>
          </div>
          <br>
        </div>
      </div>
    </div>

  </form><!-- end form -->

  <!-- desplazamiento inicial -->
  <style>
    /* Estilo inicial del div */
    .card.shadow-lg.table-row-hover {
      border: 2px solid transparent;
      transition: border-color 0.3s ease;
    }

/* Estilo para resaltar el borde */
.highlight {
  border: 2px solid #ff0000;
  animation: blink 0.5s ease-in-out infinite;
}

/* Animación intermitente */
@keyframes blink {
  0%, 100% {
    border-color: #ff0000;
  }
  50% {
    border-color: transparent;
  }
}
</style>
<script>
   // Esperar 2 segundos y desplazar hacia el div con animación de borde
  window.addEventListener('load', () => {
    setTimeout(() => {
      const targetDiv = document.querySelector('.card.shadow-lg.table-row-hover');
      if (targetDiv) {
      // Realizar el desplazamiento suave
        const targetPosition = targetDiv.getBoundingClientRect().top + window.pageYOffset;
        const startPosition = window.pageYOffset;
        const duration = 3000;
        let startTime = null;

        const animateScroll = (currentTime) => {
          if (!startTime) startTime = currentTime;
          const timeElapsed = currentTime - startTime;
          const progress = Math.min(timeElapsed / duration, 1);
          const easing = easeInOutQuad(progress);
          const scrollAmount = startPosition + (targetPosition - startPosition) * easing;

          window.scrollTo(0, scrollAmount);

          if (progress < 1) {
            requestAnimationFrame(animateScroll);
          } else {
          // Una vez finalizado el desplazamiento, iniciar el efecto de borde
            highlightBorder(targetDiv);
          }
        };

        const easeInOutQuad = (t) => {
          return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t;
        };

        const highlightBorder = (element) => {
        element.classList.add('highlight'); // Agregar clase para resaltar el borde
        setTimeout(() => {
          element.classList.remove('highlight'); // Quitar clase después de 2 segundos
        }, 2000);
      };

      requestAnimationFrame(animateScroll);
    }
  }, 2000);
  });

</script>

<script>
  document.addEventListener("DOMContentLoaded", () => {
  // Seleccionar todos los inputs y textareas
    const inputs = document.querySelectorAll(".form-control");

    inputs.forEach((input) => {
    // Agregar evento blur para verificar si hay datos
      input.addEventListener("blur", () => {
        if (input.value.trim() !== "") {
          input.classList.add("filled");
        } else {
          input.classList.remove("filled");
        }
      });

    // Restaurar estilos si se elimina el contenido
      input.addEventListener("input", () => {
        if (input.value.trim() === "") {
          input.classList.remove("filled");
        }
      });
    });
  });

</script>


<div class=col-sm-6>


  <div class="col-md">
    <div class="box box-solid box-warning">
      <div class="box-header">
        <h3 class="box-title">Opinión de nuestros clientes</h3>
      </div><!-- /.box-header -->
    </div><!-- /.box -->


    <div class="box-body">
     <?php if (count($opiniones)): ?>
      <table id="example1" class="table table-condensed table-hover">

        <thead class="thead-dark">
          <th class="text-left" style="width: 75%;">Opinión</th>
          <th class="text-left" style="width: 25%;">Calificación</th>
        </thead>
        <tbody>
          <?php foreach ($opiniones as $item): ?> 

           <tr class="table-row-hover">
            <td style="width: 75%;">
             <label><?php print_r($item->fechavisto); ?></label>
             <br>
             <?php print_r($item->opinion); ?>
             <br>
             <?php echo '- '.$item->nombres; ?> 
           </td>
           <td style="width: 25%;">
             <small class="label pull-right bg-cyan">
              <?php echo ($item->id.' ') ?>
            </small>
            <?php 
            switch ($item->estrellas) {
              case "1":
              $estrellas = 1; 
              echo "<div style='display: flex; gap: 4px; font-size: 32px; color: orange;'>";
              for ($i = 1; $i <= 5; $i++) {
                echo ($i <= $estrellas) ? "★" : "☆";
              }
              echo "</div>";
              break;
              case "2":
              $estrellas = 2; 
              echo "<div style='display: flex; gap: 4px; font-size: 32px; color: orange;'>";
              for ($i = 1; $i <= 5; $i++) {
                echo ($i <= $estrellas) ? "★" : "☆";
              }
              echo "</div>";
              break;
              case "3":
              $estrellas = 3; 
              echo "<div style='display: flex; gap: 4px; font-size: 32px; color: orange;'>";
              for ($i = 1; $i <= 5; $i++) {
                echo ($i <= $estrellas) ? "★" : "☆";
              }
              echo "</div>";
              break;
              case "4":
              $estrellas = 4; 
              echo "<div style='display: flex; gap: 4px; font-size: 32px; color: orange;'>";
              for ($i = 1; $i <= 5; $i++) {
                echo ($i <= $estrellas) ? "★" : "☆";
              }
              echo "</div>";
              break;
              default:
              $estrellas = 5; 
              echo "<div style='display: flex; gap: 4px; font-size: 32px; color: orange;'>";
              for ($i = 1; $i <= 5; $i++) {
                echo ($i <= $estrellas) ? "★" : "☆";
              }
              echo "</div>";

            }
            ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <br>
  <?php else: echo"<p>No hay registros</p>";?>
  <?php endif; ?>  

</div><!-- /.box-body -->


</div>


</div>
<!-- /.box-body 
<div class=row>
  <div class=col-sm-6 >
    <center><img src="<?php echo base_url().$publicidad[0]->ruta_s;?>" alt="Netley" style="width: 90%; height: 100px;" /></center>
  </div>
  <div class=col-sm-6 >
    <center><img src="<?php echo base_url().$publicidad[1]->ruta_s;?>" alt="Netley" style="width: 90%; height: 100px;" /></center>
  </div>
</div>
-->
</div>



</div>


<style>
  .table-row-hover:hover {
    background-color: #ffe6cc;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.8);
    border-radius: 4px; /* Bordes ligeramente redondeados */
  }

  .table-hover tbody tr:hover td {
    background-color: #ffe6cc;
  }


</style>





<!-- Modal / Ventana / Overlay en HTML DIV OCULTO -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" data-dismiss="modal">
    <div class="modal-content">  
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>            
      <div class="modal-body">
        <img src="" class="imagepreview" style="width: 100%;" >
      </div> 
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- script para mostrar la imagen modal  -->
<script>
  $(function() {
    $('.pop').on('click', function() {
      $('.imagepreview').attr('src', $(this).find('img').attr('src'));
      $('#imagemodal').modal('show');   
    });   
  });
</script>


<script>
  function validateForm() {
    const form = document.forms["myForm"];
    const consulta = document.getElementById("consulta").value.trim();
    const pais = form["pais"].value.trim().toUpperCase();
    const celular = form["celular"].value.trim();
    const whatsapp = form["watss"].value.trim();
    const email = form["email"].value.trim();
    const captchaWord = form["captchaword"].value.trim();
    const captcha = form["captcha"].value.trim();

    // Expresiones regulares
    const regexEnlace = /https?:\/\/|www\./i; // Detectar URLs
    const regexEspañol = /^[A-Za-zÁÉÍÓÚáéíóúñÑ0-9.,;:¡!¿?()\r\n\s]+$/; // Español básico
    const regexBolivia = /^[1-9][0-9]{7,10}$/; // Números bolivianos (8-10 dígitos)
    const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Validar email

    // Función auxiliar para mostrar errores
    function showError(message) {
      alert(message);
      return false;
    }

   

    // Si todo es válido
    return true;
  }
</script>





<!-- Para cambiar al español los mensajes  por defecto  -->
<script type="text/javascript">
 $(document).ready(function(){
  $('#example1').DataTable({
   'order': [[ 0, 'desc' ]],
   'paging'      : true,
   'lengthChange': false,
   'searching'   : false,
   'ordering'    : false,
   'info'        : false,
   'pageLength': 7,
   dom: 'Bfrtip',
   'language':{ paginate: {
    next: 'Sig.',
    previous: 'Ant.'
  }}
});
});
</script>


<!-- se realiza el listado de las ultimas noticias en el formulario cuerpo -->
</div>

<!--    *****************    uLTIMAS CONSULTAS   *******************   -->   

<div class="box box-solid box-default">
  <div class="box-header">
    <h3 class="box-title">ÚLTIMAS CONSULTAS</h3>
  </div><!-- /.box-header -->

  <div class="row" id="consultaCarrusel">
    <div class="col-sm-12" id="ultimasconsultas">
      <?php foreach ($consulta as $index => $item): ?>
        <div class="col-sm-3 consulta-item" style="display: <?php echo $index < 4 ? 'block' : 'none'; ?>;">
          <div class="consulta-content">
           <textarea readonly style="font-size:16px; font-family:Arial; font-weight: bold; width: 100%; color: black; background: transparent; border: none; outline: none; resize: none; overflow:hidden; text-align: left; padding: 10px; margin: 10px; line-height: 1.2;" rows="4"><?php echo trim(mb_strtoupper(strip_tags($item->titulo), 'UTF-8')); ?>
         </textarea>
         <span class="description">
          <label><?php echo trim($item->fecharesp) . ' : ' . trim($item->especialidad); ?></label>
        </span>
        <div class="box-body">
          <textarea readonly style="text-align: left; width: 100%; color: black; background: transparent; border: none; outline: none; resize: none; overflow:hidden; padding: 10px; margin: 10px; line-height: 1.2;" rows="5"><?php 
          $consulta_texto = trim(substr(strip_tags($item->consulta), 0, 180));
          echo mb_strtoupper($consulta_texto, 'UTF-8') . "...";
          ?>
        </textarea>
        <br>
        <h6 style="text-align:right;font-size:small">   
          <a href="" style="color:green;">Leer más...</a>
        </h6>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>
</div>
</div><!-- /.box -->


<!-- Agregar los efectos de carrusel -->
<script>
 $(document).ready(function() {
  var totalConsultas = $(".consulta-item").length;
  var currentIndex = 0;
  var consultasPorMostrar = 4;

  // Mostrar las primeras 4 consultas inicialmente con animación
  $(".consulta-item").slice(0, consultasPorMostrar).css({ display: "block", opacity: 1, transform: "scale(1) translateY(0)" });

  function actualizarCarrusel() {
    // Ocultar las consultas actuales con una transición más rápida
    $(".consulta-item").each(function(index) {
      $(this).animate({ opacity: 0, transform: "scale(1)" }, 300);
    });

    // Retraso antes de mostrar nuevas consultas
    setTimeout(function() {
      $(".consulta-item").hide();

      // Mostrar las siguientes 4 consultas con un efecto más llamativo
      for (var i = 0; i < consultasPorMostrar; i++) {
        var index = (currentIndex + i) % totalConsultas;

        (function(index) {
          setTimeout(function() {
            $(".consulta-item").eq(index)
            .css({ transform: "scale(1)", opacity: 0 })
            .show()
            .animate({ opacity: 1, transform: "scale(1)" }, 600);
          }, i * 150); // Retraso secuencial más dinámico
        })(index);
      }

      // Actualizar índice para el siguiente ciclo
      currentIndex = (currentIndex + consultasPorMostrar) % totalConsultas;
    }, 100); // Reducción del tiempo de transición

    // Llamada recursiva para crear el ciclo de carrusel con mayor tiempo de visualización
    // setTimeout(actualizarCarrusel, 9000); // Ahora cada 9 segundos
  }

  // Iniciar el carrusel
  // actualizarCarrusel();
});
</script>

<!-- Estilo CSS para animación y bordes sombreados con colores -->
<style>
  .consulta-item {
    display: none; /* Inicialmente ocultas */
    opacity: 0; /* Opacidad inicial */
    transform: translateY(50px); /* Desplazamiento hacia abajo para el efecto de deslizamiento */
    transition: opacity 1s ease-in-out, transform 1s ease-in-out; /* Transición suave */
    background: #ffffff; /* Fondo blanco */
    border: 3px solid; /* Borde de 3px */
    border-radius: 8px; /* Bordes redondeados */
    padding: 15px;
    margin-bottom: 10px; /* Espaciado entre consultas */
    box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.5); /* Sombra suave */
  }

  /* Colores de borde y fondo con estilo de Windows */
  .consulta-item:nth-child(4n+1) {
    border-color: #6b9dd1;
    background-color:   #d5dbdb   ;
    color: #34495e  ;
  }

  .consulta-item:nth-child(4n+2) {
    border-color: #388e3c;
    background-color:  #abebc6  ;
    color: #34495e;
  }

  .consulta-item:nth-child(4n+3) {
    border-color: #fbc02d;
    background-color:  #fad7a0 ;
    color: #34495e;
  }

  .consulta-item:nth-child(4n+4) {
    border-color: #1976d2;
    background-color:  #e6b0aa  ;
    color: #34495e;
  }
</style>






<!--    *****************    Imagenes   *******************   -->                                                                     

<div class="box box-solid box-primary">
  <div class="box-header">
    <h3 class="box-title">PUBLICACIONES</h3>
  </div><!-- /.box-header -->
  
  <div class="row">
    <?php 
    $nropublis=count($publicaciones);
    switch ($nropublis) {
      case 1:
      ?>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
           <img src="<?php echo base_url().$publicaciones[0]->ruta_s;?>" alt="Netley." style="width:100%;height:;">
           <div class="box-body">
             <div class="box-body">
              <label style="color: white;text-align:justify;font-weight: 600;"><?php echo strtoupper($publicaciones[0]->{'titulo'});?></label>
              <h5 style="text-align:justify"><?php echo $publicaciones[0]->{'descripcion'};?></h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php 
    break;

    case 2:
    ?>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
         <img src="<?php echo base_url().$publicaciones[0]->ruta_s;?>" alt="Netley." style="width:100%;height:;">
         <div class="box-body">
           <p style="color: white;text-align:justify;font-weight: 600;"><?php echo strtoupper($publicaciones[0]->{'titulo'});?></p>
           <h5 style="text-align:justify"><?php echo $publicaciones[0]->{'descripcion'};?></h5>
         </div>
       </div>
     </div>
   </div>
   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-green">
      <div class="inner">
       <img src="<?php echo base_url().$publicaciones[1]->ruta_s;?>" alt="Netley." style="width:100%;height:;">
       <div class="box-body">
         <p style="color: white;text-align:justify;font-weight: 600;"><?php echo strtoupper($publicaciones[1]->{'titulo'});?></p>
         <h5 style="text-align:justify"><?php echo $publicaciones[1]->{'descripcion'};?></h5>
       </div>
     </div>
   </div>
 </div>
 <?php 
 break;

 case 3:
 ?>
 <div class="col-lg-3 col-xs-6">
  <div class="small-box bg-aqua">
    <div class="inner">
      <img src="<?php echo base_url().$publicaciones[0]->ruta_s;?>" alt="Netley." style="width:100%;height:100%;">
      <div class="box-body">
        <p style="color: white;text-align:justify;font-weight: 600;"><?php echo strtoupper($publicaciones[0]->{'titulo'});?></p>
        <h5 style="text-align:justify"><?php echo $publicaciones[0]->{'descripcion'};?></h5>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-3 col-xs-6">
  <div class="small-box bg-green">
    <div class="inner">
      <img src="<?php echo base_url().$publicaciones[1]->ruta_s;?>" alt="Netley." style="width:100%;height:100%;">
      <div class="box-body">
        <p style="color: white;text-align:justify;font-weight: 600;"><?php echo strtoupper($publicaciones[1]->{'titulo'});?></p>
        <h5 style="text-align:justify"><?php echo $publicaciones[1]->{'descripcion'};?></h5>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-3 col-xs-6">
  <div class="small-box bg-yellow">
    <div class="inner">
      <img src="<?php echo base_url().$publicaciones[2]->ruta_s;?>" alt="Netley." style="width:100%;height:100%;">
      <div class="box-body">
        <p style="color: white;text-align:justify;font-weight: 600;"><?php echo strtoupper($publicaciones[2]->{'titulo'});?></p>
        <h5 style="text-align:justify"><?php echo $publicaciones[2]->{'descripcion'};?></h5>
      </div>
    </div>
  </div>
</div>

<?php 
break;


  //     *****************    Imagenes   *******************   


case 4:
?>
<div class="row bg-info">
  <br>
  <div class="col-sm-3">
    <div class="small-box bg-aqua">
      <div class="inner">
        <div class="contenedor"><div class="marcoFoto">
          <img src="<?php echo base_url().$publicaciones[0]->ruta_s;?>" alt="Netley." style="width:100%;height:100%;">
        </div></div>
        <div class="box-body">
          <center><p style="color: darkturquoise;">.</p>
            <p style="color: white;font-weight: 600;"><?php echo strtoupper($publicaciones[0]->{'titulo'});?></p>
          </center>
          <textarea style="text-align: justify; width: 100%; color: white; background: transparent; border: none; outline: none; resize: none; overflow: hidden;" rows="12" readonly disabled><?php echo htmlspecialchars($publicaciones[0]->{'descripcion'}); ?>
        </textarea>

      </div>
    </div>
  </div>
</div>
<div class="col-sm-3">
  <div class="small-box bg-green">
    <div class="inner">
      <div class="contenedor"><div class="marcoFoto">
        <img src="<?php echo base_url().$publicaciones[1]->ruta_s;?>" alt="Netley." style="width:100%;height:100%;">
      </div></div>
      <div class="box-body">
        <center>
          <p style="color: green;">.</p>
          <p style="color: white;font-weight: 600;"><?php echo strtoupper($publicaciones[1]->{'titulo'});?></p>
        </center>
        <textarea style="text-align: justify; width: 100%; color: #white; background: transparent; border: none; outline: none;resize: none; overflow:hidden;"  rows="12" readonly disabled ><?php echo $publicaciones[1]->{'descripcion'};?></textarea>
      </div>
    </div>
  </div>
</div>
<div class="col-sm-3">
  <div class="small-box bg-yellow">
    <div class="inner">
     <div class="contenedor"><div class="marcoFoto">
      <img src="<?php echo base_url().$publicaciones[2]->ruta_s;?>" alt="Netley." style="width:100%;height:100%;">
    </div></div>
    <div class="box-body">
      <center>
        <p style="color: darkorange;">.</p>
        <p style="color: white;font-weight: 600;"><?php echo strtoupper($publicaciones[2]->{'titulo'});?></p>
      </center>
      <textarea style="text-align: justify; width: 100%; color: #white; background: transparent; border: none; outline: none;resize: none; overflow:hidden;"  rows="12" readonly disabled><?php echo $publicaciones[2]->{'descripcion'};?></textarea>
    </div>
  </div>
</div>
</div>
<div class="col-sm-3">
  <div class="small-box bg-red">
    <div class="inner">
     <div class="contenedor"><div class="marcoFoto">
      <img src="<?php echo base_url().$publicaciones[3]->ruta_s;?>" alt="Netley." style="width:100%;height:100%;">
    </div></div>
    <div class="box-body">
      <center><p style="color: palevioletred;">.</p>
        <p style="color: white;font-weight: 600;"><?php echo strtoupper($publicaciones[3]->{'titulo'});?></p>
      </center>
      <textarea style="text-align: justify; width: 100%; color: #white; background: transparent; border: none; outline: none;resize: none; overflow:hidden;"  rows="12" readonly disabled><?php echo $publicaciones[3]->{'descripcion'};?></textarea>
    </div>
  </div>
</div>

</div>


<?php 
break;
}
?>

</div>
</div>
</div> 
</div> 
<!-- hasta esta linea se denbe volver a habiliatrlo.-->
</div>

<div class="modal fade" id="myModalxx" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
     <div class="box box-solid box-primary">
      <div class="box-header">
        <center><h2 class="modal-title">Nueva sucursal NETLEY en ... <br> SANTA CRUZ !!!</h2></center>
        <img src="" alt="">
      </div>
      <div class="box-body">
        <center><img src="<?php echo base_url().'personal/feliznetley.png' ;?>" alt="Realice su consulta gratuita. Netley. " style="width:50%;height:auto;"></center>
        <br>
      </div>
      <div class="box-footer" style="background-color: #F0F8FF ;">
        <center>
          <b>Ahora también estamos en SANTA CRUZ... </b>
          <br>Av. 21 de Mayo esq. Calle Ayacucho Nº 8
          <br>Edif. Mercedes - Piso 2 Of. 11
          <h3><b>Consulta gratuita al &nbsp;&nbsp; 71536460 </b></h3>
        </center>
      </div>
    </div>
  </div>
</div>
</div>


<script>
  $( document ).ready(function() {
    $('#myModalx').modal('show');
/*
    setTimeout(function() {
      $('#myModalx').fadeOut(2500);
    },3000
    );
    
    */

  });
</script>