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

<form method="post" action="<?php echo base_url() ?>usuarios/guardarpassword">
  <div class="container"  style="margin-top:30px" >
    <div class="row">
      <div class="col-sm-4">
      </div>
      <div class="col-sm-4">
        <div class="login-logo">
          <h3>  </h3>
        </div>
        <div class="box box-solid box-danger">
          <div class="box-header text-center">
            <h4>Cambiar contraseña de acceso</h4>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="form-group has-feedback">
              <label>Nueva contraseña </label>         
              <input type="password" class="form-control" name="pass1" autofocus required="required" maxlength="20" placeholder="Nueva contraseña" />   
              <span style="color:silver" class="glyphicon glyphicon-lock form-control-feedback"> </span> 
            </div>  
            <div class="form-group has-feedback" >
              <label>Confirmar contraseña </label>         
              <input type="password" class="form-control" name="pass2" required="required" maxlength="20" placeholder="confirmar contraseña" /> 
              <span style="color:silver" class="glyphicon glyphicon-log-in form-control-feedback"></span> 
            </div> 
              <input type="hidden" name="iduser"  value ="<?php echo $iduser ?>">
             <input type="hidden" name="estado" value ="ANTIGUO">


            <div class="row"> 
              <div class="col-sm-2"></div>
              <div class="col-sm-4">
                  <input type="submit" class="btn btn-success" style="width:100%;" value="Guardar" />
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

