<?php
//Store into the constant 'IS_AJAX' whether the request was made via AJAX or not
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
defined('BASEPATH') OR exit('No direct script access allowed');

//nombre de la clase debe de ser igual que el archivo
//para que el framework lo pueda localizar
//
class panel extends CI_Controller {
	
    public function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation', 'session', 'encrypt'));
        $this->load->helper(array('security', 'form','url'));
        $this->load->model('usuariosModel');
    }
	
	//Funcion que muestra una pantalla de inicio del sistema con la plantilla de boostrap
	public function Inicio(){


		if($this->session->userdata('us_sesion_activa')== true){ //validacion de si se ha iniciado sesion o no

			$this->load->view('administrador/panel');
		}
		else{
			redirect(base_url().'Inicio'); //en caso de que no se inicie sesion se redirecciona a la pantalla de login
		}

	}
}