<?php
/**
 * The TeamMember Controller
 */

/**
 * The TeamMember Controller
 * @category   Controllers
 * @package    Serve | City Beautiful Church
 * @subpackage Controllers
 * @author     Rachel Higley
 */
 Class TeamMemberController extends Controller
{
	/**
	 * Get all the TeamMembers
	 * @return array all the TeamMembers
	 */
	public function index()
	{

		// load the model
		$this->loadModel("TeamMember");

		// only get this table
		$this->TeamMember->options['recursive'] = 0;

		// get all the TeamMembers
		$team_members = $this->TeamMember->findAll();

		//set the success
		$this->view_data('success',$this->TeamMember->success);

		// if the call was successful
		if($this->TeamMember->success)
		{

			// set the information for the view
			$this->view_data("team_members",$team_members);

			// return the information
			return $team_members;

		}
	}
	/**
	 * Get one TeamMember
	 * @param  int the id of the TeamMember to get
	 * @return one TeamMember
	*/
	public function get($id)
	{
		if($id)
		{

			// load the model
			$this->loadModel("TeamMember");

			// only get this table
			$this->TeamMember->options['recursive'] = 0;

			// get all the TeamMembers
			$team_member = $this->TeamMember->findById($id);

			//set the success
			$this->view_data('success',$this->TeamMember->success);

			// if the call was successful
			if($this->TeamMember->success)
			{

				// set the information for the view
				$this->view_data("team_member",$team_member[0]);

				// return the information
				return $team_member[0];
			}
			return false;
		}

	}
	/**
	 * Create new TeamMember
	 * @param  array $team_member all the information to save
	 * @return boolean if it was successfull
	 */
	public function post($team_member=NULL)
	{
		//if information was sent
		if($team_member)
		{
			// load the model
			$this->loadModel("TeamMember");

			// save the new TeamMember
			$this->TeamMember->save($team_member);

			// set the success
			$this->view_data("success",$this->TeamMember->success);

			if(!$this->TeamMember->success) $this->view_data("errors",$this->TeamMember->error);

			// return the success
			return $this->TeamMember->success;
		}
	}
	/**
	 * Update a TeamMember
	 * @param  array $team_member all the information to update, including id
	 * @return boolean if it was successfull
	 */
	public function update($team_member_id=NULL,$team_member=NULL)
	{

		// if information was sent
		if($team_member)
		{
			// load the model
			$this->loadModel("TeamMember");

			// save the new TeamMember
			$this->TeamMember->save($team_member);

			// set the success
			$this->view_data("success",$this->TeamMember->success);

			// if the save was not successful
			if(!$this->TeamMember->success)
			{
				// set the errors
				$this->view_data("errors",$this->TeamMember->error);
			}
		}

		// if there is an id
		if($team_member_id)
		{

			// get a TeamMember
			$this->get($team_member_id);

		}


	}
	/**
	 * Delete a TeamMember
	 * @param  int $team_member_id id of the TeamMember to delete
	 * @return boolean if it was successfull
	 */
	public function delete($team_member_id=NULL)
	{
		// if there was an id sent
		if($team_member_id)
		{

			// load the model
			$this->loadModel("TeamMember");

			// save the new TeamMember
			$this->TeamMember->delete($team_member_id);

			// set the success
			$this->view_data("success",$this->TeamMember->success);

			// return the success
			$this->TeamMember->success;

		}
	}
}