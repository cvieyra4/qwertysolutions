<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class payment extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation', 'session', 'encrypt', 'conekta_main', 'PHPMailer'));
        $this->load->helper(array('security', 'form','url'));
    }

	public function index(){

		$this->load->view('pagina/payment');

	}

	public function create() {
		;
    	$html = '';
        if($this->input->is_ajax_request()){

        	$data = array
	    	(	
	    		'nombre' 		  => $this->input->post('nombre'), 
	    		'correo' 		  => $this->input->post('correo'), 
	            'telefono'          => $this->input->post('telefono'), 
	    		're_id_ubicacion' => $this->input->post('re_id_ubicacion'), 
	    		're_id_oficina' => $this->input->post('re_id_oficina'), 
	    		'fecha' => $this->input->post('fecha'), 
	    		'hora_inicio' => $this->input->post('hora_inicio'), 
	    		'hora_fin' => $this->input->post('hora_fin'), 
	    		'cliente' => $this->input->post('cliente'), 
	    		'precio' => $this->input->post('precio')
	    	);
            
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


		$enviado = 0;
		$mail = new PHPMailer();
		//Configuración
		$mail->CharSet = "UTF-8";  
		$mail->IsSMTP();   
		$mail->Host = 'mail.miaoffice.com.mx'; 
		$mail->SMTPAuth = true; 
		$mail->Username   = "notificaciones@miaoffice.com.mx";
		$mail->Password   = "Yoyofre12&";
		$mail->Port = 26; 
		$mail->From = "notificaciones@miaoffice.com.mx";   
		$mail->FromName = "MIAOffice";   
		$mail->IsHTML(true);
		$mail->Subject = "MIAOffice Nuevo Mensaje";
		$mail->addAddress("cesar.vieyra4@gmail.com");

$mensaje=<<<EOF
<!DOCTYPE html>
<html>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<head>
   <style>
   	.mensaje{
    max-width: 700px;
    border: solid 1px #544299;
    padding: 30px;	
   	}
   </style>
</head>
<body>
	
	 <div class="mensaje">
	 	 
	     <p>Atte. Equipo MIAOffice</p>
	 </div>
</body>
</html>
EOF;
	$mail->MsgHTML($mensaje);
	$mail->Send();
		if($mail->Send()){
			$enviado = 1;
		}
		return $enviado;

	}
}
?>