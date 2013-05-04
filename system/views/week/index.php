<div class='table'>
	<div class='row'>
		<div class='col'>id</div>
		<div class='col'>name</div>
	</div>
	<?php foreach($weeks as $week):?>
		<div class='row'>
			<div class='col'>
				<?php echo $week['id'] ?>
			</div>
			<div class='col'>
				<?php echo $week['name'] ?>
			</div>
		</div>
	<?php endforeach ?>
</div>