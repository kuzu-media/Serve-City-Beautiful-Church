<div class="row">
	<div class="cols bucket">
		<h1>New Testimonial</h1>
		<?php $params = array(); if(isset($id)) $params[0] = $id; ?>
		<form method='POST' action='<?=$_SERVER['REQUEST_URI'] ?>'  enctype="multipart/form-data">
			<?php if(isset($id)):?>
				<?php if(isset($fields) && isset($fields['id'])):?>
					<p class='error'><?php echo $fields['id']?></p>
				<?php endif;?>
				<div>
					<label for='id'>id</label>
					<input type='text' id='id' name='id' size='11' value='<?php if(isset($id)) echo $id; ?>' />
				</div>
			<?php endif;?>
			<?php if(!$team_id):?>
				<?php if(isset($fields) && isset($fields['team_id'])):?>
					<p class='error'><?php echo $fields['team_id']?></p>
				<?php endif;?>
				<div>
					<label for='team_id'>team_id</label>
					<input type='text' id='team_id' name='team_id' size='11' value='<?php if(isset($team_id)) echo $team_id; ?>' />
				</div>
			<?php endif;?>
			<?php if(isset($fields) && isset($fields['name'])):?>
				<p class='error'><?php echo $fields['name']?></p>
			<?php endif;?>
			<div>
				<label for='name'>Name:</label>
				<input type='text' id='name' name='name' value='<?php if(isset($name)) echo $name; ?>' />
			</div>
			<?php if(isset($fields) && isset($fields['photo'])):?>
				<p class='error'><?php echo $fields['photo']?></p>
			<?php endif;?>
			<div>
				<label for='photo'>Photo:</label>
				<input type='file' id='photo' name='photo' value='<?php if(isset($photo)) echo $photo; ?>' />
			</div>
			<?php if(isset($fields) && isset($fields['content'])):?>
				<p class='error'><?php echo $fields['content']?></p>
			<?php endif;?>
			<div>
				<label for='content'>Content:</label>
				<textarea name="content" id="content" cols="30" rows="10"><?php if(isset($content)) echo $content; ?></textarea>
			</div>
			<div class="row">
				<div class="col-6">
				<input type='submit' value='save' class="button" />
				</div>
			</div>
		</form>
	</div>
</div>
