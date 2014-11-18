<?php
Class Order_model extends CI_Model {

	/*	Fetch an order from orders table in DB 	*/
	function get($id)
	{
		$query = $this->db->get_where('orders', array('id' => $id));
		return $query->result_array();
	}

	/*	Fetch all orders from orders table in DB 	*/
	function getAll()
	{
		$query = $this->db->get('orders');
		return $query->result_array();
	}

	/*	Fetching items from order_items table in DB.	*/
	function getAllItems($id)
	{
		$query = $this->db->get_where('order_items', array('order_id' => $id));
		return $query->result_array('Order');
	}

	function delete($id) {
		return $this->db->delete("orders",array('id' => $id ));
	}


	function insert_order($userId, $creditCardNumber, $creditCardMonth, $creditCardYear, $total, $shoppingCart) {

		/*	Generating time and date 	*/
		$mysqlDate = date('Ymd');
		$mysqlTime = date('H:i:s');

		$this->db->insert("orders", array(
				'customer_id' => $userId,
				'order_date' => $mysqlDate,
				'order_time' => $mysqlTime,
				'total' => $total,
				'creditcard_number' => $creditCardNumber,
				'creditcard_month' => $creditCardMonth,
				'creditcard_year' => $creditCardYear)
		);

		/*	Fetching order_id of newely created order  */
		$query = $this->db->get_where("orders",array('order_date' => $mysqlDate, 'order_time' => $mysqlTime));
		$order_id_array = $query->result_array();
		$order_id = $order_id_array[0]['id'];

		/*	Inserting new items into order_items from shopping cart.  */
		foreach ($shoppingCart as $item) {
			$this->db->insert("order_items", array(
					'order_id' => $order_id,
					'product_id' => $item['id'],
					'quantity' => $item['quantity'])
			);
		}
		return $order_id;
	}
}

?>
