<?php

/*
	Orders Controller.
	Orders related functions implemented here.
*/


session_start();

class Orders extends CI_Controller {
	
	function checkout() {
		if (!$this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		$this->load->helper('checkuser');
		$data = checkUser($this);
		$data['title'] = "Shopping Cart";
		$data['description'] = "";
		$data['contents'] = 'shoppingcart/shoppingcart.php';
		$data['taskbarLinkId'] = 'shoppingcart';
		
		$this->load->helper('email');
		$this->load->model('order_model');
		$this->load->library('form_validation');
		$this->form_validation->set_message('check_expiry', 'Your credit card has expired, or the entry was invalid. Please try again.');
		$this->form_validation->set_rules('creditnumber','Credit Card Number','required');
		$this->form_validation->set_rules('creditexpiry','Expiry Date','required|callback_check_expiry');
		
		if($this->form_validation->run() == FALSE)
		{
			$data['checkouterror'] = validation_errors();
			$this->load->view('templates/template.php', $data);
		}
		
		else {
			
			/*===== Formatting Credit Cart info (card number, expiry) ==== */

			$creditcardnumber_withdashes = $this->input->post('creditnumber');
			$creditcardexpiry = $this->input->post('creditexpiry');
			$total_withdollarsign = $this->input->post('formtotal');
			$shoppingcart_json = $this->input->post('formshoppingcart');
			
			$shoppingcart = json_decode($shoppingcart_json, true);
			$total = str_replace("$", "", $total_withdollarsign);
			$creditcardnumber = str_replace("-", "", $creditcardnumber_withdashes);
			$expirySplit = explode('/', $creditcardexpiry);
			$creditcardmonth = $expirySplit[0];
			$creditcardyear = $expirySplit[1];
			
			//get customer id
			$sessionData = $this->session->userdata('logged_in');
			$userId = $sessionData['id'];
			$userEmail = $sessionData['email'];
			
			/*	Returning orderId of created order to send in the email  */			
			$orderId = $this->order_model->insert_order($userId, $creditcardnumber, $creditcardmonth, 
											$creditcardyear, $total, $shoppingcart);
			emailHelper($this, $userEmail, $orderId);
			$data['successmsg'] = "Thank you for your order!
									Your order request has been processed and a confirmation email has been sent to you.";
			$this->load->view('templates/template.php', $data);
		}
	}

	/* ==== Checking expiry =====*/

	function check_expiry($creditexpiry) {
		$currentYear = date("y");
		$currentMonth = date("m");
		$expirySplit = explode('/', $creditexpiry); 
		if ($expirySplit[1] < $currentYear) {
			return False;
		}
		else if ($expirySplit[1] == $currentYear && $expirySplit[0] < $currentMonth) {
			return False;
		}
		else if ($expirySplit[0] < 0 || $expirySplit[0] > 12) {
			return False;
		} 
		else {
			return True;
		}
	}
}