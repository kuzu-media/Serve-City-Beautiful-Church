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
	public static $allowed_actions = array("index");

	/**
	 * Get all the Dates
	 * @return array all the Dates
	 */
	public function index($first=NULL)
	{

		// if this is the first time they came to this page
		$this->view_data("first",$first);

		// set up the facebook controller
		$facebook = Core::instantiate("FacebookAPIController");

		// the url to go after login
		$redirect_uri = Asset::create_url("facebook","login");

		// the login url
		$url = $facebook->getLoginUrl(array("scope"=>"email,user_groups","redirect_uri"=>$redirect_uri));;

		// set for the view
		$this->view_data("login_url",$url);

		// load the model
		$this->loadModel("Date");

		$this->Date->options['orderBy'] = array("Shift","team_id");
		$this->Date->options['key'] = array("Shift"=>"id");

		// get all the Dates
		$dates = $this->Date->findAll();

		//set the success
		$this->view_data('success',$this->Date->success);

		// if the call was successful
		if($this->Date->success)
		{

			// get the shift member controller
			$shift_member_controller = Core::instantiate("ShiftMemberController");

			// loop through the dates
			foreach($dates as &$date)
			{
				// foreach sift
				foreach($date['Shift'] as $shift_id=>&$shift)
				{
					// get the members
					$shift['members'] = $shift_member_controller->get($shift_id);
				}
			}

			// get the team controller
			$team_controller = Core::instantiate("TeamController");

			// get all the teams
			$teams = $team_controller->index();

			// set the teams for the view
			$this->view_data("teams",$teams);

			// set the information for the view
			$this->view_data("dates",$dates);

			// if the user is logged in
			$this->view_data("logged_in",Session::get('logged_in'));

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