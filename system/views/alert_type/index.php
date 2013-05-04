<div class='table'>
	<div class='row'>
		<div class='col'>id</div>
		<div class='col'>name</div>
	</div>
	<?php foreach($alert_types as $alert_type):?>
		<div class='row'>
			<div class='col'>
				<?php echo $alert_type['id'] ?>
			</div>
			<div class='col'>
				<?php echo $alert_type['name'] ?>
			</div>
		</div>
	<?php endforeach ?>
</div>