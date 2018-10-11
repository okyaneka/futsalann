	<div id="footer" class="container-fluid">
		<div class="container">
			<div class="col-md-4">
				<div class="widget">
					<h3 class="title">User</h3>
					<ul>
						<li><a href="#">Login</a></li>
						<li><a href="#">Logout</a></li>
						<li><a href="#">Edit profile</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-4">
				<div class="widget">
					<h3 class="title">Customer</h3>
					<ul>
						<li><a href="#">Register</a></li>
						<li><a href="#"></a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-4">
				<div class="widget">
					<h3 class="title">Renter</h3>
					<ul>
						<li><a href="#">Register</a></li>
						<li><a href="#">CRUD field</a></li>
						<li><a href="#">Set dayoff</a></li>
					</ul>
				</div>
			</div>
		</div>
		<nav class="navbar-inverse row">
			<div class="container">
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a>
							<span>Page rendered in <strong>{elapsed_time}</strong> seconds, using memory <strong>{memory_usage}</strong>. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></span>
						</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
	<?php my_foot(); ?>
</body>
</html>