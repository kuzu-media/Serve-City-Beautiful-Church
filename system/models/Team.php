<?php
Class Team extends Model
{

	public $hasMany = array('Shift','TeamMember','Testimonial');

	public $required = array('name');

	public $rules = array(
		'id' => array('numeric','maxLength' =>11),
		'name' => array('alphaNumeric','maxLength' =>250),
		'photo' => array('alphaNumeric','maxLength' =>250),
		'summary' => array('alphaNumeric','maxLength' =>250),
		'video' => array(),
		'content' => array()
		);


	public function get_team_names($indexes=false)
	{
		// on get this table
		$this->options['recursive'] = 0;

		// only get the id and name
		$this->options['fields'] = array("Team"=>array("id","name"));

		// get all of them
		$team_names = $this->findByTeamTypeId(1);

		if(Auth::user('member_type_id') === "3")
		{
			// on get this table
			$this->options['recursive'] = 0;

			// only get the id and name
			$this->options['fields'] = array("Team"=>array("id","name"));

			// get the hidden teams
			$hidden_teams = $this->findByTeamTypeId(2);

			if($hidden_teams) $team_names = array_merge($team_names, $hidden_teams);
		}
		else{

				// on get this table
				$this->options['recursive'] = 0;

				// only get the id and name
				$this->options['fields'] = array("Team"=>array("id","name"));

				// only get hidden teams that this member belongs to
				$this->options['where'] = array("Team.id IN (SELECT team_id FROM team_member AS TeamMember WHERE TeamMember.member_id = ".Auth::user('id').")");

				// get the hidden teams
				$hidden_teams = $this->findByTeamTypeId(2);
				if($hidden_teams) $team_names = array_merge($team_names, $hidden_teams);

		}
		return $team_names;

	}

	public function team_ids($team_names)
	{

		$ids = "";
		foreach($team_names as $team)
		{
			$ids .= $team['id'].",";
		}
		$ids = substr($ids, 0,-1);

		return $ids;
	}


}