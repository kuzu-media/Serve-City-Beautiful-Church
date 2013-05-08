<?php
	$params = array("action"=>"post","team_id"=>$team_id);
	if(isset($errors)) $params = array_merge($params, $errors);
	View::render('testimonial/_form',$params);
 ?>