<div class='table'>
	<div class='row'>
		<div class='col'>id</div>
		<div class='col'>team_id</div>
		<div class='col'>name</div>
		<div class='col'>photo</div>
		<div class='col'>content</div>
	</div>
	<?php foreach($testimonials as $testimonial):?>
		<div class='row'>
			<div class='col'>
				<?php echo $testimonial['id'] ?>
			</div>
			<div class='col'>
				<?php echo $testimonial['team_id'] ?>
			</div>
			<div class='col'>
				<?php echo $testimonial['name'] ?>
			</div>
			<div class='col'>
				<?php echo $testimonial['photo'] ?>
			</div>
			<div class='col'>
				<?php echo $testimonial['content'] ?>
			</div>
		</div>
	<?php endforeach ?>
</div>