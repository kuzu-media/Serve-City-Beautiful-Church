<div class='table'>
	<div class='row'>
		<div class='col'>id</div>
		<div class='col'>shift_id</div>
		<div class='col'>member_id</div>
		<div class='col'>shift_member_type_id</div>
	</div>
	<?php foreach($shift_members as $shift_member):?>
		<div class='row'>
			<div class='col'>
				<?php echo $shift_member['id'] ?>
			</div>
			<div class='col'>
				<?php echo $shift_member['shift_id'] ?>
			</div>
			<div class='col'>
				<?php echo $shift_member['member_id'] ?>
			</div>
			<div class='col'>
				<?php echo $shift_member['shift_member_type_id'] ?>
			</div>
		</div>
	<?php endforeach ?>
</div>