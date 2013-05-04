<?php
Class TeamMemberType extends Model
{

	public $hasMany = array('TeamMember');

	public $required = array('name');

	public $rules = array(
		'id' => array('numeric','maxLength' =>11), 
		'name' => array('alphaNumeric','maxLength' =>250)
		);


}