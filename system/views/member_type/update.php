<?php
	$member_type['action'] = 'update';
	$params = isset($errors)?array_merge($member_type, $errors):$member_type;
	View::render('member_type/_form',$params);
?>