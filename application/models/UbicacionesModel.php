<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ubicacionesModel extends CI_Model {
	public function __construct() {
        parent::__construct(); 
		$this->load->library('session');
    } 

    public function getUbicaciones($status){
        if($status == 1){
            $this->db->where('a.ub_status', 1);  
        }
        if($status == 2){
            $this->db->where('a.ub_status', 0);
        }
        
        $this->db->order_by("a.ub_id_ubicacion", "desc");
        $query = $this->db->get('ub_ubicaciones a')->result();
        return $query;
    } 

    public function cambiar_status_ubicacion(){

        $data = array(
            'ub_status' => $this->input->post('ub_status')
        );

        $this->db->where('ub_id_ubicacion', $this->input->post('ub_id_ubicacion'));
        $this->db->update('ub_ubicaciones',$data);
        if($this->db->affected_rows()){
            return 1;
        }
    } 

    public function registrar_nueva_ubicacion() {
        
        $data = array(
            'ub_nombre'          => $this->input->post('ub_nombre'),    
            'ub_calle'           => $this->input->post('ub_calle'),
            'ub_numero_exterior' => $this->input->post('ub_numero_exterior'),
            'ub_numero_interior' => $this->input->post('ub_numero_interior'),
            'ub_colonia'         => $this->input->post('ub_colonia'),
            'ub_codigo_postal'   => $this->input->post('ub_codigo_postal'),
            'ub_status'          => 1,
            'cve_ent'            => $this->input->post('cve_ent'),
            'cve_mun'            => $this->input->post('cve_mun')
        );
        
        $this->db->insert('ub_ubicaciones',$data);
        return $this->db->insert_id();
    }

    public function getUbicacionID($id) {

        $this->db->where('a.ub_id_ubicacion', $id);
        $query = $this->db->get('ub_ubicaciones a')->row();
        return $query;

    }  

    public function editar_ubicacion($ub_id_ubicacion) {
        
        $data = array(
            'ub_nombre'          => $this->input->post('ub_nombre'),
            'ub_calle'           => $this->input->post('ub_calle'),
            'ub_numero_exterior' => $this->input->post('ub_numero_exterior'),
            'ub_numero_interior' => $this->input->post('ub_numero_interior'),
            'ub_colonia'         => $this->input->post('ub_colonia'),
            'ub_codigo_postal'   => $this->input->post('ub_codigo_postal'),
            'cve_ent'            => $this->input->post('cve_ent'),
            'cve_mun'            => $this->input->post('cve_mun')
        );
        
        $this->db->where('ub_id_ubicacion', $ub_id_ubicacion);
        $this->db->update('ub_ubicaciones',$data);
    }

    public function getUbicacionesEvento(){
        $this->db->where('ub_status', 1);  
        $this->db->order_by("ub_id_ubicacion", "desc");
        $query = $this->db->get('ub_ubicaciones')->result();
        return $query;
    } 

    public function getDireccion($id, $ent, $mun){
        $this->db->where('a.ub_id_ubicacion', $id);
        $this->db->where('c.cve_ent', $ent);
        $this->db->where('c.cve_mun', $mun);
        $this->db->join('entidad b', 'a.cve_ent = b.cve_ent', 'left');
        $this->db->join('municipio c', 'a.cve_mun = c.cve_mun', 'left');
        $query = $this->db->get('ub_ubicaciones a')->row();
        return $query;
    }  

}

?>