<div class="row">
	<div class="bucket cols">
		<h1>Edit <?php if(isset($name)) echo $name; ?> Team Page</h1>
<?php
	$team['action'] = 'update';
	$params = isset($errors)?array_merge($team, $errors):$team;
	View::render('team/_form',$params);
?>