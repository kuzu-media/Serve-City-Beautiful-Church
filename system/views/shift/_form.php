<?php $params = array(); if(isset($id)) $params[0] = $id; ?>
<form method='POST' action='<?= Asset::create_url('Shift',$action,$params) ?>'>
	<?php if(isset($id)):?>
		<?php if(isset($fields) && isset($fields['id'])):?>
			<p class='error'><?php echo $fields['id']?></p>
		<?php endif;?>
		<div>
			<label for='id'>id</label>
			<input type='text' id='id' name='id' size='11' value='<?php if(isset($id)) echo $id; ?>' />
		</div>
	<?php endif;?>
	<?php if(isset($fields) && isset($fields['date_id'])):?>
		<p class='error'><?php echo $fields['date_id']?></p>
	<?php endif;?>
	<div>
		<label for='date_id'>date_id</label>
		<input type='text' id='date_id' name='date_id' size='11' value='<?php if(isset($date_id)) echo $date_id; ?>' />
	</div>
	<?php if(isset($fields) && isset($fields['team_id'])):?>
		<p class='error'><?php echo $fields['team_id']?></p>
	<?php endif;?>
	<div>
		<label for='team_id'>team_id</label>
		<input type='text' id='team_id' name='team_id' size='11' value='<?php if(isset($team_id)) echo $team_id; ?>' />
	</div>
	<?php if(isset($fields) && isset($fields['time'])):?>
		<p class='error'><?php echo $fields['time']?></p>
	<?php endif;?>
	<div>
		<label for='time'>time</label>
		<input type='text' id='time' name='time' value='<?php if(isset($time)) echo $time; ?>' />
	</div>
	<?php if(isset($fields) && isset($fields['notes'])):?>
		<p class='error'><?php echo $fields['notes']?></p>
	<?php endif;?>
	<div>
		<label for='notes'>notes</label>
		<input type='text' id='notes' name='notes' value='<?php if(isset($notes)) echo $notes; ?>' />
	</div>
	<input type='submit' value='save' />
</form>
