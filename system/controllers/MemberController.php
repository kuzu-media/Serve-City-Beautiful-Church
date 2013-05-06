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
	public static $allowed_actions = array("logout","login","post");


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

		// get all the Members
		$members = $this->Member->findAll();

		//set the success
		$this->view_data('success',$this->Member->success);

		// if the call was successful
		if($this->Member->success)
		{

			// set the information for the view
			$this->view_data("members",$members);

			// return the information
			return $members;

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
			$this->Member->options['recursive'] = 0;

			// get all the Members
			$member = $this->Member->findById($id);

			//set the success
			$this->view_data('success',$this->Member->success);

			// if the call was successful
			if($this->Member->success)
			{

				// set the information for the view
				$this->view_data("member",$member[0]);

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

		// load the team model
		$this->loadModel("Team");

		// on get this table
		$this->Team->options['recursive'] = 0;

		// only get the id and name
		$this->Team->options['fields'] = array("Team"=>array("id","name"));

		// get all of them
		$teams = $this->Team->findAll();

		// set the teams for the view
		$this->view_data("teams",$teams);

		//if information was sent
		if($member)
		{

			// if there is a profile pic upload
			if(isset($_FILES['profile_pic']) && !empty($_FILES['profile_pic']['name']))
			{
				$file_name = Asset::$paths['img']."profile_pics/pic-".time().".".pathinfo($_FILES['profile_pic']['name'])['extension'];
				 move_uploaded_file($_FILES["profile_pic"]['tmp_name'], WEBROOT_PATH."/".$file_name);

				 $member["profile_pic"] = Asset::relative_url().$file_name;

			}
			// if they didn't upload a new profile pic and there was already one set it
			else if(!empty($member['facebook_pic']))
			{
				$member['profile_pic'] = $member['facebook_pic'];

			}

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

				// if there are teams
				if(isset($member['teams']))
				{
					// get the team member controller
					$team_member_controller = Core::instantiate("TeamMemberController");

					// loop throught the teams selected
					foreach($member['teams'] as $team_id)
					{
						// save each team member
						$team_member_controller->post(array("team_id"=>$team_id,"member_id"=>$member['id'],"team_member_type_id"=>2));
					}

				}

				// get the shift member controller
				$shift_member_controller = Core::instantiate("ShiftMemberController");

				// create the shift member
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

		echo "<pre>";
		var_dump($member_id);
		var_dump($member);
		echo "</pre>";
		// if information was sent
		if($member)
		{
			// load the model
			$this->loadModel("Member");

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

	public function login($shift_id, $user=NULL)
	{
		if($user)
		{

			if(Auth::login($user))
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


				Core::redirect("date","index");
			}
			else {

				self::$success = false;

				$this->view_data("errors","Email or Password is incorrect");
			}
		}
	}
	public function logout()
	{
		// log the user out
		Auth::logout();

		// // redirect back to home page
		Core::redirect("Team","Index");

	}
}