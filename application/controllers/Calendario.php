<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class calendario extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation', 'session', 'encrypt'));
        $this->load->helper(array('security', 'form','url'));
        $this->load->model('calendarioModel');
        $this->load->model('oficinasModel');
    }

    public function index(){
    	$data['oficinas'] = $this->oficinasModel->getOficinasEventos();
    	$this->load->view('administrador/calendario/calendario', $data);
    }

    public function getEventos(){
    	$eventos = $this->calendarioModel->getEventos();
    	echo json_encode($eventos);
    }

    public function ejecutar_registrar_evento(){

    	$this->form_validation->set_rules('ca_titulo', 'titulo', 'required|xss_clean');
    	$this->form_validation->set_rules('ca_hora_inicio', 'hora Inicio', 'required|xss_clean');
    	$this->form_validation->set_rules('ca_hora_fin', 'hora Final', 'required|xss_clean');
    	if ($this->form_validation->run() == false){
        	echo json_encode(false);
	    }else{
	    	$id_evento = $this->calendarioModel->guardar_evento();
	    	if($id_evento){
	    		echo json_encode($id_evento);
	    	}
	    }
    }

    public function getEventoId(){

    	$evento = $this->calendarioModel->getEventoId();
    	echo json_encode($evento);
    }

    public function ejecutar_editar_evento(){
    	$id_evento = $this->input->post('id_evento_editar');

    	$this->form_validation->set_rules('ca_titulo_editar', 'titulo', 'required|xss_clean');
    	$this->form_validation->set_rules('ca_id_oficina_editar', 'oficina', 'required|xss_clean');
    	$this->form_validation->set_rules('ca_hora_inicio_editar', 'hora Inicio', 'required|xss_clean');
    	$this->form_validation->set_rules('ca_hora_fin_editar', 'hora Final', 'required|xss_clean');
    	if ($this->form_validation->run() == false){
        	echo json_encode(false);
	    }else{
	    	$evento = $this->calendarioModel->editar_evento($id_evento);
	    	if($evento){
	    		echo json_encode($evento);
	    	}
	    }

    }

    public function eliminar_evento(){

    	$eliminar_evento = $this->calendarioModel->eliminar_evento();
    	if($eliminar_evento){
    		echo json_encode($eliminar_evento);
    	}
    }



}
?> 