<html>
<head>
<meta charset="UTF-8" />
<title>Baseball Cards Store</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
<link rel = "stylesheet" href="<?= base_url()?>css/template.css">

</head>
<body>
<h2>Order Confirmation</h2>
<<<<<<< HEAD
<div id="header">
	Thank you for shopping with our store
</div>
<div id="content">
	<?php
		foreach($allproducts as $product) {
			echo $product['name'],"   ", $product['price'],"$<br>";
		}
	?>
</div>
<hr>
<div id=total>
	<?php
		echo "Your total: ",$orders[0]['total'],"$";
	?>
</div>
=======
	<div id="header">
		Thank you for shopping with our store
	</div>
	<div id="content">
		<?php
			foreach($allproducts as $product) {
				echo $product['name'],"   $", $product['price'],"<br>";
			}
		?>
	</div>
	<hr>
	<div id=total>
		<?php
			echo "Your total is: $", $orders[0]['total'];
		?>
	</div>
>>>>>>> origin/Rick-branch
</body>
</html>
