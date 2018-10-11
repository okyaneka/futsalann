<?php $this->load->view('inc/header');?>
<div class="container">
	<?php echo bootstrap_breadcrumb($breadcrumb); ?>
</div>

<div id="content" class="container">
	<div class="col-md-4 col-md-offset-8">
		<?php echo $main; ?>
	</div>
</div>
<?php $this->load->view('inc/footer');