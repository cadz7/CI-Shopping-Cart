<?php
/*
	Accounts Controller.
	User related operations implemented here.
*/


session_start();
class Accounts extends CI_Controller {
	
	function login() {
		if ($this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		$this->load->helper('checkuser');
		$this->load->model('user_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required|callback_check_database');
		if($this->form_validation->run() == FALSE && !$this->session->userdata('logged_in'))
		{
			$data['taskbar'] = 'templates/taskbar_anon.php';
			$data['message'] = validation_errors();
		}
	
		else if ($this->session->userdata('logged_in') && $this->input->post('title') == 'Accounts') {
			redirect('', 'refresh');
		}
		
		else {
			$data = checkUser($this);
		}
	
		$data['title'] = $this->input->post('title');
		$data['description'] = $this->input->post('description');
		$data['contents'] = $this->input->post('contents');
		$data['taskbarLinkId'] = $this->input->post('taskbarLinkId');
		
		//Load the data from database if the user was in catalogue page.
		if($data['contents'] == 'catalogue/list.php'){
			$this->load->model('product_model');
			$products = $this->product_model->getAll();
			$data['contentsdata']=$products;}
		
		$this->load->view('templates/template.php', $data);
	}
	
	function check_database($password){
		$username = $this->input->post('username');
		$result = $this->user_model->login($username, $password);
		if ($result){
			$sess_array = array();
			foreach ($result as $row) {
				$sess_array = array(
						'id' => $row->id,
						'login' => $row->login,
						'first' => $row->first,
						'last' => $row->last,
						'email' => $row->email
				);
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return TRUE;
		}
		else {
			$this->form_validation->set_message('check_database', 'Invalid username or password. Please try again.');
			return false;
		}
	}
	
	function logout()
	{
		$this->session->unset_userdata('logged_in');
		redirect('', 'refresh');
	}
	
	function create() {
		if ($this->session->userdata('logged_in')) {
			redirect('', 'refresh');
		}
		$this->load->helper('checkuser');
		$this->load->model('user_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('firstname','First Name','required');
		$this->form_validation->set_rules('lastname','Last Name','required');
		$this->form_validation->set_rules('username','Username','required|is_unique[customers.login]');
		$this->form_validation->set_rules('password','Password','required|min_length[6]');
		$this->form_validation->set_rules('passconf','Password Confirmation','required|matches[password]');
		$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[customers.email]');
		
		$data = checkUser($this);
		$data['title'] = $this->input->post('title');
		$data['description'] = $this->input->post('description');
		$data['contents'] = $this->input->post('contents');
		$data['taskbarLinkId'] = $this->input->post('taskbarLinkId');
		
		if($this->form_validation->run() == FALSE){
			$data['contentsMessageDanger'] = validation_errors();
		}
		
		else {
			$first = $this->input->post('firstname');
			$last = $this->input->post('lastname');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$email = $this->input->post('email');
			$result = $this->user_model->insert($first, $last, $username, $password, $email);
			$data['contentsMessageSuccess'] = "You account was created successfully. Login whenever you're ready.";
		}

		$this->load->view('templates/template.php', $data);
	}
}