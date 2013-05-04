<?php
Class Week extends Model
{

	public $required = array('name');

	public $rules = array(
		'id' => array('numeric','maxLength' =>11), 
		'name' => array('alphaNumeric','maxLength' =>4)
		);


}