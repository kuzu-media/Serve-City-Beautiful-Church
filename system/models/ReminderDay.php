<?php
Class ReminderDay extends Model
{

	public $soft_delete = false;

	public $hasMany = array('Member');

	public $required = array('name');

	public $rules = array(
		'id' => array('numeric','maxLength' =>11),
		'name' => array('alphaNumeric','maxLength' =>250)
		);


}