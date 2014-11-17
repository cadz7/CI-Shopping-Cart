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

