<!DOCTYPE html>
<html>
<head>
  <meta property="og:site_name" content="Netley" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://www.netley.bo/" />
  <meta property="og:title" content="Asesoramiento legal gratuito en toda Bolivia"> 

<meta name="description" content="Hotel Viña del Sur en Tarija, Bolivia. Disfruta de una estadía acogedora en el sur del país, con habitaciones cómodas, servicio personalizado y la calidez tarijeña que te hará sentir como en casa." />
<meta name="keywords" content="hotel, viña del sur, tarija, bolivia, sur de bolivia, hospedaje, alojamiento, turismo, vacaciones, descanso, hotel en tarija, hotel boutique, viñedos, valle central, turismo en tarija, hotel familiar, hotel romántico, hotel con piscina, hotel con desayuno, hotel económico, hotel de lujo" />
  <meta name=”robots” content=”index, follow” />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hotel Viña del Sur</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>imgs/iconos/netley.ico" />
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
      folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/skins/_all-skins.min.css">
      <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/morris.js/morris.css">
      <!-- jvectormap -->
      <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
      folder instead of downloading all of them to reduce the load. -->


      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
      

      <!-- Google Font -->
      <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
      <!--botones sociales-->
      <link rel="stylesheet" href="<?php echo base_url();?>css/stylesbsocial.css">     
      <script type="text/javascript" src="<?php echo base_url();?>js/bsocial.js"></script>
      <!-- Para style= display :none and show mostrar pequeños formularios como conuslta gratuira-->
      <script src="https://code.jquery.com/jquery-3.2.1.js"></script>   
      <!-- Para sacar notificaciones -->
      <script src="<?php echo base_url();?>js/push.min.js"></script>    
      <script type="text/javascript">
        $(document).ready(function(){
          $("#hide").on('click', function() {
            $("#element").hide();
            return false;
          });

          $("#show").on('click', function() {
            $("#element").show();
            return false;
          });
        });
      </script> 
    <!-- PARA BARRA HORIZONTAL EN DATATABLES 
<style>
.container-fluid{
overflow-x:scroll;
}
.table{
border: 1px solid #0000F0;
}
</style>
-->
<!-- PARA GIRAR FOTOGRAFIAS -->
<style>
  .marcoFoto {
    overflow: hidden; /*esta propiedad evita que la imagen ocupe mas espacio que su contenedor*/
    width:100%;
    border: 1px solid #FFF;
    box-sizing:border-box;
    float:left;
  }

  .marcoFoto img {
    transition: all 1s ease;
    width:100%;
  }

  .marcoFoto img:hover {
    transform:scale(1.5) rotate(20deg); /*cuando nos posicionamos sobre la imagen con esta propiedad aumentamos su escala y ademas la giramos*/
    opacity:0.9;
  }

  .marcoFotop {
    overflow: hidden; /*esta propiedad evita que la imagen ocupe mas espacio que su contenedor*/
    width:100%;
    border: 5px solid #FFF;
    box-sizing:border-box;
    float:left;
  }
  .marcoFotop img {
    transition: all 2s ease;
    width:100%;
  }
  .marcoFotop img:hover {
    transform:scale(1.5) rotate(0deg); /*cuando nos posicionamos sobre la imagen con esta propiedad aumentamos su escala y ademas la giramos*/
    opacity:0.9;
  }


  .contenedor{
    margin:1px; 
    max-width:100%;
    width:100%;
  }
</style>




<!-- estilo de las datatables -->
<style>
  .table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(217, 235, 235,0.4);
  }
  .table-striped tbody tr:nth-of-type(even) {
    background-color: rgba(217, 235, 235,0.4);
  }
  .table-hover tbody tr:hover {
    background-color: rgba(217, 235, 235,0.4);

  }
  .thead-green {
    background-color: rgb(0, 99, 71);
    color: white;
  }
</style>


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-185420887-1">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-185420887-1');
</script>







</head>
<body class="hold-transition skin-blue sidebar-mini;" >
  <!-- <body class="hold-transition skin-blue layout-top-nav"> -->


    <!-- librerias para mensajes de alerta toastr  -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <!-- la funcion javascrip que se encarga de mostrar el mensaje -->
    <script>
      function mostrarmensaje(x,i){
        //alert(x);
        
        switch (i) {
        case 1: toastr.info(x,'NETLEY & ASOCIADOS',{"progressBar":true, "closeButton":true, "hideDuration": "4000", "positionClass": "toast-top-full-width", "showMethod":"slideDown"});
         break;
       case 2: toastr.warning(x,'NETLEY & ASOCIADOS',{"progressBar":true, "closeButton":true, "hideDuration": "4000", "positionClass": "toast-top-full-width", "showMethod":"slideDown"});
         break;
       case 3: toastr.success(x,'NETLEY & ASOCIADOS',{"progressBar":true, "closeButton":true, "hideDuration": "4000", "positionClass": "toast-top-full-width", "showMethod":"slideDown"});
         break;
       case 4: toastr.error(x,'NETLEY & ASOCIADOS',{"progressBar":true, "closeButton":true, "hideDuration": "4000", "positionClass": "toast-top-full-width", "showMethod":"slideDown"});
         break;
       }
     }
   </script>



   <!-- librerias para botones sociales -->
   <div id="fb-root"></div>
   <script>
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>


