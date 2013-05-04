<?php 
	$params = array("action"=>"post");
	if(isset($errors)) $params = array_merge($params, $errors);
	View::render('member_week/_form',$params);
 ?>