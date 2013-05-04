<?php $params = array(); if(isset($id)) $params[0] = $id; ?>
<form method='POST' action='<?= Asset::create_url('TeamMember',$action,$params) ?>'>
	<?php if(isset($id)):?>
		<?php if(isset($fields) && isset($fields['id'])):?>
			<p class='error'><?php echo $fields['id']?></p>
		<?php endif;?>
		<div>
			<label for='id'>id</label>
			<input type='text' id='id' name='id' size='11' value='<?php if(isset($id)) echo $id; ?>' />
		</div>
	<?php endif;?>
	<?php if(isset($fields) && isset($fields['team_id'])):?>
		<p class='error'><?php echo $fields['team_id']?></p>
	<?php endif;?>
	<div>
		<label for='team_id'>team_id</label>
		<input type='text' id='team_id' name='team_id' size='11' value='<?php if(isset($team_id)) echo $team_id; ?>' />
	</div>
	<?php if(isset($fields) && isset($fields['member_id'])):?>
		<p class='error'><?php echo $fields['member_id']?></p>
	<?php endif;?>
	<div>
		<label for='member_id'>member_id</label>
		<input type='text' id='member_id' name='member_id' size='11' value='<?php if(isset($member_id)) echo $member_id; ?>' />
	</div>
	<?php if(isset($fields) && isset($fields['team_member_type_id'])):?>
		<p class='error'><?php echo $fields['team_member_type_id']?></p>
	<?php endif;?>
	<div>
		<label for='team_member_type_id'>team_member_type_id</label>
		<input type='text' id='team_member_type_id' name='team_member_type_id' size='11' value='<?php if(isset($team_member_type_id)) echo $team_member_type_id; ?>' />
	</div>
	<input type='submit' value='save' />
</form>
