<?php
Class Date extends Model
{

	public $soft_delete = false;

	public $hasMany = array('Shift');

	public $required = array('date');

	public $rules = array(
		'id' => array('numeric','maxLength' =>11),
		'date' => array('alphaNumeric','maxLength' =>8),
		'notes' => array()
		);


}