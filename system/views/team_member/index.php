<div class='table'>
	<div class='row'>
		<div class='col'>id</div>
		<div class='col'>team_id</div>
		<div class='col'>member_id</div>
		<div class='col'>team_member_type_id</div>
	</div>
	<?php foreach($team_members as $team_member):?>
		<div class='row'>
			<div class='col'>
				<?php echo $team_member['id'] ?>
			</div>
			<div class='col'>
				<?php echo $team_member['team_id'] ?>
			</div>
			<div class='col'>
				<?php echo $team_member['member_id'] ?>
			</div>
			<div class='col'>
				<?php echo $team_member['team_member_type_id'] ?>
			</div>
		</div>
	<?php endforeach ?>
</div>