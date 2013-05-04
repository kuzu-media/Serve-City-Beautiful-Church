<?php
/**
 * The Team Controller
 */

/**
 * The Team Controller
 * @category   Controllers
 * @package    Serve | City Beautiful Church
 * @subpackage Controllers
 * @author     Rachel Higley
 */
 Class TeamController extends Controller
{
	/**
	 * Get all the Teams
	 * @return array all the Teams
	 */
	public function index()
	{

		// load the model
		$this->loadModel("Team");

		// only get this table
		$this->Team->options['recursive'] = 0;

		// get all the Teams
		$teams = $this->Team->findAll();

		//set the success
		$this->view_data('success',$this->Team->success);

		// if the call was successful
		if($this->Team->success)
		{

			// set the information for the view
			$this->view_data("teams",$teams);

			// return the information
			return $teams;

		}
	}
	/**
	 * Get one Team
	 * @param  int the id of the Team to get
	 * @return one Team
	*/
	public function get($id)
	{
		if($id)
		{

			// load the model
			$this->loadModel("Team");

			// only get this table
			$this->Team->options['recursive'] = 0;

			// get all the Teams
			$team = $this->Team->findById($id);

			//set the success
			$this->view_data('success',$this->Team->success);

			// if the call was successful
			if($this->Team->success)
			{

				// set the information for the view
				$this->view_data("team",$team[0]);

				// return the information
				return $team[0];
			}
			return false;
		}

	}
	/**
	 * Create new Team
	 * @param  array $team all the information to save
	 * @return boolean if it was successfull
	 */
	public function post($team=NULL)
	{
		//if information was sent
		if($team)
		{
			// load the model
			$this->loadModel("Team");

			// save the new Team
			$this->Team->save($team);

			// set the success
			$this->view_data("success",$this->Team->success);
			if(!$this->Team->success) return $this->view_data("errors",$this->Team->error);

			// return the success
			return $this->Team->success;
		}
	}
	/**
	 * Update a Team
	 * @param  array $team all the information to update, including id
	 * @return boolean if it was successfull
	 */
	public function update($team_id=NULL,$team=NULL)
	{

		// if information was sent
		if($team)
		{
			// load the model
			$this->loadModel("Team");

			// save the new Team
			$this->Team->save($team);

			// set the success
			$this->view_data("success",$this->Team->success);

			// if the save was not successful
			if(!$this->Team->success)
			{
				// set the errors
				$this->view_data("errors",$this->Team->error);
			}
		}

		// if there is an id
		if($team_id)
		{
			
			// get a Team
			$this->get($team_id);
			
		}


	}
	/**
	 * Delete a Team
	 * @param  int $team_id id of the Team to delete
	 * @return boolean if it was successfull
	 */
	public function delete($team_id=NULL)
	{
		// if there was an id sent
		if($team_id)
		{

			// load the model
			$this->loadModel("Team");

			// save the new Team
			$this->Team->delete($team_id);

			// set the success
			$this->view_data("success",$this->Team->success);

			// return the success
			$this->Team->success;

		}
	}
}