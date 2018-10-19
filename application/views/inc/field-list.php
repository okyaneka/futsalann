<?php foreach ($fields as $field) : ?>
<div class="field field-<?php echo $field['id'];?> col-md-4 p-x-10 m-b-15">
	<div class="field-wrapper">
		<div class="field-images img-wrapper">
			<a href="<?php echo base_url('field/view/'.$field['id']);?>">
				<img src="<?php echo base_url('assets/images/uploads/'.$field['image']);?>">
			</a>
		</div>
		<div class="container-fluid">
			<div class="field-content p-y-10">
				<p class="field-floor m-0"><a class="col-main" href="#" data-floor="<?php echo $field['option']['floor'];?>"><?php echo $field['option']['floor'];?></a></p>
				<h4 class="field-name m-t-5"><a href="<?php echo base_url('field/view/'.$field['id']);?>"><?php echo ucfirst($field['name']);?></a></h4>
			</div>
			<div class="field-order">

				<div class="field-price m-15">
					<p class="m-b-5">Mulai dari:</p>
					<h3 class="baseprice m-0">Rp. <?php echo price_format($field['baseprice']);?></h3>
				</div>
				<div class="bg-main text-center p-10">
					<a class="order-now" href="<?php echo base_url('book/field/'.$field['id']);?>">PESAN SEKARANG</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endforeach;?>
