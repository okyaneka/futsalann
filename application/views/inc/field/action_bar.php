<div class="container-fluid m-b-15">
	<!-- left -->
	<div>
		
	</div>
	<!-- right -->
	<div class="pull-right">
		<?php if (isset($id)) : ?>
		<a href="<?php echo base_url('field/view/'.$id);?>" target="_blank" class="btn btn-default">Tampilan</a>
		<?php endif; ?>
		<div class="btn-group">
			<button type="submit" class="btn btn-primary"><?php echo isset($id) ? 'Perbarui' : 'Terbitkan' ; ?></button>
			<a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
				&nbsp;<i class="fa fa-cog"></i>&nbsp;
			</a>
			<ul class="dropdown-menu" role="menu">
				<li><a href="#">Simpan draf</a></li>
			</ul>
		</div>
	</div>
</div>