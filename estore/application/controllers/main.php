<?php

/*
    Main/ Shopping Cart Controller.
    Shopping cart related operations implemented here.
*/

session_start();

class Main extends CI_Controller {
	
    function __construct() {
    		// Call the Controller constructor
	    	parent::__construct();
    }
	
    function checkout() {
    	$this->load->helper('checkuser');
    	$this->load->helper('shoppingcartcount');
    	$data = checkUser($this);
    	$data['title'] = "Checkout";
    	$data['description'] = "";
    	$data['contents'] = '';
    	$data['taskbarLinkId'] = 'checkout';
    	$data['cartcount'] = shoppingCartCount($this->session->userdata('shoppingCart'));
    	$this->load->view('templates/template.php', $data);    	
    }
    
    function shoppingCart() {
    	$this->load->helper('checkuser');
    	$this->load->helper('shoppingcartcount');
    	$data = checkUser($this);
    	$data['title'] = "Shopping Cart";
    	$data['description'] = "";
    	$data['contents'] = 'shoppingcart/shoppingcart.php';
    	$data['taskbarLinkId'] = 'shoppingcart';
    	$this->load->view('templates/template.php', $data);
    }
    
    function createUser() {
    	$this->load->helper('checkuser');
    	$this->load->helper('shoppingcartcount');
    	$data = checkUser($this);
    	$data['title'] = "Accounts";
    	$data['description'] = "Fill out the form below to create a new user account";
    	$data['contents'] = 'user/createUserForm.php';
    	$data['taskbarLinkId'] = 'createuser';
    	$data['cartcount'] = shoppingCartCount($this->session->userdata('shoppingCart'));
    	$this->load->view('templates/template.php', $data);
    }
    
    function index() {
        $this->load->helper('checkuser');
        $this->load->helper('shoppingcartcount');
        $data = checkUser($this);
        $data['title'] = "Catalogue";
        $data['description'] = "";
        $data['taskbarLinkId'] = 'catalogue';
        $data['contents'] = 'catalogue/list.php';
        $data['cartcount'] = shoppingCartCount($this->session->userdata('shoppingCart'));
            	
        $this->load->model('product_model');
        $products = $this->product_model->getAll();
        $data['contentsdata']=$products;
            	
        if ($this->session->userdata('shoppingCart')) {
            $shoppingCart = $this->session->userdata('shoppingCart');
        }
        else {
            $shoppingCart = array();
        }
            	
        $data['cartcontents'] = $shoppingCart; 
        $this->load->view('templates/template.php', $data);
    	
    }
	
}