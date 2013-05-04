<?php $params = array(); if(isset($id)) $params[0] = $id; ?>
<form method='POST' action='<?= Asset::create_url('Testimonial',$action,$params) ?>'>
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
	<?php if(isset($fields) && isset($fields['name'])):?>
		<p class='error'><?php echo $fields['name']?></p>
	<?php endif;?>
	<div>
		<label for='name'>name</label>
		<input type='text' id='name' name='name' value='<?php if(isset($name)) echo $name; ?>' />
	</div>
	<?php if(isset($fields) && isset($fields['photo'])):?>
		<p class='error'><?php echo $fields['photo']?></p>
	<?php endif;?>
	<div>
		<label for='photo'>photo</label>
		<input type='text' id='photo' name='photo' value='<?php if(isset($photo)) echo $photo; ?>' />
	</div>
	<?php if(isset($fields) && isset($fields['content'])):?>
		<p class='error'><?php echo $fields['content']?></p>
	<?php endif;?>
	<div>
		<label for='content'>content</label>
		<input type='text' id='content' name='content' value='<?php if(isset($content)) echo $content; ?>' />
	</div>
	<input type='submit' value='save' />
</form>
