<?php
/**
 * The MemberType Controller
 */

/**
 * The MemberType Controller
 * @category   Controllers
 * @package    Serve | City Beautiful Church
 * @subpackage Controllers
 * @author     Rachel Higley
 */
 Class MemberTypeController extends Controller
{
	/**
	 * Get all the MemberTypes
	 * @return array all the MemberTypes
	 */
	public function index()
	{

		// load the model
		$this->loadModel("MemberType");

		// only get this table
		$this->MemberType->options['recursive'] = 0;

		// get all the MemberTypes
		$member_types = $this->MemberType->findAll();

		//set the success
		$this->view_data('success',$this->MemberType->success);

		// if the call was successful
		if($this->MemberType->success)
		{

			// set the information for the view
			$this->view_data("member_types",$member_types);

			// return the information
			return $member_types;

		}
	}
	/**
	 * Get one MemberType
	 * @param  int the id of the MemberType to get
	 * @return one MemberType
	*/
	public function get($id)
	{
		if($id)
		{

			// load the model
			$this->loadModel("MemberType");

			// only get this table
			$this->MemberType->options['recursive'] = 0;

			// get all the MemberTypes
			$member_type = $this->MemberType->findById($id);

			//set the success
			$this->view_data('success',$this->MemberType->success);

			// if the call was successful
			if($this->MemberType->success)
			{

				// set the information for the view
				$this->view_data("member_type",$member_type[0]);

				// return the information
				return $member_type[0];
			}
			return false;
		}

	}
	/**
	 * Create new MemberType
	 * @param  array $member_type all the information to save
	 * @return boolean if it was successfull
	 */
	public function post($member_type=NULL)
	{
		//if information was sent
		if($member_type)
		{
			// load the model
			$this->loadModel("MemberType");

			// save the new MemberType
			$this->MemberType->save($member_type);

			// set the success
			$this->view_data("success",$this->MemberType->success);
			if(!$this->MemberType->success) return $this->view_data("errors",$this->MemberType->error);

			// return the success
			return $this->MemberType->success;
		}
	}
	/**
	 * Update a MemberType
	 * @param  array $member_type all the information to update, including id
	 * @return boolean if it was successfull
	 */
	public function update($member_type_id=NULL,$member_type=NULL)
	{

		// if information was sent
		if($member_type)
		{
			// load the model
			$this->loadModel("MemberType");

			// save the new MemberType
			$this->MemberType->save($member_type);

			// set the success
			$this->view_data("success",$this->MemberType->success);

			// if the save was not successful
			if(!$this->MemberType->success)
			{
				// set the errors
				$this->view_data("errors",$this->MemberType->error);
			}
		}

		// if there is an id
		if($member_type_id)
		{
			
			// get a MemberType
			$this->get($member_type_id);
			
		}


	}
	/**
	 * Delete a MemberType
	 * @param  int $member_type_id id of the MemberType to delete
	 * @return boolean if it was successfull
	 */
	public function delete($member_type_id=NULL)
	{
		// if there was an id sent
		if($member_type_id)
		{

			// load the model
			$this->loadModel("MemberType");

			// save the new MemberType
			$this->MemberType->delete($member_type_id);

			// set the success
			$this->view_data("success",$this->MemberType->success);

			// return the success
			$this->MemberType->success;

		}
	}
}