<h2>New Product</h2>

<style>
	input { display: block;}
</style>

<?php 
	echo "<p>" . anchor('admin/editProduct','Back') . "</p>";
	echo form_open_multipart('store/create');
?>

<div class="form-group">
<?php
	echo form_label('Name'); 
	echo form_error('name');
	//echo form_input('name',set_value('name'),"required");
	$name_input = array( 'name' => 'name', 'class' => 'form-control');
	echo form_input($name_input , set_value('name'),"required");
?>
</div>
<div class="form-group">
<?php
	echo form_label('Description');
	echo form_error('description');
	$des_input = array( 'name' => 'description', 'class' => 'form-control');
	echo form_input($des_input,set_value('description'),"required");
?>
</div>
<div class="form-group">
<?php	
	echo form_label('Price');
	echo form_error('price');
	$price_input = array( 'name' => 'price', 'class' => 'form-control');
	echo form_input($price_input,set_value('price'),"required");
?>
</div>
<?php
	echo form_label('Photo');
	
	if(isset($fileerror))
		echo $fileerror;	
?>	
<div class="form-group">
	<input type="file" name="userfile" size="30"/>
</div>	

<?php 

$attributes = array(
		'name' => 'submit',
		'class' => 'btn btn-default',
		'value' => 'Create'
);

	//$attributes = array('class' => 'btn btn-default', 'id' => 'myform');
	//echo form_submit('submit', 'Create', $attributes);
	echo form_submit($attributes);
	echo form_close();
?>	

