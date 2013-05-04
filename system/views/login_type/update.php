<?php
	$login_type['action'] = 'update';
	$params = isset($errors)?array_merge($login_type, $errors):$login_type;
	View::render('login_type/_form',$params);
?>