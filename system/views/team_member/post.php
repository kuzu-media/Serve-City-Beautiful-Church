<?php 
	$params = array("action"=>"post");
	if(isset($errors)) $params = array_merge($params, $errors);
	View::render('team_member/_form',$params);
 ?>