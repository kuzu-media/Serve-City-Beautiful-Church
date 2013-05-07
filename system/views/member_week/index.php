<div class='table'>
	<div class='row'>
		<div class='col'>id</div>
		<div class='col'>member_id</div>
		<div class='col'>week_id</div>
	</div>
	<?php foreach($member_weeks as $member_week):?>
		<div class='row'>
			<div class='col'>
				<?php echo $member_week['id'] ?>
			</div>
			<div class='col'>
				<?php echo $member_week['member_id'] ?>
			</div>
			<div class='col'>
				<?php echo $member_week['week_id'] ?>
			</div>
		</div>
	<?php endforeach ?>
</div>