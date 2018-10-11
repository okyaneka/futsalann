<!-- Main row -->
<div class="row">
	<div class="container-fluid">
		<div class="col-md-4">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Tambah fasilitas</h3>
				</div>
				<div class="box-body">
					<?php echo $form;?>				
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<form method="POST" action="<?php echo base_url('field/facility/delete');?>">
				<div class="m-b-15">
					<button class="btn btn-danger" type="submit">Hapus data terpilih</button>
				</div>
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Daftar fasilitas</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<?php echo $table;?>
					</div>
					<!-- /.box-body -->
				</div>
			</form>
		</div>
	</div>
	<!-- /.box -->
</div>
<!-- /.row (main row) -->
