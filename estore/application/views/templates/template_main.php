<div class="jumbotron">
<?php
if (isset($title)){
?>
<h1><?= $title ?></h1>
<?php
}
?>

<?php
if (isset($description)){
	if($description != "")
	{
?>
<p><?= $description ?></p>
<?php
} }
?>

</div>

<?php
if(isset($contents)){
	if($contents != ""){
?>
<div class="contents">
<?php
if(isset($contentsMessageSuccess)) {
?>

<div class="alert alert-success" role="alert"><?= $contentsMessageSuccess ?></div>

<?php
}
?>

<?php
if(isset($contentsMessageDanger)) {
?>

<div class="alert alert-danger" role="alert"><?= $contentsMessageDanger ?></div>

<?php
}
?>

<?php
if (isset($allproducts)) {
?>
<div id="content">
	<?php
		echo '<table style="width:100%">';
		$total = 0;
		foreach($allproducts as $product) {
			echo '<tr>';
			echo '<td>',$product['name'],'</td>','<td>',"   $", $product['price'],"</td>";
			$total += intval($product['price']);
			echo '</tr>';
		}
		echo '</table>';
		echo 'total: $',$total,'<br>';
		echo	'<input class="btn btn-primary cart" type="submit" onclick="window.print()" value="Print Receipt"></input>';
	?>
</div>
<hr>
<div id=total>
	<?php
		echo "Your total is: $", $orders[0]['total'];
	?>
</div>
<?php
}
?>

<?php
if (isset($contentsdata)){
	$this->load->view($contents,$contentsdata);
}else{
	$this->load->view($contents);
}
	?>
</div>
<?php
}}
?>
