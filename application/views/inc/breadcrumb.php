<div class="banner-top">
	<div class="container">
		<h1><?php echo $title;?></h1>
		<em></em>
		<h2>
			<a href="<?php echo base_url();?>">Home</a>
			<label>/</label>

			<?php if (isset($segment) && ! empty($segment)) : foreach ($segment as $item) : ?>
			<a href="<?php echo $item['url'];?>"><?php echo $item['title'];?></a>
			<label>/</label>
			<?php endforeach; endif;?>

			<?php echo $title;?>
		</h2>
	</div>
</div>