<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Baseball Cards Store</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">

<link rel = "stylesheet" href="<?= base_url();?>css/template.css">

</head>
<body>
<script>
$(document).ready(function () {
	$('li').removeClass();
	$('#<?= $taskbarLinkId ?>').addClass('active');
	$('li > a').click(function() {
		$('li').removeClass();
		$(this).parent().addClass('active');
	});
});
</script>

	<?php $this->load->view('templates/taskbar_admin.php')?>
	<div class="container-all">
	<?php 
	if (isset($message)) { 
	?>
	<div class="alert alert-warning" role="alert"><?= $message ?></div>
	<?php
	}
	?>
	<div class="jumbotron"> 
	<?php 
	if (isset($title)){
	?>
		<h1><?= $title ?></h1>
	<?php 
	}?>
	
	<?php 
	if (isset($addProduct)){
	?>
	<p><?php $this->load->view('product/newForm.php'); ?></p>
	<?php 
	}
	?>
	
	<?php 
	if (isset($products)){
	?>
	<p><?php $this->load->view('product/list.php', $products); ?></p>
	<?php 
	}
	?>
	
	<?php
	if(isset($product) && isset($editsingleproduct)){
	?>
	<p><?php $this->load->view('product/editForm.php', $product)?></p>
	<?php 
	}
	?>
	
	<?php
	if(isset($product) && isset($viewsingleproduct)){
	?>
	<p><?php $this->load->view('product/read.php', $product)?></p>
	<?php 
	}
	?>
	
	<?php
	if(isset($users)){
	?>
	<p><?php $this->load->view('admin/users/list.php', $users)?></p>
	<?php 
	}
	?>
	
	<?php
	if(isset($orders)){
	?>
	<p><?php $this->load->view('admin/orders/list.php', $orders)?></p>
	<?php 
	}
	?>
	
	</div>
	</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</body>

</html>
