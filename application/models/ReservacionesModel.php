<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class reservacionesModel extends CI_Model {
	public function __construct() {
        parent::__construct(); 
		$this->load->library('session');
    }

    public function getFechasDisponibles(){
    	$fecha = explode('/', $this->input->post('re_fecha'));
        $re_fecha = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];

    	$this->db->where('re_id_oficina', $this->input->post('re_id_oficina'));
    	$this->db->where('re_fecha', $re_fecha);
    	$query = $this->db->get('reservaciones')->result();
    	return $query;
    } 

    public function agregar_reservacion(){
    	$fecha = explode('/', $this->input->post('re_fecha'));
    	$re_fecha = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];

    	$data = array(
    		're_fecha' 		 => $re_fecha,
    		're_hora_inicio' => $this->input->post('re_hora_inicio'),
    		're_hora_fin'	 => $this->input->post('re_hora_fin'),
    		're_id_cliente'  => $this->input->post('re_id_cliente'),
    		're_id_oficina'  => $this->input->post('re_id_oficina'),
    		're_id_espacio'  => 0,
    		're_precio'		 => $this->input->post('re_precio')
    	);

    	$this->db->insert('reservaciones', $data);
    	if($this->db->affected_rows()){
    		return 1;
    	}else{
    		return 0;
    	}

    }

}
?> 