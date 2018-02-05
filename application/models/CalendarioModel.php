<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class calendarioModel extends CI_Model {
	public function __construct() {
        parent::__construct(); 
		$this->load->library('session');
    } 

    public function getEventos() {
        $this->db->where('ca_id_oficina', $this->input->post('ca_id_oficina'));
        $this->db->where('ca_status', 1);
        $query = $this->db->get('calendario')->result();
        return $query;
    } 

    public function guardar_evento(){
        if($this->input->post('ca_fecha_inicio')){
            $fecha = $this->input->post('ca_fecha_inicio');
            $fecha = explode("/",$fecha);
            $fecha = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
            $ca_fecha_inicio = $fecha;
        }
        if($this->input->post('ca_fecha_fin')){
            $fecha1 = $this->input->post('ca_fecha_fin');
            $fecha1 = explode("/",$fecha1);
            $fecha1 = $fecha1[2].'-'.$fecha1[1].'-'.$fecha1[0];
            $ca_fecha_fin = $fecha1;
        }

        $data = array(
            'ca_titulo'         => $this->input->post('ca_titulo'),
            'ca_fecha_inicio'   => $ca_fecha_inicio,
            'ca_fecha_fin'      => $ca_fecha_fin,
            'ca_hora_inicio'    => $this->input->post('ca_hora_inicio'),
            'ca_hora_fin'       => $this->input->post('ca_hora_fin'),
            'ca_id_oficina'     => $this->input->post('ca_id_oficina'),
            'ca_status'         => 1
        );

        $this->db->insert('calendario', $data);
        if($this->db->affected_rows()){
            return $this->db->insert_id();
        }

    }

    public function getEventoID(){
        $this->db->where('ca_status', 1);
        $this->db->where('id_evento', $this->input->post('id_evento'));
        $query = $this->db->get('calendario')->row();
        return $query;
    }

    public function editar_evento($id_evento){

        $data = array(
            'ca_titulo'         => $this->input->post('ca_titulo_editar'),
            'ca_hora_inicio' => $this->input->post('ca_hora_inicio_editar'),
            'ca_hora_fin'    => $this->input->post('ca_hora_fin_editar'),
            'ca_id_oficina'     => $this->input->post('ca_id_oficina_editar')
        );

        $this->db->where('id_evento', $id_evento);
        $this->db->update('calendario', $data);
        if($this->db->affected_rows()){
            return true;
        }else{
            return true;
        }
    }

    public function eliminar_evento(){

        $data = array(
            'ca_status' => 0
        );

        $this->db->where('id_evento', $this->input->post('id_evento'));
        $this->db->update('calendario', $data);
        if($this->db->affected_rows()){
            return true;
        }

    }

    public function getFechasDisponibles(){
        $fecha = explode('/', $this->input->post('re_fecha'));
        $re_fecha = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];


        $this->db->where('ca_id_oficina', $this->input->post('re_id_oficina'));
        $this->db->where('ca_status', 1);
        $this->db->where('ca_fecha_inicio <=', $re_fecha);
        $this->db->where('ca_fecha_fin >=', $re_fecha);
        $query = $this->db->get('calendario')->row();
        return $query;
    }

}

?>