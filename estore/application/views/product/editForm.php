<h2>Edit Product</h2>

<style>
	input { display: block;}
	
</style>

<?php 
	echo "<p>" . anchor('admin/editProduct','Back') . "</p>";
	
	echo form_open("store/update/$product->id");
?>

<div class="form-group">
<?php	
	echo form_label('Name'); 
	echo form_error('name');
	$name_input = array( 'name' => 'name', 'class' => 'form-control');
	echo form_input($name_input,$product->name,"required");
?>
</div>
<div class="form-group">
<?php
	echo form_label('Description');
	echo form_error('description');
	$des_input = array( 'name' => 'description', 'class' => 'form-control');
	echo form_input($des_input,$product->description,"required");

?>
</div>
<div class="form-group">
<?php
	
	echo form_label('Price');
	echo form_error('price');
	$price_input = array( 'name' => 'price', 'class' => 'form-control');
	echo form_input($price_input,$product->price,"required");
?>
</div>

<?php	
	$attributes = array( 'name' => 'submit', 'class' => 'btn btn-default', 'value' => 'Save' );	
	//echo form_submit('submit', 'Save');
	echo form_submit($attributes);
	echo form_close();
?>	

