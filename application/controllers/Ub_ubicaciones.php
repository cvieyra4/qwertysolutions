<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ub_ubicaciones extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation', 'session', 'encrypt'));
        $this->load->helper(array('security', 'form','url'));
        $this->load->model('ubicacionesModel');
        $this->load->model('usuariosModel');
    }

    public function index(){
    	$this->usuariosModel->usuario_activo_o_inactivo();
    	redirect(base_url().'ub_ubicaciones/ub_listado/1');
    }

    public function ub_listado($status=1){
    	$data['status'] = $status;
    	$data['ubicaciones'] = $this->ubicacionesModel->getUbicaciones($status);
    	$this->load->view('administrador/ub_ubicaciones/ub_listado', $data);
    }

    public function cambiar_status_ubicacion(){

        $status = $this->ubicacionesModel->cambiar_status_ubicacion();
        if($status){
            echo json_encode($status);
        }
    }

    public function agregar_ubicacion(){

    	$this->load->view('administrador/ub_ubicaciones/ub_agregar');
    }

    /*metodo que valida los datos de nueva ubicación */
	public function ejecutar_registrar_nueva_ubicacion(){

		$this->usuariosModel->usuario_activo_o_inactivo();
		$this->form_validation->set_rules('ub_calle', 			'calle',  		   'required|xss_clean'); 
		$this->form_validation->set_rules('ub_numero_exterior', 'Número Exterior', 'required|numeric|xss_clean'); 
		$this->form_validation->set_rules('ub_numero_interior', 'Número Interior', 'xss_clean');
		$this->form_validation->set_rules('ub_colonia', 		'Colonia', 		   'required|xss_clean');
		$this->form_validation->set_rules('ub_codigo_postal',   'Codigo Postal',   'required|numeric|xss_clean');
			   
		if ($this->form_validation->run() == false){

			$this->load->view('administrador/ub_ubicaciones/ub_agregar');

		}else{
			$ub_id_ubicacion = $this->ubicacionesModel->registrar_nueva_ubicacion(); 
			redirect('ub_ubicaciones');
		}	 
	}

	public function editar_ubicacion($ub_id_ubicacion){
        $this->usuariosModel->usuario_activo_o_inactivo();
        $data['ubicacion']     = $this->ubicacionesModel->getUbicacionID($ub_id_ubicacion);

        $this->load->view('administrador/ub_ubicaciones/ub_editar', $data);
    }

    /*metodo que valida los datos de nueva ubicación */
	public function ejecutar_editar_ubicacion(){
		$ub_id_ubicacion = $this->input->post('id');

		$this->usuariosModel->usuario_activo_o_inactivo();
		$this->form_validation->set_rules('ub_calle', 			'calle',  		   'required|xss_clean'); 
		$this->form_validation->set_rules('ub_numero_exterior', 'Número Exterior', 'required|numeric|xss_clean'); 
		$this->form_validation->set_rules('ub_numero_interior', 'Número Interior', 'xss_clean');
		$this->form_validation->set_rules('ub_colonia', 		'Colonia', 		   'required|xss_clean');
		$this->form_validation->set_rules('ub_codigo_postal',   'Codigo Postal',   'required|numeric|xss_clean');
			   
		if ($this->form_validation->run() == false){

		$data['ubicacion']     = $this->ubicacionesModel->getUbicacionID($ub_id_ubicacion);
        $this->load->view('administrador/ub_ubicaciones/ub_editar', $data);

		}else{
			$this->ubicacionesModel->editar_ubicacion($ub_id_ubicacion); 
			redirect('ub_ubicaciones');
		}	 
	}

}
?> 