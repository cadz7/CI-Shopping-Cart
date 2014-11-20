<h2>Product Table</h2>
<style>
	input { display: block;}
	a {
		color: white;
	}
	a:hover {
		color: white;
	}
	tr:hover {
		background: rgb(74, 118, 168) !important;
	}
</style>
<?php 
		echo "<p>" . anchor('admin/addProduct','Add New') . "</p>";
?>
<table class="table table-hover">

<?php  
		echo "<tr><th>Name</th><th>Description</th><th>Price</th><th>Photo</th><th>Operations</th><th></th><th></th></tr>";
		
		foreach ($products as $product) {
			echo "<tr>";
			echo "<td>" . $product->name . "</td>";
			echo "<td>" . $product->description . "</td>";
			echo "<td>" . $product->price . "</td>";
			echo "<td><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='100px' /></td>";
				
			echo "<td>" . anchor("admin/deleteProduct/$product->id",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'") . "</td>";
			echo "<td>" . anchor("admin/editSingleProduct/$product->id",'Edit') . "</td>";
			echo "<td>" . anchor("admin/viewSingleProduct/$product->id",'View') . "</td>";
				
			echo "</tr>";
		}
?>

</table>
