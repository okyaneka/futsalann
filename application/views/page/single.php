<?php $this->load->view('inc/header');?>
<div class="container">
	<?php echo bootstrap_breadcrumb($breadcrumb); ?>
</div>

<div id="content" class="container">
  <div class="col-md-9">
  	<?php echo $main; ?>
  </div>
  <div class="col-md-3">
  	<?php $this->load->view('inc/sidebar'); ?>
  </div>
</div>
<?php $this->load->view('inc/footer');