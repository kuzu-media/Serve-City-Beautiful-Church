<div class='table'>
	<div class='row'>
		<div class='col'>id</div>
	</div>
	<?php foreach($member_weeks as $member_week):?>
		<div class='row'>
			<div class='col'>
				<?php echo $member_week['id'] ?>
			</div>
		</div>
	<?php endforeach ?>
</div>