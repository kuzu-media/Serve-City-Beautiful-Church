<div class='table'>
	<div class='row'>
		<div class='col'>id</div>
		<div class='col'>name</div>
	</div>
	<?php foreach($reminder_days as $reminder_day):?>
		<div class='row'>
			<div class='col'>
				<?php echo $reminder_day['id'] ?>
			</div>
			<div class='col'>
				<?php echo $reminder_day['name'] ?>
			</div>
		</div>
	<?php endforeach ?>
</div>