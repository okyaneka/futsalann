<?php $this->load->view('header');?>
<div id="content" class="container">
	<div class="col-md-3">
		<?php $this->load->view('sidebar'); ?>
	</div>
	<div class="col-md-9">
		<?php echo $main; ?>
	</div>
</div>
<?php $this->load->view('footer');