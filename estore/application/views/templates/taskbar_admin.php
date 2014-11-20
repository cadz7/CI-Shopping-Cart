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
			<div class="navbar-brand"><b>Estore</b></div> 
			<div class="navbar-brand">
			<img alt="Brand" class="img-responsive" src="http://simpleicon.com/wp-content/uploads/baseball.png" width="24" height="24">
			</div>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div id="navbar"
			class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li id="catalogue"><?php echo anchor("/",'Catalogue') ?></li>
				<li id="shoppingcart"><?php echo anchor("main/shoppingcart",'Shopping Cart <span class="badge">0</span>') ?></li>
				<li id="admin" class="dropdown">
          <a  href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            
            <li><?php echo anchor('admin/addProduct','Add Products') ?></li>
            <li><?php echo anchor('admin/editProduct','Edit Products') ?></li>
            <li><?php echo anchor('admin/getOrders','Delete Orders') ?></li>
            <li><?php echo anchor('admin/getUsers','Remove Users') ?></li>
          </ul>
        </li>
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
	</div>
</nav>




