<?php $this->load->view('header');?>
  <div id="content" class="container">
      <div class="col-md-3">
      	<?php $this->load->view('sidebar'); ?>
      </div>
      <div class="col-md-9">
      	<div class="col-md-4">
      		<?php echo $main; ?>
      	</div>
      	<div class="col-md-8">
      		<?php echo $secondary; ?>
      	</div>
      </div>
  </div>
<?php $this->load->view('footer');