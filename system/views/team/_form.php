<?php $params = array(); if(isset($id)) $params[0] = $id; ?>
<form method='POST' action='<?= Asset::create_url('Team',$action,$params) ?>'>
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
	<?php if(isset($fields) && isset($fields['photo'])):?>
		<p class='error'><?php echo $fields['photo']?></p>
	<?php endif;?>
	<div>
		<label for='photo'>photo</label>
		<input type='text' id='photo' name='photo' value='<?php if(isset($photo)) echo $photo; ?>' />
	</div>
	<?php if(isset($fields) && isset($fields['summary'])):?>
		<p class='error'><?php echo $fields['summary']?></p>
	<?php endif;?>
	<div>
		<label for='summary'>summary</label>
		<input type='text' id='summary' name='summary' value='<?php if(isset($summary)) echo $summary; ?>' />
	</div>
	<?php if(isset($fields) && isset($fields['video'])):?>
		<p class='error'><?php echo $fields['video']?></p>
	<?php endif;?>
	<div>
		<label for='video'>video</label>
		<input type='text' id='video' name='video' value='<?php if(isset($video)) echo $video; ?>' />
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
