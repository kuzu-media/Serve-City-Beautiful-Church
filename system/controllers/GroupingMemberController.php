<?php
/**
 * The GroupingMember Controller
 */

/**
 * The GroupingMember Controller
 * @category   Controllers
 * @package    Serve | City Beautiful Church
 * @subpackage Controllers
 * @author     Rachel Higley
 */
 Class GroupingMemberController extends Controller
{

	public static $allowed_actions = array('post');

	/**
	 * Create new GroupMember
	 * @param  array $Group_member all the information to save
	 * @return boolean if it was successfull
	 */
	public function post($id = null)
	{

		if($id)
		{

			if(Session::get('logged_in'))
			{
				$user_id = Auth::user('id');
				$group_member = array(
					"grouping_id"=> $id,
					"member_id"=> $user_id
				);

				Session::set('joined',true);

				// load the model
				$this->loadModel("GroupingMember");

				// save the new GroupMember
				$this->GroupingMember->save($group_member);

				// set the success
				$this->view_data("success",$this->GroupingMember->success);

				header("Location: ".$_SERVER['HTTP_REFERER']);
			}

		}

	}
}