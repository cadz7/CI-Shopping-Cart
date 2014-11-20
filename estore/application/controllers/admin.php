<?php

/*
	Admin Controller.
	Admin related operations implemented here.
*/

class Admin extends CI_Controller{
	
	function __construct() {
		// Call the Controller constructor
		parent::__construct();
	}

	/*==== Product operations ====*/
	function addProduct() {
		$data['taskbarLinkId'] = 'admin';
		$data['addProduct'] = 'True';
		$this->load->view('admin/admin_template.php',$data);
	}
	
	function editProduct() {
		$this->load->model('product_model');
		$products = $this->product_model->getAll();
		$data['products']=$products;
		$data['taskbarLinkId'] = 'admin';
		$this->load->view('admin/admin_template.php',$data);
	}
	
	function editSingleProduct($id) {
		$this->load->helper('checkuser');
		$data = checkUser($this);
		$data['taskbarLinkId'] = 'admin';
		$this->load->model('product_model');
		$product = $this->product_model->get($id);	
		$data['product']=$product;
		$data['editsingleproduct'] = "True";	
		$this->load->view('admin/admin_template.php',$data);
	}
	
	function viewSingleProduct($id){
		$this->load->helper('checkuser');
		$data = checkUser($this);
		$data['taskbarLinkId'] = 'admin';
		$this->load->model('product_model');
		$product = $this->product_model->get($id);
		$data['product']=$product;
		$data['viewsingleproduct'] = "True";
		$this->load->view('admin/admin_template.php',$data);
	}
	
	function deleteProduct($id) {
		$this->load->model('product_model');	
		if (isset($id))
			$this->product_model->delete($id);	
		redirect('admin/editProduct');
	
	}
	
	/*==== User operations ====*/
	function getUsers() {
		$this->load->model('user_model');
		$users = $this->user_model->getAll();
		$data['taskbarLinkId'] = 'admin';
		$data['users']=$users;
		$this->load->view('admin/admin_template.php',$data);
	}
	
	function deleteUser($id) {
		$this->load->model('user_model');
		if (isset($id))
			$this->user_model->delete($id);
		redirect('admin/getUsers');
	
	}
	
	
	/*==== Order operations ====*/
	function getOrders() {
		$this->load->model('order_model');
		$orders = $this->order_model->getAll();
		$data['taskbarLinkId'] = 'admin';
		$data['orders']=$orders;
		$this->load->view('admin/admin_template.php',$data);
	}
	
	function deleteOrder($id) {
		$this->load->model('order_model');
		if (isset($id))
			$this->order_model->delete($id);
		redirect('admin/getOrders');
	
	}
	
}

?>