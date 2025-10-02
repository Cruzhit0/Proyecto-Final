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





<div class="container  show-top-margin separate-rows tall-rows" style="margin-left:3%; margin-top:10px;width:94%;">

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

    
    <table id="tablacuerpo1" class="table table-striped table-row-hover">
      <tbody>
        <?php if (count($noticia)): ?>
          <?php foreach ($noticia as $item): ?> 
            <tr>
              <td>
                <div class="col-sm-12">
                  <h4><b><?php echo mb_strtoupper($item->titulo); ?> </b></h4>
                  <span class="description"><h5> Publicado el <?php echo($item->fecha); ?> </h5> </span>
                </div>
                <div class="box-body">

                  <div class="card" style="text-align:justify">


                   <div class="contenedor"><div class="marcoFotop">
                    <a href="<?php echo base_url() ?>Noticias/vernoticia/<?php echo $item->id ?>" style="color:green;"><img src="<?php echo base_url().$item->ruta_s;?>" alt="Netley. " style="width:100%;height:auto;"></a>

                  </div></div>
                  <div class="box-body">

                  </div>

                  <?php 
                  $palabras=str_word_count($item->descripcion);
                  $item->descripcion; 
                  $splittedstring=array();
                  $data=$item->descripcion; 
                  $splittedstring=explode(" ",$data,50);
                  foreach ($splittedstring as $key => $value) {
                    if($key<30) {
                      echo $splittedstring[$key]." " ;
                    }
                  }
                  echo "...";
                  ?>
                  <br>    
                  <p style="text-align:right">  
                    <a href="<?php echo base_url() ?>Noticias/vernoticia/<?php echo $item->id ?>" style="color:green;">Leer mas...   </a>
                  </p>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <!-- Load Facebook SDK for JavaScript -->
              <div style="text-align: right;">
                <div class="fb-like" 
                data-href="https://www.netley.bo"
                data-width="500"
                data-layout="button_count" data-action="like"
                data-show-faces="true"
                data-size="large" 
                data-share="true">
              </div>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php else: echo"<p>.</p>";?>
      <?php endif; ?>  
    </tbody> 
  </table>      


</div> 

<?php
$ip_add = $_SERVER['REMOTE_ADDR'];
              //echo "IP ".$ip_add;
$parIP="http://www.geoplugin.net/php.gp?ip=".$ip_add;
              //echo $parIP;
$datosIP=unserialize(file_get_contents($parIP));
              // print_r($datosIP);
$vpais=$datosIP["geoplugin_countryName"];
$vciudad=$datosIP["geoplugin_city"];
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

    <input type="hidden" name="pais" value="<?= $vpais ?>">
    <input type="hidden" name="ciudad" value="<?= $vciudad ?>">
    <input type="hidden" name="estado" value="PENDIENTE">

    <div class="card shadow-lg table-row-hover" 
    style="background-color: #f0f8ff;  padding: 20px; border-radius: 10px;">
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
        placeholder="Describa su consulta de manera detallada. Máximo 1500 caracteres."
        class="form-control border-info p-3 rounded-3 shadow"
        required
        data-error="Ingrese su consulta"
        autofocus
        style="resize: none; background-color: #e9f7ff;">
      </textarea>
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
        style="background-color: #e9f7ff;"
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
        style="background-color: #e9f7ff;">
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
        style="background-color: #e9f7ff;">
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
        style="background-color: #e9f7ff;"
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
        style="background-color: #e9f7ff;"
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
        style="background-color: #e9f7ff;"
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
        style="background-color: #e9f7ff;"
        title="Escriba los números de arriba"
        placeholder="Ingrese los números mostrados arriba"
        required>
      </div>
    </div>

    <div class="col-sm-12 text-center mt-4">
      <!-- Botón de Enviar -->
      <button type="submit" id="submit" class="btn btn-primary px-5 py-2 shadow-lg rounded-pill">
        Enviar consulta
      </button>
      
      <!-- Mensaje de Condiciones -->
      <div class="mt-3 text-info text-center">
        <br>
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
              echo "<div style='font-size:50px;color:orange'>*</div>";
              break;
              case "2":
              echo "<div style='font-size:50px;color:orange'>**</div>";
              break;
              case "3":
              echo "<div style='font-size:50px;color:orange'>***</div>";
              break;
              case "4":
              echo "<div style='font-size:50px;color:orange'>****</div>";
              break;
              default:
              echo "<div style='font-size:50px;color:orange'>*****</div>";
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
    const captchaWord = form["captchaword"].value.trim();
    const captcha = form["captcha"].value.trim();

    // Expresiones regulares
    const regexEnlace = /https?:\/\/|www\./i; // Detectar URLs
    const regexEspañol = /^[A-Za-zÁÉÍÓÚáéíóúñÑ0-9.,;:¡!¿?()\r\n\s]+$/; // Español básico
    const regexBolivia = /^[1-9][0-9]{7}$/; // Números bolivianos (8 dígitos)

    // Validaciones
    if (regexEnlace.test(consulta)) {
      alert("La consulta es incorrecta.");
      return false;
    }

    if (!regexEspañol.test(consulta)) {
      alert("La consulta está mal redactada.");
      return false;
    }

    if (pais !== "BOLIVIA") {
      alert("Sólo autorizado país de origen.");
      return false;
    }

    if (!regexBolivia.test(celular)) {
      alert("El número de celular debe ser un número válido.");
      return false;
    }

    if (!regexBolivia.test(whatsapp)) {
      alert("El número de WhatsApp debe ser un número válido.");
      return false;
    }

    if (captchaWord !== captcha) {
      alert("Error en el CAPTCHA.");
      return false;
    }

    // Si todas las validaciones pasan
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
<br>
<div class="box">
  <div class="box-header">
    <h3 class="box-title">ULTIMAS CONSULTAS</h3>
  </div><!-- /.box-header -->
