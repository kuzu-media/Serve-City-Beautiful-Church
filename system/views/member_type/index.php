<div class='table'>
	<div class='row'>
		<div class='col'>id</div>
		<div class='col'>name</div>
	</div>
	<?php foreach($member_types as $member_type):?>
		<div class='row'>
			<div class='col'>
				<?php echo $member_type['id'] ?>
			</div>
			<div class='col'>
				<?php echo $member_type['name'] ?>
			</div>
		</div>
	<?php endforeach ?>
</div>