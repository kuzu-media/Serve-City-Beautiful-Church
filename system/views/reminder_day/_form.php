<?php $params = array(); if(isset($id)) $params[0] = $id; ?>
<form method='POST' action='<?= Asset::create_url('ReminderDay',$action,$params) ?>'>
	<?php if(isset($id)):?>
		<?php if(isset($fields) && isset($fields['id'])):?>
			<p class='error'><?php echo $fields['id']?></p>
		<?php endif;?>
		<div>
			<label for='id'>id</label>
			<input type='text' id='id' name='id' size='11' value='<?php if(isset($id)) echo $id; ?>' />
		</div>
	<?php endif;?>
	<?php if(isset($fields) && isset($fields['name'])):?>
		<p class='error'><?php echo $fields['name']?></p>
	<?php endif;?>
	<div>
		<label for='name'>name</label>
		<input type='text' id='name' name='name' value='<?php if(isset($name)) echo $name; ?>' />
	</div>
	<input type='submit' value='save' />
</form>
