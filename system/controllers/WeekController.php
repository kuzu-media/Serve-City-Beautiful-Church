<?php
/**
 * The Week Controller
 */

/**
 * The Week Controller
 * @category   Controllers
 * @package    Serve | City Beautiful Church
 * @subpackage Controllers
 * @author     Rachel Higley
 */
 Class WeekController extends Controller
{
	/**
	 * Get all the Weeks
	 * @return array all the Weeks
	 */
	public function index()
	{

		// load the model
		$this->loadModel("Week");

		// only get this table
		$this->Week->options['recursive'] = 0;

		// get all the Weeks
		$weeks = $this->Week->findAll();

		//set the success
		$this->view_data('success',$this->Week->success);

		// if the call was successful
		if($this->Week->success)
		{

			// set the information for the view
			$this->view_data("weeks",$weeks);

			// return the information
			return $weeks;

		}
	}
	/**
	 * Get one Week
	 * @param  int the id of the Week to get
	 * @return one Week
	*/
	public function get($id)
	{
		if($id)
		{

			// load the model
			$this->loadModel("Week");

			// only get this table
			$this->Week->options['recursive'] = 0;

			// get all the Weeks
			$week = $this->Week->findById($id);

			//set the success
			$this->view_data('success',$this->Week->success);

			// if the call was successful
			if($this->Week->success)
			{

				// set the information for the view
				$this->view_data("week",$week[0]);

				// return the information
				return $week[0];
			}
			return false;
		}

	}
	/**
	 * Create new Week
	 * @param  array $week all the information to save
	 * @return boolean if it was successfull
	 */
	public function post($week=NULL)
	{
		//if information was sent
		if($week)
		{
			// load the model
			$this->loadModel("Week");

			// save the new Week
			$this->Week->save($week);

			// set the success
			$this->view_data("success",$this->Week->success);
			if(!$this->Week->success) return $this->view_data("errors",$this->Week->error);

			// return the success
			return $this->Week->success;
		}
	}
	/**
	 * Update a Week
	 * @param  array $week all the information to update, including id
	 * @return boolean if it was successfull
	 */
	public function update($week_id=NULL,$week=NULL)
	{

		// if information was sent
		if($week)
		{
			// load the model
			$this->loadModel("Week");

			// save the new Week
			$this->Week->save($week);

			// set the success
			$this->view_data("success",$this->Week->success);

			// if the save was not successful
			if(!$this->Week->success)
			{
				// set the errors
				$this->view_data("errors",$this->Week->error);
			}
		}

		// if there is an id
		if($week_id)
		{
			
			// get a Week
			$this->get($week_id);
			
		}


	}
	/**
	 * Delete a Week
	 * @param  int $week_id id of the Week to delete
	 * @return boolean if it was successfull
	 */
	public function delete($week_id=NULL)
	{
		// if there was an id sent
		if($week_id)
		{

			// load the model
			$this->loadModel("Week");

			// save the new Week
			$this->Week->delete($week_id);

			// set the success
			$this->view_data("success",$this->Week->success);

			// return the success
			$this->Week->success;

		}
	}
}