<?php
function shoppingCartCount($cart){
	if ($cart) {
		return count($cart);
	}
	else {
		return 0;
	}
}