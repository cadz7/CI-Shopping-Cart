<script type="text/javascript">
$(document).ready(function(){
	/*	Get and Set cookies   */
	var shoppingCart =  getCookie('shoppingCart');

	/*	Creating cart array from JSON */
	if (shoppingCart) {
		shoppingCart = JSON.parse(shoppingCart);
	}
	else {
		shoppingCart = [];
	}

	var changedItems =[];

	/*	Removing items   */
	function removeFromCart (id) {
		for( var i = 0; i < shoppingCart.length; i++) {
			if (shoppingCart[i].id == parseInt(id)) {
				shoppingCart.splice(i,1);
			}
		}
		deleteCookie('shoppingCart');
		setCookie('shoppingCart', JSON.stringify(shoppingCart));
		$('#formshoppingcart').attr('value', JSON.stringify(shoppingCart));
		$('#formtotal').attr('value', getTotal(shoppingCart));
	}

	/*	Changing quantities   */

	function changeQuantityInCart (id, quantity) {
		for( var i = 0; i < shoppingCart.length; i++) {
			if (shoppingCart[i].id == parseInt(id)) {
				shoppingCart[i].quantity = quantity;
			}
		}
		setCookie('shoppingCart', JSON.stringify(shoppingCart));
		$('#formshoppingcart').attr('value', JSON.stringify(shoppingCart));
		$('#formtotal').attr('value', getTotal(shoppingCart));
	}

	function addToChanged (item_id, item_quantity) {
		for (var i=0; i < changedItems.length; i++) {
			if (changedItems[i].id == item_id) {
				changedItems[i].quantity = item_quantity;
				return
			}
		}
		//Creating an item object with updated quantity value
		var item = {
			id: item_id,
			quantity: item_quantity
		};
		changedItems.push(item);
	}

	/*	Removing changed items	*/
	function removeFromChanged (item_id) {
		for (var i=0; i < changedItems.length; i++) {
			if (changedItems[i].id == item_id) {
				changedItems.splice(i,1);
			}
		}
	}

	function htmlEncode(value){
		return $('<div/>').text(value).html();
	}

	function htmlDecode(value){
		return $('<div/>').html(value).text();
	}

	function getTotal(shoppingCart) {
		var total = 0;
		for (var i=0; i < shoppingCart.length; i++) {
			price = parseFloat(shoppingCart[i].price);
			quantity = parseInt(shoppingCart[i].quantity);
			subtotal = price * quantity;
			total += subtotal
		}
		return "$" + total.toFixed(2);
	}

	function makeShoppingCartTable(shoppingCart) {
		cartTable = "<th></th><th>Name</th><th>Price</th><th>Quantity</th><th></th>";
		for (var i=0; i < shoppingCart.length; i++) {
			price = parseFloat(shoppingCart[i].price);
			cartTable += "<tr><td><img class = 'cartphoto' src='" + "<?= base_url() ?>" +"images/product/";
			cartTable += shoppingCart[i].photo + "'></td>";
			cartTable += "<td>" + htmlEncode(shoppingCart[i].name) + "</td>";
			cartTable += "<td>$" + price.toFixed(2) + "</td>";
			cartTable += '<td> <div class="form-group">';
			cartTable += '<input type="text" pattern="\\d+" class="form-control quantity" ';
			cartTable += 'oninvalid="setCustomValidity(\'Please enter a positive numeric value\')" ';
			cartTable += 'onchange="try{setCustomValidity(\'\')}catch(e){}" ';
			cartTable += 'required= "" value ="'+ htmlEncode(shoppingCart[i].quantity) +'">';
			cartTable += '<div class="inventoryproductid">' + shoppingCart[i].id + '</div>';
			cartTable += '</div>' + '</td>';
		    cartTable += '<td><button type="button" class="btn btn-xs btn-danger item">' +
	 		'Remove</button></td></tr>';
		}
		cartTable += '<tr>';
		cartTable += '<td></td><td colspan=2><ul class="list-group"><ul class="list-group">';
	    cartTable += '<li class="list-group-item disabled"><b>Total Price</b><div class="cartprice">'
		cartTable += getTotal(shoppingCart) + '</div></li></ul></td>';
		cartTable +=	'<td></td><td><input id="cartbutton" class="btn btn-primary cart" type="submit" value="Update Cart"></input></td>';
		cartTable +=	'<td></td><td><input class="btn btn-primary cart" type="submit" onclick="window.print()" value="Print Receipt"></input></td>';
	    cartTable += '</tr>';
		return cartTable;
	}

	function noItemsMsg() {
		$('.inventory').html('<div class="alert alert-warning" role="alert"><h3>No items in the cart!</h3>' +
		'<p><b>The cart is currently empty. Please click <a href="'+
		'<?= base_url()?>' + '">here</a>' +
		' and items to the cart.</b></div>');
	}

	if(shoppingCart[0] != undefined && shoppingCart[0].id != undefined) {

		//Markup for the Shopping Cart Table
		tableMarkup = makeShoppingCartTable(shoppingCart);
		cartTable = '<form id="shopping-cart" role="form">';
		cartTable += '<div class="panel panel-default">';
		cartTable += '<div class="panel-heading"><h3>Shopping Cart</h3></div>';
		cartTable += '<table class="table cart">' + tableMarkup;
		cartTable += '</table></div></form>';
		$('.inventory').html(cartTable);


		/*	=====  Code for Checkout Form ======	*/

		checkoutForm = '<?php 	$attributes = array('role' => 'form');
								echo form_open("orders/checkout", $attributes); ?>';
		checkoutForm += '<div class="panel panel-default">';
		checkoutForm += '<div class="panel-heading"><h3>Checkout</h3></div>';
		checkoutForm += '<p><div class="form-group credit">'
		checkoutForm +=	'<label for="creditnumber">Credit Card Number</label>';
		checkoutForm += '<?php
				$creditcardnumber_type = array('type'=>'text', 'class'=>'form-control', 'pattern'=>'[0-9]{4}[-][0-9]{4}[-][0-9]{4}[-][0-9]{4}',
				'oninvalid'=>"setCustomValidity(\'Please enter your credit card number with 16 digits\')",
				'onchange'=>"try{setCustomValidity(\'\')}catch(e){}",
				'id'=>'creditnumber', 'name'=>'creditnumber', 'required'=>'', 'placeholder'=>'XXXX-XXXX-XXXX-XXXX');
				echo form_input($creditcardnumber_type);
		?>';
		checkoutForm +=	'<br/><label for="creditdate">Expiry Date (MM/YY)</label>';
		checkoutForm += '<?php
				$creditcardexpiry_type = array('type'=>'text', 'class'=>'form-control', 'pattern'=>'[0-9]{2}[/][0-9]{2}',
				'oninvalid'=>"setCustomValidity(\'The expiry date is not formatted correctly\')",
				'onchange'=>"try{setCustomValidity(\'\')}catch(e){}",
				'id'=>'creditexpiry', 'name'=>'creditexpiry', 'required'=>'', 'placeholder'=>'MM/DD');
				echo form_input($creditcardexpiry_type);
		?>';
		checkoutForm += '<?php
				$total_type = array('type'=>'hidden', 'class'=>'form-control', 'value' => '',
				'id'=>'formtotal', 'name'=>'formtotal', 'visibility'=>'hidden');
				echo form_input($total_type);
		?>';
		checkoutForm += '<?php
				$shoppingcart_type = array('type'=>'hidden', 'class'=>'form-control', 'value' => '',
				'id'=>'formshoppingcart', 'name'=>'formshoppingcart', 'visibility'=>'hidden');
				echo form_input($shoppingcart_type);
		?>';
		checkoutForm += '<br/><?php
				$submit_type = array('type'=>'submit', 'class'=>'btn btn-primary checkout', 'value'=>'Submit Order');
				echo form_submit($submit_type);
		?>'
		checkoutForm += '</div>';
		checkoutForm += '<?php echo form_close(); ?>';
		$('.checkout').html(checkoutForm);
	}


	//Nothing in the shopping cart
	else {
		noItemsMsg();
	}

	// Prevents form submission for cartinventory but still preserves validation messages
	$('#shopping-cart').on( "submit", function( event ) {
    	if ( this.checkValidity && !this.checkValidity() ) {
        	$( this ).find( ":invalid" ).first().focus();
        	event.preventDefault();
        }
        return false;
     });

	 // Changes border color red for quantity field if it differs from original quantity value
	 $('.form-control.quantity').change(function() {
		item_id = $(this).parent().find('.inventoryproductid').html();
		item_quantity = $(this).val();
		if ($(this).val() != $(this).attr('value')) {
			$(this).css('border-color', 'red');
			addToChanged(item_id, item_quantity);
		}
		else {
			$(this).css('border-color', '#CCC');
			removeFromChanged(item_id);
		}
	 });

	 // Remove button clicked for item, hide row of item, remove it from cookies variable shopping
	 // cart.
	$('.btn.btn-xs.btn-danger.item').click(function() {
		var row = $(this).parent().parent();
		var id = row.find('.inventoryproductid').html();
		removeFromCart(id);
		row.hide();
		$('#shoppingcart').find('.badge').html(shoppingCart.length);
		if (shoppingCart[0] == undefined || shoppingCart[0].id == undefined) {
			noItemsMsg();
		}
		else {
			$('.cartprice').html(getTotal(shoppingCart));
		}
	});

	$('#cartbutton').click(function() {
		for (var i = 0; i < changedItems.length; i++) {
			if (changedItems[i].quantity == 0) {
				removeFromCart(changedItems[i].id);
			}
			else {
				changeQuantityInCart (changedItems[i].id, changedItems[i].quantity);
			}
			$('.inventoryproductid').each(function() {
				var row = $(this).parent().parent().parent();
				if ($(this).html() == changedItems[i].id) {
					if (changedItems[i].quantity == 0) {
						row.hide();
						if (shoppingCart[0] == undefined || shoppingCart[0].id == undefined) {
							noItemsMsg();
						}
					}
					else {
						var form = $(this).parent();
						form.find('.form-control.quantity').css('border-color', '#CCC');
					}
				}
			});
		}
		$('.cartprice').html(getTotal(shoppingCart));
	});
	$('#formshoppingcart').attr('value', JSON.stringify(shoppingCart));
	$('#formtotal').attr('value', getTotal(shoppingCart));
	<?php
	if(isset($successmsg)) {
	?>
	$('.inventory').hide();
	$('.checkout').hide();
	$('.alert.alert-warning').hide();
	$('.alert.alert-info').hide();
	shoppingCart = [];
	setCookie('shoppingCart', JSON.stringify(shoppingCart));
	$('#shoppingcart').find('.badge').html(shoppingCart.length);
	<?php
	}
	?>
});


</script>
<?php
if(isset($successmsg)) {
?>
<div class="alert alert-success" role="alert">
<h3>Success!</h3>
<p><b><?= $successmsg ?></b>
</div>
<?php
}
if($login == 'anon') {
?>
<div class="alert alert-warning" role="alert">
<h3>Oops!</h3>
<p><b>You haven't logged in, or you don't have an account with us. Please go
<a href= '<?= base_url()?>main/createuser'>here</a> and create a new user account, or login above.</b>
</div>
<?php
}
if(isset($checkouterror) && $checkouterror){
?>
<div class="alert alert-danger" role="alert">
<?= $checkouterror ?>
</div>

<?php
}
?>

<div class="inventory"></div>

<?php
if($login != 'anon') {
?>

<div class="checkout"></div>
<?php
}
?>
