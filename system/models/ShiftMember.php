<?php
Class ShiftMember extends Model
{

	public $soft_delete = false;

	public $belongsTo = array('Shift','Member','ShiftMemberType');

	public $required = array('shift_id','member_id','shift_member_type_id');

	public $rules = array(
		'id' => array('numeric','maxLength' =>11),
		'shift_id' => array('numeric','maxLength' =>11),
		'member_id' => array('numeric','maxLength' =>11),
		'shift_member_type_id' => array('numeric','maxLength' =>11)
		);


}