<?php
Class User_model extends CI_Model {
	
	/*	Fetch all users 	*/
	function getAll(){
		$query = $this->db->get('customers');

		//return all users;
		return $query->result_array();
	}
	
	/*	Login check for user in DB */	
	function login($username, $password)
	{
		$this->db->select('id, first, last, login, password, email');
		$this->db->from('customers');
		$this->db->where('login', $username);
		$this->db->where('password', $password);
		$this->db->limit(1);
		
		//Return false if no user could be found
		$query = $this->db->get();
		if($query -> num_rows() == 1) {
			return $query->result();
		}
		else {
			return false;
		}
	}

	/*	Inserting a user into DB  */
	function insert($first, $last, $username, $password, $email) {
		return $this->db->insert("customers", array('first' => $first,
									'last' => $last,
									'login' => $username,
									'password' => $password,
									'email' => $email));
	}
	
	/*	Deleting a user from DB  */
	function delete($id) {
		return $this->db->delete("customers",array('id' => $id ));
	}
}