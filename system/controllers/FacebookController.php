<?php
Class FacebookController extends Controller
{
	public static $allowed_actions = array("register","login");

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
					Session::set('user',$member[0]);

					// set that the user is logged in
					Session::set('logged_in',true);

					// get the shift member controller
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
				// if it doesn't then register the user
				else
				{

					Core::redirect("member","post",array($shift_id,$user_id));

				}

			}
		}
		else
		{
			echo "no_user_id";
		}

	}
}