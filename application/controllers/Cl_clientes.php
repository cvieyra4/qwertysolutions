<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cl_clientes extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation', 'session', 'encrypt'));
        $this->load->helper(array('security', 'form','url'));
        $this->load->model('clientesModel');
        $this->load->model('usuariosModel');
    }

    public function index(){

    	$this->usuariosModel->usuario_activo_o_inactivo();
    	redirect(base_url().'cl_clientes/cl_listado/1');
    }

    public function cl_listado($status=1){
        $data['status'] = $status;
    	$data['clientes'] = $this->clientesModel->getClientes($status);
    	$this->load->view('administrador/cl_clientes/cl_listado', $data);

    }

    public function cambiar_status_cliente(){

        $status = $this->clientesModel->cambiar_status_cliente();
        if($status){
        	echo json_encode($status);
        }
    }

    public function agregar_cliente(){
    	$this->usuariosModel->usuario_activo_o_inactivo();
    	$this->load->view('administrador/cl_clientes/cl_agregar');
    }

    public function validar_cliente_ajax(){
    		$arr_errores = array(
				'error_cl_correo'          =>  0,
				'error_cl_usuario'   	   =>  0                                      
			); 

			//validando el numero de empleado.
    		$cl_correo             = $this->input->post('cl_correo'); 
    		$resultado_cl_correo   = $this->clientesModel->checkCorreo($cl_correo);
			if(isset($resultado_cl_correo)){
				$arr_errores['error_cl_correo'] =1;
			}

    		$cl_usuario             = $this->input->post('cl_usuario'); 
    		$resultado_cl_usuario   = $this->clientesModel->checkNuevoCliente($cl_usuario);
			if(isset($resultado_cl_usuario)){
				$arr_errores['error_cl_usuario'] =1;
			}

			echo json_encode($arr_errores);
    }

     /*metodo que valida si el correo ha sido registrado anteriormente*/
	public function usermail_correcto($cl_correo){
			if(preg_match('/[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/', $cl_correo)){
						return TRUE;
			}else{
				$this->form_validation->set_message('usermail_correcto', 'Usted debe introducir una direccion de correo correcta.');
				return FALSE;
			}
    }
    
    /*Metodo que valida si el correo ha sido registrado anteriormente*/
	public function usermail_check($cl_correo){
			$resultado = $this->clientesModel->checkCorreo($cl_correo);
			if(isset($resultado)){
				$this->form_validation->set_message('usermail_check', 'El %s '. $cl_correo .' ya ha sido registrado.');
				return FALSE;
			}else{
				return TRUE;
			}
    }
    
    /*Metodo que valida si el nombre de cliente ha sido registrado anteriormente*/
	public function username_check($cl_usuario){
			$resultado = $this->clientesModel->checkNuevoCliente($cl_usuario);
			if(isset($resultado)){
				$this->form_validation->set_message('username_check', 'El nombre de %s '. $cl_usuario .' ya ha sido registrado.');
				return FALSE;
			}else{
				return TRUE;
			}
    }

    /*metodo que valida que la contraseña sea escrita correctamente con el nivel de seguridad solicitado*/
	function pass_check($cl_contrasenia){
				if(preg_match('/^[A-Z]{1}[a-z0-9]{8}[&$#_?¡()=]{1}$/', $cl_contrasenia)){
						return TRUE;
				}
				else{
					$this->form_validation->set_message('pass_check', 'La %s debe contener la primera letra mayuscula, el ultimo caracter debe ser caracter y deben ser 10 digitos.');
					return false;
				}     
    }

    /*metodo que valida los datos de nuevo cliente */
	public function ejecutar_registrar_nuevo_cliente(){
		$this->usuariosModel->usuario_activo_o_inactivo();
		$this->form_validation->set_rules('cl_nombre', 'nombre', 'required|xss_clean'); 
		$this->form_validation->set_rules('cl_apellido_paterno', 'apellido', 'required|xss_clean'); 
		$this->form_validation->set_rules('cl_apellido_materno', 'apellido materno', 'xss_clean');
		$this->form_validation->set_rules('cl_correo', 'correo', 'required|xss_clean|callback_usermail_correcto|callback_usermail_check');
			
		$this->form_validation->set_rules('cl_usuario', 'usuario', 'required|xss_clean|callback_username_check|alpha_numeric|max_length[25]');
		$this->form_validation->set_rules('cl_contrasenia', 'Contraseña', 'required|xss_clean|min_length[7]|max_length[10]|callback_pass_check|matches[cl_fcontrasenia]|md5');
		$this->form_validation->set_rules('cl_fcontrasenia', 'Confirmar contraseña', 'required|xss_clean');
		$this->form_validation->set_rules('cl_telefono',      'telefono de empleado',      'xss_clean'); 
			   

		if ($this->form_validation->run() == false){
			$this->load->view('administrador/cl_clientes/cl_agregar');
		}else{
			$cl_id_cliente = $this->clientesModel->registrar_nuevo_cliente(); 
			redirect('cl_clientes');
		}	 
	}

	public function editar_cliente($cl_id_cliente){
        $this->usuariosModel->usuario_activo_o_inactivo();
        $data['cliente']      	  = $this->clientesModel->getClienteID($cl_id_cliente);

        $this->load->view('administrador/cl_clientes/cl_editar', $data);
    }

    function validar_cliente_editar_ajax(){
            $arr_errores = array(
                'error_cl_correo'          =>  0,
                'error_cl_usuario'         =>  0                                      
            ); 
            $cl_id_cliente = $this->input->post('id'); 

            //validando el correo
            $cl_correo             = $this->input->post('cl_correo'); 
            $resultado_cl_correo   = $resultado = $this->usuariosModel->checkCorreoEditar($cl_correo, $cl_id_cliente);
            if(isset($resultado_cl_correo)){
                $arr_errores['error_cl_correo'] =1;
            }

            $cl_usuario             = $this->input->post('cl_usuario'); 
            $resultado_cl_usuario   = $this->usuariosModel->checkUsuarioEditar($cl_usuario, $cl_id_cliente);
            if(isset($resultado_cl_usuario)){
                $arr_errores['error_cl_usuario'] =1;
            }

            echo json_encode($arr_errores);
    }

    /*Metodo que valida si el correo ya pertenece a otro usuario*/
    function usermail_check_edit($cl_correo){
            $cl_id_usuario = $this->input->post('id'); 
            $resultado = $this->clientesModel->checkCorreoEditar($cl_correo, $cl_id_usuario);
            if(isset($resultado)){
                $this->form_validation->set_message('usermail_check_edit', 'El %s '. $cl_correo .' ya ha sido registrado.');
                return FALSE;
            }else{
                return TRUE;
            }
    }

    /*Método que valida si el nombre de usuario ha sido registrado anteriormente*/
    function username_check_edit($cl_usuario){
        
            $cl_id_usuario = $this->input->post('id'); 
        
            $resultado = $this->clientesModel->checkClienteEditar($cl_usuario, $cl_id_usuario);
            if(isset($resultado)){
                $this->form_validation->set_message('username_check_edit', 'El nombre de %s '. $cl_usuario .' ya ha sido registrado.');
                return FALSE;
            }else{
                return TRUE;
            }
    }

    public function ejecutar_editar_cliente(){
	        $this->usuariosModel->usuario_activo_o_inactivo();
	        $cl_id_cliente = $this->input->post('id');

	        $this->form_validation->set_rules('cl_nombre', 'nombre', 'required|xss_clean'); 
			$this->form_validation->set_rules('cl_apellido_paterno', 'apellido', 'required|xss_clean'); 
			$this->form_validation->set_rules('cl_apellido_materno', 'apellido materno', 'xss_clean'); 
			$this->form_validation->set_rules('cl_correo',           'Correo',           'required|xss_clean|callback_usermail_correcto|callback_usermail_check_edit');

	        $this->form_validation->set_rules('cl_telefono', 'Nivel Usuario',    'required|xss_clean');
	        
	        $this->form_validation->set_rules('cl_usuario',          'Usuario',          'required|xss_clean|callback_username_check_edit|alpha_numeric|max_length[25]');
	        if($this->input->post('cl_contrasenia') || $this->input->post('cl_fcontrasenia')){
	            $this->form_validation->set_rules('cl_contrasenia',         'Contraseña',       'xss_clean|min_length[7]|max_length[10]|callback_pass_check|matches[us_fcontrasenia]|md5');
	            $this->form_validation->set_rules('cl_fcontrasenia', 'Confirmar contraseña', 'xss_clean');
	        }
	        //Verifica que el formulario esté validado.
	            if ($this->form_validation->run() == false){

			        $data['cliente']      	  = $this->clientesModel->getClienteID($cl_id_cliente);

        			$this->load->view('administrador/cl_clientes/cl_editar', $data);

	            }else{
					$this->clientesModel->editar_cliente($cl_id_cliente); 
					redirect('cl_clientes'); /*redirecciona al listado de usuarios*/
				}	
    }

}
?> 