</div><!-- /.box -->

<table id="tablacuerpo2" class="table table-striped table-row-hover">

  <div class="col-sm-12">
   <div class="row">

    <div class="col-sm-3 bg-info table-striped table-row-hover" style="text-align:left;  word-wrap: break-word;">
      <br><textarea readonly style="font-size:16px; font-family:Arial; font-weight: bold; width: 100%; color: black; background: transparent; border: none; outline: none;resize: none; overflow:hidden;"  rows="2" ><?php echo mb_strtoupper($consulta[0]->{'titulo'},'utf-8'); ?></textarea>

      <span class="description"><label><?php echo($consulta[0]->{'fecharesp'}.' : '.$consulta[0]->{'especialidad'});?> </label> </span>

      <div class="box-body">
        <textarea readonly style="text-align: justify; width: 100%; color: #white; background: transparent; border: none; outline: none;resize: none; overflow:hidden;"  rows="5" ><?php $consulta[0]->{'consulta'}=substr ( $consulta[0]->{'consulta'} , 0, 180 ); echo mb_strtoupper($consulta[0]->{'consulta'},'utf-8'); $palabras=str_word_count($consulta[0]->{'consulta'}, 1);
        echo "...";
      ?></textarea>
      <br> 
      <h6 style="text-align:right;font-size:small">   
        <a href="<?php echo base_url() ?>Consultas/verconsultasolo/<?php echo $consulta[0]->{'id'} ?>" style="color:green;">Leer mas...   </a>
      </h6>
    </div>
  </div> 

  <div class="col-sm-3 bg-info table-striped table-row-hover" style="text-align:left;  word-wrap: break-word;">
    <br><textarea readonly style="font-size:16px; font-family:Arial; font-weight: bold; width: 100%; color: black; background: transparent; border: none; outline: none;resize: none; overflow:hidden;"  rows="2" ><?php echo mb_strtoupper($consulta[1]->{'titulo'},'utf-8'); ?></textarea>

    <span class="description"><label><?php echo($consulta[1]->{'fecharesp'}.' : '.$consulta[1]->{'especialidad'});?> </label> </span>
    <div class="box-body">
     <textarea readonly style="text-align: justify; width: 100%; color: #white; background: transparent; border: none; outline: none;resize: none; overflow:hidden;"  rows="5" ><?php $consulta[1]->{'consulta'}=substr ( $consulta[1]->{'consulta'} , 0, 180 ); echo mb_strtoupper($consulta[1]->{'consulta'},'utf-8'); $palabras=str_word_count($consulta[1]->{'consulta'}, 1);
     echo "...";
   ?></textarea>
   <br>    
   <h6 style="text-align:right;font-size:small"> 
    <a href="<?php echo base_url() ?>Consultas/verconsultasolo/<?php echo $consulta[1]->{'id'} ?>" style="color:green;">Leer mas...   </a>
  </h6>
