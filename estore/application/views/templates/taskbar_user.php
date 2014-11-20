<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed"
				data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<div class="navbar-brand"><b>EStore</b></div> 
			<div class="navbar-brand">
			<img alt="Brand" class="img-responsive" src="http://simpleicon.com/wp-content/uploads/baseball.png" width="24" height="24">
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
			echo form_open("accounts/logout", $attributes);
			?>
			<?php 
			$submit_type = array('type'=>'submit', 'class'=>'btn btn-default btn-logout', 'value'=>'Logout');
			echo form_submit($submit_type);
			echo form_close();
			?>
		</div>
	</div>
</nav>




