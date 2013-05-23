<?php
/**
 * The TeamMember Controller
 */

/**
 * The TeamMember Controller
 * @category   Controllers
 * @package    Serve | City Beautiful Church
 * @subpackage Controllers
 * @author     Rachel Higley
 */
 Class TeamMemberController extends Controller
{
	/**
	 * Get all the TeamMembers
	 * @return array all the TeamMembers
	 */
	public function index($id=NULL)
	{

		// load the model
		$this->loadModel("TeamMember");

		// only get this table
		$this->TeamMember->options['recursive'] = 0;

		if($id) {
			// get all the TeamMembers for a member
			$team_members = $this->TeamMember->findByMemberId($id);
		}

		else {
			// get all the TeamMembers
			$team_members = $this->TeamMember->findAll($id);
		}

		//set the success
		$this->view_data('success',$this->TeamMember->success);

		// if the call was successful
		if($this->TeamMember->success)
		{

			// set the information for the view
			$this->view_data("team_members",$team_members);

			// return the information
			return $team_members;

		}

		return false;
	}
	/**
	 * Get one TeamMember
	 * @param  int the id of the TeamMember to get
	 * @return one TeamMember
	*/
	public function get($id)
	{
		if($id)
		{

			// load the model
			$this->loadModel("TeamMember");

			// only get this table
			$this->TeamMember->options['recursive'] = 0;

			// get all the TeamMembers
			$team_member = $this->TeamMember->findById($id);

			//set the success
			$this->view_data('success',$this->TeamMember->success);

			// if the call was successful
			if($this->TeamMember->success)
			{

				// set the information for the view
				$this->view_data("team_member",$team_member[0]);

				// return the information
				return $team_member[0];
			}
			return false;
		}

	}
	/**
	 * Create new TeamMember
	 * @param  array $team_member all the information to save
	 * @return boolean if it was successfull
	 */
	public function post($team_member=NULL)
	{
		//if information was sent
		if($team_member)
		{
			// load the model
			$this->loadModel("TeamMember");

			// save the new TeamMember
			$this->TeamMember->save($team_member);

			// set the success
			$this->view_data("success",$this->TeamMember->success);

			if(!$this->TeamMember->success) $this->view_data("errors",$this->TeamMember->error);

			// return the success
			return $this->TeamMember->success;
		}
	}
	/**
	 * Update a TeamMember
	 * @param  array $team_member all the information to update, including id
	 * @return boolean if it was successfull
	 */
	public function update($team_member_id=NULL,$team_member=NULL)
	{

		// if information was sent
		if($team_member)
		{
			// load the model
			$this->loadModel("TeamMember");

			// save the new TeamMember
			$this->TeamMember->save($team_member);

			// set the success
			$this->view_data("success",$this->TeamMember->success);

			// if the save was not successful
			if(!$this->TeamMember->success)
			{
				// set the errors
				$this->view_data("errors",$this->TeamMember->error);
			}
		}

		// if there is an id
		if($team_member_id)
		{

			// get a TeamMember
			$this->get($team_member_id);

		}


	}
	/**
	 * Delete a TeamMember
	 * @param  int $team_member_id id of the TeamMember to delete
	 * @return boolean if it was successfull
	 */
	public function delete($team_member_id=NULL)
	{
		// if there was an id sent
		if($team_member_id)
		{

			// load the model
			$this->loadModel("TeamMember");

			// save the new TeamMember
			$this->TeamMember->delete($team_member_id);

			// set the success
			$this->view_data("success",$this->TeamMember->success);

			// return the success
			$this->TeamMember->success;

		}
	}

	public function available($info)
	{
		$timestamp = strtotime($info['date']);

		$info['start_date'] = date('m/01/y', $timestamp);

		$info['end_date'] = date('m/t/y', $timestamp);

		switch ($info['date']) {
			case date("m/d/y",strtotime("First Sunday of ".date('F',$timestamp))):
				$info['week_id'] = 1;
				break;
			case date("m/d/y",strtotime("Second Sunday of ".date('F',$timestamp))):
				$info['week_id'] = 2;
				break;
			case date("m/d/y",strtotime("Third Sunday of ".date('F',$timestamp))):
				$info['week_id'] = 3;
				break;
			case date("m/d/y",strtotime("Fourth Sunday of ".date('F',$timestamp))):
				$info['week_id'] = 4;
				break;
			case date("m/d/y",strtotime("Fifth Sunday of ".date('F',$timestamp))):
				$info['week_id'] = 5;
				break;
		}

		$this->loadModel('TeamMember');

		$rec = $this->_get_recommended($info);

		$this->view_data('recommened', $rec);

		$serving = $this->_get_serving($info);

		$this->view_data('serving',$serving);

		$sunday = $this->_get_sunday($info);

		$this->view_data('sunday',$sunday);

		$max = $this->_get_max($info);

		$this->view_data('max',$max);

		$archived = $this->_get_archived($info);

		$this->view_data('archived',$archived);

		$this->view_data('date',$info['date']);

	}

	private function _get_recommended($info)
	{
		$this->TeamMember->options['fields'] = array("Member"=>array("id","name","email","phone","profile_pic","times","facebook_id"));
		$this->TeamMember->options['recursive'] = 1;
		$this->TeamMember->belongsTo = array("Member");
		$this->TeamMember->options['joins'] = array(array("MemberWeek","Member"));
		$this->TeamMember->options['where'] = array(
			"Member.times > (SELECT COUNT(*) from (SELECT DISTINCT shift_member.member_id, date.id from shift_member JOIN shift on shift.id = shift_member.shift_id JOIN date on date.id = shift.date_id WHERE date.date BETWEEN '".$info['start_date']."' AND '".$info['end_date']."') dates  WHERE dates.member_id = TeamMember.member_id)",
			"MemberWeek.week_id in (".$info['week_id'].",6)",
			"TeamMember.team_member_type_id !=  4",
			"TeamMember.member_id NOT IN (SELECT shift_member.member_id from shift_member JOIN shift on shift.id = shift_member.shift_id WHERE shift.date_id = ".$info['date_id'].")"
		);
		$this->TeamMember->options['addToEnd'] = "GROUP BY TeamMember.id";

		$members = $this->TeamMember->findByTeamId($info['team_id']);

		if($members) return $members;

		return false;
	}

	private function _get_serving($info)
	{
		$this->TeamMember->options['fields'] = array("Member"=>array("id","name","email","phone","profile_pic","times","facebook_id"),"Team"=>array("id","name"),"Shift"=>array("id","time","team_id"),"TeamMember"=>array('id'));
		$this->TeamMember->options['recursive'] = 3;
		$this->TeamMember->hasMany = array();
		$this->TeamMember->belongsTo = array("Member");
		$this->TeamMember->options['joins'] = array(array("MemberWeek","Member"),array('ShiftMember','Member'),array('ShiftMember','Shift','LEFT',true),array('Shift','Team','LEFT',true));
		$this->TeamMember->options['where'] = array(
			"MemberWeek.week_id in (".$info['week_id'].",6)",
			"TeamMember.team_member_type_id !=  4",
			"TeamMember.member_id IN ( SELECT shift_member.member_id from shift_member JOIN shift on shift.id = shift_member.shift_id WHERE shift.date_id = ".$info['date_id']." AND shift_member.member_id NOT IN (SELECT member_id from shift_member WHERE shift_member.shift_id = ".$info['shift_id']."))",
			"date_id"=>array($info['date_id'],"Shift")
		);
		$this->TeamMember->options['key'] = array("Team"=>"id");


		$members = $this->TeamMember->findByTeamId($info['team_id']);

		if($members) return $members;

		return false;
	}

	private function _get_sunday($info)
	{
		$this->TeamMember->options['fields'] = array("Member"=>array("id","name","email","phone","profile_pic","times","facebook_id"));
		$this->TeamMember->options['recursive'] = 1;
		$this->TeamMember->belongsTo = array("Member");
		$this->TeamMember->options['joins'] = array(array("MemberWeek","Member"));
		$this->TeamMember->options['where'] = array(
			"Member.times > (SELECT COUNT(*) from (SELECT DISTINCT shift_member.member_id, date.id from shift_member JOIN shift on shift.id = shift_member.shift_id JOIN date on date.id = shift.date_id WHERE date.date BETWEEN '".$info['start_date']."' AND '".$info['end_date']."') dates  WHERE dates.member_id = TeamMember.member_id)",
			"TeamMember.member_id NOT IN (SELECT member_id from member_week WHERE member_week.member_id = TeamMember.member_id AND member_week.week_id IN (".$info['week_id'].",6))",
			"TeamMember.team_member_type_id !=  4",
			"TeamMember.member_id NOT IN (SELECT shift_member.member_id from shift_member JOIN shift on shift.id = shift_member.shift_id WHERE shift.date_id = ".$info['date_id'].")"
		);
		$this->TeamMember->options['addToEnd'] = "GROUP BY TeamMember.id";

		$members = $this->TeamMember->findByTeamId($info['team_id']);

		if($members) return $members;

		return false;
	}

	private function _get_max($info)
	{
		$this->TeamMember->options['fields'] = array("Member"=>array("id","name","email","phone","profile_pic","times","facebook_id"));
		$this->TeamMember->options['recursive'] = 1;
		$this->TeamMember->belongsTo = array("Member");
		$this->TeamMember->options['joins'] = array(array("MemberWeek","Member"));
		$this->TeamMember->options['where'] = array(
			"Member.times <= (SELECT COUNT(*) from (SELECT DISTINCT shift_member.member_id, date.id from shift_member JOIN shift on shift.id = shift_member.shift_id JOIN date on date.id = shift.date_id WHERE date.date BETWEEN '".$info['start_date']."' AND '".$info['end_date']."') dates  WHERE dates.member_id = TeamMember.member_id)",
			"MemberWeek.week_id IN (".$info['week_id'].",6)",
			"TeamMember.team_member_type_id !=  4",
			"TeamMember.member_id NOT IN (SELECT shift_member.member_id from shift_member JOIN shift on shift.id = shift_member.shift_id WHERE shift.date_id = ".$info['date_id'].")"
		);
		$this->TeamMember->options['addToEnd'] = "GROUP BY TeamMember.id";

		$members = $this->TeamMember->findByTeamId($info['team_id']);

		if($members) return $members;

		return false;
	}
	private function _get_archived($info)
	{

		$this->TeamMember->options['fields'] = array("Member"=>array("id","name","email","phone","profile_pic","times","facebook_id"));
		$this->TeamMember->options['recursive'] = 1;
		$this->TeamMember->belongsTo = array("Member");
		$this->TeamMember->options['where'] = array(
			"TeamMember.team_member_type_id =  4",
		);
		$this->TeamMember->options['addToEnd'] = "GROUP BY TeamMember.id";

		$members = $this->TeamMember->findByTeamId($info['team_id']);

		if($members) return $members;

		return false;

	}
}