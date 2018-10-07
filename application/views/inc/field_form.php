
		<div class="container-fluid m-b-15">
			<!-- left -->
			<div>
				
			</div>
			<!-- right -->
			<div class="pull-right">
					<a href="#" class="btn btn-default">Tampilan</a>
				<div class="btn-group">
					<button type="submit" class="btn btn-primary">Terbitkan</button>
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-cog"></i>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#">Simpan draf</a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="form-group">
			<input id="name" type="text" name="name" placeholder="Nama produk" class="form-control">
		</div>

		<div class="form-group">
			<label for="description">Deskripsi produk</label>
			<input id="description" type="textarea" name="description" placeholder="Deskripsi produk">
		</div>
		<script type="text/javascript">	
			$(function () {
				CKEDITOR.replace( "description" );
			})
		</script>

		<div class="container-fluid">
			<div class="col-md-3">
				<ul class="nav nav-pills nav-stacked">
			  		<li><a data-toggle="tab" href="#price" class="active">Harga</a></li>
					<li><a data-toggle="tab" href="#resource">Resources</a></li>
					<li><a data-toggle="tab" href="#facility">Fasilitas</a></li>
					<li><a data-toggle="tab" href="#address">Alamat</a></li>
				</ul>
			</div>
			<div class="col-md-9">
			  	<div class="tab-content">
			    	<div id="price" class="tab-pane fade in active">
			    		<h3>Menu 1</h3>
						<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
					</div>
				</div>
			</div>
		</div>
		</div>