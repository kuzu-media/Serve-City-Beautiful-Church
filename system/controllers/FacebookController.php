<?php
Class FacebookController extends Controller
{
	public static $allowed_actions = array("register","login");

	public function register($shift_id, $facebook_id, $member=NULL)
	{

		$this->loadModel("Team");

		$this->Team->options['recursive'] = 0;

		$this->Team->options['fields'] = array("Team"=>array("id","name"));

		$teams = $this->Team->findAll();

		$this->view_data("teams",$teams);

		if($member)
		{

			// set the profile pic
			if(empty($member['profile_pic'])) $member['profile_pic'] = $member['facebook_pic'];

			// make them a facebook user
			$member['login_type_id'] = 1;

			// make them a member not an admin
			$member['member_type_id'] = 2;

			// load the model
			$this->loadModel("Member");

			// make phone required if they select text
			if(isset($member['alert_type_id']) && $member['alert_type_id'] === "2") array_push($this->Member->required, "phone");

			// save the new Member
			$member['id'] = $this->Member->save($member);

			// set the success
			$this->view_data("success",$this->Member->success);

			// if the save was successful
			if($this->Member->success)
			{

				// set the session user
				Session::set('user',$member);

				// set that the user is logged in
				Session::set('logged_in',true);

				// get the shift member controller
				$shift_member_controller = Core::instantiate("ShiftMemberController");

				// create the shift memeber
				$shift_member = array(
						"shift_id"=>$shift_id,
						"member_id"=>$member['id']
					);

				// save the shift member
				$shift_member_controller->post($shift_member);

				// go back to the calender
				Core::redirect("date","index");

				// return the success
				return $this->Member->success;
			}
			else
			{
				// set the errors
				$this->view_data("errors",$this->Member->error);

				// set the member
				$this->view_data("member",$member);
			}

		}
		else if($facebook_id)
		{
			$facebook = Core::instantiate("FacebookAPIController");

			$member = $facebook->api('/me','GET');

			$member['facebook_id'] = $member['id'];

			$member['profile_pic'] = "https://graph.facebook.com/".$member['username']."/picture";

			unset($member['id']);

			$this->view_data("member",$member);
		}

	}

	public function login($shift_id)
	{

		// we got a user back from facebook
		if(!isset($_GET['error']))
		{

			// set up the facebook controller
			$facebook = Core::instantiate("FacebookAPIController");

			$user_id = $facebook->getUser();

			// if we have a user id
			if($user_id)
			{

				$this->loadModel("Member");

				// check if this facebook id already exists
				$member = $this->Member->check_id($user_id);

				// if it does then login
				if($member)
				{
					// set the session user
					Session::set('member',$member[0]);

					// set that the user is logged in
					Session::set('logged_in',true);

					// get the shift memeber controller
					$shift_member_controller = Core::instantiate("ShiftMemberController");

					// create the shift member
					$shift_member = array(
						"shift_id"=>$shift_id,
						"member_id"=>$member[0]['id']
					);

					// save the shift member
					$shift_member_controller->post($shift_member);

					Core::redirect("date","index");

				}
				// if it doesn't register
				else
				{

					Core::redirect("facebook","register",array($shift_id,$user_id));

				}

			}
		}
		else
		{
			echo "no_user_id";
		}

	}
}