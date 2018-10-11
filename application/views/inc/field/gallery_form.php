<div class="container-fluid row">
	<div class="well text-center">
		<div class="field-gallery">
			<div class="caption">
				<h3 class="drop-text">Taruh / pilih gambar disini</h3>
				<p>Atau</p>
				<div class="form-group" style="display: inline-block;">
					<input class="file-gallery btn btn-default" type="file" name="file" multiple="multiple">
				</div>
			</div>
			<div class="content">
			<?php if (empty($gallery)) : ?>
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
					<input type="hidden" name="gallery[]" value="<?php echo $photo['id'];?>">
				</div>
			<?php endforeach; endif;?>
		</div>
		</div>
	</div>
</div>