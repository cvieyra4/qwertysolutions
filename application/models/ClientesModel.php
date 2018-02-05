<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class clientesModel extends CI_Model {
	public function __construct() {
        parent::__construct(); 
		$this->load->library('session');
    }

    public function getClientes($status) {
		if($status==1){
            $this->db->where('a.cl_status', 1); 
        }
        if($status==2){
            $this->db->where('a.cl_status', 0); 
        }
		
		$this->db->order_by("a.cl_id_cliente", "desc");
        $query = $this->db->get('cl_clientes a')->result();
        return $query;
    }  

    public function cambiar_status_cliente(){

        $data = array(
            'cl_status' => $this->input->post('cl_status')
        );

        $this->db->where('cl_id_cliente', $this->input->post('cl_id_cliente'));
        $this->db->update('cl_clientes',$data);
        if($this->db->affected_rows()){
            return 1;
        }
    }

    //metodo que devuelve un usuario que coincida con la variable de correo que se recibe como parametro
    public function checkCorreo($correo) {
        $this->db->where('cl_correo', $correo);
        $query = $this->db->get('cl_clientes')->row();
        return $query;
    } 

    //metodo que devuelve los datos de un cliente que coincida con la variable de usuario que se recibe como parametro 
    public function checkNuevoCliente($usuario) {
        $this->db->where('cl_usuario', $usuario);
        $query = $this->db->get('cl_clientes')->row();
        return $query;
    } 

    public function registrar_nuevo_cliente() {
        
        $data = array(
            
            'cl_nombre'            => ucwords(strtolower(htmlentities($this->input->post('cl_nombre'), ENT_QUOTES,'UTF-8'))),
            'cl_apellido_materno'  => ucwords(strtolower(htmlentities($this->input->post('cl_apellido_materno'), ENT_QUOTES,'UTF-8'))),
            'cl_apellido_paterno'  => ucwords(strtolower(htmlentities($this->input->post('cl_apellido_paterno'), ENT_QUOTES,'UTF-8'))),
            'cl_correo'            => $this->input->post('cl_correo'),
            'cl_usuario'           => $this->input->post('cl_usuario'),
            'cl_contrasenia'       => $this->input->post('cl_contrasenia'),
            'cl_telefono'  		   => str_replace(' ', '',$this->input->post('cl_telefono')),
            'cl_status'            => 1
        );
        
        $this->db->insert('cl_clientes',$data);
        return $this->db->insert_id();
         
    }

    public function getClienteID($id) {

        $this->db->where('a.cl_id_cliente', $id);
        $query = $this->db->get('cl_clientes a')->row();
        return $query;

    }  

    /*verifica que el nombre de usuario no se encuentre ocupado por algun otro usuario para poder agregarselo al editar*/
    public function checkClienteEditar($usuario, $cl_id_cliente) {
        $this->db->where('cl_usuario', $usuario);
        $this->db->where('cl_id_cliente !=', $cl_id_cliente);
        $query = $this->db->get('cl_clientes')->row();
        return $query;
    }   
    /*verifica que el correo de usuario no se encuentre ocupado por algun otro usuario para poder agregarselo al editar*/
    public function checkCorreoEditar($correo, $cl_id_cliente) {
        $this->db->where('cl_correo', $correo);
        $this->db->where('cl_id_cliente !=', $cl_id_cliente);
        $query = $this->db->get('cl_clientes')->row();
        return $query;
    }

    public function editar_cliente($cl_id_cliente){

        if( $this->input->post('cl_contrasenia')!=""){
            $data = array(
                'cl_contrasenia'      => $this->input->post('cl_contrasenia'),
            );
            $this->db->where('cl_id_usuario',$cl_id_usuario);
            $this->db->update('cl_usuarios',$data);     
        }

        $data = array(
            
            'cl_nombre'            => ucwords(strtolower(htmlentities($this->input->post('cl_nombre'), ENT_QUOTES,'UTF-8'))),
            'cl_apellido_materno'  => ucwords(strtolower(htmlentities($this->input->post('cl_apellido_materno'), ENT_QUOTES,'UTF-8'))),
            'cl_apellido_paterno'  => ucwords(strtolower(htmlentities($this->input->post('cl_apellido_paterno'), ENT_QUOTES,'UTF-8'))),
            'cl_correo'            => $this->input->post('cl_correo'),
            'cl_usuario'           => $this->input->post('cl_usuario'),
            'cl_telefono'  		   => str_replace(' ', '',$this->input->post('cl_telefono'))
            
        );

        $this->db->where('cl_id_cliente', $cl_id_cliente);
        $this->db->update('cl_clientes',$data);
    }

    /* Metodo para login de clientes en el sitio web */
    public function checkClientelog($usuario) {
        $this->db->where('cl_usuario', $usuario);
        $this->db->where('cl_status', 1);
        $query = $this->db->get('cl_clientes')->row();
        return $query;
    }

}
?>