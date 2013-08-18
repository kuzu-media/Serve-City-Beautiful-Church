<?php
Class Shift extends Model
{

	public $soft_delete = false;

	public $belongsTo = array('Date','Team');

	public $hasMany = array('ShiftMember');

	public $required = array('date_id','team_id','time');

	public $rules = array(
		'id' => array('numeric','maxLength' =>11),
		'date_id' => array('numeric','maxLength' =>11),
		'team_id' => array('numeric','maxLength' =>11),
		'time' => array('alphaNumeric','maxLength' =>250),
		'notes' => array()
		);


}