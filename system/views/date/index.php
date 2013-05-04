<div class='table'>
	<div class='row'>
		<div class='col'>id</div>
		<div class='col'>date</div>
		<div class='col'>notes</div>
	</div>
	<?php foreach($dates as $date):?>
		<div class='row'>
			<div class='col'>
				<?php echo $date['id'] ?>
			</div>
			<div class='col'>
				<?php echo $date['date'] ?>
			</div>
			<div class='col'>
				<?php echo $date['notes'] ?>
			</div>
		</div>
	<?php endforeach ?>
</div>