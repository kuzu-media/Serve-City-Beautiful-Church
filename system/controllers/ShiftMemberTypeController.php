<?php
/**
 * The ShiftMemberType Controller
 */

/**
 * The ShiftMemberType Controller
 * @category   Controllers
 * @package    Serve | City Beautiful Church
 * @subpackage Controllers
 * @author     Rachel Higley
 */
 Class ShiftMemberTypeController extends Controller
{
	/**
	 * Get all the ShiftMemberTypes
	 * @return array all the ShiftMemberTypes
	 */
	public function index()
	{

		// load the model
		$this->loadModel("ShiftMemberType");

		// only get this table
		$this->ShiftMemberType->options['recursive'] = 0;

		// get all the ShiftMemberTypes
		$shift_member_types = $this->ShiftMemberType->findAll();

		//set the success
		$this->view_data('success',$this->ShiftMemberType->success);

		// if the call was successful
		if($this->ShiftMemberType->success)
		{

			// set the information for the view
			$this->view_data("shift_member_types",$shift_member_types);

			// return the information
			return $shift_member_types;

		}
	}
	/**
	 * Get one ShiftMemberType
	 * @param  int the id of the ShiftMemberType to get
	 * @return one ShiftMemberType
	*/
	public function get($id)
	{
		if($id)
		{

			// load the model
			$this->loadModel("ShiftMemberType");

			// only get this table
			$this->ShiftMemberType->options['recursive'] = 0;

			// get all the ShiftMemberTypes
			$shift_member_type = $this->ShiftMemberType->findById($id);

			//set the success
			$this->view_data('success',$this->ShiftMemberType->success);

			// if the call was successful
			if($this->ShiftMemberType->success)
			{

				// set the information for the view
				$this->view_data("shift_member_type",$shift_member_type[0]);

				// return the information
				return $shift_member_type[0];
			}
			return false;
		}

	}
	/**
	 * Create new ShiftMemberType
	 * @param  array $shift_member_type all the information to save
	 * @return boolean if it was successfull
	 */
	public function post($shift_member_type=NULL)
	{
		//if information was sent
		if($shift_member_type)
		{
			// load the model
			$this->loadModel("ShiftMemberType");

			// save the new ShiftMemberType
			$this->ShiftMemberType->save($shift_member_type);

			// set the success
			$this->view_data("success",$this->ShiftMemberType->success);
			if(!$this->ShiftMemberType->success) return $this->view_data("errors",$this->ShiftMemberType->error);

			// return the success
			return $this->ShiftMemberType->success;
		}
	}
	/**
	 * Update a ShiftMemberType
	 * @param  array $shift_member_type all the information to update, including id
	 * @return boolean if it was successfull
	 */
	public function update($shift_member_type_id=NULL,$shift_member_type=NULL)
	{

		// if information was sent
		if($shift_member_type)
		{
			// load the model
			$this->loadModel("ShiftMemberType");

			// save the new ShiftMemberType
			$this->ShiftMemberType->save($shift_member_type);

			// set the success
			$this->view_data("success",$this->ShiftMemberType->success);

			// if the save was not successful
			if(!$this->ShiftMemberType->success)
			{
				// set the errors
				$this->view_data("errors",$this->ShiftMemberType->error);
			}
		}

		// if there is an id
		if($shift_member_type_id)
		{
			
			// get a ShiftMemberType
			$this->get($shift_member_type_id);
			
		}


	}
	/**
	 * Delete a ShiftMemberType
	 * @param  int $shift_member_type_id id of the ShiftMemberType to delete
	 * @return boolean if it was successfull
	 */
	public function delete($shift_member_type_id=NULL)
	{
		// if there was an id sent
		if($shift_member_type_id)
		{

			// load the model
			$this->loadModel("ShiftMemberType");

			// save the new ShiftMemberType
			$this->ShiftMemberType->delete($shift_member_type_id);

			// set the success
			$this->view_data("success",$this->ShiftMemberType->success);

			// return the success
			$this->ShiftMemberType->success;

		}
	}
}