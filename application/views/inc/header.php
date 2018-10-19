<!DOCTYPE html>
<html>
<head>
	<?php my_head(); ?>
</head>
<body>
	<div id="header" class="container-fluid">
		<nav class="navbar-default row">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#my_menu">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<?php echo anchor(base_url(),'Futsalann','class="navbar-brand col-main"');?>
				</div>
				<!-- main menu -->
				<div class="collapse navbar-collapse" id="my_menu">
					<ul class="nav navbar-nav navbar-right p-l-15">
					<?php if ( ! isset($this->session->user_id)) : ?>
						<li><a href="<?php echo base_url('user/register');?>">Daftar</a></li>
						<li><a href="<?php echo base_url('user/login');?>">Masuk</a></li>
					<?php else : ?>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="fa fa-user"></span><span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url('user/profile');?>">Profil</a></li>
								<li><a href="<?php echo base_url('user/logout');?>">Logout</a></li>
							</ul>
						</li>
						<?php if ($this->futsalann->who_is_login() == 'renter') : ?>
							<li><a href="<?php echo base_url('user/dashboard');?>">Dashboard</a></li>
						<?php endif;?>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="far fa-envelope"></i>
								<span class="label label-success">0</span>
							</a>
							<ul class="dropdown-menu">
								<li></li>
							</ul>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="far fa-bell"></i>
								<span class="label label-warning">0</span>
							</a>
							<ul class="dropdown-menu">
								<li></li>
							</ul>
						</li>
					<?php endif;?>
						<!-- <li class="dropdown">
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
						</li> -->
					</ul>
					<?php echo isset($search) ? $search : '';?>
				</div> <!-- #my_menu -->
			</div>
		</nav>
		
		<!-- navbar (menu, user, cart) -->
	</div>