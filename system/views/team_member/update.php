<?php
	$team_member['action'] = 'update';
	$params = isset($errors)?array_merge($team_member, $errors):$team_member;
	View::render('team_member/_form',$params);
?>