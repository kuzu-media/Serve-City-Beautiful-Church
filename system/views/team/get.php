<div class="row">
	<div class="cols bucket">
		<h1><?php echo $team['name']?></h1>
		<iframe width="560" height="315" src="<?php echo $team['video']?>" frameborder="0" allowfullscreen></iframe>
		<p><?php echo $team['content']?></p>
	</div>
</div>
<?php if($testimonials): ?>
	<div class="row">
		<h2>Testimonials</h2>
	</div>
	<?php foreach($testimonials as $i=>$testimonial):?>
		<?php if($i%3 === 0 ) echo '<div class="row">' ?>
		<div class="cols col-4">
			<div class="bucket">
				<?php echo Asset::img($testimonial['photo']) ?>
				<h3><?php echo $testimonial['name'] ?></h3>
				<p><?php echo $testimonial['content']?></p>
			</div>
		</div>
		<?php if($i%3 === 2 ) echo '</div>' ?>
	<?php endforeach;?>
	<?php if($i%3 !== 2) echo '</div>' ?>
<?php endif;?>