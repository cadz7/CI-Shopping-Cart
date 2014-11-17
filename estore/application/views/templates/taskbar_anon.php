<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed"
				data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<div class="navbar-brand"><b>Baseball Cards Shop</b></div> 
			<div class="navbar-brand">
			<img alt="Brand" class="img-responsive" src="<?= base_url(); ?>/images/glyphicons_311_baseball.png">
			</div>
		</div>

		<div id="navbar"
			class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li id="catalogue"><?php echo anchor("/",'Catalogue') ?></li>
				<li id="shoppingcart"><?php echo anchor("main/shoppingcart",'Shopping Cart <span class="badge">0</span>') ?></li>
			</ul>
			<?php 
			$attributes = array('class' => 'navbar-form navbar-right', 'role' => 'form');
			echo form_open("accounts/login", $attributes);
			?>
			<div class="form-group">
          	<?php
			$username_type = array('type'=>'text', 'class'=>'form-control', 
					'id'=>'username', 'name'=>'username', 'required'=>'', 'placeholder'=>'Username');
			echo form_input($username_type); 
			?>
			</div>
			<div class="form-group">	
			<?php
			$password_type = array('type'=>'password', 'class'=>'form-control',
					'id'=>'password', 'name'=>'password', 'required'=>'', 'placeholder'=>'Password');
			echo form_input($password_type);
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
			$submit_type = array('type'=>'submit', 'class'=>'btn btn-default', 'value'=>'Sign in');
			echo form_submit($submit_type);
			echo form_close();
			?>
			<ul class="nav navbar-nav navbar-right">
				<li id="createuser"><?php echo anchor("main/createuser",'Create A New Account') ?></li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container-fluid -->
</nav>




