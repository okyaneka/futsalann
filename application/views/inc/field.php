<!-- 
	Nama
	Galeri
	Deskripsi
	Fasilitas
	Tipe lantai
-->
<?php // echo '<pre>'.print_r($field,TRUE).'</pre>'; ?>
<div class="row m-b-20">
	<div class="col-md-4">
		<div id="slider" class="flexslider">
			<ul class="slides">	
				<?php foreach ($gallery as $value) : ?>
					<li class="field-image field-image-<?php echo $value['id'];?>" data-thumb="<?php echo base_url('assets/images/uploads/'.$value['file']);?>"><img src="<?php echo base_url('assets/images/uploads/'.$value['file']);?>"></li>
				<?php endforeach;?>
			</ul>
		</div>
	</div>
	<div class="col-md-6">
		<h1><?php echo $name;?></h1>
		<!-- <p><i class="fa fa-star"></i></p> -->
		<h4 class="col-main"><strong><?php echo $option['floor'];?></strong></h4>
		<div class="price m-b-20">
			<p>Harga mulai:</p>
			<h3 class="m-t-0"><span class="baseprice">Rp. <?php echo price_format($baseprice);?></span><small> per jam</small></h3>
		</div>
		<div class="custom-price m-b-20">
			<?php if ( ! empty($price)) :?>
			<p>Harga khusus:</p>
			<div class="table-responsive">
				<table class="table table-striped">
					<tbody>
						<?php foreach ($price as $value) : ?>
							<tr>
								<td><?php echo $value['type'];?></td>
								<td><?php echo $value['start'];?></td>
								<td>s/d</td>
								<td><?php echo $value['end'];?></td>
								<td>Rp. <?php echo price_format($value['price'] + $baseprice);?><small> per jam</small></td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
			<?php endif;?>
		</div>
		<a class="col-white p-x-20 p-y-10 bg-main text-center" href="<?php echo base_url('book/field/'.$id);?>" style="display: inline-block;">BOOKING SEKARANG</a>
		<div class="futsalann-address m-y-20">
			<p>Alamat : <?php echo implode(', ', $address);?></p>
			<div class="map"></div>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBP3oSzIvGSkO3CsoWbhmVvHfq_dHm2A3U"
    async defer></script>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-default panel-renter">
			<div class="panel-body p-x-5">
				<div class="text-center">
					<p><img class="img-responsive" src="<?php echo base_url('assets/images/profiles/'.$user['photo']);?>"></p>
					<p><?php echo $user['firstname'].' '.$user['lastname'];?></p>
					<p><i class="fa fa-map-marker-alt"></i> <?php echo $user['city'];?></p>
					<hr>
					<a class="btn btn-default" href="#"><i class="far fa-comment"></i> Chat renter</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-md-10">
	<div class="futsalann-tab">
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#description"><i class="fa fa-info p-r-10"></i> Informasi Lapangan</a></li>
			<li><a data-toggle="tab" href="#review"><i class="fa fa-star p-r-10"></i> Ulasan ()</a></li>
			<li><a data-toggle="tab" href="#discuss"><i class="fa fa-comments p-r-10"></i> Diskusi Lapangan ()</a></li>
		</ul>

		<div class="tab-content">
			<div id="description" class="tab-pane fade in active">
				<?php echo $description;?>
				<h4>Fasilitas</h4>
				<ul>
					<?php foreach ($facility as $value) : ?>
					<li><?php echo $value['name'];?></li>
					<?php endforeach;?>
				</ul>
			</div>
			<div id="review" class="tab-pane fade">
				<h3>Ulasan ()</h3>
				<p>Some content in menu 1.</p>
			</div>
			<div id="discuss" class="tab-pane fade">
				<h3>Diskusi lapangan ()</h3>
				<p>Some content in menu 2.</p>
			</div>
		</div>
	</div>
</div>