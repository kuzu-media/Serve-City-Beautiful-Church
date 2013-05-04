<?php
/**
 * The AlertType Controller
 */

/**
 * The AlertType Controller
 * @category   Controllers
 * @package    Serve | City Beautiful Church
 * @subpackage Controllers
 * @author     Rachel Higley
 */
 Class AlertTypeController extends Controller
{
	/**
	 * Get all the AlertTypes
	 * @return array all the AlertTypes
	 */
	public function index()
	{

		// load the model
		$this->loadModel("AlertType");

		// only get this table
		$this->AlertType->options['recursive'] = 0;

		// get all the AlertTypes
		$alert_types = $this->AlertType->findAll();

		//set the success
		$this->view_data('success',$this->AlertType->success);

		// if the call was successful
		if($this->AlertType->success)
		{

			// set the information for the view
			$this->view_data("alert_types",$alert_types);

			// return the information
			return $alert_types;

		}
	}
	/**
	 * Get one AlertType
	 * @param  int the id of the AlertType to get
	 * @return one AlertType
	*/
	public function get($id)
	{
		if($id)
		{

			// load the model
			$this->loadModel("AlertType");

			// only get this table
			$this->AlertType->options['recursive'] = 0;

			// get all the AlertTypes
			$alert_type = $this->AlertType->findById($id);

			//set the success
			$this->view_data('success',$this->AlertType->success);

			// if the call was successful
			if($this->AlertType->success)
			{

				// set the information for the view
				$this->view_data("alert_type",$alert_type[0]);

				// return the information
				return $alert_type[0];
			}
			return false;
		}

	}
	/**
	 * Create new AlertType
	 * @param  array $alert_type all the information to save
	 * @return boolean if it was successfull
	 */
	public function post($alert_type=NULL)
	{
		//if information was sent
		if($alert_type)
		{
			// load the model
			$this->loadModel("AlertType");

			// save the new AlertType
			$this->AlertType->save($alert_type);

			// set the success
			$this->view_data("success",$this->AlertType->success);
			if(!$this->AlertType->success) return $this->view_data("errors",$this->AlertType->error);

			// return the success
			return $this->AlertType->success;
		}
	}
	/**
	 * Update a AlertType
	 * @param  array $alert_type all the information to update, including id
	 * @return boolean if it was successfull
	 */
	public function update($alert_type_id=NULL,$alert_type=NULL)
	{

		// if information was sent
		if($alert_type)
		{
			// load the model
			$this->loadModel("AlertType");

			// save the new AlertType
			$this->AlertType->save($alert_type);

			// set the success
			$this->view_data("success",$this->AlertType->success);

			// if the save was not successful
			if(!$this->AlertType->success)
			{
				// set the errors
				$this->view_data("errors",$this->AlertType->error);
			}
		}

		// if there is an id
		if($alert_type_id)
		{
			
			// get a AlertType
			$this->get($alert_type_id);
			
		}


	}
	/**
	 * Delete a AlertType
	 * @param  int $alert_type_id id of the AlertType to delete
	 * @return boolean if it was successfull
	 */
	public function delete($alert_type_id=NULL)
	{
		// if there was an id sent
		if($alert_type_id)
		{

			// load the model
			$this->loadModel("AlertType");

			// save the new AlertType
			$this->AlertType->delete($alert_type_id);

			// set the success
			$this->view_data("success",$this->AlertType->success);

			// return the success
			$this->AlertType->success;

		}
	}
}