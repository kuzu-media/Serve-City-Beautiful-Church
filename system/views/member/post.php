<?php
	$params = isset($member)?$member:array();
	$params["teams"] = $teams;
	if(isset($errors)) $params = array_merge($params,$errors);
	View::render('member/_form',$params);
 ?>