<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class oficinasModel extends CI_Model {
    public function __construct() {
        parent::__construct(); 
        $this->load->library('session');
    } 

    public function getOficinas($status) {
        if($status==1){
            $this->db->where('a.of_status', 1);
        }
        if($status==2){
            $this->db->where('a.of_status', 0);
        }
        $this->db->order_by("a.of_id_oficina", "desc");
        $this->db->join('ub_ubicaciones b', 'b.ub_id_ubicacion = a.of_id_ubicacion', 'left');
        $query = $this->db->get('of_oficinas a')->result();
        return $query;
    } 

    public function cambiar_status_oficina(){

        $data = array(
            'of_status' => $this->input->post('of_status')
        );

        $this->db->where('of_id_oficina', $this->input->post('of_id_oficina'));
        $this->db->update('of_oficinas',$data);
        if($this->db->affected_rows()){
            return 1;
        }
    } 

    public function registrar_nueva_oficina() {
        
        $data = array(
            
            'of_nombre'       => $this->input->post('of_nombre'),
            'of_precio'       => $this->input->post('of_precio'),
            'of_id_ubicacion' => $this->input->post('of_id_ubicacion'),
            'of_status'       => 1
        );
        
        $this->db->insert('of_oficinas',$data);
        return $this->db->insert_id();
    }

    public function getoficinaID($id) {

        $this->db->where('a.of_id_oficina', $id);
        $query = $this->db->get('of_oficinas a')->row();
        return $query;

    }  

    public function editar_oficina($of_id_oficina) {
        
        $data = array(
            
            'of_nombre'       => $this->input->post('of_nombre'),
            'of_precio'       => $this->input->post('of_precio'),
            'of_id_ubicacion' => $this->input->post('of_id_ubicacion')
        );
        
        $this->db->where('of_id_oficina', $of_id_oficina);
        $this->db->update('of_oficinas',$data);
    }

    public function getOficinasEventos(){
        $this->db->where('of_status', 1);
        $this->db->order_by("of_nombre", "asc");
        $query = $this->db->get('of_oficinas')->result();
        return $query;
    }   

}

?>