<?php
	$team['action'] = 'update';
	$params = isset($errors)?array_merge($team, $errors):$team;
	View::render('team/_form',$params);
?>