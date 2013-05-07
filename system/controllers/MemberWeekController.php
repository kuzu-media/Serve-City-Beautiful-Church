<?php
/**
 * The MemberWeek Controller
 */

/**
 * The MemberWeek Controller
 * @category   Controllers
 * @package    Serve | City Beautiful Church
 * @subpackage Controllers
 * @author     Rachel Higley
 */
 Class MemberWeekController extends Controller
{
	/**
	 * Get all the MemberWeeks
	 * @return array all the MemberWeeks
	 */
	public function index($id=NULL)
	{

		// load the model
		$this->loadModel("MemberWeek");

		// only get this table
		$this->MemberWeek->options['recursive'] = 0;

		if($id) {
			// get all the TeamMembers for a member
			$member_weeks = $this->MemberWeek->findByMemberId($id);
		}

		else {
			// get all the TeamMembers
			$member_weeks = $this->MemberWeek->findAll($id);
		}

		//set the success
		$this->view_data('success',$this->MemberWeek->success);

		// if the call was successful
		if($this->MemberWeek->success)
		{

			// set the information for the view
			$this->view_data("member_weeks",$member_weeks);

			// return the information
			return $member_weeks;

		}
	}
	/**
	 * Get one MemberWeek
	 * @param  int the id of the MemberWeek to get
	 * @return one MemberWeek
	*/
	public function get($id)
	{
		if($id)
		{

			// load the model
			$this->loadModel("MemberWeek");

			// only get this table
			$this->MemberWeek->options['recursive'] = 0;

			// get all the MemberWeeks
			$member_week = $this->MemberWeek->findById($id);

			//set the success
			$this->view_data('success',$this->MemberWeek->success);

			// if the call was successful
			if($this->MemberWeek->success)
			{

				// set the information for the view
				$this->view_data("member_week",$member_week[0]);

				// return the information
				return $member_week[0];
			}
			return false;
		}

	}
	/**
	 * Create new MemberWeek
	 * @param  array $member_week all the information to save
	 * @return boolean if it was successfull
	 */
	public function post($member_week=NULL)
	{
		//if information was sent
		if($member_week)
		{
			// load the model
			$this->loadModel("MemberWeek");

			// save the new MemberWeek
			$this->MemberWeek->save($member_week);

			// set the success
			$this->view_data("success",$this->MemberWeek->success);
			if(!$this->MemberWeek->success) return $this->view_data("errors",$this->MemberWeek->error);

			// return the success
			return $this->MemberWeek->success;
		}
	}
	/**
	 * Update a MemberWeek
	 * @param  array $member_week all the information to update, including id
	 * @return boolean if it was successfull
	 */
	public function update($member_week_id=NULL,$member_week=NULL)
	{

		// if information was sent
		if($member_week)
		{
			// load the model
			$this->loadModel("MemberWeek");

			// save the new MemberWeek
			$this->MemberWeek->save($member_week);

			// set the success
			$this->view_data("success",$this->MemberWeek->success);

			// if the save was not successful
			if(!$this->MemberWeek->success)
			{
				// set the errors
				$this->view_data("errors",$this->MemberWeek->error);
			}
		}

		// if there is an id
		if($member_week_id)
		{

			// get a MemberWeek
			$this->get($member_week_id);

		}


	}
	/**
	 * Delete a MemberWeek
	 * @param  int $member_week_id id of the MemberWeek to delete
	 * @return boolean if it was successfull
	 */
	public function delete($member_week_id=NULL)
	{
		// if there was an id sent
		if($member_week_id)
		{

			// load the model
			$this->loadModel("MemberWeek");

			// save the new MemberWeek
			$this->MemberWeek->delete($member_week_id);

			// set the success
			$this->view_data("success",$this->MemberWeek->success);

			// return the success
			$this->MemberWeek->success;

		}
	}
}