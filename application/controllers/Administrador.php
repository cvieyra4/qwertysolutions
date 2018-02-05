<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation', 'session', 'encrypt'));
        $this->load->helper(array('security', 'form','url'));
        $this->load->model('usuariosModel');
    }

    public function index(){

    	$this->load->view('administrador/login');
    }


    function usr_check($usuario){	
		$us_usuario = $this->input->post('us_usuario');
		if(isset($us_usuario)){
		    $usr = $this->usuariosModel->checkNuevoUsuariolog($us_usuario);
			if ($usr != null) { 
			    return true;
			}else{    
				$this->form_validation->set_message('usr_check', 'El %s '. $usuario .' es incorrecto.');
				return false;
			}
		} 
    }
    
	function contrasenia_check($us_contrasenia){
			$us_usuario = $this->input->post('us_usuario');
			if(isset($us_usuario)){
				$us = $this->usuariosModel->checkNuevoUsuariolog($us_usuario);
				if ($us != null) { 
					if ($us->us_contrasenia == do_hash($us_contrasenia, 'md5')) { 
						return true;
					}else{  
						$this->form_validation->set_message('contrasenia_check', 'La %s es incorrecta.');
						return false;
					}
				} 
			}
    }

    public function iniciar_sesion(){
        $this->form_validation->set_rules('us_usuario', 'usuario', 'required|xss_clean|callback_usr_check');
		$this->form_validation->set_rules('us_contrasenia', 'contraseña', 'required|xss_clean|callback_contrasenia_check');
        if ($this->form_validation->run() == false){
			 $this->load->view('administrador/login'); 
		}else {
			$us_usuario = $this->input->post('us_usuario');
			if(isset($us_usuario)){
				$us = $this->usuariosModel->checkNuevoUsuariolog($us_usuario);

				$sessionData = array(
					'us_id_usuario'    		=> $us->us_id_usuario,
					'us_usuario'       		=> $us->us_usuario,
					'us_nombre'		   	  	=> $us->us_nombre,
					'us_apellido_paterno'	=> $us->us_apellido_paterno,
					'us_nivel_usuario' 		=> $us->nu_nombre,
					'us_sesion_activa' 	  	=> true
					);
				$this->session->set_userdata($sessionData);
						
				redirect(base_url().'panel/inicio'); //redirecciona a la pagina de bienvenido
			}else{
				redirect(base_url().'administrador');  //en caso de error nos redirecciona de nuevo al login
			}
		}
    }

    public function sitio_web()
    {
	   $this->session->sess_destroy();
       redirect(base_url(), 'refresh');
    }


    public function destroy()
    {
	   $this->session->sess_destroy();
       redirect(base_url().'administrador', 'refresh');
    }
}
?>