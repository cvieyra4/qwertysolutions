<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sitio_web extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation', 'session', 'encrypt'));
        $this->load->helper(array('security', 'form','url'));
        $this->load->model('clientesModel');
        $this->load->model('oficinasModel');
        $this->load->model('calendarioModel');
        $this->load->model('reservacionesModel');
        $this->load->model('ubicacionesModel');
    }

    public function index(){
    	
    	$data['ubicaciones'] = $this->ubicacionesModel->getUbicacionesEvento();
    	$this->load->view('pagina/index', $data);

    }

    public function getEspacios(){
    	$oficinas = $this->oficinasModel->getEspacios($this->input->post('re_id_ubicacion'));
    	echo json_encode($oficinas);
    }

    public function getDireccion(){
        $direccion = $this->ubicacionesModel->getDireccion($this->input->post('re_id_ubicacion'), $this->input->post('entidad'), $this->input->post('municipio'));
        echo json_encode($direccion);
    }

    public function validar_usuario_ajax(){
    		$arr_errores = array(
				'error_cl_usuario'  =>  0,
				'error_cl_contrasenia' =>  0                                      
			); 

			$cl_usuario 	= $this->input->post('cl_usuario');
			$cl_contrasenia = $this->input->post('cl_contrasenia');
			$cl 	    	= $this->clientesModel->checkClientelog($cl_usuario);

			if(!isset($cl->cl_usuario)){
				$arr_errores['error_cl_usuario'] =1;
			}else{
				$arr_errores['error_cl_usuario'] =0;
			}

			if(isset($cl->cl_usuario)){
				if ($cl->cl_contrasenia == do_hash($cl_contrasenia, 'md5')) {
					$arr_errores['error_cl_contrasenia'] =0;
				}else{
					$arr_errores['error_cl_contrasenia'] =1;
				}
			}

			echo json_encode($arr_errores);
    } 

    public function login_cliente($cl_usuario){
		
		if(isset($cl_usuario)){
			$cl = $this->clientesModel->checkClientelog($cl_usuario);

			$sessionData = array(
				'cl_id_cliente'		=> $cl->cl_id_cliente,
				'cl_nombre'			=> $cl->cl_nombre.' '.$cl->cl_apellido_paterno.$cl->cl_apellido_materno,
				'cl_correo'			=> $cl->cl_correo,
				'cl_telefono'		=> $cl->cl_telefono,	
				'cl_usuario'       	=> $cl->cl_usuario,
				'cl_sesion_activa' 	=> true
			);
			$this->session->set_userdata($sessionData);
						
			redirect(base_url()); //redirecciona a la pagina de bienvenido
			
		}else{
			redirect(base_url());  //en caso de error nos redirecciona de nuevo al login
		}
    }

    public function cerrar_sesion()
    {
	   $this->session->sess_destroy();
       redirect(base_url(), 'refresh');
    }

    public function getFechasDisponibles(){
    	$calendario  = $this->calendarioModel->getFechasDisponibles();
    	echo json_encode($calendario);
    }
    public function getHorarios(){
        $calendario  = $this->calendarioModel->getFechasDisponibles();
        $fecha = explode('/', $this->input->post('re_fecha'));
        $re_fecha = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
        $re_id_oficina = $this->input->post('re_id_oficina');
        $re_id_ubicacion = $this->input->post('re_id_ubicacion');
        $hi = explode(":", $calendario->ca_hora_inicio);
        $hf = explode(":", $calendario->ca_hora_fin);
        $rango = $hf[0]-$hi[0];
        $dura_horas = $this->input->post('dura_horas');

        $html = '';
        for($hi[0]; $hi[0]<$hf[0]; $hi[0]+=$dura_horas){
            $horaIni = $hi[0].':'.$hi[1];
            $horaFin = $hi[0]+$dura_horas.':'.$hi[1];

            $reservaciones = $this->reservacionesModel->getReservacion($re_fecha, $horaIni, $horaFin, $re_id_oficina, $re_id_ubicacion);
            if($reservaciones == 0){
                $html .= '<option value="'.$horaIni.'-'.$horaFin.'">'.$horaIni.' - '.$horaFin.'</option>';
            }
        }
        echo json_encode($html);
    }

    public function getReservacion(){
    	$reservacion = $this->reservacionesModel->getReservacion();
    	if(isset($reservacion)){
    		echo json_encode(1);
    	}else{
    		echo json_encode(0);
    	}
    	
    }

    public function agregar_reservacion(){
    	$data = array
    	(	
    		'nombre' 		  => $this->input->post('nombre'), 
    		'correo' 		  => $this->input->post('correo'), 
            'telefono'          => $this->input->post('telefono'), 
    		're_id_ubicacion' => $this->input->post('re_id_ubicacion'), 
    		're_id_oficina' => $this->input->post('re_id_oficina'), 
    		'fecha' => $this->input->post('re_fecha'), 
    		'horario' => $this->input->post('horario'), 
    		'cliente' => $this->input->post('re_id_cliente'), 
    		'precio' => $this->input->post('re_precio')
    	);
    	$reservacion = $this->reservacionesModel->agregar_reservacion();
        if($reservacion == 1){
    	   $this->session->set_flashdata($data);
    	   redirect(base_url().'payment');
        }else{
            redirect(base_url());
        }
    }
}
?>