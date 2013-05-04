<?php
	$team_member_type['action'] = 'update';
	$params = isset($errors)?array_merge($team_member_type, $errors):$team_member_type;
	View::render('team_member_type/_form',$params);
?>