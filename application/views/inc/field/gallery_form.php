<div class="container-fluid row">
	<div class="well text-center">
		<div class="field-gallery">
		<?php if (empty($gallery)) : ?>
			<h3 class="drop-text">Taruh / pilih gambar disini</h3>
		<?php else : 
			foreach ($gallery as $photo) : ?>
			<div class="thumbnail pull-left text-center m-10">
				<a href="<?php echo base_url('assets/images/uploads/'.$photo['file']); ?>" target="_blank">
					<img src="<?php echo base_url('assets/images/uploads/'.$photo['file']); ?>" alt="<?php echo $photo['file']; ?>">
				</a>
				<?php if ($photo['main'] == TRUE) : ?>
					<a class="setmain btn btn-sm ismain disabled btn-default" href="#" data-id="<?php echo $photo['id'];?>">Main</a>
				<?php else : ?>
					<a class="setmain btn btn-sm btn-primary" href="#" data-id="<?php echo $photo['id'];?>">Set main</a>
				<?php endif; ?>
				<a class="delete btn btn-sm btn-danger" href="#" data-id="<?php echo $photo['id'];?>">Hapus</a>
			</div>
		<?php endforeach; endif;?>
		</div>
	</div>
</div>