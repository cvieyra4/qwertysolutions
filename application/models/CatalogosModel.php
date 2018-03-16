<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class catalogosModel extends CI_Model {
	public function __construct() {
        parent::__construct(); 
		$this->load->library('session');
    } 

    public function getEstados(){
    	$query = $this->db->get('entidad')->result();
    	return $query;
    }

    public function getMunicipios($id){
    	$this->db->where('cve_ent', $id);
    	$query = $this->db->get('municipio')->result();
    	return $query;
    }

}
?>