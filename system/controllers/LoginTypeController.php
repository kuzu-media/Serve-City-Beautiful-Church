<?php
/**
 * The LoginType Controller
 */

/**
 * The LoginType Controller
 * @category   Controllers
 * @package    Serve | City Beautiful Church
 * @subpackage Controllers
 * @author     Rachel Higley
 */
 Class LoginTypeController extends Controller
{
	/**
	 * Get all the LoginTypes
	 * @return array all the LoginTypes
	 */
	public function index()
	{

		// load the model
		$this->loadModel("LoginType");

		// only get this table
		$this->LoginType->options['recursive'] = 0;

		// get all the LoginTypes
		$login_types = $this->LoginType->findAll();

		//set the success
		$this->view_data('success',$this->LoginType->success);

		// if the call was successful
		if($this->LoginType->success)
		{

			// set the information for the view
			$this->view_data("login_types",$login_types);

			// return the information
			return $login_types;

		}
	}
	/**
	 * Get one LoginType
	 * @param  int the id of the LoginType to get
	 * @return one LoginType
	*/
	public function get($id)
	{
		if($id)
		{

			// load the model
			$this->loadModel("LoginType");

			// only get this table
			$this->LoginType->options['recursive'] = 0;

			// get all the LoginTypes
			$login_type = $this->LoginType->findById($id);

			//set the success
			$this->view_data('success',$this->LoginType->success);

			// if the call was successful
			if($this->LoginType->success)
			{

				// set the information for the view
				$this->view_data("login_type",$login_type[0]);

				// return the information
				return $login_type[0];
			}
			return false;
		}

	}
	/**
	 * Create new LoginType
	 * @param  array $login_type all the information to save
	 * @return boolean if it was successfull
	 */
	public function post($login_type=NULL)
	{
		//if information was sent
		if($login_type)
		{
			// load the model
			$this->loadModel("LoginType");

			// save the new LoginType
			$this->LoginType->save($login_type);

			// set the success
			$this->view_data("success",$this->LoginType->success);
			if(!$this->LoginType->success) return $this->view_data("errors",$this->LoginType->error);

			// return the success
			return $this->LoginType->success;
		}
	}
	/**
	 * Update a LoginType
	 * @param  array $login_type all the information to update, including id
	 * @return boolean if it was successfull
	 */
	public function update($login_type_id=NULL,$login_type=NULL)
	{

		// if information was sent
		if($login_type)
		{
			// load the model
			$this->loadModel("LoginType");

			// save the new LoginType
			$this->LoginType->save($login_type);

			// set the success
			$this->view_data("success",$this->LoginType->success);

			// if the save was not successful
			if(!$this->LoginType->success)
			{
				// set the errors
				$this->view_data("errors",$this->LoginType->error);
			}
		}

		// if there is an id
		if($login_type_id)
		{
			
			// get a LoginType
			$this->get($login_type_id);
			
		}


	}
	/**
	 * Delete a LoginType
	 * @param  int $login_type_id id of the LoginType to delete
	 * @return boolean if it was successfull
	 */
	public function delete($login_type_id=NULL)
	{
		// if there was an id sent
		if($login_type_id)
		{

			// load the model
			$this->loadModel("LoginType");

			// save the new LoginType
			$this->LoginType->delete($login_type_id);

			// set the success
			$this->view_data("success",$this->LoginType->success);

			// return the success
			$this->LoginType->success;

		}
	}
}