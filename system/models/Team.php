<?php
Class Team extends Model
{

	public $hasMany = array('Shift','TeamMember','Testimonial');

	public $required = array('name');

	public $rules = array(
		'id' => array('numeric','maxLength' =>11), 
		'name' => array('alphaNumeric','maxLength' =>250), 
		'photo' => array('alphaNumeric','maxLength' =>250), 
		'summary' => array('alphaNumeric','maxLength' =>250), 
		'video' => array(), 
		'content' => array()
		);


}