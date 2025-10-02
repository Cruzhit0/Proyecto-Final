<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Usuarios extends CI_controller
{
	public function construct(){
		parent::construct();
	} 

	public function index(){
		$data = array();
		$this->load->model('usuario_model');
		$this->load->view('usuarios/iniciar_sesion');
	}




	public function iniciar_sesion_post_postulante(){
		if($this->input->post())
		{
			$nombre=$this->input->post('email');
			$contrasena=$this->input->post('contrasena');
			$this->load->model('usuario_model');
			$this->load->model('modelPostulante');
			$this->load->model('modelConsultag');
			$usuario=$this->usuario_model->usuario_por_nombre_contrasena($nombre,$contrasena);
			$vnropostulantes=$this->modelPostulante->contarpostulantes();
			$vnroconsultas=$this->modelConsultag->contarpendientes();
			$vnroagendados=$this->modelConsultag->contaragendados();
			
			$vcontarconsultas=11;
			
			if($usuario){
				//Si usuario es correcto, se crea la sesion con id y nombre
				$usuario_data=array(
					'iduser'=>$usuario->iduser,
					'nombre'=>$usuario->nombre,
					'logueado'=>TRUE,
					'vpostulantes'=>$vnropostulantes,
					'vconsultasg'=>$vnroconsultas,
					'vconsultase'=>5,
					'vcontarconsultas'=>$vcontarconsultas,
					'vcontaragendados'=>$vnroagendados,
					'vencimiento'=>$date('Y-m-d')
				);
				$this->session->set_userdata($usuario_data);
				redirect('usuarios/logueado');						
			}
			else{
				$this->session->set_flashdata('error', 'Su e-mail o su contraseña no son válidos!!!');
				redirect('usuarios/iniciar_sesion_postulante');					
			}
		}
		else{

			$this->iniciar_sesion();			   
		}
	}




	public function logueado(){
		if($this->session->userdata('logueado')){

			//$data=array();
			$data_s['iduser']=$this->session->userdata('iduser');
			$data_s['nombre']=$this->session->userdata('nombre');
			$data_s['tipo']=$this->session->userdata('tipo');
			$data_s['idp']=$this->session->userdata('idp');
			$data_s['logueado']=$this->session->userdata('logueado');
			$data_s['tipo']=$this->session->userdata('tipo');

			$data_s['vpostulantes']=$this->session->userdata('vpostulantes');
			$data_s['vconsultasg']=$this->session->userdata('vconsultasg');
			$data_s['vagendados']=$this->session->userdata('vagendados');
			$data_s['vconsultase']=$this->session->userdata('vconsultase');
			$data_s['vcontarclientesejecutivospendientes']=$this->session->userdata('vcontarclientesejecutivospendientes');
			$data_s['vcontarconsultas']=$this->session->userdata('vcontarconsultas');
			$data_s['vnroejecutivos']=$this->session->userdata('vnroejecutivos');

			$this->load->model('ModelConsultag');
			$data_s['vcontarconsultas']=$this->ModelConsultag->contarconsultas();
			$data_s['vcontaragendados']=$this->ModelConsultag->contaragendados();
			$data_s['vcontarejecutivos']=$this->ModelConsultag->contarclientesejecutivos();
			$data_s['vcontarconcluidos']=$this->ModelConsultag->contarclientesconcluidos();

			// se realiza la consulta en la bd de cantidad de consultas ejecutivas por mes  y tambien de la anterior gestiom
			$data_s['consultasgpormes']=$this->ModelConsultag->consultasgpormes();
			$data_s['ejecutivospormes']=$this->ModelConsultag->ejecutivospormes();
			$data_s['ejecutivospormesgestant']=$this->ModelConsultag->ejecutivospormesgestant();


			$vencimiento=$this->session->userdata('vencimiento');
			$vencimientoyear=substr($vencimiento,0,4);
			$vencimientomonth=substr($vencimiento,5,2);
			//se asigna busqueda de TODOS los departamentos.
			$sucursal='TODOS';
			$data_s['pagospormes']=$this->ModelConsultag->pagospormes();
			$data_s['cobrarpormes']=$this->ModelConsultag->cobrarpormes($sucursal, $vencimientoyear, $vencimientomonth);

			//establece los clientes ejecutivos con finalizacion NORMAL, PERDIDA, DESISTIO
			$data_s['ejec_en_proceso']=$this->ModelConsultag->ejecutivos_en_actual_proceso();
			$data_s['ejec_normal']=$this->ModelConsultag->ejecutivos_normal();
			$data_s['ejec_perdida']=$this->ModelConsultag->ejecutivos_perdida();
			$data_s['ejec_desistio']=$this->ModelConsultag->ejecutivos_desistio();

			
			//buscamos la foto segun su idp
			$idp=$this->session->userdata('idp');
			$this->load->model('ModelSupervisor');
			$data_s['vfoto']=$this->ModelSupervisor->buscarfoto($idp);
			
			$this->load->view('pages/librerias');
			$this->load->view('pages/cabecera',$data_s);
			//recupero el vencimiento si existe
			//$vencimiento = $this->input->post('vencimiento');

			$vencimiento = $this->input->post('vencimiento');//numero de consulta del cliente
			if($vencimiento != NULL){
				$vencimiento = $this->input->post('vencimiento');
				//$data_s['vencimiento']=$vencimiento;
				$this->session->set_userdata('vencimiento', $vencimiento);
				//$data_s['cobrarpormes']='';
				//$data_s['cobrarpormes']=$this->ModelConsultag->cobrarpormes($vencimiento );
			}else{
				//$data_s['cobrarpormes']=$this->ModelConsultag->pagospormes();
				//$data_s['vencimiento']='';
			}


			//para ver las estadisticas y todo administrador, se carga por defecto
			switch ($data_s['tipo']) {
				case '1':
				// es el menu de superadministrador ea y yo
				$this->load->view('contenidoppal');
				$this->load->view('pages/menuizq',$data_s);
				break;
				case '2':
				//  ES EL MENU DE MERYLUZ. NOTICIAS PUBLICACIONES , VER CONSULTAS Y AGENDAR.
				$this->load->view('contenidoppal');
				$this->load->view('pages/menuejecutivos',$data_s);
				break;
				case '3':
				$this->load->view('contenidoppal');
				//$this->load->view('pages/menu3',$data_s);
				$this->load->view('pages/menumarketing',$data_s);
				break;
				case '4':
				$this->load->view('contenidoppal');
				$this->load->view('pages/menuadministrador',$data_s);
				break;
				case '5':
				// es el menu de administrador por sucursal, HABILITADO PARA ISABEL, SANDRA, DANA
				$this->load->view('contenidoppal');
				$this->load->view('pages/menucg',$data_s);
				break;
				case '6':
				// es el de abogado. muestra solo sus casos
				$this->load->view('contenidoppal');
				$this->load->view('pages/menu3',$data_s);
				break;
			}

			$this->load->view('pages/pie');
			$this->load->view('pages/menuder');
			$this->load->view('pages/scripts');

		}else{
			redirect('usuarios/iniciar_sesion');
		}
	}

	public function cerrar_sesion(){
		$usuario_data=array('logueado'=>FALSE);
		$this->session->set_userdata($usuario_data);
		//redirect('usuarios/iniciar_sesion');
		redirect('inicio');

	}

	public function iniciar_sesion_postulante(){
		$data = array();
		$data['error'] = $this->session->flashdata('error');
		$this->load->view('estructura/cabecera');
		$this->load->view('estructura/menu_postulante');
		$this->load->view('usuarios/iniciar_sesion_postulante',$data);
		$this->load->view('estructura/pie');
		$this->load->view('estructura/scripts');

	}


	public function iniciar_sesion_ex(){
		$data = array();
		$this->session->set_flashdata('message', 'Ingrese datos de manera adecuada.');
		$data['error'] = $this->session->flashdata('message');
		$this->load->view('estructura/cabecera');
		$this->load->view('estructura/menu');
		$this->load->view('usuarios/iniciar_sesion_ex',$data);
		$this->load->view('estructura/pie');
		$this->load->view('estructura/scripts');
	}
	

	public function verifica_iniciar_sesion_ex(){
		
		// Validar reCAPTCHA
		//$recaptchaResponse = $this->input->post('g-recaptcha-response');
        //$recaptchaSecretKey = '6LfG-3IoAAAAAA7q-YPc3LHq9dTGJjem42wCbUfI'; // Reemplaza con tu clave secreta

        //$url = 'https://www.google.com/recaptcha/api/siteverify';
        //$data = array(
        //	'secret' => $recaptchaSecretKey,
        //	'response' => $recaptchaResponse
        //);

       // $options = array(
       // 	'http' => array(
       // 		'method' => 'POST',
       // 		'content' => http_build_query($data)
       // 	)
       // );

        //$context = stream_context_create($options);
        //$verify = file_get_contents($url, false, $context);
        //$captcha_success = json_decode($verify);

        //if ($captcha_success->success) {
            // El reCAPTCHA se ha verificado correctamente, aquí puedes agregar la lógica de autenticación
        	//$fnac=$this->input->post('fnac');
		$cedula=$this->input->post('cedula');
		$idconsultag=$this->input->post('idconsultag');
        	//$iduser=$this->usuario_model->usuario_por_cedula_idconsultag($cedula, $idconsultag);
		$iduser=1581;
            // Verificar las credenciales del usuario (sustituye esto con tu lógica de autenticación)
		if ($cedula === '333' && $idconsultag === '443') {
                // Inicia sesión o redirige al usuario a donde desees
			$this->load->model('ModelConsultag');
			$parametro = array (
				"id" => $iduser
			);
				//datos del proceso
			$data["proceso"] = $this->ModelConsultag->editar($parametro);
			$data["consultagreg"] = $this->ModelConsultag->editar($parametro);
				//listado de documentos digitales del proceso
			$parametro = array (
				"idp" => $iduser
			);
			$data["docsdigitales"] = $this->ModelConsultag->listadocsdigitales($parametro);
        		//echo "Inicio de sesión exitoso. Listado de expediente digital";

        		//ahora recuperamos los datos de agendacierre  - cierre del caso
			$parametroagenda = array (
				"idconsultag" => $iduser
			);
        		//ahora recuperamos los datos de agendacierre  - cierre del caso
        		$data["cierre"] =  $this->ModelConsultag->listaagendacierre($parametroagenda);//saca datos de agendacierre - cierre
				// obtenemos los pagos del cliente
        		$data["pagosregs"] =  $this->ModelConsultag->listapagos($parametroagenda);

        		$this->load->view('pages/librerias');
        		$this->load->view('estructura/cabecera');
        		$this->load->view('estructura/menu_user');
        		$this->load->view('formupdatedocsmas_cli',$data);
        		//$this->load->view('pages/pie');
        		$this->load->view('pages/scripts');

        		/*
        		$this->load->view('estructura/cabecera');
        		$this->load->view('estructura/menu_user');
        		$this->load->view('formupdatedocsmas_cli',$data);
        		$this->load->view('estructura/pie');
        		$this->load->view('estructura/scripts');
        		*/

        	} else {
        		//echo "Credenciales incorrectas.";
        		$data = array();
        		$this->session->set_flashdata('messageerror', 'Credenciales incorrectas.');
        		$data['error'] = $this->session->flashdata('messageerror');
        		$this->load->view('estructura/cabecera');
        		$this->load->view('estructura/menu');
        		$this->load->view('usuarios/iniciar_sesion_ex',$data);
        		$this->load->view('estructura/pie');
        		$this->load->view('estructura/scripts');
        	}
        /*
        } else {
        	//echo "Seleccione cuadro No soy un robot. Captcha no válido. Inténtalo de nuevo.";
        	$data = array();
        	$this->session->set_flashdata('messageerror', 'Seleccione cuadro No soy un robot. Inténtalo de nuevo.');
        	$data['error'] = $this->session->flashdata('messageerror');
        	$this->load->view('estructura/cabecera');
        	$this->load->view('estructura/menu');
        	$this->load->view('usuarios/iniciar_sesion_ex',$data);
        	$this->load->view('estructura/pie');
        	$this->load->view('estructura/scripts');
        }
        */

    }


    public function cambiapassword($iduser){
    	$data = array();
    	$data['error'] = $this->session->flashdata('error');
    	$data['iduser'] = $iduser;

    	$this->load->view('estructura/cabecera');
    	$this->load->view('estructura/menu');
    	$this->load->view('usuarios/cambiapassword',$data);
    	$this->load->view('estructura/pie');
    	$this->load->view('estructura/scripts');
    }
    public function guardarpassword(){

    	$salt = 'Juan%Raul&Churqui';

    	$p1 = $this->input->post('pass1');
    	$p1_hash = hash('sha256', $salt . hash('sha256', $p1 . $salt));

    	$p2 = $this->input->post('pass2');
    	$p2_hash = hash('sha256', $salt . hash('sha256', $p2 . $salt));

    	$parametros = array (
    		"contrasena" => $p1_hash,
    		"estado" => 'ANTIGUO'
    	);
    	$iduser = $this->input->post('iduser');

    	if (strcmp($p1_hash,$p2_hash)==0){
    		$this->load->model('Usuario_model');
    		$idEdit = $this->Usuario_model->actualizar($parametros, $iduser); 
    		$this->session->set_flashdata('error', 'CORRECTO.       Ahora inicie sesión con su nueva contraseña.  !');
    		redirect('usuarios/iniciar_sesion_post/'.$iduser);
    		die(1);
    	}else{
    		$this->session->set_flashdata('error', 'Las contraseñas no coinciden. intente nuevamente!');
    		redirect('usuarios/cambiapassword/'.$iduser);
    		die(1);
    	}
    }


    public function iniciar_sesion(){
    	
    	$data = array();
    	$data['error'] = $this->session->flashdata('error');
    	$this->load->view('estructura/cabecera');
    	
    	$this->load->view('estructura/menu');
    	$this->load->view('usuarios/iniciar_sesion',$data);
    	$this->load->view('estructura/pie');
    	$this->load->view('estructura/scripts');
    }

    public function iniciar_sesion_post(){
    	
    	if($this->input->post())
    	{
    		$this->load->model('usuario_model');
    		$this->load->model('modelPostulante');
    		$this->load->model('modelConsultag');
    		$this->load->model('modelSupervisor');

    		$nombre=$this->input->post('nombre');
    		$contrasena=$this->input->post('contrasena');

			//$password = 'stc2021';
    		$salt = 'Juan%Raul&Churqui';
    		$password_hash = hash('sha256', $salt . hash('sha256', $contrasena . $salt));

    		$usuario=$this->usuario_model->usuario_por_nombre_contrasena($nombre,$password_hash);
    		if($usuario){
			$estado=$usuario->estado;//tipo de usuario NUEVO O ANTIGUO
			if (strcmp($estado,'NUEVO') == 0) { 
				$this->session->set_flashdata('error', 'Por seguridad del sistema, usted debe cambiar su contraseña de acceso!');
				redirect('usuarios/cambiapassword/'.$usuario->iduser);
				die(1); 
			}
		}

		if($usuario){
				//Si usuario es correcto, se actualizan cuentas y se crea la sesion con datos en usuario_data
			$vnropostulantes=$this->modelPostulante->contarpostulantes();
				//$vnroconsultas=$this->modelConsultag->contarpendientes();
				//$vcontarconsultas=$this->modelConsultag->contarconsultas();
			$vnroejecutivos=$this->modelSupervisor->contarejecutivos();
			$vcontarconsultas=$this->modelConsultag->contarconsultas();
			$vnroconsultas=$this->modelConsultag->contarpendientes();
			$vnroagendados=$this->modelConsultag->contaragendados();
			$vcontarclientesejecutivos=$this->modelConsultag->contarclientesejecutivos();
			$vcontarclientesejecutivospendientes=$this->modelConsultag->contarclientesejecutivospendientes();
			$usuario_data=array(
				'iduser'=>$usuario->idp,
				'nombre'=>$usuario->nombre,
				'tipo'=>$usuario->tipo,
				'idp'=>$usuario->idp,
				'logueado'=>TRUE,
				'vpostulantes'=>$vnropostulantes,
				'vconsultasg'=>$vnroconsultas,
				'vagendados'=>$vnroagendados,
				'vconsultase'=>$vcontarclientesejecutivos,
				'vcontarclientesejecutivospendientes'=>$vcontarclientesejecutivospendientes,
				'vcontarconsultas'=>$vcontarconsultas,
				'vnroejecutivos'=>$vnroejecutivos,
				'vencimiento'=>date("Y-m-d")
			);

			
			$this->session->set_userdata($usuario_data);
			redirect('usuarios/logueado');						
		}
		else{
			$this->session->set_flashdata('error', 'El usuario o la contraseña son incorrectos.');
			redirect('usuarios/iniciar_sesion');					
		}
	}
	else{

		$this->iniciar_sesion();			   
	}
}

}

?>