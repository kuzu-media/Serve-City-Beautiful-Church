<?php 
	$params = array("action"=>"post");
	if(isset($errors)) $params = array_merge($params, $errors);
	View::render('testimonial/_form',$params);
 ?>