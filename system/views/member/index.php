<div class='table'>
	<div class='row'>
		<div class='col'>id</div>
		<div class='col'>facebook_id</div>
		<div class='col'>name</div>
		<div class='col'>email</div>
		<div class='col'>phone</div>
		<div class='col'>profile_pic</div>
		<div class='col'>times</div>
		<div class='col'>reminder_day_id</div>
		<div class='col'>member_type_id</div>
		<div class='col'>alert_type_id</div>
		<div class='col'>login_type_id</div>
		<div class='col'>password</div>
	</div>
	<?php foreach($members as $member):?>
		<div class='row'>
			<div class='col'>
				<?php echo $member['id'] ?>
			</div>
			<div class='col'>
				<?php echo $member['facebook_id'] ?>
			</div>
			<div class='col'>
				<?php echo $member['name'] ?>
			</div>
			<div class='col'>
				<?php echo $member['email'] ?>
			</div>
			<div class='col'>
				<?php echo $member['phone'] ?>
			</div>
			<div class='col'>
				<?php echo $member['profile_pic'] ?>
			</div>
			<div class='col'>
				<?php echo $member['times'] ?>
			</div>
			<div class='col'>
				<?php echo $member['reminder_day_id'] ?>
			</div>
			<div class='col'>
				<?php echo $member['member_type_id'] ?>
			</div>
			<div class='col'>
				<?php echo $member['alert_type_id'] ?>
			</div>
			<div class='col'>
				<?php echo $member['login_type_id'] ?>
			</div>
			<div class='col'>
				<?php echo $member['password'] ?>
			</div>
		</div>
	<?php endforeach ?>
</div>