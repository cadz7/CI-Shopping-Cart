<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
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

		<!-- Collect the nav links, forms, and other content for toggling -->
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
			$submit_type = array('type'=>'submit', 'class'=>'btn btn-default', 'value'=>'Logout');
			echo form_submit($submit_type);
			echo form_close();
			?>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container-fluid -->
</nav>




