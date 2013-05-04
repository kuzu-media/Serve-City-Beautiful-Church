<?php 
	$params = array("action"=>"post");
	if(isset($errors)) $params = array_merge($params, $errors);
	View::render('reminder_day/_form',$params);
 ?>