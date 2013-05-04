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

			// load the model
			$this->loadModel("ShiftMember");

			// if we got a shift back
			if($shift)
			{

				// I only want the id
				$this->ShiftMember->options['fields'] = array("ShiftMember"=>array("id"));

				// Match the team id in the shift table
				$this->ShiftMember->options['where'] = array("team_id"=>array($shift['team_id'],"Shift"));

				// the the shifts for this member on the team
				$shifts = $this->ShiftMember->findByMemberId($shift_member['member_id']);

				// if there is one member is a server if not they are a sheep
				$shift_member['shift_member_type_id'] = $shift?1:2;

			}

			// save the new ShiftMember
			$this->ShiftMember->save($shift_member);

			// set the success
			$this->view_data("success",$this->ShiftMember->success);

			// set the errors
			if(!$this->ShiftMember->success) $this->view_data("errors",$this->ShiftMember->error);

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

		}
	}
}