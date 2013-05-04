<?php
	$week['action'] = 'update';
	$params = isset($errors)?array_merge($week, $errors):$week;
	View::render('week/_form',$params);
?>