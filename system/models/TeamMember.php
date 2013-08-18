<?php
Class TeamMember extends Model
{

	public $soft_delete = false;

	public $belongsTo = array('Team','Member','TeamMemberType');

	public $required = array('team_id','member_id','team_member_type_id');

	public $rules = array(
		'id' => array('numeric','maxLength' =>11),
		'team_id' => array('numeric','maxLength' =>11),
		'member_id' => array('numeric','maxLength' =>11),
		'team_member_type_id' => array('numeric','maxLength' =>11)
		);


}