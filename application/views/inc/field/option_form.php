<div class="container-fluid row">
	<div class="col-md-3 well well-sm">
		<ul class="nav nav-pills nav-stacked">
			<li class="active"><a data-toggle="tab" href="#option">Opsi</a></li>
			<li><a data-toggle="tab" href="#price">Harga</a></li>
			<li><a data-toggle="tab" href="#resource">Resources</a></li>
			<li><a data-toggle="tab" href="#facility">Fasilitas</a></li>
			<li><a data-toggle="tab" href="#address">Alamat</a></li>
		</ul>
	</div>
	<div class="col-md-9 p-r-0">
		<div class="tab-content">
			<!-- price -->
			<div id="price" class="tab-pane fade">
				<div class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-md-4">Harga per jam</label>
						<div class="col-md-6">
							<input class="form-control" type="number" name="baseprice" value="<?php echo isset($baseprice) ? $baseprice : '' ;?>">
						</div>
					</div>
				</div>
				
				<div class="custom-prices">
					<table id="custom-prices" class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Tipe</th>
								<th>Jangkauan</th>
								<th>Harga</th>
								<th>Prioritas</th>
								<th></th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th colspan="5">
									<a href="#" class="btn btn-default add-row">Tambah baris</a>
								</th>
							</tr>
						</tfoot>
						<tbody>
							<?php if ( ! empty($price)) : 
							foreach ($price as $amount) : ?>
								<tr>
									<td>
										<input class="price-id" type="hidden" name="<?php echo 'price['.$amount['id'].'][id]';?>" value="<?php echo $amount['id'];?>">
										<?php echo price_type($amount['id'],$amount['type_id']); ?>
									</td>
									<td>
										<input name="price[<?php echo $amount['id'];?>][start]" type="time" value="<?php echo $amount['start'];?>">s/d<input name="price[<?php echo $amount['id'];?>][end]" type="time" value="<?php echo $amount['end'];?>">
									</td>
									<td>
										<span>[+]</span>
										<input name="price[<?php echo $amount['id'];?>][price]" style="width: 5em" type="number" value="<?php echo $amount['price'];?>">
									</td>
									<td>
										<input name="price[<?php echo $amount['id'];?>][priority]" style="width: 3em" type="number" value="<?php echo $amount['priority'];?>">
									</td>
									<td>
										<a class="action-link text-danger del-row" href="#">del</a>
									</td>
								</tr>
							<?php endforeach; endif;?>
						</tbody>
					</table>
				</div>
			</div>
			<div id="option" class="tab-pane fade in active">
				<div class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-md-4">Buka</label>
						<div class="col-md-6">
							<input class="" type="time" name="option[open]" value="<?php echo $option['open'];?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4">Tutup</label>
						<div class="col-md-6">
							<input class="" type="time" name="option[close]" value="<?php echo $option['close'];?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4">Minimal pesan</label>
						<div class="col-md-6">
							<input class="" type="number" name="option[min_order]" value="<?php echo $option['min_order'];?>" style="width: 4em"> Jam
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4">Maksimal pesan</label>
						<div class="col-md-6">
							<input class="" type="number" name="option[max_order]" value="<?php echo $option['max_order'];?>" style="width: 4em"> Jam
						</div>
					</div>
				</div>
			</div>
			<div id="resource" class="tab-pane fade">
				<div class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-md-4">Label</label>
						<div class="col-md-6">
							<input class="form-control" type="text" name="resname" value="<?php echo $resname;?>">
						</div>
					</div>
				</div>

				<div class="resource">
					<table id="resource" class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Nama</th>
								<th>Harga</th>
								<th></th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th colspan="3">
									<a href="#" class="btn btn-default add-row">Tambah baris</a>
								</th>
							</tr>
						</tfoot>
						<tbody>
							<?php foreach ($resource as $res) : ?>
								<tr>
									<td>
										<input class="res-id" type="hidden" name="<?php echo 'res['.$res['id'].'][id]';?>" value="<?php echo $res['id'];?>">
										<input name="res[<?php echo $res['id'];?>][name]" type="text" value="<?php echo $res['name'];?>">
									</td>
									<td>
										<span>[+]</span><input name="res[<?php echo $res['id'];?>][price]" type="number" value="<?php echo $res['price'];?>">
									</td>
									<td>
										<a class="action-link text-danger del-row" href="#" style="width:3em">del</a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>	
			</div>
			<div id="facility" class="tab-pane fade">
				<div class="facility">
					<div class="well">
						<?php if (count($facility) == 0) : ?>
						<span>Belum terdapat fasilitas</span>
						<?php else : foreach ($facility as $item) : ?>
							<p class="p-x-10 facility-name facility-<?php echo $item['id']; ?>">
								<?php echo $item['name']; ?>
								<a class="remove-facility remove-facility-<?php echo $item['id']; ?> m-l-10" href="#">
									<span class="badge">x</span>
								</a>
							</p>
							<input class="facility-form facility-<?php echo $item['id']; ?>" name="facility[<?php echo $item['id']; ?>]" value="<?php echo $item['name']; ?>" type="hidden">
						<?php endforeach; endif; ?>
					</div>
					<div class="form-horizontal">
						<div class="form-group">
							<div class="col-md-4">
								<input class="form-control facility-input" type="text" data-toggle="tooltip" data-placement="top">
							</div>
							<a href="#" class="btn btn-default add-facility">Tambah</a>
						</div>
					</div>
				</div>
			</div>
			<div id="address" class="tab-pane fade">
				<div class="address">
					<div class="form-group container-fluid">
						<div class="checkbox">
							<label><input class="equal-to-user-address" type="checkbox">Sama dengan alamat pengguna</label>
						</div>
					</div>
					<div class="form-group col-md-6">
						<label for="street">Jalan</label>
						<input id="street" class="form-control" type="text" name="address[street]" value="<?php echo $address['street']; ?>">
					</div>
					<div class="form-group col-md-4">
						<label for="district">Kecamatan</label>
						<input id="district" class="form-control" type="text" name="address[district]" value="<?php echo $address['district']; ?>">
					</div>
					<div class="form-group col-md-4">
						<label for="city">Kabupaten / kota</label>
						<input id="city" class="form-control" type="text" name="address[city]" value="<?php echo $address['city']; ?>">
					</div>
					<div class="form-group col-md-3">
						<label for="zip">Kode pos</label>
						<input id="zip" class="form-control" type="text" name="address[zip]" value="<?php echo $address['zip']; ?>">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>