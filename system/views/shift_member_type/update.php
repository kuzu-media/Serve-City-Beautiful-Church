<?php
	$shift_member_type['action'] = 'update';
	$params = isset($errors)?array_merge($shift_member_type, $errors):$shift_member_type;
	View::render('shift_member_type/_form',$params);
?>