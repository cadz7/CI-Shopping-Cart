<?php
function isIdInCart($id, $cart) {
	foreach ($cart as $item) {
		if ($item['id'] == $id) {
			return true;
		}
	}
	return false;
}