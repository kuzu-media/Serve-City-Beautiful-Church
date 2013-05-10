<?php
/**
 * The ShiftMember Controller
 */

/**
 * The ShiftMember Controller
 * @category   Controllers
 * @package    Serve | City Beautiful Church
 * @subpackage Controllers
 * @author     Rachel Higley
 */
 Class ShiftMemberController extends Controller
{
	public static $allowed_actions = array("post");

	/**
	 * Get all the ShiftMembers
	 * @return array all the ShiftMembers
	 */
	public function index()
	{

		// load the model
		$this->loadModel("ShiftMember");

		// only get this table
		$this->ShiftMember->options['recursive'] = 0;

		// get all the ShiftMembers
		$shift_members = $this->ShiftMember->findAll();

		//set the success
		$this->view_data('success',$this->ShiftMember->success);

		// if the call was successful
		if($this->ShiftMember->success)
		{

			// set the information for the view
			$this->view_data("shift_members",$shift_members);

			// return the information
			return $shift_members;

		}
	}
	/**
	 * Get one ShiftMember
	 * @param  int the id of the ShiftMember to get
	 * @return one ShiftMember
	*/
	public function get($id)
	{
		if($id)
		{

			// load the model
			$this->loadModel("ShiftMember");

			// just the member table
			$this->ShiftMember->belongsTo = array("Member");

			// get the belongs to
			$this->ShiftMember->options['recursive'] = 3;

			// get all the ShiftMembers
			$shift_member = $this->ShiftMember->findByShiftId($id);

			//set the success
			$this->view_data('success',$this->ShiftMember->success);

			// if the call was successful
			if($this->ShiftMember->success)
			{

				// set the information for the view
				$this->view_data("shift_member",$shift_member);

				// return the information
				return $shift_member;
			}
			return false;
		}

	}
	/**
	 * Create new ShiftMember
	 * @param  array $shift_member all the information to save
	 * @return boolean if it was successfull
	 */
	public function post($shift_member=NULL)
	{
		//if information was sent
		if($shift_member)
		{
			// get the shift controller
			$shift_controller = Core::instantiate("ShiftController");

			// get the current shift
			$shift = $shift_controller->get($shift_member['shift_id']);

			if(!isset($shift_member['member_id'])) $shift_member['member_id'] = Auth::user("id");

			// load the model
			$this->loadModel("ShiftMember");


			// if we got a shift back
			if($shift)
			{

				// I only want the id
				$this->ShiftMember->options['fields'] = array("ShiftMember"=>array("id"));

				// Match the team id in the shift table
				$this->ShiftMember->options['where'] = array("team_id"=>array($shift['Shift']['team_id'],"Shift"));

				// the the shifts for this member on the team
				$shifts = $this->ShiftMember->findByMemberId($shift_member['member_id']);

				$this->loadModel("Member");
				$this->Member->options['recursive'] = 0;
				$this->Member->options['fields'] = array("Member"=>array("id","name","profile_pic","facebook_id"));
				$member = $this->Member->findById($shift_member['member_id']);

				// if they have had previous shifts on this team then they are a server
				if($shifts)
				{
					$shift_member['shift_member_type_id'] = 1;
				}
				// if they haven't then they are sheep
				else {

					$shift_member['shift_member_type_id'] = 2;

					// get the shepherds for this team
					$this->loadModel('TeamMember');
					$this->TeamMember->options['recursive'] = 1;
					$this->TeamMember->belongsTo = array("Member");
					$this->TeamMember->options['fields'] = array(
						"Member"=>array("id","phone"),
						"TeamMember"=>array("id","team_id","member_id","team_member_type_id")
					);
					$this->TeamMember->options['where'] = array("TeamMember.team_member_type_id in (1,4)");

					$shepherds = $this->TeamMember->findByTeamId($shift['Shift']['team_id']);

					// if we have a member and at least on shepherd
					if($member && $shepherds)
					{
						// we are going to send a message to each sheperd
						foreach($shepherds as $shepherd)
						{
							// format the shepherds phone
							$phone = preg_replace('/[\D]/', "", $shepherd['Member']['phone']);

							// create a message with the sheeps number and the date and time they are serving.
							$message = "Hey! ".$member[0]['name']." just signed up to serve on ".$shift['Date']['date']." at ".$shift['Shift']['time'].". It's their first time, so be sure to welcome them!";

							// send a message using twilio
							$twilio = Core::instantiate("TwilioController");
							$message = $twilio->account->sms_messages->create("4073783757",$phone,$message);

						}

					}

				}

			}

			// save the new ShiftMember
			$shift_id = $this->ShiftMember->save($shift_member);

			// set the success
			$this->view_data("success",$this->ShiftMember->success);

			// set the member
			if($this->Member->success) $this->view_data("member",$member[0]);

			// set the errors
			if(!$this->ShiftMember->success) $this->view_data("errors",$this->ShiftMember->error);

			$this->view_data("shift_member_id",$shift_id);

			// return the success
			return $this->ShiftMember->success;
		}
	}
	/**
	 * Update a ShiftMember
	 * @param  array $shift_member all the information to update, including id
	 * @return boolean if it was successfull
	 */
	public function update($shift_member_id=NULL,$shift_member=NULL)
	{

		// if information was sent
		if($shift_member)
		{
			// load the model
			$this->loadModel("ShiftMember");

			// save the new ShiftMember
			$this->ShiftMember->save($shift_member);

			// set the success
			$this->view_data("success",$this->ShiftMember->success);

			// if the save was not successful
			if(!$this->ShiftMember->success)
			{
				// set the errors
				$this->view_data("errors",$this->ShiftMember->error);
			}
		}

		// if there is an id
		if($shift_member_id)
		{

			// get a ShiftMember
			$this->get($shift_member_id);

		}


	}
	/**
	 * Delete a ShiftMember
	 * @param  int $shift_member_id id of the ShiftMember to delete
	 * @return boolean if it was successfull
	 */
	public function delete($shift_member_id=NULL)
	{

		// if there was an id sent
		if($shift_member_id)
		{

			// load the model
			$this->loadModel("ShiftMember");

			// save the new ShiftMember
			$this->ShiftMember->delete($shift_member_id);

			// set the success
			$this->view_data("success",$this->ShiftMember->success);

			// return the success
			$this->ShiftMember->success;

			header("Location: ".$_SERVER['HTTP_REFERER']);

		}
	}

	public function availability($team_id,$date_id)
	{
		// get the servers for that date
		$this->loadModel("ShiftMember");
		$this->ShiftMember->options['recursive'] = 1;
		$this->ShiftMember->belongsTo = array("Shift");
		$this->ShiftMember->options['fields'] = array("ShiftMember"=>array("id","member_id"),"Shift"=>array());
		$this->ShiftMember->options['where'] = array("date_id"=>array($date_id,"Shift"));
		$servers = $this->ShiftMember->findAll();


		if($servers)
		{
			// string for not in
			$not = "";
			foreach($servers as $member)
			{
				$not .= $member['ShiftMember']['member_id'].", ";
			}

			$not = substr($not, 0,-2);

		}
		else
		{
			// set emtpy string for not in
			$not = "''";
		}


		// get all the members that aren't already serving that day
		$this->loadModel("Member");
		$this->Member->options['recursive'] = 2;
		$this->Member->hasMany = array("TeamMember");
		$this->Member->options['fields'] = array("Member"=>array("id","name","email","phone","profile_pic","times","facebook_id"));
		$this->Member->options['where'] = array("team_id"=>array($team_id,"TeamMember"), "Member.id NOT IN (".$not.")","TeamMember.team_member_type_id != 3");
		$members = $this->Member->findAll();

		if($this->Member->success) $this->view_data("members",$members);
		$this->view_data("success",$this->Member->success);

		// get all the member that are serving and when
		$this->Member->options['recursive'] = 2;
		$this->Member->hasMany = array("TeamMember","ShiftMember");
		$this->Member->options['joins'] = array(array("ShiftMember","Shift"),array("Shift","Team"));
		$this->Member->options['fields'] = array(
													"Member"=>array("id","name","email","phone","profile_pic","times","facebook_id"),
													"Shift"=>array("id","time","team_id")
												);
		$this->Member->options['where'] = array("team_id"=>array($team_id,"TeamMember"), "Member.id IN (".$not.")","TeamMember.team_member_type_id != 3","date_id"=>array($date_id,"Shift"));
		$working_members = $this->Member->findAll();


		if($this->Member->success)
		{
			$this->view_data("working_members",$working_members);

			// load the team model
			$this->loadModel("Team");
			// on get this table
			$this->Team->options['recursive'] = 0;
			// only get the id and name
			$this->Team->options['fields'] = array("Team"=>array("id","name"));
			// get all of them
			$team_names = $this->Team->findAll();
			// set the teams for the view
			$this->view_data("team_names",$team_names);

		}

		// get the archived members
		$this->Member->options['recursive'] = 2;
		$this->Member->hasMany = array("TeamMember");
		$this->Member->options['where'] = array("team_id"=>array($team_id,"TeamMember"), "Member.id NOT IN (".$not.")","TeamMember.team_member_type_id = 3");
		$achived_members = $this->Member->findAll();


		if($this->Member->success) $this->view_data("achived_members",$achived_members);

	}
}