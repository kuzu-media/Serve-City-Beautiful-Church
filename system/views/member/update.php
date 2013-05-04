<?php
	$member['action'] = 'update';
	$params = isset($errors)?array_merge($member, $errors):$member;
	View::render('member/_form',$params);
?>