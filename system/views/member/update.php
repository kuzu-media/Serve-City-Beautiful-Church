<?php
	$params = isset($member)?$member:array();
	$params["team_names"] = $team_names;
	$params["login_url"] = $login_url;
	if(isset($errors)) $params = array_merge($params,$errors);
	View::render('member/_form',$params);
 ?>