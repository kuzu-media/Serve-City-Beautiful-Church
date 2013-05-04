<?php $params = array(); if(isset($id)) $params[0] = $id; ?>
<form method='POST' action='<?= Asset::create_url('ShiftMember',$action,$params) ?>'>
	<?php if(isset($id)):?>
		<?php if(isset($fields) && isset($fields['id'])):?>
			<p class='error'><?php echo $fields['id']?></p>
		<?php endif;?>
		<div>
			<label for='id'>id</label>
			<input type='text' id='id' name='id' size='11' value='<?php if(isset($id)) echo $id; ?>' />
		</div>
	<?php endif;?>
	<?php if(isset($fields) && isset($fields['shift_id'])):?>
		<p class='error'><?php echo $fields['shift_id']?></p>
	<?php endif;?>
	<div>
		<label for='shift_id'>shift_id</label>
		<input type='text' id='shift_id' name='shift_id' size='11' value='<?php if(isset($shift_id)) echo $shift_id; ?>' />
	</div>
	<?php if(isset($fields) && isset($fields['member_id'])):?>
		<p class='error'><?php echo $fields['member_id']?></p>
	<?php endif;?>
	<div>
		<label for='member_id'>member_id</label>
		<input type='text' id='member_id' name='member_id' size='11' value='<?php if(isset($member_id)) echo $member_id; ?>' />
	</div>
	<?php if(isset($fields) && isset($fields['shift_member_type_id'])):?>
		<p class='error'><?php echo $fields['shift_member_type_id']?></p>
	<?php endif;?>
	<div>
		<label for='shift_member_type_id'>shift_member_type_id</label>
		<input type='text' id='shift_member_type_id' name='shift_member_type_id' size='11' value='<?php if(isset($shift_member_type_id)) echo $shift_member_type_id; ?>' />
	</div>
	<input type='submit' value='save' />
</form>
