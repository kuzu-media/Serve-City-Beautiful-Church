<?php
/**
 * The Group Controller
 */

/**
 * The Group Controller
 * @category   Controllers
 * @package    Serve | City Beautiful Church
 * @subpackage Controllers
 * @author     Rachel Higley
 */
 Class GroupController extends Controller
{

	public static $allowed_actions = array("index","get");


	public function before_action()
	{

		parent::before_action();

		$url = Core::$info_of_url;

		// if the user isn't an admin they can't see the admin action
		if(Auth::user("member_type_id") === "2")
		{

			Core::redirect(AUTH_REDIRECT_CONTROLLER,AUTH_REDIRECT_ACTION);

		}
	}

	public function get($id=null)
	{
		$this->loadModel('Grouping');

		$this->Grouping->options['recursive'] = 0;

		$groups = $this->Grouping->findAll();

		$this->view_data('groups',$groups);

		if(!is_numeric($id))
		{
			$id = $groups[0]['id'];
		}

		$this->Grouping->options['recursive'] = 0;

		$group = $this->Grouping->findById($id);

		if($this->Grouping->success) $this->view_data('current_group',$group[0]);

		// load the team model
		$this->loadModel("Team");

		// get the team names
		$team_names = $this->Team->get_team_names();

		$ids = $this->Team->get_team_names();


		$this->Team->hasMany = array();
		$this->Team->options['fields'] = array(
				"Team"=>array("id","name","team_type_id"),
				"Member"=>array("id","facebook_id","profile_pic","name","email","phone"),
				"TeamMember"=>array("id","team_member_type_id"),
				"GroupingMember"=>array("id","member_id","grouping_id")
		);
		// order by the team
		$this->Team->options['orderBy'] = array("Team","id","ASC, IFNULL(TeamMember.team_member_type_id,100), TeamMember.team_member_type_id DESC");

		$this->Team->options['where'] = array("Team.id IN (".$this->Team->team_ids($team_names).") AND GroupingMember.grouping_id = ".$id);
		$this->Team->options['joins'] = array(array("TeamMember","Team"),array('TeamMember','Member',true),array("GroupingMember","Member"));

		$teams = $this->Team->findAll();

		//set the success
		$this->view_data('success',$this->Team->success);

		// if the call was successful
		if($this->Team->success)
		{
			// set the information for the view
			$this->view_data("teams",$teams);

			// set the teams for the view
			$this->view_data("team_names",$team_names);
		}

	}

	public function get_one($id=null)
	{

		if($id)
		{

			// load the model
			$this->loadModel("Grouping");

			// only get this table
			$this->Grouping->options['recursive'] = 0;

			// get all the Groupings
			$grouping = $this->Grouping->findById($id);

			//set the success
			$this->view_data('success',$this->Grouping->success);

			// if the call was successful
			if($this->Grouping->success)
			{
				// set the information for the view
				$this->view_data("group",$grouping[0]);

				// return the information
				return $grouping[0];
			}
			return false;
		}

	}

	public function post($group=NULL)
	{
		//if information was sent
		if($group)
		{

			// var_dump($group);
			// load the model
			$this->loadModel("Grouping");

			// save the new Group
			$id = $this->Grouping->save($group);

			// set the success
			$this->view_data("success",$this->Grouping->success);
			// var_dump($this->Group->error);
			if(!$this->Grouping->success) return $this->view_data("errors",$this->Grouping->error);

			// return the success
			Core::redirect('group','get',array($id));


		}
	}

	/**
	 * Update a Team
	 * @param  array $team all the information to update, including id
	 * @return boolean if it was successfull
	 */
	public function update($group_id=NULL,$group=NULL)
	{

		// if information was sent
		if($group)
		{
			// set the team id
			$group['id'] = $group_id;

			// load the model
			$this->loadModel("Grouping");

			// save the new Team
			$this->Grouping->save($group);

			// set the success
			$this->view_data("success",$this->Grouping->success);

			// if the save was not successful
			if(!$this->Grouping->success)
			{
				// set the errors
				$this->view_data("errors",$this->Grouping->error);

			}
		}

		// if there is an id
		if($group_id)
		{

			// get a Team
			$this->get_one($group_id);

		}


	}

}