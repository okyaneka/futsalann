<!DOCTYPE html>
<html>
<head>
	<?php my_head(); ?>
</head>
<body>
	<div id="header" class="container-fluid">
		<nav class="navbar navbar-default row">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#my_menu">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<?= anchor(base_url(),'Futsaloka','class="navbar-brand"');?>
				</div>
				<!-- main menu -->
				<div class="collapse navbar-collapse" id="my_menu">
					<ul class="nav navbar-nav main-menu">
						<li><?= anchor(base_url(), 'Home');?></li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Dropdown<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Item 1</a></li>
								<li><a href="#">Item 2</a></li>
								<li><a href="#">Item 3</a></li>
							</ul>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php echo base_url('user/register');?>">Daftar</a></li>
						<li><a href="<?php echo base_url('user/login');?>">Masuk</a></li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="fa fa-user"></span><span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url('/user/profile/'.$this->session->user_id) ?>">Login status : <?php echo isset($_SESSION['user_id']) ? 'OK (user_id = '.$_SESSION['user_id'].')' : 'No user login' ;?></a></li>
								<li><a href="<?php echo base_url('/user/logout'); ?>">Logout</a></li>
							</ul>
						</li>
						<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<span class="fa fa-shopping-cart"></span>
							<span class="badge"><?php empty( $this->cart->total_items() ) ? '' : $this->cart->total_items();?></span>
							<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li></li>
							</ul>
						</li>
					</ul>
				</div> <!-- #my_menu -->
			</div>
		</nav>
		
		<!-- navbar (menu, user, cart) -->
	</div>
	<div class="container">
		<?php echo bootstrap_breadcrumb($breadcrumb); ?>
	</div>