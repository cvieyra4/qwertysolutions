<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class of_oficinas extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation', 'session', 'encrypt'));
        $this->load->helper(array('security', 'form','url'));
        $this->load->model('oficinasModel');
        $this->load->model('ubicacionesModel');
        $this->load->model('usuariosModel');
    }

    public function index(){
        $this->usuariosModel->usuario_activo_o_inactivo();
        redirect(base_url().'of_oficinas/of_listado/1');
    }

    public function of_listado($status=1){
        $data['status'] = $status;
        $data['oficinas'] = $this->oficinasModel->getOficinas($status);
        $this->load->view('administrador/of_oficinas/of_listado', $data);
    }

    public function cambiar_status_oficina(){

        $status = $this->oficinasModel->cambiar_status_oficina();
        if($status){
            echo json_encode($status);
        }
    }

    public function agregar_oficina(){

        $data['ubicaciones'] = $this->ubicacionesModel->getUbicaciones(1);
        $this->load->view('administrador/of_oficinas/of_agregar', $data);
    }

    /*metodo que valida los datos de nueva ubicación */
    public function ejecutar_registrar_nueva_oficina(){

        $this->usuariosModel->usuario_activo_o_inactivo();
        $this->form_validation->set_rules('of_nombre',       'Oficina',   'required|xss_clean'); 
        $this->form_validation->set_rules('of_precio',       'Precio',    'required|numeric|xss_clean'); 
        $this->form_validation->set_rules('of_id_ubicacion', 'Ubicación', 'required|xss_clean');
               
        if ($this->form_validation->run() == false){

            $data['ubicaciones'] = $this->ubicacionesModel->getUbicaciones(1);
            $this->load->view('administrador/of_oficinas/of_agregar', $data);

        }else{

            $of_id_oficina = $this->oficinasModel->registrar_nueva_oficina(); 
            redirect('of_oficinas');
        }    
    }

    public function editar_oficina($of_id_oficina){

        $this->usuariosModel->usuario_activo_o_inactivo();
        $data['oficina']     = $this->oficinasModel->getoficinaID($of_id_oficina);
        $data['ubicaciones'] = $this->ubicacionesModel->getUbicaciones();
        $this->load->view('administrador/of_oficinas/of_editar', $data);
    }

    /*metodo que valida los datos de nueva ubicación */
    public function ejecutar_editar_oficina(){
        $of_id_oficina = $this->input->post('id');

        $this->usuariosModel->usuario_activo_o_inactivo();
        $this->form_validation->set_rules('of_nombre',       'Oficina',   'required|xss_clean'); 
        $this->form_validation->set_rules('of_precio',       'Precio',    'required|numeric|xss_clean'); 
        $this->form_validation->set_rules('of_id_ubicacion', 'Ubicación', 'required|xss_clean');
               
        if ($this->form_validation->run() == false){

        $data['oficina']     = $this->oficinasModel->getoficinaID($of_id_oficina);
        $data['ubicaciones'] = $this->ubicacionesModel->getUbicaciones(1);
        $this->load->view('administrador/of_oficinas/of_editar', $data);

        }else{
            $this->oficinasModel->editar_oficina($of_id_oficina); 
            redirect('of_oficinas');
        }    
    }

}
?> 