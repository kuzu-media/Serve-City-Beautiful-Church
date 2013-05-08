<?php
	$params = array("action"=>"post","dates"=>$dates,"teams"=>$teams);
	if(isset($errors)) $params = array_merge($params, $errors);
	View::render('shift/_form',$params);
 ?>