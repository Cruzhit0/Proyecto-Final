<?php
if ($error){
  ?>
  <script>
    mostrarmensaje('<?=$error;?>',4);
  //1 info, 2 warning, 3 succes, 4 error
</script>
<?php
}
?> 


<form method="post" action="<?php echo base_url() ?>usuarios/iniciar_sesion_post_postulante">
<div class="container"  style="margin-top:30px" >
  <div class="row">
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4">
      <div class="login-logo">
        <h3>  </h3>
      </div>
      <div class="box box-solid box-primary">
        <div class="box-header text-center">
          <h4>Postulación...</h4>
        </div><!-- /.box-header -->
        <div class="box-body">
         <div class="row text-center"> 

         </div>

         <div class="form-group has-feedback">
          <label> Email </label>         
          <input type="email" class="form-control" name="email" required="required" placeholder="Correo electrónico" /> 



            
          <span class="glyphicon glyphicon-user form-control-feedback"> </span> 
        </div>  
        <div class="form-group has-feedback" >
          <label> Contraseña </label>         
          <input type="password" class="form-control" name="contrasena" required="required" placeholder="Contraseña" /> 
          <span class="glyphicon glyphicon-lock form-control-feedback"></span> 
        </div> 
        <div class="row text-center"> 
          <input type="submit" class="btn btn-success" value="Ingresar" />
        </div>
      </div><!-- /.box-body -->
    </div><!-- /.box -->

  </div>  
</div> 
</div>    
</form>


<div class="jumbotron text-center" style="margin-bottom:0">  </div>

