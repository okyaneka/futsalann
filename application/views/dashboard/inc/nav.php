<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?php echo base_url('assets/images/profiles/'.$user['meta']['photo']);?>" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?php echo $user['meta']['firstname'].' '.$user['meta']['lastname'];?></p>
				<a><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<?php echo $sidebar;?>
	</section>
	<!-- /.sidebar -->
</aside>