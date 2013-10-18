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

			// don't get the requested or declined members
			$this->ShiftMember->options['where'] = array("ShiftMember.shift_member_type_id NOT IN (3,4)");

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
						"Member"=>array("id","phone","alert_type_id","email","name"),
						"TeamMember"=>array("id","team_id","member_id","team_member_type_id")
					);
					$this->TeamMember->options['where'] = array("TeamMember.team_member_type_id in (1,2)");

					$shepherds = $this->TeamMember->findByTeamId($shift['Shift']['team_id']);

					// if we have a member and at least on shepherd
					if($member && $shepherds)
					{
						// we are going to send a message to each sheperd
						foreach($shepherds as $shepherd)
						{
							// create a message with the sheep's number and the date and time they are serving.
							$message = $member[0]['name']." just signed up to serve on ".$shift['Date']['date']." at ".$shift['Shift']['time'].". It's their first time, so be sure to welcome them!";

							// if they prefer emails
							if($shepherd['Member']['alert_type_id'] === "1")
							{
								$email = "Hey ".$shepherd['Member']['name']."!\n\n".$message."\n\nThanks!";
								// send email
								mail($shepherd['Member']['email'], "New Member!", $email,"From: serve@citybeautifulchurch.com");
							}
							// if they prefer text
							else if($shepherd['Member']['alert_type_id'] === "2")
							{

								$text = "Hey! ".$message;

								// format the shepherds phone
								$phone = preg_replace('/[\D]/', "", $shepherd['Member']['phone']);

								// send a message using twilio
								$twilio = Core::instantiate("TwilioController");
								$message = $twilio->account->sms_messages->create("4073783757",$phone,$text);
							}


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

			if(!$this->ShiftMember->success)
			{
				// set the errors
				$this->view_data("errors",$this->ShiftMember->error);

				// if this member already exists for this shift
				if(stripos($this->ShiftMember->error['msg'],'Duplicate') >= 0)
				{
					// get the id of the shift member
					$this->ShiftMember->options['recursive'] = 0;
					$this->ShiftMember->options['fields'] = array("ShiftMember"=>array("id"));
					$member = $this->ShiftMember->findByShiftIdAndMemberId($shift_member['shift_id'],$shift_member['member_id']);

					if($member && isset($member[0]['id']))
					{
						// set the id
						$shift_member['id'] = $member[0]['id'];


						// update the ShiftMember
						$shift_id = $this->ShiftMember->save($shift_member);

						// set the success
						$this->view_data("success",$this->ShiftMember->success);

					}


				}
			}

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

	public function request($info)
	{


		$save_data = array(
			"shift_id"=>$info['shiftId'],
			"member_id"=>$info['memberId'],
			"shift_member_type_id"=>3);
		$this->loadModel('ShiftMember');
		$shift_member_id = $this->ShiftMember->save($save_data);

		if($this->ShiftMember->success)
		{

			$today = date("d");

			// if today is before the 20th of this month
			if($today < 20)
			{
				$month = date("m");
			}
			// else the date is after the 20th
			else
			{
				$month = date("m") + 1;
				if($month == 13) $month = 1;
			}

			// creat the date
			$str = $month."/20/".date("Y");
			$compare_date = strtotime($str);

			$serve_date = strtotime($info['shiftDate']);

			$shift = array(
					"team_name"=>$info['teamName'],
					"date"=>$info['shiftDate'],
					"time"=>$info['shiftTime'],
					"member_id"=>$info['memberId'],
					"shift_member_id"=>$shift_member_id );

			// if the shift date is after the next 20th
			if($serve_date >= $compare_date)
			{
				$this->loadModel("Request");

				$shift['name'] = $info['memberName'];
				$shift['email'] = $info['memberEmail'];

				$this->Request->save($shift);

			}
			// if the shift date is before the next 20th
			else
			{
				$email_info = array("name"=>$info['memberName']);
				$email_info['shifts'] = array(array("Request"=>$shift));

				// send the email
				mail($info['memberEmail'], "You have been invited to serve!", View::render('emails/request',$email_info,array("render"=>false)),'MIME-Version: 1.0' . "\r\n".'Content-type: text/html; charset=iso-8859-1' . "\r\nFrom: serve@citybeautifulchurch.com");
			}
		}

	}

	public function invite($shift_member_id,$status)
	{
		$this->loadModel("ShiftMember");
		if($status === "accept")
		{
			$this->ShiftMember->save(array("id"=>$shift_member_id,"shift_member_type_id"=>1));
			$this->view_data("status","Accepted");
			$this->view_data("msg","Thank you for choosing to accept our invitation to serve.<br /><br />To see more opportunities to serve <a href='".Asset::create_url('date','index')."'>click here</a>.");
		}
		else
		{
			$this->ShiftMember->save(array("id"=>$shift_member_id,"shift_member_type_id"=>4));
			$this->view_data("status","Declined");
			$this->view_data("msg","We're sorry you won't be able to serve on this date.<br /><br />To see more opportunities to serve <a href='".Asset::create_url('date','index')."'>click here</a>.");
		}
	}
}