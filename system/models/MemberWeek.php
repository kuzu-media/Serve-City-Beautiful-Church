<?php
Class MemberWeek extends Model
{

	public $required = array('member_id','week_id');

	public $rules = array(
		'id' => array('numeric','maxLength' =>11), 
		'member_id' => array('numeric','maxLength' =>11), 
		'week_id' => array('numeric','maxLength' =>11)
		);


}