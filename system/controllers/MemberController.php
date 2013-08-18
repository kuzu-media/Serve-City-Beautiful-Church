<?php
/**
 * The Member Controller
 */

/**
 * The Member Controller
 * @category   Controllers
 * @package    Serve | City Beautiful Church
 * @subpackage Controllers
 * @author     Rachel Higley
 */
 Class MemberController extends Controller
{
	public static $allowed_actions = array("logout","login","post","forgot","reset");

	public function before_action()
	{

		parent::before_action();

		$url = Core::$info_of_url;

		// if the user isn't an admin they can't see the admin action
		if(Auth::user("member_type_id") === "2" && (Core::$info_of_url['action'] === "index" || Core::$info_of_url['action'] === "update_admin") )
		{

			Core::redirect(AUTH_REDIRECT_CONTROLLER,AUTH_REDIRECT_ACTION);

		}
	}


	/**
	 * Get all the Members
	 * @return array all the Members
	 */
	public function index()
	{

		// load the model
		$this->loadModel("Member");

		// only get this table
		$this->Member->options['recursive'] = 0;

		// get all non system admins
		$this->Member->options['where'] = array("Member.member_type_id != 3");

		// get all the Members
		$members = $this->Member->findAll();

		//set the success
		$this->view_data('success',$this->Member->success);

		// if the call was successful
		if($this->Member->success)
		{

			// set the information for the view
			$this->view_data("members",$members);

			// only get this table
			$this->Member->options['recursive'] = 0;

			// get all non system admins
			$this->Member->options['where'] = array("Member.member_type_id = 3");

			// get all the Members
			$system_admins = $this->Member->findAll();

			if($this->Member->success)
			{
				// set the information for the view
				$this->view_data("system_admins",$system_admins);
			}

			// return the information
			return $members;

		}
	}

	public function update_admin($member_type, $member_id)
	{
		if($member_type && $member_type === "3")
		{
			$this->loadModel("Member");

			if(is_array($member_id))
			{
				$member_id = $member_id['member_id'];
			}

			$this->Member->save(array("id"=>$member_id, "member_type_id"=>$member_type));

			header("Location: ".$_SERVER['HTTP_REFERER']);

		}
		if($member_type && $member_type === "1")
		{
			$this->loadModel("TeamMember");

			$this->options['recursive'] = 0;

			// find out if this user is a team leader
			$this->TeamMember->findByMemberIdAndTeamMemberTypeId($member_id,4);

			$this->loadModel("Member");

			// if we found this member to be a team leader
			if($this->TeamMember->success)
			{

				// save them as a team leader
				$this->Member->save(array("id"=>$member_id, "member_type_id"=>1));

			}
			else
			{
				// save them as a member
				$this->Member->save(array("id"=>$member_id, "member_type_id"=>2));
			}

			header("Location: ".$_SERVER['HTTP_REFERER']);
		}
	}

	/**
	 * Get one Member
	 * @param  int the id of the Member to get
	 * @return one Member
	*/
	public function get($id)
	{
		if($id)
		{

			// load the model
			$this->loadModel("Member");

			// only get this table
			$this->Member->options['recursive'] = 3;
			$this->Member->hasMany = array("TeamMember","MemberWeek");
			$this->Member->options['fields'] = array("Member"=>array("id","facebook_id","name","email","phone","profile_pic","times","reminder_day_id","alert_type_id"),"TeamMember"=>array("id","team_id"),"MemberWeek"=>array("id","week_id"));



			// get all the Members
			$member = $this->Member->findById($id);

			//set the success
			$this->view_data('success',$this->Member->success);

			// if the call was successful
			if($this->Member->success)
			{

				$member_info = $member[0]['Member'];
				$member_info['teams'] = array();
				$member_info['weeks'] = array();
				foreach($member[0]['TeamMember'] as $team)
				{
					array_push($member_info['teams'], $team['team_id']);
				}

				foreach($member[0]['MemberWeek'] as $week)
				{
					array_push($member_info['weeks'], $week['week_id']);
				}

				// set the information for the view
				$this->view_data("member",$member_info);

				// return the information
				return $member[0];
			}
			return false;
		}

	}
	/**
	 * Create new Member
	 * @param  array $member all the information to save
	 * @return boolean if it was successfull
	 */
	public function post($shift_id=NULL, $facebook_id=NULL, $member=NULL)
	{

		// this means the member came through the shift id becauset there wasn't one
		if(is_array($shift_id))
		{
			$member = $shift_id;
			$shift_id = NULL;
		}
		// these means the member came through the facebook id param
		if(is_array($facebook_id))
		{
			$member = $facebook_id;
			$facebook_id = NULL;

		}
		if(!$facebook_id)
		{
			$this->_facebook_login_url();
		}

		// get the teams
		$this->_get_teams();

		//if information was sent
		if($member)
		{

			$this->_set_profile_pic($member);

			// if there is a facebook id make it a facebook login, if not make it a default
			$member['login_type_id']  = $facebook_id?1:2;

			// set the member type to default
			$member['member_type_id'] = 2;

			// if there is a facebook id set it, if not then remove it
			$member['facebook_id'] = $facebook_id?$facebook_id:NULL;

			// load the model
			$this->loadModel("Member");

			// make phone required if they select text
			if(isset($member['alert_type_id']) && $member['alert_type_id'] === "2") array_push($this->Member->required, "phone");

			// save the new Member
			$member['id'] = $this->Member->save($member);

			// if the save was successful
			if($this->Member->success)
			{

				// set the session user
				Session::set('user',$member);

				// set that the user is logged in
				Session::set('logged_in',true);

				// save the teams for this member
				$this->_set_teams($member);

				// save the weeks for this member
				$this->_set_weeks($member);

				if($shift_id && $shift_id !== "-1")
				{
					// get the shift member controller
					$shift_member_controller = Core::instantiate("ShiftMemberController");

					// create the shift member
					$shift_member = array(
						"shift_id"=>$shift_id,
						"member_id"=>$member['id']
					);

					// save the shift member
					$shift_member_controller->post($shift_member);

				}

				// go back to the calender
				Core::redirect("date","index",array("group"));

				// return the success
				return $this->Member->success;
			}
			// if save was unsuccessful
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
	/**
	 * Update a Member
	 * @param  array $member all the information to update, including id
	 * @return boolean if it was successfull
	 */
	public function update($member_id=NULL,$member=NULL)
	{

		// get the teams for the checkboxs
		$this->_get_teams();

		// if information was sent
		if($member)
		{
			// set the member id
			$member['id'] = $member_id;

			// set the profile pic for save
			$this->_set_profile_pic($member);

			// save the teams
			$this->_set_teams($member);

			// save the weeks for this member
			$this->_set_weeks($member);

			// load the model
			$this->loadModel("Member");

			// make phone required if they select text
			if(isset($member['alert_type_id']) && $member['alert_type_id'] === "2") array_push($this->Member->required, "phone");

			// save the new Member
			$this->Member->save($member);

			// set the success
			$this->view_data("success",$this->Member->success);

			// if the save was not successful
			if(!$this->Member->success)
			{

				// set the errors
				$this->view_data("errors",$this->Member->error);
			}

		}

		// if there is an id
		if($member_id)
		{

			// get a Member
			$this->get($member_id);

			$this->_facebook_login_url();

		}


	}
	/**
	 * Delete a Member
	 * @param  int $member_id id of the Member to delete
	 * @return boolean if it was successfull
	 */
	public function delete($member_id=NULL)
	{
		// if there was an id sent
		if($member_id)
		{

			// load the model
			$this->loadModel("Member");

			// save the new Member
			$this->Member->delete($member_id);

			// set the success
			$this->view_data("success",$this->Member->success);

			// return the success
			$this->Member->success;

		}
	}

	public function login($shift_id=NULL, $user=NULL)
	{

		if(is_array($shift_id))
		{
			$user = $shift_id;
			$shift_id = NULL;
		}
		if($user)
		{

			if(Auth::login($user))
			{
				if($shift_id)
				{
					// get the shift member controller
					$shift_member_controller = Core::instantiate("ShiftMemberController");

					// create the shift member
					$shift_member = array(
							"shift_id"=>$shift_id,
							"member_id"=>Auth::user('id')
						);

					// save the shift member
					$shift_member_controller->post($shift_member);

				}

				Core::redirect("date","index");
			}
			else {

				self::$success = false;

				$this->view_data("errors","Email or Password is incorrect");
			}
		}

		$this->_facebook_login_url();
	}

	public function forgot($member=NULL)
	{
		if($member && $member['email'])
		{

			$this->loadModel('Member');

			$this->Member->options['fields'] = array("Member"=>array("id","name"));
			$this->Member->options['recursive'] = 0;

			$returned_member = $this->Member->findByEmail($member['email']);

			if($this->Member->success && isset($returned_member[0]))
			{
				$id = $returned_member[0]['id']."f".$this->_random_string(20);
				$url = Asset::create_url("member","reset",array($id));
				$message = "Hello ".$returned_member[0]['name']."\n\n\nYou have requested a new password. To reset your password go to: ".$url."\n\nThanks!\nCity Beautiful Church";
				mail($member['email'], "Reset Your Password", $message,"From: serve@citybeautifulchurch.com");
			}
			else
			{
				$this->view_data("fields",array("email"=>"This email in not signed up."));
			}

		}

	}

	public function reset($id, $member=NULL)
	{

		$id = preg_split("/f/",  $id);

		$id = $id[0];

		if($member)
		{

			$member['id'] = $id;

			$this->loadModel('Member');

			$this->Member->options['returnSaved'] = true;

			// save the new Member
			$member = $this->Member->save($member);

			// if the save was successful
			if($this->Member->success)
			{

				unset($member['password']);

				// set the session user
				Session::set('user',$member);

				// set that the user is logged in
				Session::set('logged_in',true);

				// go back to the calender
				Core::redirect("date","index");

				// return the success
				return $this->Member->success;
			}
			// if save was unsuccessful
			else
			{

				// set the errors
				$this->view_data("errors",$this->Member->error);

				// set the member
				$this->view_data("member",$member);
			}

		}




	}

	public function logout()
	{
		// log the user out
		Auth::logout();

		// set up the facebook controller
		$facebook = Core::instantiate("FacebookAPIController");

		$redirect_uri = Asset::create_url("Team","index");

		$params = array( 'next' => $redirect_uri);

		$url = $facebook->getLogoutUrl($params); // $params is optional.

		header("Location: ".$url);

	}

	private function _facebook_login_url()
	{
		// set up the facebook controller
		$facebook = Core::instantiate("FacebookAPIController");

		// the url to go after login
		$redirect_uri = Asset::create_url("facebook","login");

		// the login url
		$url = $facebook->getLoginUrl(array("scope"=>"email,user_groups","redirect_uri"=>$redirect_uri));;

		// set for the view
		$this->view_data("login_url",$url);
	}

	private function _get_teams()
	{
		// load the team model
		$this->loadModel("Team");

		// get all of them
		$team_names = $this->Team->get_team_names();

		// set the teams for the view
		$this->view_data("team_names",$team_names);

	}

	private function _random_string($length, $charset='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')
	{
	    $str = '';
	    $count = strlen($charset);
	    while ($length--) {
	        $str .= $charset[mt_rand(0, $count-1)];
	    }
	    return $str;
	}
	private function _set_teams($member)
	{
		// if there are teams
		if(isset($member['teams']))
		{
			// get the team member controller
			$team_member_controller = Core::instantiate("TeamMemberController");

			if(isset($member['id']))
			{
				$teams = $team_member_controller->index($member['id']);

				if($teams)
				{
					foreach($teams as $team)
					{
						if(($index = array_search($team['team_id'], $member['teams'])) !== false)
						{
							unset($member['teams'][$index]);

						}
						else
						{
							$team_member_controller->delete($team['id']);
						}
					}
				}


			}

			// loop throught the teams selected
			foreach($member['teams'] as $team_id)
			{
				// save each team member
				$team_member_controller->post(array("team_id"=>$team_id,"member_id"=>$member['id'],"team_member_type_id"=>3));
			}

		}
	}

	private function _set_weeks($member)
	{

		// if there are teams
		if(isset($member['weeks']))
		{
			// get the team member controller
			$member_week_controller = Core::instantiate("MemberWeekController");

			if(isset($member['id']))
			{
				$weeks = $member_week_controller->index($member['id']);

				if($weeks)
				{
					foreach($weeks as $week)
					{
						if(($index = array_search($week['week_id'], $member['weeks'])) !== false)
						{
							unset($member['weeks'][$index]);

						}
						else
						{
							$member_week_controller->delete($week['id']);
						}
					}
				}


			}

			// loop throught the teams selected
			foreach($member['weeks'] as $week_id)
			{
				// save each team member
				$member_week_controller->post(array("week_id"=>$week_id,"member_id"=>$member['id']));
			}

		}

	}

	private function _set_profile_pic(&$member)
	{
		// if there is a profile pic upload
		if(isset($_FILES['profile_pic']) && !empty($_FILES['profile_pic']['name']))
		{
			$extension = pathinfo($_FILES['profile_pic']['name']);
			$file_name = Asset::$paths['img']."profile_pics/pic-".time().".".$extension['extension'];
			 move_uploaded_file($_FILES["profile_pic"]['tmp_name'], WEBROOT_PATH."/".$file_name);

			 $member["profile_pic"] = Asset::relative_url().$file_name;

		}
		// if they didn't upload a new profile pic and there was already one set it
		else if(!empty($member['facebook_pic']))
		{
			$member['profile_pic'] = $member['facebook_pic'];

		}
	}
}