<?php
Class Member extends Model
{

	public $soft_delete = false;

	public $belongsTo = array('ReminderDay','AlertType','LoginType','MemberType');

	public $hasMany = array('ShiftMember','TeamMember',"MemberWeek");

	public $required = array('name','email','alert_type_id');

	public $rules = array(
		'id' => array('numeric','maxLength' =>11),
		'facebook_id' => array('numeric','maxLength' =>40,"unique"),
		'name' => array('alphaNumeric','maxLength' =>250),
		'email' => array('email','maxLength' =>250,"unique"),
		'phone' => array('alphaNumeric','maxLength' =>13),
		'profile_pic' => array(),
		'times' => array('numeric','maxLength' =>1),
		'reminder_day_id' => array('numeric','maxLength' =>1),
		'member_type_id' => array('numeric','maxLength' =>11),
		'alert_type_id' => array('numeric','maxLength' =>10),
		'login_type_id' => array('numeric','maxLength' =>11),
		'password' => array('alphaNumeric','maxLength' =>205,'minLength'=>6)
		);

	public function check_id($id)
	{
		$this->options['recursive'] = 0;

		$user = $this->findByFacebookId($id);

		if($this->success) return $user;

		return $this->success;

	}

	public function before_validation(&$data, &$rules)
	{

		parent::before_validation($data,$rules);

		if(isset($data['password']))
		{

			if(!isset($data['confirm']) || empty($data['confirm'])) $data['confirm'] = "!";

			$rules['confirm'] = array('equalTo' => $data['password']);


		}

	}
	public function before_save(&$data)
	{

		parent::before_save($data);

		if(isset($data['password'])) {

			$data['password'] = Core::encrypt($data['password']);

		}

		if(isset($data['email'])) {

			$data['email'] = strtolower($data['email']);

		}

		return $data;

	}


	public static function phone($number, $echo=true)
	{
		$phone = preg_replace("/[^0-9]/", "", $number);

		$phone = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $phone);

		if($echo) echo $phone;
		else return $phone;
	}

}