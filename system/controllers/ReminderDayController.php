<?php
/**
 * The ReminderDay Controller
 */

/**
 * The ReminderDay Controller
 * @category   Controllers
 * @package    Serve | City Beautiful Church
 * @subpackage Controllers
 * @author     Rachel Higley
 */
 Class ReminderDayController extends Controller
{
	/**
	 * Get all the ReminderDays
	 * @return array all the ReminderDays
	 */
	public function index()
	{

		// load the model
		$this->loadModel("ReminderDay");

		// only get this table
		$this->ReminderDay->options['recursive'] = 0;

		// get all the ReminderDays
		$reminder_days = $this->ReminderDay->findAll();

		//set the success
		$this->view_data('success',$this->ReminderDay->success);

		// if the call was successful
		if($this->ReminderDay->success)
		{

			// set the information for the view
			$this->view_data("reminder_days",$reminder_days);

			// return the information
			return $reminder_days;

		}
	}
	/**
	 * Get one ReminderDay
	 * @param  int the id of the ReminderDay to get
	 * @return one ReminderDay
	*/
	public function get($id)
	{
		if($id)
		{

			// load the model
			$this->loadModel("ReminderDay");

			// only get this table
			$this->ReminderDay->options['recursive'] = 0;

			// get all the ReminderDays
			$reminder_day = $this->ReminderDay->findById($id);

			//set the success
			$this->view_data('success',$this->ReminderDay->success);

			// if the call was successful
			if($this->ReminderDay->success)
			{

				// set the information for the view
				$this->view_data("reminder_day",$reminder_day[0]);

				// return the information
				return $reminder_day[0];
			}
			return false;
		}

	}
	/**
	 * Create new ReminderDay
	 * @param  array $reminder_day all the information to save
	 * @return boolean if it was successfull
	 */
	public function post($reminder_day=NULL)
	{
		//if information was sent
		if($reminder_day)
		{
			// load the model
			$this->loadModel("ReminderDay");

			// save the new ReminderDay
			$this->ReminderDay->save($reminder_day);

			// set the success
			$this->view_data("success",$this->ReminderDay->success);
			if(!$this->ReminderDay->success) return $this->view_data("errors",$this->ReminderDay->error);

			// return the success
			return $this->ReminderDay->success;
		}
	}
	/**
	 * Update a ReminderDay
	 * @param  array $reminder_day all the information to update, including id
	 * @return boolean if it was successfull
	 */
	public function update($reminder_day_id=NULL,$reminder_day=NULL)
	{

		// if information was sent
		if($reminder_day)
		{
			// load the model
			$this->loadModel("ReminderDay");

			// save the new ReminderDay
			$this->ReminderDay->save($reminder_day);

			// set the success
			$this->view_data("success",$this->ReminderDay->success);

			// if the save was not successful
			if(!$this->ReminderDay->success)
			{
				// set the errors
				$this->view_data("errors",$this->ReminderDay->error);
			}
		}

		// if there is an id
		if($reminder_day_id)
		{
			
			// get a ReminderDay
			$this->get($reminder_day_id);
			
		}


	}
	/**
	 * Delete a ReminderDay
	 * @param  int $reminder_day_id id of the ReminderDay to delete
	 * @return boolean if it was successfull
	 */
	public function delete($reminder_day_id=NULL)
	{
		// if there was an id sent
		if($reminder_day_id)
		{

			// load the model
			$this->loadModel("ReminderDay");

			// save the new ReminderDay
			$this->ReminderDay->delete($reminder_day_id);

			// set the success
			$this->view_data("success",$this->ReminderDay->success);

			// return the success
			$this->ReminderDay->success;

		}
	}
}