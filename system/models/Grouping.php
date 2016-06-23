<?php
Class Grouping extends Model
{

	public $hasMany = array('GroupingMember');

	public $required = array('name','roustart_invite','end_invite');

	public $rules = array(
		'id' => array('numeric','maxLength' =>11),
		'name' => array('alphaNumeric','maxLength' =>250),
		);

}