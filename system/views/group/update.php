<div class="row">
	<div class="bucket cols">
		<h1>Edit <?php if(isset($name)) echo $name; ?> Group</h1>
		<?php
			$group['action'] = 'update';
			$params = isset($errors)?array_merge($group, $errors):$group;
			View::render('group/_form',$params);
		?>
	</div>
</div>