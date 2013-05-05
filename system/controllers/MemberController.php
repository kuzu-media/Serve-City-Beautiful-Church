<?php
/**
 * The Member Controller
 */

/**
 * The Member Controller
 * @category   Controllers
 * @package    Serve | City Beautiful Church
 * @subpackage Controllers
 * @author     Rachel Higley
 */
 Class MemberController extends Controller
{
	public static $allowed_actions = array("logout");

	/**
	 * Get all the Members
	 * @return array all the Members
	 */
	public function index()
	{

		// load the model
		$this->loadModel("Member");

		// only get this table
		$this->Member->options['recursive'] = 0;

		// get all the Members
		$members = $this->Member->findAll();

		//set the success
		$this->view_data('success',$this->Member->success);

		// if the call was successful
		if($this->Member->success)
		{

			// set the information for the view
			$this->view_data("members",$members);

			// return the information
			return $members;

		}
	}
	/**
	 * Get one Member
	 * @param  int the id of the Member to get
	 * @return one Member
	*/
	public function get($id)
	{
		if($id)
		{

			// load the model
			$this->loadModel("Member");

			// only get this table
			$this->Member->options['recursive'] = 0;

			// get all the Members
			$member = $this->Member->findById($id);

			//set the success
			$this->view_data('success',$this->Member->success);

			// if the call was successful
			if($this->Member->success)
			{

				// set the information for the view
				$this->view_data("member",$member[0]);

				// return the information
				return $member[0];
			}
			return false;
		}

	}
	/**
	 * Create new Member
	 * @param  array $member all the information to save
	 * @return boolean if it was successfull
	 */
	public function post($member=NULL)
	{
		//if information was sent
		if($member)
		{
			// load the model
			$this->loadModel("Member");

			// save the new Member
			$this->Member->save($member);

			// set the success
			$this->view_data("success",$this->Member->success);
			if(!$this->Member->success) return $this->view_data("errors",$this->Member->error);

			// return the success
			return $this->Member->success;
		}
	}
	/**
	 * Update a Member
	 * @param  array $member all the information to update, including id
	 * @return boolean if it was successfull
	 */
	public function update($member_id=NULL,$member=NULL)
	{

		// if information was sent
		if($member)
		{
			// load the model
			$this->loadModel("Member");

			// save the new Member
			$this->Member->save($member);

			// set the success
			$this->view_data("success",$this->Member->success);

			// if the save was not successful
			if(!$this->Member->success)
			{
				// set the errors
				$this->view_data("errors",$this->Member->error);
			}
		}

		// if there is an id
		if($member_id)
		{

			// get a Member
			$this->get($member_id);

		}


	}
	/**
	 * Delete a Member
	 * @param  int $member_id id of the Member to delete
	 * @return boolean if it was successfull
	 */
	public function delete($member_id=NULL)
	{
		// if there was an id sent
		if($member_id)
		{

			// load the model
			$this->loadModel("Member");

			// save the new Member
			$this->Member->delete($member_id);

			// set the success
			$this->view_data("success",$this->Member->success);

			// return the success
			$this->Member->success;

		}
	}

	public function logout()
	{
		// log the user out
		Auth::logout();

		// // redirect back to home page
		Core::redirect("Team","Index");

	}
}