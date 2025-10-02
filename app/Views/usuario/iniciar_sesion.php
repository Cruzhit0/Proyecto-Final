<?php
if ($error){
  ?>
  <script>
    mostrarmensaje('<?=$error;?>',3);
  //1 info, 2 warning, 3 succes, 4 error
</script>
<?php
}
?> 

<form method="post" action="<?php echo base_url() ?>usuarios/iniciar_sesion_post">
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
            <h4>Iniciar sesión</h4>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="form-group has-feedback">
              <label> Nombre </label>         
              <input type="text" class="form-control" name="nombre" autofocus required pattern="^[A-Za-z0-9]+$" title="Solo letras y numeros" maxlength="25" placeholder="Usuario" />   
              <span class="glyphicon glyphicon-user form-control-feedback"> </span> 
            </div>  
            <div class="form-group has-feedback" >
              <label> Contraseña </label>         
              <input type="password" class="form-control" name="contrasena" required maxlength="25" placeholder="Contraseña" /> 
              <span class="glyphicon glyphicon-lock form-control-feedback"></span> 
            </div> 

            <div class="row"> 
              <div class="col-sm-2"></div>
              <div class="col-sm-4">
                  <input type="submit" class="btn btn-success" style="width:100%;" value="Ingresar" />
              </div>
              <div class="col-sm-4">
                  <a href="<?php echo base_url();?>inicio" class="btn btn-danger" style="width:100%;">Cancelar</a>
              </div>
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->

      </div>  
    </div> 
  </div>    
</form>


<div class="jumbotron text-center" style="margin-bottom:0; background-color: white">  </div>

