<?php
	$shift_member['action'] = 'update';
	$params = isset($errors)?array_merge($shift_member, $errors):$shift_member;
	View::render('shift_member/_form',$params);
?>