<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Baseball Cards Store</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
<link rel = "stylesheet" href="<?= base_url()?>css/template.css">
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>


</head>
<body>

<script type="text/javascript">

$(document).ready(function() {
	/* Check if items in cookies exist */
	var shoppingCart =  getCookie('shoppingCart');

	/* If the items exist, display them in shopping cart. */
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

	/*  Set Counter of shoppping cart items	*/
	$('#shoppingcart').find('.badge').html(shoppingCart.length);

	$('.thumbnail').find('button').click(function() {

		/* Add the card to cookies based on matching id */
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

		/* Remove the card from cookies based on matching id */
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
