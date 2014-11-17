<?php 
		$attributes = array('role' => 'form');
		echo form_open("accounts/create", $attributes);
?>
<div class="form-group">
<label for="firstName">First Name</label>

<?php 
$firstname_type = array('type'=>'text', 'class'=>'form-control',
		'id'=>'firstname', 'name'=>'firstname', 'required'=>'', 'placeholder'=>'Enter your first name');
echo form_input($firstname_type);
?>

</div>
<div class="form-group">
<label for="lastName">Last Name</label>

<?php 
$lastname_type = array('type'=>'text', 'class'=>'form-control',
		'id'=>'lastname', 'name'=>'lastname', 'required'=>'', 'placeholder'=>'Enter your last name');
echo form_input($lastname_type);
?>

</div>
<div class="form-group">
<label for="login">Username</label>

<?php 
$username_type = array('type'=>'text', 'class'=>'form-control',
		'id'=>'username', 'name'=>'username', 'required'=>'', 'placeholder'=>'Enter a username');
echo form_input($username_type);
?>

</div>
<div class="form-group">
<label for="password">Password</label>

<?php 
$password_type = array('type'=>'password', 'class'=>'form-control', 'pattern'=>'.{6}(.)*',
		'oninvalid'=>"setCustomValidity('Please enter a password with at least 5 characters')",
		'onchange'=>"try{setCustomValidity('')}catch(e){}",
		'id'=>'pass1', 'name'=>'password', 'required'=>'', 'placeholder'=>'Enter a password');
echo form_input($password_type);
?>

</div>
<div class="form-group">
<label for="passconf">Password Confirmation</label>

<?php 
echo form_password('passconf','',"id='pass2' required
		class='form-control' placeholder='Confirm your password'");
?>

</div>

<div class="form-group">
<label for="email">Email</label>

<?php 
$email_type = array('type'=>'email', 'class'=>'form-control',
		'id'=>'email', 'name'=>'email', 'required'=>'', 'placeholder'=>'Enter your email');
echo form_input($email_type);
?>

</div>
<?php 
$title_type = array('type'=>'hidden', 'class'=>'form-control', 'value' => $title,
		'id'=>'title', 'name'=>'title', 'visibility'=>'hidden');
echo form_input($title_type);
$description_type = array('type'=>'hidden', 'class'=>'form-control', 'value' => $description,
		'id'=>'description', 'name'=>'description');
echo form_input($description_type);
$contents_type = array('type'=>'hidden', 'class'=>'form-control', 'value' => $contents,
		'id'=>'contents', 'name'=>'contents', 'visibility'=>'hidden');
echo form_input($contents_type);
$taskbarLinkId_type = array('type'=>'hidden', 'class'=>'form-control', 'value' => $taskbarLinkId,
		'id'=>'taskbarLinkId', 'name'=>'taskbarLinkId', 'visibility'=>'hidden');
echo form_input($taskbarLinkId_type);
$submit_type = array('type'=>'submit', 'class'=>'btn btn-default', 'value'=>'Submit');
echo form_submit($submit_type);
echo form_close();
?>