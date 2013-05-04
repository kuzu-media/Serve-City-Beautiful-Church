<?php $params = array(); if(isset($id)) $params[0] = $id; ?>
<form method='POST' action='<?= Asset::create_url('Member',$action,$params) ?>'>
	<?php if(isset($id)):?>
		<?php if(isset($fields) && isset($fields['id'])):?>
			<p class='error'><?php echo $fields['id']?></p>
		<?php endif;?>
		<div>
			<label for='id'>id</label>
			<input type='text' id='id' name='id' size='11' value='<?php if(isset($id)) echo $id; ?>' />
		</div>
	<?php endif;?>
	<?php if(isset($fields) && isset($fields['facebook_id'])):?>
		<p class='error'><?php echo $fields['facebook_id']?></p>
	<?php endif;?>
	<div>
		<label for='facebook_id'>facebook_id</label>
		<input type='text' id='facebook_id' name='facebook_id' size='11' value='<?php if(isset($facebook_id)) echo $facebook_id; ?>' />
	</div>
	<?php if(isset($fields) && isset($fields['name'])):?>
		<p class='error'><?php echo $fields['name']?></p>
	<?php endif;?>
	<div>
		<label for='name'>name</label>
		<input type='text' id='name' name='name' value='<?php if(isset($name)) echo $name; ?>' />
	</div>
	<?php if(isset($fields) && isset($fields['email'])):?>
		<p class='error'><?php echo $fields['email']?></p>
	<?php endif;?>
	<div>
		<label for='email'>email</label>
		<input type='text' id='email' name='email' value='<?php if(isset($email)) echo $email; ?>' />
	</div>
	<?php if(isset($fields) && isset($fields['phone'])):?>
		<p class='error'><?php echo $fields['phone']?></p>
	<?php endif;?>
	<div>
		<label for='phone'>phone</label>
		<input type='text' id='phone' name='phone' value='<?php if(isset($phone)) echo $phone; ?>' />
	</div>
	<?php if(isset($fields) && isset($fields['profile_pic'])):?>
		<p class='error'><?php echo $fields['profile_pic']?></p>
	<?php endif;?>
	<div>
		<label for='profile_pic'>profile_pic</label>
		<textarea id='profile_pic' name='profile_pic'><?php if(isset($profile_pic)) echo $profile_pic; ?></textarea>
	</div>
	<?php if(isset($fields) && isset($fields['times'])):?>
		<p class='error'><?php echo $fields['times']?></p>
	<?php endif;?>
	<div>
		<label for='times'>times</label>
		<input type='text' id='times' name='times' size='1' value='<?php if(isset($times)) echo $times; ?>' />
	</div>
	<?php if(isset($fields) && isset($fields['reminder_day_id'])):?>
		<p class='error'><?php echo $fields['reminder_day_id']?></p>
	<?php endif;?>
	<div>
		<label for='reminder_day_id'>reminder_day_id</label>
		<input type='text' id='reminder_day_id' name='reminder_day_id' size='1' value='<?php if(isset($reminder_day_id)) echo $reminder_day_id; ?>' />
	</div>
	<?php if(isset($fields) && isset($fields['member_type_id'])):?>
		<p class='error'><?php echo $fields['member_type_id']?></p>
	<?php endif;?>
	<div>
		<label for='member_type_id'>member_type_id</label>
		<input type='text' id='member_type_id' name='member_type_id' size='11' value='<?php if(isset($member_type_id)) echo $member_type_id; ?>' />
	</div>
	<?php if(isset($fields) && isset($fields['alert_type_id'])):?>
		<p class='error'><?php echo $fields['alert_type_id']?></p>
	<?php endif;?>
	<div>
		<label for='alert_type_id'>alert_type_id</label>
		<input type='text' id='alert_type_id' name='alert_type_id' size='10' value='<?php if(isset($alert_type_id)) echo $alert_type_id; ?>' />
	</div>
	<?php if(isset($fields) && isset($fields['login_type_id'])):?>
		<p class='error'><?php echo $fields['login_type_id']?></p>
	<?php endif;?>
	<div>
		<label for='login_type_id'>login_type_id</label>
		<input type='text' id='login_type_id' name='login_type_id' size='11' value='<?php if(isset($login_type_id)) echo $login_type_id; ?>' />
	</div>
	<?php if(isset($fields) && isset($fields['password'])):?>
		<p class='error'><?php echo $fields['password']?></p>
	<?php endif;?>
	<div>
		<label for='password'>password</label>
		<input type='text' id='password' name='password' value='<?php if(isset($password)) echo $password; ?>' />
	</div>
	<input type='submit' value='save' />
</form>
