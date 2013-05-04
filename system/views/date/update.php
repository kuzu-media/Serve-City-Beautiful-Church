<?php
	$date['action'] = 'update';
	$params = isset($errors)?array_merge($date, $errors):$date;
	View::render('date/_form',$params);
?>