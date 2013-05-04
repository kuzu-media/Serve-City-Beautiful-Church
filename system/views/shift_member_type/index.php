<div class='table'>
	<div class='row'>
		<div class='col'>id</div>
		<div class='col'>name</div>
	</div>
	<?php foreach($shift_member_types as $shift_member_type):?>
		<div class='row'>
			<div class='col'>
				<?php echo $shift_member_type['id'] ?>
			</div>
			<div class='col'>
				<?php echo $shift_member_type['name'] ?>
			</div>
		</div>
	<?php endforeach ?>
</div>