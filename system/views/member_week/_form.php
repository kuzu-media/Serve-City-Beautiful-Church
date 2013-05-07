<?php $params = array(); if(isset($id)) $params[0] = $id; ?>
<form method='POST' action='<?= Asset::create_url('MemberWeek',$action,$params) ?>'>
	<?php if(isset($id)):?>
		<?php if(isset($fields) && isset($fields['id'])):?>
			<p class='error'><?php echo $fields['id']?></p>
		<?php endif;?>
		<div>
			<label for='id'>id</label>
			<input type='text' id='id' name='id' size='11' value='<?php if(isset($id)) echo $id; ?>' />
		</div>
	<?php endif;?>
	<?php if(isset($fields) && isset($fields['member_id'])):?>
		<p class='error'><?php echo $fields['member_id']?></p>
	<?php endif;?>
	<div>
		<label for='member_id'>member_id</label>
		<input type='text' id='member_id' name='member_id' size='11' value='<?php if(isset($member_id)) echo $member_id; ?>' />
	</div>
	<?php if(isset($fields) && isset($fields['week_id'])):?>
		<p class='error'><?php echo $fields['week_id']?></p>
	<?php endif;?>
	<div>
		<label for='week_id'>week_id</label>
		<input type='text' id='week_id' name='week_id' size='11' value='<?php if(isset($week_id)) echo $week_id; ?>' />
	</div>
	<input type='submit' value='save' />
</form>
