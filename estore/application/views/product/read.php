<h2>Product Entry</h2>
<?php 
	echo "<p>" . anchor('admin/editProduct','Back') . "</p>";

	echo "<p> ID = " . $product->id . "</p>";
	echo "<p> NAME = " . $product->name . "</p>";
	echo "<p> Description = " . $product->description . "</p>";
	echo "<p> Price = " . $product->price . "</p>";
	echo "<p><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='200px'/></p>";
		
?>	

