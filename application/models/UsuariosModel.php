<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class usuariosModel extends CI_Model {
	public function __construct() {
        parent::__construct(); 
		$this->load->library('session');
    } 

    public function usuario_activo_o_inactivo(){
            $us_id_usuario = $this->session->userdata('us_id_usuario');
            $usuario       = $this->getUsuarioID($us_id_usuario);
            if($usuario->us_status ==0 ){
                echo "<script language='javascript'>top.location.href=  '".base_url()."Administrador/destroy'</script>";
            }
    }
    
	public function checkNuevoUsuariolog($usuario) {
        $this->db->where('a.us_usuario', $usuario);
        $this->db->where('a.us_status', 1);
        $this->db->join('nu_nivel_usuarios b', 'b.nu_id_nivel_usuario = a.us_id_nivel_usuario');
        $query = $this->db->get('us_usuarios a')->row();
        return $query;
    }

    public function getUsuarios($status) {
        if($status == 1){
            $this->db->where('a.us_status', 1);
        }
        if($status == 2){
            $this->db->where('a.us_status', 0);
        }
        $this->db->order_by("a.us_id_usuario", "desc");
        $this->db->join('nu_nivel_usuarios b',  'b.nu_id_nivel_usuario = a.us_id_nivel_usuario', 'left');
        $query = $this->db->get('us_usuarios a')->result();
        return $query;
    } 

    public function cambiar_status_usuario(){

        $data = array(
            'us_status' => $this->input->post('us_status')
        );

        $this->db->where('us_id_usuario', $this->input->post('us_id_usuario'));
        $this->db->update('us_usuarios',$data);
        if($this->db->affected_rows()){
            return 1;
        }
    } 

    //metodo que devuelve un usuario que coincida con la variable de correo que se recibe como parametro
    public function checkCorreo($correo) {
        $this->db->where('us_correo', $correo);
        $query = $this->db->get('us_usuarios')->row();
        return $query;
    } 

    //metodo que devuelve los datos de un usuario que coincida con la variable de usuario que se recibe como parametro 
    public function checkNuevoUsuario($usuario) {
        $this->db->where('us_usuario', $usuario);
        $query = $this->db->get('us_usuarios')->row();
        return $query;
    } 

    public function getNivelUsuario(){
        $query = $this->db->get('nu_nivel_usuarios')->result();
        return $query;
    }

    public function registrar_nuevo_usuario() {
        
        $data = array(
            
            'us_nombre'            => ucwords(strtolower(htmlentities($this->input->post('us_nombre'), ENT_QUOTES,'UTF-8'))),
            'us_apellido_materno'  => ucwords(strtolower(htmlentities($this->input->post('us_apellido_materno'), ENT_QUOTES,'UTF-8'))),
            'us_apellido_paterno'  => ucwords(strtolower(htmlentities($this->input->post('us_apellido_paterno'), ENT_QUOTES,'UTF-8'))),
            'us_correo'            => $this->input->post('us_correo'),
            'us_usuario'           => $this->input->post('us_usuario'),
            'us_contrasenia'       => $this->input->post('us_contrasenia'),
            'us_id_nivel_usuario'  => $this->input->post('us_id_nivel_usuario'),
            'us_status'            => 1
        );
        
        $this->db->insert('us_usuarios',$data);
        return $this->db->insert_id();
    }

    public function getUsuarioID($id) {

        $this->db->where('a.us_id_usuario', $id);
        $this->db->join('nu_nivel_usuarios b',  'a.us_id_nivel_usuario = b.nu_id_nivel_usuario', 'left');
        $query = $this->db->get('us_usuarios a')->row();
        return $query;

    }  

    /*verifica que el nombre de usuario no se encuentre ocupado por algun otro usuario para poder agregarselo al editar*/
    public function checkUsuarioEditar($usuario, $us_id_usuario) {
        $this->db->where('us_usuario', $usuario);
        $this->db->where('us_id_usuario !=', $us_id_usuario);
        $query = $this->db->get('us_usuarios')->row();
        return $query;
    }   
    /*verifica que el correo de usuario no se encuentre ocupado por algun otro usuario para poder agregarselo al editar*/
    public function checkCorreoEditar($correo, $us_id_usuario) {
        $this->db->where('us_correo', $correo);
        $this->db->where('us_id_usuario !=', $us_id_usuario);
        $query = $this->db->get('us_usuarios')->row();
        return $query;
    }

    public function editar_usuario($us_id_usuario){

        if( $this->input->post('us_contrasenia')!=""){
            $data = array(
                'us_contrasenia'      => $this->input->post('us_contrasenia'),
            );
            $this->db->where('us_id_usuario',$us_id_usuario);
            $this->db->update('us_usuarios',$data);     
        }

        $data = array(
            
            'us_nombre'            => ucwords(strtolower(htmlentities($this->input->post('us_nombre'), ENT_QUOTES,'UTF-8'))),
            'us_apellido_materno'  => ucwords(strtolower(htmlentities($this->input->post('us_apellido_materno'), ENT_QUOTES,'UTF-8'))),
            'us_apellido_paterno'  => ucwords(strtolower(htmlentities($this->input->post('us_apellido_paterno'), ENT_QUOTES,'UTF-8'))),
            'us_correo'            => $this->input->post('us_correo'),
            'us_usuario'           => $this->input->post('us_usuario'),
            'us_id_nivel_usuario'  => $this->input->post('us_id_nivel_usuario')
            
        );

        $this->db->where('us_id_usuario', $us_id_usuario);
        $this->db->update('us_usuarios',$data);
    }
}
?>