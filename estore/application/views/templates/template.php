<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Baseball Cards Store</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">

<link rel = "stylesheet" href="<?= base_url()?>css/template.css">
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>


</head>
<body>

<script type="text/javascript">

$(document).ready(function(){
	//Does shoppingCart exist in cookies
	var shoppingCart =  getCookie('shoppingCart');

	// Determine which items are in shopping cart and change
	// their button class
	if (shoppingCart) {
		shoppingCart = JSON.parse(shoppingCart);
		$('.thumbnail').each(function() {
			for( var i = 0; i < shoppingCart.length; i++) {
				if (shoppingCart[i].id == parseInt($( this ).find('#shopping-cart-product-id').html())) {
					$( this ).find('button').attr('class', 'btn btn-xs btn-success btn-group-sm');
					$( this ).find('button').html('Remove From Cart');
				}
			}
		});
	}
	else {
		shoppingCart = [];
	}

	// set badge on shopping cart link to number of types of card in cart
	$('#shoppingcart').find('.badge').html(shoppingCart.length);

	$('.thumbnail').find('button').click(function() {

		// Add card to cart by getting shopping cart adding card id to cart and then adding the cart
		// to cookies
		if($(this).attr('class') == 'btn btn-xs btn-primary btn-group-sm') {
			var shoppingCartItem = 	{
					id: $( this ).parent().parent().find('#shopping-cart-product-id').html(),
					name: $( this ).parent().parent().find('#shopping-cart-product-name').html(),
					price: $( this ).parent().parent().find('#shopping-cart-product-price').html(),
					photo: $( this ).parent().parent().find('#shopping-cart-product-photo').html(),
					quantity: 1
					};
			shoppingCart.push(shoppingCartItem);
			setCookie('shoppingCart', JSON.stringify(shoppingCart));
			$( this ).attr('class', 'btn btn-xs btn-success btn-group-sm');
			$( this ).html('Remove From Cart');
			$('#shoppingcart').find('.badge').html(shoppingCart.length);
		}

		// Remove card from cart by getting shopping cart finding card with matching id and removing
		// the card from the cart, then adding the cart to cookies
		else {
			for( var i = 0; i < shoppingCart.length; i++) {
				if (shoppingCart[i].id == parseInt($( this ).parent().parent().find('#shopping-cart-product-id').html())) {
					shoppingCart.splice(i,1);
				}
			}
			deleteCookie('shoppingCart');
			setCookie('shoppingCart', JSON.stringify(shoppingCart));
			$( this ).attr('class', 'btn btn-xs btn-primary btn-group-sm');
			$( this ).html('Add to Cart');
			$('#shoppingcart').find('.badge').html(shoppingCart.length);
		}
	});

	$('.img').popover();
	$('li').removeClass();
	$('#<?= $taskbarLinkId ?>').addClass('active');
	$('li > a').click(function() {
    	$('li').removeClass();
    	$(this).parent().addClass('active');
	});
});

</script>

	<?php if (isset($taskbar)) {
		$this->load->view($taskbar);
	}?>
	<div class="container-all">
	<?php
	if (isset($message)) {
	?>
	<div class="alert alert-danger" role="alert"><?= $message ?></div>
	<?php
	}
	?>
	
	<p>
	<?php $this->load->view('templates/template_main.php')?>
	</div>
<script src="<?= base_url() ?>js/cookies.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</body>

</html>
