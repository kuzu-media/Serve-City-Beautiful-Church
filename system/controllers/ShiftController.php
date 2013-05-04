<?php
/**
 * The Shift Controller
 */

/**
 * The Shift Controller
 * @category   Controllers
 * @package    Serve | City Beautiful Church
 * @subpackage Controllers
 * @author     Rachel Higley
 */
 Class ShiftController extends Controller
{
	/**
	 * Get all the Shifts
	 * @return array all the Shifts
	 */
	public function index()
	{

		// load the model
		$this->loadModel("Shift");

		// only get this table
		$this->Shift->options['recursive'] = 0;

		// get all the Shifts
		$shifts = $this->Shift->findAll();

		//set the success
		$this->view_data('success',$this->Shift->success);

		// if the call was successful
		if($this->Shift->success)
		{

			// set the information for the view
			$this->view_data("shifts",$shifts);

			// return the information
			return $shifts;

		}
	}
	/**
	 * Get one Shift
	 * @param  int the id of the Shift to get
	 * @return one Shift
	*/
	public function get($id)
	{
		if($id)
		{

			// load the model
			$this->loadModel("Shift");

			// only get this table
			$this->Shift->options['recursive'] = 0;

			// get all the Shifts
			$shift = $this->Shift->findById($id);

			//set the success
			$this->view_data('success',$this->Shift->success);

			// if the call was successful
			if($this->Shift->success)
			{

				// set the information for the view
				$this->view_data("shift",$shift[0]);

				// return the information
				return $shift[0];
			}
			return false;
		}

	}
	/**
	 * Create new Shift
	 * @param  array $shift all the information to save
	 * @return boolean if it was successfull
	 */
	public function post($shift=NULL)
	{
		//if information was sent
		if($shift)
		{
			// load the model
			$this->loadModel("Shift");

			// save the new Shift
			$this->Shift->save($shift);

			// set the success
			$this->view_data("success",$this->Shift->success);
			if(!$this->Shift->success) return $this->view_data("errors",$this->Shift->error);

			// return the success
			return $this->Shift->success;
		}
	}
	/**
	 * Update a Shift
	 * @param  array $shift all the information to update, including id
	 * @return boolean if it was successfull
	 */
	public function update($shift_id=NULL,$shift=NULL)
	{

		// if information was sent
		if($shift)
		{
			// load the model
			$this->loadModel("Shift");

			// save the new Shift
			$this->Shift->save($shift);

			// set the success
			$this->view_data("success",$this->Shift->success);

			// if the save was not successful
			if(!$this->Shift->success)
			{
				// set the errors
				$this->view_data("errors",$this->Shift->error);
			}
		}

		// if there is an id
		if($shift_id)
		{
			
			// get a Shift
			$this->get($shift_id);
			
		}


	}
	/**
	 * Delete a Shift
	 * @param  int $shift_id id of the Shift to delete
	 * @return boolean if it was successfull
	 */
	public function delete($shift_id=NULL)
	{
		// if there was an id sent
		if($shift_id)
		{

			// load the model
			$this->loadModel("Shift");

			// save the new Shift
			$this->Shift->delete($shift_id);

			// set the success
			$this->view_data("success",$this->Shift->success);

			// return the success
			$this->Shift->success;

		}
	}
}