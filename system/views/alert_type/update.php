<?php
	$alert_type['action'] = 'update';
	$params = isset($errors)?array_merge($alert_type, $errors):$alert_type;
	View::render('alert_type/_form',$params);
?>