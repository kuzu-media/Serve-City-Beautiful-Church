<?php
/**
 * The TeamMemberType Controller
 */

/**
 * The TeamMemberType Controller
 * @category   Controllers
 * @package    Serve | City Beautiful Church
 * @subpackage Controllers
 * @author     Rachel Higley
 */
 Class TeamMemberTypeController extends Controller
{
	/**
	 * Get all the TeamMemberTypes
	 * @return array all the TeamMemberTypes
	 */
	public function index()
	{

		// load the model
		$this->loadModel("TeamMemberType");

		// only get this table
		$this->TeamMemberType->options['recursive'] = 0;

		// get all the TeamMemberTypes
		$team_member_types = $this->TeamMemberType->findAll();

		//set the success
		$this->view_data('success',$this->TeamMemberType->success);

		// if the call was successful
		if($this->TeamMemberType->success)
		{

			// set the information for the view
			$this->view_data("team_member_types",$team_member_types);

			// return the information
			return $team_member_types;

		}
	}
	/**
	 * Get one TeamMemberType
	 * @param  int the id of the TeamMemberType to get
	 * @return one TeamMemberType
	*/
	public function get($id)
	{
		if($id)
		{

			// load the model
			$this->loadModel("TeamMemberType");

			// only get this table
			$this->TeamMemberType->options['recursive'] = 0;

			// get all the TeamMemberTypes
			$team_member_type = $this->TeamMemberType->findById($id);

			//set the success
			$this->view_data('success',$this->TeamMemberType->success);

			// if the call was successful
			if($this->TeamMemberType->success)
			{

				// set the information for the view
				$this->view_data("team_member_type",$team_member_type[0]);

				// return the information
				return $team_member_type[0];
			}
			return false;
		}

	}
	/**
	 * Create new TeamMemberType
	 * @param  array $team_member_type all the information to save
	 * @return boolean if it was successfull
	 */
	public function post($team_member_type=NULL)
	{
		//if information was sent
		if($team_member_type)
		{
			// load the model
			$this->loadModel("TeamMemberType");

			// save the new TeamMemberType
			$this->TeamMemberType->save($team_member_type);

			// set the success
			$this->view_data("success",$this->TeamMemberType->success);
			if(!$this->TeamMemberType->success) return $this->view_data("errors",$this->TeamMemberType->error);

			// return the success
			return $this->TeamMemberType->success;
		}
	}
	/**
	 * Update a TeamMemberType
	 * @param  array $team_member_type all the information to update, including id
	 * @return boolean if it was successfull
	 */
	public function update($team_member_type_id=NULL,$team_member_type=NULL)
	{

		// if information was sent
		if($team_member_type)
		{
			// load the model
			$this->loadModel("TeamMemberType");

			// save the new TeamMemberType
			$this->TeamMemberType->save($team_member_type);

			// set the success
			$this->view_data("success",$this->TeamMemberType->success);

			// if the save was not successful
			if(!$this->TeamMemberType->success)
			{
				// set the errors
				$this->view_data("errors",$this->TeamMemberType->error);
			}
		}

		// if there is an id
		if($team_member_type_id)
		{
			
			// get a TeamMemberType
			$this->get($team_member_type_id);
			
		}


	}
	/**
	 * Delete a TeamMemberType
	 * @param  int $team_member_type_id id of the TeamMemberType to delete
	 * @return boolean if it was successfull
	 */
	public function delete($team_member_type_id=NULL)
	{
		// if there was an id sent
		if($team_member_type_id)
		{

			// load the model
			$this->loadModel("TeamMemberType");

			// save the new TeamMemberType
			$this->TeamMemberType->delete($team_member_type_id);

			// set the success
			$this->view_data("success",$this->TeamMemberType->success);

			// return the success
			$this->TeamMemberType->success;

		}
	}
}