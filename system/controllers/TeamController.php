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

	public static $allowed_actions = array("index","get");


	public function before_action()
	{

		parent::before_action();

		$url = Core::$info_of_url;

		// if the user isn't an admin they can't see the admin action
		if(Auth::user("member_type_id") === "2" && (Core::$info_of_url['action'] === "admin" || Core::$info_of_url['action'] === 'update'))
		{

			Core::redirect(AUTH_REDIRECT_CONTROLLER,AUTH_REDIRECT_ACTION);

		}

		$this->loadModel('Grouping');

		$this->Grouping->options['recursive'] = 0;

		$groups = $this->Grouping->findAll();

		if($this->Grouping->success)
		{
			$now = time();
			foreach($groups as $group)
			{
				$range_start = strtotime($group['start_invite']);
				$range_end = strtotime($group['end_invite']);
				if($range_start < $now && $now < $range_end)
				{
					$this->layout_data('group_invite',$group);
				}
			}
		}


	}

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
		$teams = $this->Team->findByTeamTypeId(1);

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
				$testimonials_controller = Core::instantiate("TestimonialController");

				$testimonials = $testimonials_controller->index($id);

				$this->view_data("testimonials",$testimonials);

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

			// if there is a profile pic upload
			if(isset($_FILES['photo']) && !empty($_FILES['photo']['name']))
			{
				$extension = pathinfo($_FILES['photo']['name']);
				$file_name = "team_pics/pic-".time().".".$extension['extension'];
				move_uploaded_file($_FILES["photo"]['tmp_name'], WEBROOT_PATH."/".Asset::$paths['img'].$file_name);

				$team["photo"] = $file_name;

			}
			// if they didn't upload a new profile pic and there was already one set it
			else
			{
				unset($team['photo']);

			}

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
			// set the team id
			$team['id'] = $team_id;

			// if there is a profile pic upload
			if(isset($_FILES['photo']) && !empty($_FILES['photo']['name']))
			{
				$extension = pathinfo($_FILES['photo']['name']);
				$file_name = "team_pics/pic-".time().".".$extension['extension'];
				move_uploaded_file($_FILES["photo"]['tmp_name'], WEBROOT_PATH."/".Asset::$paths['img'].$file_name);

				$team["photo"] = $file_name;

			}
			// if they didn't upload a new profile pic and there was already one set it
			else
			{
				unset($team['photo']);

			}

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

	/**
	 * Admin page
	 * @return array all the Teams
	 */
	public function admin()
	{

		// load the team model
		$this->loadModel("Team");

		// get the team names
		$team_names = $this->Team->get_team_names();

		$ids = $this->Team->get_team_names();


		$this->Team->hasMany = array();
		$this->Team->options['fields'] = array(
				"Team"=>array("id","name","team_type_id"),
				"Member"=>array("id","facebook_id","profile_pic","name","email","phone"),
				"TeamMember"=>array("id","team_member_type_id")
		);
		// order by the team
		$this->Team->options['orderBy'] = array("Team","id","ASC, IFNULL(TeamMember.team_member_type_id,100), TeamMember.team_member_type_id DESC");

		$this->Team->options['where'] = array("Team.id IN (".$this->Team->team_ids($team_names).")");
		$this->Team->options['joins'] = array(array("TeamMember","Team"),array('TeamMember','Member',true));

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


			$this->loadModel("Member");

			$this->Member->options['recursive'] = 0;
			$this->Member->options['fields'] = array("Member"=>array("id","name"));
			$this->Member->options['orderBy'] = array("Member","name","ASC");
			$members = $this->Member->findAll();

			if($this->Member->success)
			{
				$this->view_data("members",$members);
			}

			// if system admin
			if(Auth::user('member_type_id') === "3")
			{
				// get all the members that aren't part of team
				$this->Member->options['recursive'] = 0;

				$this->Member->options['where'] = array("Member.id NOT IN (SELECT member_id from team_member )");

				$members = $this->Member->findAll();

				if($this->Member->success)
				{
					$this->view_data("non_team_members",$members);
				}

				array_push($team_names, array("id"=>"none","name"=>"Members Not On a Team"));
			}

			// return the information
			return $teams;

		}
	}

	public function email($email=NULL)
	{
		// load the team model
		$this->loadModel("Team");

		// get the team names
		$team_names = $this->Team->get_team_names();

		// set the teams for the view
		$this->view_data("team_names",$team_names);

		// load the group model
		$this->loadModel("Grouping");

		// on get this table
		$this->Grouping->options['recursive'] = 0;

		// only get the id and name
		$this->Grouping->options['fields'] = array("Grouping"=>array("id","name"));

		// get the group names
		$group_names = $this->Grouping->findAll();

		// set the teams for the view
		$this->view_data("group_names",$group_names);

		if($email)
		{


			$this->loadModel('Member');

			$this->Member->belongsTo = array();

			$this->Member->options['fields'] = array("Member"=>array("id","email"));

			if($email['group'] === "none")
			{

				if($email['team'] === 'all')
				{

					$members = $this->Member->findAll();

				}
				else if($email['team'] === "leads")
				{

					$this->Member->options['where'] = array("Member.member_type_id IN (1,3)");

					$members = $this->Member->findAll();

				}
				else
				{
					$team_member_controller = Core::instantiate("TeamMemberController");

					$members = $team_member_controller->get($email["team"]);
				}
			}
			else
			{
				if($email['team'] === 'all')
				{

					$this->Member->options['where'] = array("grouping_id"=>array($email['group'],"GroupingMember"));

					$members = $this->Member->findAll();

				}
				else if($email['team'] === "leads")
				{

					$this->Member->options['where'] = array("Member.member_type_id IN (1,3)","grouping_id"=>array($email['group'],"GroupingMember"));

					$members = $this->Member->findAll();

				}
				else
				{
					$this->Member->options['where'] = array("grouping_id"=>array($email['group'],"GroupingMember"),'team_id'=>array($email['team'],"TeamMember"));

					$members = $this->Member->findAll();
				}

			}


			foreach($members as $member)
			{

				mail($member['Member']['email'],$email['subject'],$email['message'],"From: serve@citybeautifulchurch.com");
			}
		}

	}

}