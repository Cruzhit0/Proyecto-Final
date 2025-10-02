<script src='https://www.google.com/recaptcha/api.js' async defer></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<?php
if($this->session->flashdata('message'))
{
  ?>
  <?php
  $error= $this->session->flashdata('message');
  ?>
  <script>
    mostrarmensaje('<?=$error;?>',1);
  // ahora se debe llevar al siguiente formulario de form usuario
</script>
<?php
}
?>

<?php
if($this->session->flashdata('messageerror'))
{
  ?>
  <?php
  $error= $this->session->flashdata('messageerror');
  ?>
  <script>
    mostrarmensaje('<?=$error;?>',4);
    //1 info, 2 warning, 3 succes, 4 error
  </script>
  <?php
}
?>
<?php
if($this->session->flashdata('success_message'))
{
  ?>
  <?php
  $error= $this->session->flashdata('success_message');
  ?>
  <script>
    mostrarmensaje('<?=$error;?>',3);
  //1 info, 2 warning, 3 succes, 4 error
</script>
<?php
}
?>
<?php $startDate = date("Y-m-d");//saca fecha del sistema
$fnac = date("Y-m-d", strtotime("-30 years", strtotime($startDate)));
?>
<form method="post" action="<?php echo base_url(); ?>usuarios/verifica_iniciar_sesion_ex">
  <div class="container"  style="margin-top:30px" >
    <div class="row">
      <div class="col-sm-4">
      </div>
      <div class="col-sm-4">
       <div class="box box-solid box-primary">
        <div class="box-header text-center">
          <h4>Sesión cliente</h4>
        </div>
        <div class="box-body">
          <div class="col-sm-1">
          </div>
          <div class="col-sm-10">
            <div class="form-group has-feedback" >
              <label> Cédula de Identidad </label>         
              <input type="text" class="form-control" id="cedula" name="cedula" pattern="[0-9]{3,8}" required placeholder="Cédula de identidad" value="33"/> 
              <span class="glyphicon glyphicon-user form-control-feedback"></span> 
            </div> 
            <div class="form-group has-feedback" >
              <label> ID. </label>         
              <input type="text" class="form-control" id="idconsultag" name="idconsultag" pattern="[0-9]{3,5}" value="44" required placeholder="ID" /> 
              <span class="glyphicon glyphicon-lock  form-control-feedback"></span> 
            </div>
          </div>
        </div>
      </div><!-- /.box -->
      <div class="row"> 
        <div class="col-sm-6">
          <input type="submit" id="login" name="login" class="btn btn-success" style="width:100%;" value="Ingresar" />
        </div>
        <div class="col-sm-6">
          <a href="<?php echo base_url();?>inicio" class="btn btn-danger" style="width:100%;">Cancelar</a>
        </div>
      </div>
    </div>  
  </div> 
</div>    
</form>