</div>
</div>

<div class="col-sm-3 bg-info table-striped table-row-hover" style="text-align:left;  word-wrap: break-word;">
  <br><textarea readonly style="font-size:16px; font-family:Arial; font-weight: bold; width: 100%; color: black; background: transparent; border: none; outline: none;resize: none; overflow:hidden;"  rows="2" ><?php echo mb_strtoupper($consulta[2]->{'titulo'},'utf-8'); ?></textarea>

  <span class="description"><label><?php echo($consulta[2]->{'fecharesp'}.' : '.$consulta[2]->{'especialidad'});?> </label> </span>
  <div class="box-body">
    <textarea readonly style="text-align: justify; width: 100%; color: #white; background: transparent; border: none; outline: none;resize: none; overflow:hidden;"  rows="5" ><?php $consulta[2]->{'consulta'}=substr ( $consulta[2]->{'consulta'} , 0, 180 ); echo mb_strtoupper($consulta[2]->{'consulta'},'utf-8'); $palabras=str_word_count($consulta[2]->{'consulta'}, 1);
    echo "...";
  ?></textarea>
  <br>    
  <h6 style="text-align:right;font-size:small">   
    <a href="<?php echo base_url() ?>Consultas/verconsultasolo/<?php echo $consulta[2]->{'id'} ?>" style="color:green;">Leer mas...   </a>
  </h6>
</div>
</div>

<div class="col-sm-3 bg-info table-striped table-row-hover" style="text-align:left;  word-wrap: break-word;">
  <br><textarea readonly style="font-size:16px; font-family:Arial; font-weight: bold; width: 100%; color: black; background: transparent; border: none; outline: none;resize: none; overflow:hidden;"  rows="2" ><?php echo mb_strtoupper($consulta[3]->{'titulo'},'utf-8'); ?></textarea>

  <span class="description"><label><?php echo($consulta[3]->{'fecharesp'}.' : '.$consulta[3]->{'especialidad'});?> </label> </span>
  <div class="box-body">
   <textarea readonly style="text-align: justify; width: 100%; color: #white; background: transparent; border: none; outline: none;resize: none; overflow:hidden;"  rows="5" ><?php $consulta[3]->{'consulta'}=substr ( $consulta[3]->{'consulta'} , 0, 180 ); echo mb_strtoupper($consulta[3]->{'consulta'},'utf-8'); $palabras=str_word_count($consulta[3]->{'consulta'}, 1);
   echo "...";
 ?></textarea>
 <br>    
 <h6 style="text-align:right;font-size:small"> 
  <a href="<?php echo base_url() ?>Consultas/verconsultasolo/<?php echo $consulta[3]->{'id'} ?>" style="color:green;">Leer mas...   </a>
</h6>
</div>
</div>
</div>
</div>
</table> 









<!--    *****************    Imagenes   *******************   -->                                                                     
<div class="box">
  <div class="jumbotron text-center" style="background-color: #FFFFFF;">
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
            <textarea style="text-align: justify; width: 100%; color: #white; background: transparent; border: none; outline: none;resize: none; overflow:hidden;"  rows="12" ><?php echo $publicaciones[3]->{'descripcion'};?></textarea>
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
            <textarea style="text-align: justify; width: 100%; color: #white; background: transparent; border: none; outline: none;resize: none; overflow:hidden;"  rows="12" ><?php echo $publicaciones[1]->{'descripcion'};?></textarea>
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
          <textarea style="text-align: justify; width: 100%; color: #white; background: transparent; border: none; outline: none;resize: none; overflow:hidden;"  rows="12" ><?php echo $publicaciones[2]->{'descripcion'};?></textarea>
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
        <textarea style="text-align: justify; width: 100%; color: #white; background: transparent; border: none; outline: none;resize: none; overflow:hidden;"  rows="12" ><?php echo $publicaciones[3]->{'descripcion'};?></textarea>
      </div>
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