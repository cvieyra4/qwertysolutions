<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sitio_web extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation', 'session', 'encrypt'));
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
				'cl_id_cliente'		=> $cl->cl_id_cliente,
				'cl_nombre'			=> $cl->cl_nombre.$cl->cl_apellido_paterno.$cl->cl_apellido_materno,
				'cl_correo'			=> $cl->cl_correo,
				'cl_telefono'		=> $cl->cl_telefono,	
				'cl_usuario'       	=> $cl->cl_usuario,
				'cl_sesion_activa' 	=> true
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
    	$calendario  = $this->calendarioModel->getFechasDisponibles();
    	echo json_encode($calendario);
    }

    public function getReservacion(){
    	$reservacion = $this->reservacionesModel->getReservacion();
    	if(isset($reservacion)){
    		echo json_encode(1);
    	}else{
    		echo json_encode(0);
    	}
    	
    }

    public function agregar_reservacion(){
    	$data = array
    	(	
    		'nombre' 		  => $this->input->post('nombre_invitado'), 
    		'correo' 		  => $this->input->post('correo_invitado'), 
    		're_id_ubicacion' => $this->input->post('re_id_ubicacion'), 
    		're_id_oficina' => $this->input->post('re_id_oficina'), 
    		're_fecha' => $this->input->post('re_fecha'), 
    		're_hora_inicio' => $this->input->post('re_hora_inicio'), 
    		're_hora_fin' => $this->input->post('re_hora_fin'), 
    		're_id_cliente' => $this->input->post('re_id_cliente'), 
    		're_precio' => $this->input->post('re_precio'), 

    	);
    	$reservacion = $this->reservacionesModel->agregar_reservacion();
    	$this->session->set_flashdata($data);
    	redirect(base_url().'payment');
    }
}
?>