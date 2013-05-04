<?php
Class Member extends Model
{

	public $belongsTo = array('ReminderDay','AlertType','LoginType','MemberType');

	public $hasMany = array('ShiftMember','TeamMember');

	public $required = array('name','email','profile_pic');

	public $rules = array(
		'id' => array('numeric','maxLength' =>11), 
		'facebook_id' => array('numeric','maxLength' =>11), 
		'name' => array('alphaNumeric','maxLength' =>250), 
		'email' => array('alphaNumeric','maxLength' =>250), 
		'phone' => array('alphaNumeric','maxLength' =>13), 
		'profile_pic' => array(), 
		'times' => array('numeric','maxLength' =>1), 
		'reminder_day_id' => array('numeric','maxLength' =>1), 
		'member_type_id' => array('numeric','maxLength' =>11), 
		'alert_type_id' => array('numeric','maxLength' =>10), 
		'login_type_id' => array('numeric','maxLength' =>11), 
		'password' => array('alphaNumeric','maxLength' =>205)
		);


}