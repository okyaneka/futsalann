<input id="field_id" type="hidden" name="field_id" value="<?php echo isset($id) ? $id : '';?>">

<div class="form-group">
	<input id="name" type="text" name="name" placeholder="Nama produk" class="form-control" value="<?php echo isset($name) ? $name : '' ;?>">
</div>

<div class="form-group">
	<label for="description">Deskripsi produk</label>
	<textarea id="description" name="description">
		<?php echo isset($description) ? $description : '' ; ?>
	</textarea>


</div>
<script type="text/javascript">	
	$(function () {
		CKEDITOR.replace( "description" );
	})
</script>