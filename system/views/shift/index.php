<div class='table'>
	<div class='row'>
		<div class='col'>id</div>
		<div class='col'>date_id</div>
		<div class='col'>team_id</div>
		<div class='col'>time</div>
		<div class='col'>notes</div>
	</div>
	<?php foreach($shifts as $shift):?>
		<div class='row'>
			<div class='col'>
				<?php echo $shift['id'] ?>
			</div>
			<div class='col'>
				<?php echo $shift['date_id'] ?>
			</div>
			<div class='col'>
				<?php echo $shift['team_id'] ?>
			</div>
			<div class='col'>
				<?php echo $shift['time'] ?>
			</div>
			<div class='col'>
				<?php echo $shift['notes'] ?>
			</div>
		</div>
	<?php endforeach ?>
</div>