<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class us_usuarios extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation', 'session', 'encrypt'));
        $this->load->helper(array('security', 'form','url'));
        $this->load->model('usuariosModel');
    }

    public function index(){
    	$this->usuariosModel->usuario_activo_o_inactivo();
    	redirect(base_url().'us_usuarios/us_listado/1');
    }

    public function us_listado($status=1){
        $data['status'] = $status;
    	$data['usuarios'] = $this->usuariosModel->getUsuarios($status);
    	$this->load->view('administrador/us_usuarios/us_listado', $data);
    }

    public function cambiar_status_usuario(){

        $status = $this->usuariosModel->cambiar_status_usuario();
        if($status){
        	echo json_encode($status);
        }
    }

    public function agregar_usuario(){
    	$data['nivel_usuario'] = $this->usuariosModel->getNivelUsuario();
    	$this->load->view('administrador/us_usuarios/us_agregar', $data);
    }

    function validar_usuario_ajax(){
    		$arr_errores = array(
				'error_us_correo'          =>  0,
				'error_us_usuario'   	   =>  0                                      
			); 

			//validando el numero de empleado.
    		$us_correo             = $this->input->post('us_correo'); 
    		$resultado_us_correo   = $this->usuariosModel->checkCorreo($us_correo);
			if(isset($resultado_us_correo)){
				$arr_errores['error_us_correo'] =1;
			}

    		$us_usuario             = $this->input->post('us_usuario'); 
    		$resultado_us_usuario   = $this->usuariosModel->checkNuevoUsuario($us_usuario);
			if(isset($resultado_us_usuario)){
				$arr_errores['error_us_usuario'] =1;
			}

			echo json_encode($arr_errores);
    }

     /*metodo que valida si el correo ha sido registrado anteriormente*/
	function usermail_correcto($us_correo){
			if(preg_match('/[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/', $us_correo)){
						return TRUE;
			}else{
				$this->form_validation->set_message('usermail_correcto', 'Usted debe introducir una direccion de correo correcta.');
				return FALSE;
			}
    }
    
    /*Metodo que valida si el correo ha sido registrado anteriormente*/
	function usermail_check($us_correo){
			$resultado = $this->usuariosModel->checkCorreo($us_correo);
			if(isset($resultado)){
				$this->form_validation->set_message('usermail_check', 'El %s '. $us_correo .' ya ha sido registrado.');
				return FALSE;
			}else{
				return TRUE;
			}
    }
    
    /*Metodo que valida si el nombre de usuario ha sido registrado anteriormente*/
	function username_check($us_usuario){
			$resultado = $this->usuariosModel->checkNuevoUsuario($us_usuario);
			if(isset($resultado)){
				$this->form_validation->set_message('username_check', 'El nombre de %s '. $us_usuario .' ya ha sido registrado.');
				return FALSE;
			}else{
				return TRUE;
			}
    }
    
    /*metodo que valida que la contraseña sea escrita correctamente con el nivel de seguridad solicitado*/
	function pass_check($us_contrasenia){
				if(preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#])([A-Za-z\d$@$!%*?&#]|[^ ]){6,10}$/', $us_contrasenia)){
						return TRUE;
				}
				else{
					$this->form_validation->set_message('pass_check', 'La %s debe contener 1 letra en mayúscula, 1 símbolo y 1 dígito numérico y sin espacios en una palabra de 6 a 10 letras.');
					return false;
				}     
    }

    /*metodo que valida los datos de nuevo usuario */
	public function ejecutar_registrar_nuevo_usuario(){
		$this->usuariosModel->usuario_activo_o_inactivo();
		$this->form_validation->set_rules('us_nombre', 'nombre', 'required|xss_clean'); 
		$this->form_validation->set_rules('us_apellido_paterno', 'apellido', 'required|xss_clean'); 
		$this->form_validation->set_rules('us_apellido_materno', 'apellido materno', 'xss_clean');
		$this->form_validation->set_rules('us_correo', 'correo', 'required|xss_clean|callback_usermail_correcto|callback_usermail_check');
			
		$this->form_validation->set_rules('us_usuario', 'usuario', 'required|xss_clean|callback_username_check|alpha_numeric|max_length[25]');
		$this->form_validation->set_rules('us_contrasenia', 'Contraseña', 'required|xss_clean|min_length[7]|max_length[10]|callback_pass_check|matches[us_fcontrasenia]|md5');
		$this->form_validation->set_rules('us_fcontrasenia', 'Confirmar contraseña', 'required|xss_clean');
		$this->form_validation->set_rules('us_id_nivel_usuario',      'Nivel de empleado',      'required|xss_clean'); 
			   

		if ($this->form_validation->run() == false){
			$data['nivel_usuario'] = $this->usuariosModel->getNivelUsuario();
			$this->load->view('administrador/us_usuarios/us_agregar', $data);
		}else{
			$us_id_usuario = $this->usuariosModel->registrar_nuevo_usuario(); 
			redirect('us_usuarios');
		}	 
	}

	public function editar_usuario($us_id_usuario){
        $this->usuariosModel->usuario_activo_o_inactivo();
        $data['usuario']      	  = $this->usuariosModel->getUsuarioID($us_id_usuario);
        $data['nivel_usuario'] = $this->usuariosModel->getNivelUsuario();

        $this->load->view('administrador/us_usuarios/us_editar', $data);
    }

    function validar_usuario_editar_ajax(){
            $arr_errores = array(
                'error_us_correo'          =>  0,
                'error_us_usuario'         =>  0                                      
            ); 
            $us_id_usuario = $this->input->post('id'); 

            //validando el correo
            $us_correo             = $this->input->post('us_correo'); 
            $resultado_us_correo   = $resultado = $this->usuariosModel->checkCorreoEditar($us_correo, $us_id_usuario);
            if(isset($resultado_us_correo)){
                $arr_errores['error_us_correo'] =1;
            }

            $us_usuario             = $this->input->post('us_usuario'); 
            $resultado_us_usuario   = $this->usuariosModel->checkUsuarioEditar($us_usuario, $us_id_usuario);
            if(isset($resultado_us_usuario)){
                $arr_errores['error_us_usuario'] =1;
            }

            echo json_encode($arr_errores);
    }

    /*Metodo que valida si el correo ya pertenece a otro usuario*/
    function usermail_check_edit($us_correo){
            $us_id_usuario = $this->input->post('id'); 
            $resultado = $this->usuariosModel->checkCorreoEditar($us_correo, $us_id_usuario);
            if(isset($resultado)){
                $this->form_validation->set_message('usermail_check_edit', 'El %s '. $us_correo .' ya ha sido registrado.');
                return FALSE;
            }else{
                return TRUE;
            }
    }

    /*Método que valida si el nombre de usuario ha sido registrado anteriormente*/
    function username_check_edit($us_usuario){
        
            $us_id_usuario = $this->input->post('id'); 
        
            $resultado = $this->usuariosModel->checkUsuarioEditar($us_usuario, $us_id_usuario);
            if(isset($resultado)){
                $this->form_validation->set_message('username_check_edit', 'El nombre de %s '. $us_usuario .' ya ha sido registrado.');
                return FALSE;
            }else{
                return TRUE;
            }
    }

	public function ejecuta_editar_usuario(){
	        $this->usuariosModel->usuario_activo_o_inactivo();
	        $us_id_usuario = $this->input->post('id');

	        $this->form_validation->set_rules('us_nombre', 'nombre', 'required|xss_clean'); 
			$this->form_validation->set_rules('us_apellido_paterno', 'apellido', 'required|xss_clean'); 
			$this->form_validation->set_rules('us_apellido_materno', 'apellido materno', 'xss_clean'); 
			$this->form_validation->set_rules('us_correo',           'Correo',           'required|xss_clean|callback_usermail_correcto|callback_usermail_check_edit');

	        $this->form_validation->set_rules('us_id_nivel_usuario', 'Nivel Usuario',    'required|xss_clean');
	        
	        $this->form_validation->set_rules('us_usuario',          'Usuario',          'required|xss_clean|callback_username_check_edit|alpha_numeric|max_length[25]');
	        if($this->input->post('us_contrasenia') || $this->input->post('us_fcontrasenia')){
	            $this->form_validation->set_rules('us_contrasenia',         'Contraseña',       'xss_clean|min_length[7]|max_length[10]|callback_pass_check|matches[us_fcontrasenia]|md5');
	            $this->form_validation->set_rules('us_fcontrasenia', 'Confirmar contraseña', 'xss_clean');
	        }
	        //Verifica que el formulario esté validado.
	            if ($this->form_validation->run() == false){

			        $data['usuario']      	  = $this->usuariosModel->getUsuarioID($us_id_usuario);
        			$data['nivel_usuario'] = $this->usuariosModel->getNivelUsuario();

			        $this->load->view('administrador/us_usuarios/us_editar', $data);

	            }else{
					$this->usuariosModel->editar_usuario($us_id_usuario); 
					redirect('Us_usuarios'); /*redirecciona al listado de usuarios*/
				}	
    }

}
?> 