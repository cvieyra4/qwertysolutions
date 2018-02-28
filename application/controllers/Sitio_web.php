<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sitio_web extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation', 'session', 'encrypt', 'conekta'));
        $this->load->helper(array('security', 'form','url'));
        $this->load->model('clientesModel');
        $this->load->model('oficinasModel');
        $this->load->model('calendarioModel');
        $this->load->model('reservacionesModel');
        $this->load->model('ubicacionesModel');
    }

    public function index(){
    	
    	$data['ubicaciones'] = $this->ubicacionesModel->getUbicacionesEvento();
    	$this->load->view('pagina/index', $data);

    }

    public function getEspacios(){
    	$oficinas = $this->oficinasModel->getEspacios($this->input->post('re_id_ubicacion'));
    	echo json_encode($oficinas);
    }

    public function validar_usuario_ajax(){
    		$arr_errores = array(
				'error_cl_usuario'  =>  0,
				'error_cl_contrasenia' =>  0                                      
			); 

			$cl_usuario 	= $this->input->post('cl_usuario');
			$cl_contrasenia = $this->input->post('cl_contrasenia');
			$cl 	    	= $this->clientesModel->checkClientelog($cl_usuario);

			if(!isset($cl->cl_usuario)){
				$arr_errores['error_cl_usuario'] =1;
			}else{
				$arr_errores['error_cl_usuario'] =0;
			}

			if(isset($cl->cl_usuario)){
				if ($cl->cl_contrasenia == do_hash($cl_contrasenia, 'md5')) {
					$arr_errores['error_cl_contrasenia'] =0;
				}else{
					$arr_errores['error_cl_contrasenia'] =1;
				}
			}

			echo json_encode($arr_errores);
    } 

    public function login_cliente($cl_usuario){
		
		if(isset($cl_usuario)){
			$cl = $this->clientesModel->checkClientelog($cl_usuario);

			$sessionData = array(
				'cl_id_cliente'    		=> $cl->cl_id_cliente,
				'cl_usuario'       		=> $cl->cl_usuario,
				'cl_sesion_activa' 	  	=> true
			);
			$this->session->set_userdata($sessionData);
						
			redirect(base_url()); //redirecciona a la pagina de bienvenido
			
		}else{
			redirect(base_url());  //en caso de error nos redirecciona de nuevo al login
		}
    }

    public function cerrar_sesion()
    {
	   $this->session->sess_destroy();
       redirect(base_url(), 'refresh');
    }

    public function getFechasDisponibles(){
    	$data['c']  = $this->calendarioModel->getFechasDisponibles();
    	$data['r'] = $this->reservacionesModel->getFechasDisponibles();
    	echo json_encode($data);
    }

    public function agregar_reservacion(){

    	$reservacion = $this->reservacionesModel->agregar_reservacion();
    	echo json_encode($reservacion);
    }

    public function payment(){

    	//creamos un cargo
		  $charge = Conekta_Charge::create(array(
		    'description'=>'Stogies',
		    'reference_id'=>'9839-wolf_pack',
		    'amount'=>20000,
		    'currency'=>'MXN',
		    'card'=>"tok_test_visa_4242",
		    "details"=> array(
		      "email"=>"logan@x-men.org"
		    )
		  ));

		  //imprimimos el objeto charge que devuelve conekta
		  print_r($charge);

		  //para buscar un cargo existente
		  print_r(Conekta_Charge::find($charge->id));

		  //cachando errores para crear o buscar cargos
		  try{
		        print_r(Conekta_Charge::find($charge->id));
		  }catch (Conekta_Error $e){
		        echo $e->getMessage();
		  }
    }

}
?>