<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*declaracion de algunas connstantes*/
define('DS', DIRECTORY_SEPARATOR);

$rutalibreria = BASEPATH . 'libraries' . DS . 'class.phpmailer.php';
$rutalibreria2 = BASEPATH . 'libraries' . DS . 'class.smtp.php';
require_once $rutalibreria;
require_once $rutalibreria2;

class payment extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation', 'session', 'encrypt', 'conekta_main', 'PHPMailer'));
        $this->load->helper(array('security', 'form','url'));
        $this->load->model(array('ubicacionesModel', 'oficinasModel'));
    }

	public function index(){

		$this->load->view('pagina/payment');

	}

	public function create() {
		;
    	$html = '';
        if($this->input->is_ajax_request()){
            
            //obtener datos post
            $card= $this->input->post('card');
	   		$customer_id = '';
            try {
			  $customer = Customer::create(
			    array(
			      "name" =>  $this->input->post("nombre"),
			      "email" => $this->input->post("correo"),
			      "phone" => $this->input->post("telefono"),
			      "payment_sources" => array(
			        array(
			            "type" => "card",
			            "token_id" => "tok_test_visa_4242"
			        )
			      )//payment_sources
			    )//customer
			  );

			  $order = Order::create(
			    array(
			      "line_items" => array(
			        array(
			          "name" => "Reservación",
			          "unit_price" => $this->input->post("precio"),
			          "quantity" => 1
			        )//first line_item
			      ),  //shipping_lines - physical goods only
			      "currency" => "MXN",
			      "customer_info" => array(
			        "customer_id" => $customer->id
			      ), //shipping_contact - required only for physical goods
			      "charges" => array(
			          array(
			              "payment_method" => array(
			                      "type" => "default"
			              ) //payment_method - use customer's <code>default</code> - a card
			          ) //first charge
			      ) //charges
			    )//order
			  );

			$data = array
	    	(	
                'nombre'          => $this->input->post('nombre'), 
                'correo'          => $this->input->post('correo'), 
	            'telefono'        => $this->input->post('telefono'), 
                're_id_ubicacion' => $this->input->post('re_id_ubicacion'), 
                're_id_oficina'   => $this->input->post('re_id_oficina'), 
                'fecha'           => $this->input->post('fecha'), 
                'dura_horas'	  => $this->input->post('dura_horas'),
                'horario'         => $this->input->post('horario'), 
                'cliente'         => $this->input->post('cliente'), 
                'precio'          => $this->input->post('precio'),
                'order'			  => $order->id
	    	);


			  $mail = $this->sendMail($data);
			  echo json_encode($mail);

			} catch (ProccessingError $error){
			  echo json_encode($error->getMesage());
			} catch (ParameterValidationError $error){
			  echo json_encode($error->getMessage());
			} catch (Handler $error){
			  echo json_encode($error->getMessage());
			}
	    }
	}
    public function sendMail($data){
    
    $ubicacion = $this->ubicacionesModel->getUbicacionID($data['re_id_ubicacion']);
    $espacio = $this->oficinasModel->getoficinaID($data['re_id_oficina']);

    $horario = explode('-', $data['horario']);

    $enviado = 0;
	$mail = new PHPMailer();
	//Configuración
	$mail->CharSet = "UTF-8";  
	$mail->IsSMTP(true);   
	$mail->Host = 'smtpout.secureserver.net'; 
	$mail->SMTPAuth = true; 
	$mail->Username   = "notificaciones1@miaoffice.com.mx";
	$mail->Password   = "mia.2018";
	$mail->Port = 80; 
	$mail->From = "notificaciones@miaoffice.com.mx";   
	$mail->FromName = "MIAOffice";   
	$mail->IsHTML(true);
	$mail->Subject = "MIAOffice  Pago Renta de Oficinas";
	$mail->addAddress("cesar.vieyra4@gmail.com");
	$mail->addAddress("belinda_butcher@hotmail.com");

$mensaje='
        <!DOCTYPE html>
        <html>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width", initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        <style>
        .mensaje{
            max-width: 700px;
            border: solid 1px #544299;
            padding: 30px;	
        }
        </style>
        </head>
        <body>
        	<h2>Confirmación de reservación</h2>
            <div class="mensaje">
            	<h4>Nº de orden: '.$data['order'].'</h4>
            	<h4>Cliente: '.$data['nombre'].'</h4>
            	<h4>Correo: '.$data['correo'].'</h4>
            	<h4>Teléfono: '.$data['telefono'].'</h4>
            	<table id="example">
					<tbody>
						<tr>
							<td>Ubicación: </td>
							<td>'.$ubicacion->ub_nombre.'</td>
						</tr>
						<tr>
							<td>Espacio: </td>
							<td>'.$espacio->of_nombre.'</td>
						</tr>
						<tr>
							<td>Fecha: </td>
							<td>'.$data['fecha'].'</td>
						</tr>
						<tr>
							<td>Nº horas: </td>
							<td>'.$data['dura_horas'].'</td>
						</tr>
						<tr>
							<td>Total: </td>
							<td>$'.number_format($data['precio'],2,'.',',').'</td>
						</tr>
						<tr>
							<td>Hora inicio: </td>
							<td>'.$horario[0].'</td>
						</tr>
						<tr>
							<td>Hora final: </td>
							<td>'.$horario[1].'</td>
						</tr>
					</tbody>
				</table>
            </div>
        </body>
        </html>';

	$mail->MsgHTML($mensaje);
	if($mail->Send()){
		$enviado = 1;
	}else{
		$enviado = 0;
	}
	return $enviado;

	}
}
?>