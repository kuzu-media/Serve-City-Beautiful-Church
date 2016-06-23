<?php
Class GroupingMember extends Model
{

	public $soft_delete = false;

	public $belongsTo = array('Grouping','Member');

	public $required = array('grouping_id','member_id');

	public $rules = array(
		'id' => array('numeric','maxLength' =>11),
		'grouping_id' => array('numeric','maxLength' =>11),
		'member_id' => array('numeric','maxLength' =>11),
		);


}