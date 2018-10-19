<form method="POST" action="<?php echo base_url('field/delete');?>">
	<!-- Main row -->
	<div class="row">
		<div class="container-fluid">
			<div class="m-b-15">
				<a class="btn btn-default" href="<?php echo base_url('field/add');?>">Tambah baru</a>
				<button class="btn btn-danger" type="submit">Hapus data terpilih</button>
			</div>
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Daftar lapangan</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
						<?php echo $table;?>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
		</div>
		<!-- /.box -->
	</div>
	<!-- /.row (main row) -->
</form>