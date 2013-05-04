<?php $params = array(); if(isset($id)) $params[0] = $id; ?>
<form method='POST' action='<?= Asset::create_url('Date',$action,$params) ?>'>
	<?php if(isset($id)):?>
		<?php if(isset($fields) && isset($fields['id'])):?>
			<p class='error'><?php echo $fields['id']?></p>
		<?php endif;?>
		<div>
			<label for='id'>id</label>
			<input type='text' id='id' name='id' size='11' value='<?php if(isset($id)) echo $id; ?>' />
		</div>
	<?php endif;?>
	<?php if(isset($fields) && isset($fields['date'])):?>
		<p class='error'><?php echo $fields['date']?></p>
	<?php endif;?>
	<div>
		<label for='date'>date</label>
		<input type='text' id='date' name='date' value='<?php if(isset($date)) echo $date; ?>' />
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
