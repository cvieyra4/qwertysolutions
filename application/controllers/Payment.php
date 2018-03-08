<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class payment extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation', 'session', 'encrypt', 'conekta_main'));
        $this->load->helper(array('security', 'form','url'));
    }

	public function index(){
		var_dump($this->session->set_flashdata('data'));
		$this->load->view('pagina/payment');

	}

	public function create() {
    	$html = '';
        if($this->input->is_ajax_request()){
            
            //obtener datos post
            $card= $this->input->post('card');
	   		$customer_id = '';
            try {
			  $customer = Customer::create(
			    array(
			      "name" => "Fulanito Pérez",
			      "email" => "cesar.vieyra4@gmail.com",
			      "phone" => "+52181818181",
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
			          "name" => "Tacos",
			          "unit_price" => 1000,
			          "quantity" => 12
			        )//first line_item
			      ), //line_items
			      "shipping_lines" => array(
			        array(
			          "amount" => 1500,
			           "carrier" => "FEDEX"
			        )
			      ), //shipping_lines - physical goods only
			      "currency" => "MXN",
			      "customer_info" => array(
			        "customer_id" => $customer->id
			      ), //customer_info
			      "shipping_contact" => array(
			        "address" => array(
			          "street1" => "Calle 123, int 2",
			          "postal_code" => "06100",
			          "country" => "MX"
			        )//address
			      ), //shipping_contact - required only for physical goods
			      "metadata" => array("reference" => "12987324097", "more_info" => "lalalalala"),
			      "charges" => array(
			          array(
			              "payment_method" => array(
			                      "type" => "default"
			              ) //payment_method - use customer's <code>default</code> - a card
			          ) //first charge
			      ) //charges
			    )//order
			  );

			    $html .= "ID: ". $order->id;
				$html .= "Status: ". $order->payment_status;
				$html .= "$". $order->amount/100 . $order->currency;
				$html .= "Order";
				$html .= $order->line_items[0]->quantity .
				  "-". $order->line_items[0]->name .
				  "- $". $order->line_items[0]->unit_price/100;
				$html .= "Payment info";
				$html .= "CODE:". $order->charges[0]->payment_method->auth_code;
				$html .= "Card info:" .
				  "- ". $order->charges[0]->payment_method->name .
				  "- <strong><strong>". $order->charges[0]->payment_method->last4 .
				  "- ". $order->charges[0]->payment_method->brand .
				  "- ". $order->charges[0]->payment_method->type;

				 echo json_encode($html);

			} catch (ProccessingError $error){
			  echo json_encode($error->getMesage());
			} catch (ParameterValidationError $error){
			  echo json_encode($error->getMessage());
			} catch (Handler $error){
			  echo json_encode($error->getMessage());
			}
	    }
	}
}
?>