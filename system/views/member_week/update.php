<?php
	$member_week['action'] = 'update';
	$params = isset($errors)?array_merge($member_week, $errors):$member_week;
	View::render('member_week/_form',$params);
?>