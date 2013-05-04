<?php
	$testimonial['action'] = 'update';
	$params = isset($errors)?array_merge($testimonial, $errors):$testimonial;
	View::render('testimonial/_form',$params);
?>