<?php
	$reminder_day['action'] = 'update';
	$params = isset($errors)?array_merge($reminder_day, $errors):$reminder_day;
	View::render('reminder_day/_form',$params);
?>