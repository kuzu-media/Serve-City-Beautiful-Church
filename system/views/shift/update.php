<?php
	$shift['action'] = 'update';
	$params = isset($errors)?array_merge($shift, $errors):$shift;
	View::render('shift/_form',$params);
?>