<?php
/*
	Default provided Controller.
	Store operations implemented here.
*/
session_start();

class Store extends CI_Controller {
     
     
    function __construct() {
    		// Call the Controller constructor
	    	parent::__construct();
	    	
	    	
	    	$config['upload_path'] = './images/product/';
	    	$config['allowed_types'] = 'gif|jpg|png';
/*	    	$config['max_size'] = '100';
	    	$config['max_width'] = '1024';
	    	$config['max_height'] = '768';
*/
	    		    	
	    	$this->load->library('upload', $config);
	    	
    }

    function index() {
    		$this->load->model('product_model');
    		$products = $this->product_model->getAll();
    		$data['products']=$products;
    		$this->load->view('product/list.php',$data);
    }
    
    function newForm() {
	    	$this->load->view('product/newForm.php');
    }
    
	function create() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required|is_unique[products.name]');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('price','Price','required');
		
		$fileUploadSuccess = $this->upload->do_upload();
		
		if ($this->form_validation->run() == true && $fileUploadSuccess) {
			$this->load->model('product_model');

			$product = new Product();
			$product->name = $this->input->get_post('name');
			$product->description = $this->input->get_post('description');
			$product->price = $this->input->get_post('price');
			
			$data = $this->upload->data();
			$product->photo_url = $data['file_name'];
			
			$this->product_model->insert($product);

			//Then we redirect to the index page again
			//redirect('store/index', 'refresh');
			redirect('admin/editProduct');
			
		}
		else {
			if ( !$fileUploadSuccess) {
				$data['fileerror'] = $this->upload->display_errors();
				//$data['title'] = 'Add Products';
				$data['taskbarLinkId'] = 'admin';
				$data['addProduct'] = 'True';
				$this->load->view('admin/admin_template.php',$data);
				//$this->load->view('store/index');
				return;
			}
			
			//$this->load->view('product/newForm.php');
			//$data['title'] = 'Add Products';
			$data['taskbarLinkId'] = 'admin';
			$data['addProduct'] = 'True';
			$this->load->view('admin/admin_template.php',$data);
		}	
	}
	
	function read($id) {
		$this->load->model('product_model');
		$product = $this->product_model->get($id);
		$data['product']=$product;
		$this->load->view('product/read.php',$data);
	}
	
	function editForm($id) {
		$this->load->model('product_model');
		$product = $this->product_model->get($id);
		$data['product']=$product;
		$this->load->view('product/editForm.php',$data);
	}
	
	function update($id) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('price','Price','required');
		
		if ($this->form_validation->run() == true) {
			$product = new Product();
			$product->id = $id;
			$product->name = $this->input->get_post('name');
			$product->description = $this->input->get_post('description');
			$product->price = $this->input->get_post('price');
			
			$this->load->model('product_model');
			$this->product_model->update($product);
			//Then we redirect to the index page again
			//redirect('store/index', 'refresh');
			redirect('admin/editProduct');
		}
		else {
			$product = new Product();
			$product->id = $id;
			$product->name = set_value('name');
			$product->description = set_value('description');
			$product->price = set_value('price');
			$data['product']=$product;
			$this->load->view('product/editForm.php',$data);
		}
	}
    	
	function delete($id) {
		$this->load->model('product_model');
		
		if (isset($id)) 
			$this->product_model->delete($id);
		
		//Then we redirect to the index page again
		//redirect('store/index', 'refresh');
		redirect('admin/editProduct');
		
	}
	
	function addToCart($id) {
		if (isset($id)) {
			$cartProduct['id'] = $id;
			$cartProduct['quantity'] = 1;
			if ($this->session->userdata('shoppingCart')) {
				$shoppingCart = $this->session->userdata('shoppingCart');
				$shoppingCart[] = $cartProduct; 
			}
			else {
				$shoppingCart[] = $cartProduct;
			}
			$this->session->set_userdata('shoppingCart', $shoppingCart);
		}
		redirect("", 'refresh');
	}
      
	function removeFromCart($id) {
		if (isset($id)) {
			$newShoppingCart = array();
			$oldShoppingCart = $this->session->userdata('shoppingCart');
			foreach ($oldShoppingCart as $item) {
				if($item['id'] != $id) {
					$newShoppingCart[] = $item;
				}
			}
			$this->session->set_userdata('shoppingCart', $newShoppingCart);
		}
		redirect("", 'refresh');
	}
}

