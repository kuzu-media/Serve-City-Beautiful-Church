<?php
/**
 * The Date Controller
 */

/**
 * The Date Controller
 * @category   Controllers
 * @package    Serve | City Beautiful Church
 * @subpackage Controllers
 * @author     Rachel Higley
 */
 Class DateController extends Controller
{
	/**
	 * Get all the Dates
	 * @return array all the Dates
	 */
	public function index()
	{

		// load the model
		$this->loadModel("Date");

		// only get this table
		$this->Date->options['recursive'] = 0;

		// get all the Dates
		$dates = $this->Date->findAll();

		//set the success
		$this->view_data('success',$this->Date->success);

		// if the call was successful
		if($this->Date->success)
		{

			// set the information for the view
			$this->view_data("dates",$dates);

			// return the information
			return $dates;

		}
	}
	/**
	 * Get one Date
	 * @param  int the id of the Date to get
	 * @return one Date
	*/
	public function get($id)
	{
		if($id)
		{

			// load the model
			$this->loadModel("Date");

			// only get this table
			$this->Date->options['recursive'] = 0;

			// get all the Dates
			$date = $this->Date->findById($id);

			//set the success
			$this->view_data('success',$this->Date->success);

			// if the call was successful
			if($this->Date->success)
			{

				// set the information for the view
				$this->view_data("date",$date[0]);

				// return the information
				return $date[0];
			}
			return false;
		}

	}
	/**
	 * Create new Date
	 * @param  array $date all the information to save
	 * @return boolean if it was successfull
	 */
	public function post($date=NULL)
	{
		//if information was sent
		if($date)
		{
			// load the model
			$this->loadModel("Date");

			// save the new Date
			$this->Date->save($date);

			// set the success
			$this->view_data("success",$this->Date->success);
			if(!$this->Date->success) return $this->view_data("errors",$this->Date->error);

			// return the success
			return $this->Date->success;
		}
	}
	/**
	 * Update a Date
	 * @param  array $date all the information to update, including id
	 * @return boolean if it was successfull
	 */
	public function update($date_id=NULL,$date=NULL)
	{

		// if information was sent
		if($date)
		{
			// load the model
			$this->loadModel("Date");

			// save the new Date
			$this->Date->save($date);

			// set the success
			$this->view_data("success",$this->Date->success);

			// if the save was not successful
			if(!$this->Date->success)
			{
				// set the errors
				$this->view_data("errors",$this->Date->error);
			}
		}

		// if there is an id
		if($date_id)
		{
			
			// get a Date
			$this->get($date_id);
			
		}


	}
	/**
	 * Delete a Date
	 * @param  int $date_id id of the Date to delete
	 * @return boolean if it was successfull
	 */
	public function delete($date_id=NULL)
	{
		// if there was an id sent
		if($date_id)
		{

			// load the model
			$this->loadModel("Date");

			// save the new Date
			$this->Date->delete($date_id);

			// set the success
			$this->view_data("success",$this->Date->success);

			// return the success
			$this->Date->success;

		}
	}
}