<?php
define("SYSTEM_PATH", "../../serve_cbc/");
//define("SYSTEM_PATH","../system/");

include(SYSTEM_PATH."core/Core.php");
include(SYSTEM_PATH."Settings.php");

spl_autoload_register('Core::autoloader');

echo "hello";
Core::run_extenstions();

	$date_controller = Core::instantiate("DateController");

	$weeks = $date_controller->index();

	$current_week = $weeks[0];

	$team_email = array();
	$team_info = array();
	$team_id = 0;
	foreach($current_week['Shift'] as $shift)
	{
		// if we have a new team
		if($shift['team_id'] !== $team_id)
		{
			$team_id = $shift['team_id'];
			$team_info[$team_id] = array();
			$team_email[$team_id] = "Hello Team Leader!\n\n";
			$team_email[$team_id] .= "Here are the members of your team that are serving this week.\n";

		}

		$team_email[$team_id].= "\nServing at ".$shift['time'].":\n";
		if($shift['members'])
		{
			foreach($shift['members'] as $member){

				$team_email[$team_id] .= $member['Member']['name']."\n";
			}
		}
		else
		{
			$team_email[$team_id] .= "Sorry you have no members serving at this time\n";
		}

		$info = array(
			"date" => $current_week['date'],
			"date_id" => $shift['date_id'],
			"team_id" => $shift['team_id'],
			"shift_id" => $shift['id'],
			"shift_time" => $shift['time']
		);
		array_push($team_info[$team_id], $info);

	}

	$team_controller = Core::instantiate("TeamMemberController");

	foreach ($team_info as $team_id => $shifts) {

		$team_email[$team_id] .= "\nIf you are in need of more members reach out to the people below:\n";

		foreach($shifts as $shift)
		{
			$team_email[$team_id] .= "\nAvailable at ".$shift['shift_time']."\n";

			$member_info = $team_controller->available($shift);

			if(!empty($member_info['recommened']))
			{

				$team_email[$team_id] .= "\nRecommended Members:\n";
				foreach($member_info['recommened'] as $member)
				{
					$team_email[$team_id] .=  $member['Member']['name']."\t\t".$member['Member']['email']."\t\t".Member::phone($member['Member']['phone'],false)."\n";
				}

			}
			else
			{
				$team_email[$team_id] .= "Sorry there are no recommended members for this opportunity.\n\n";
			}
			if(!empty($member_info['serving']))
			{

				$team_email[$team_id] .= "\nAlready Serving:\n";
				foreach($member_info['serving'] as $member)
				{
					$team_email[$team_id] .=  $member['Member']['name']."\t\t".$member['Member']['email']."\t\t".Member::phone($member['Member']['phone'],false)."\n";
				}

			}
			if(!empty($member_info['sunday']))
			{
				$team_email[$team_id] .= "\nDon't Prefer This Sunday:\n";
				foreach($member_info['sunday'] as $member)
				{
					$team_email[$team_id] .=  $member['Member']['name']."\t\t".$member['Member']['email']."\t\t".Member::phone($member['Member']['phone'],false)."\n";
				}

			}
			if(!empty($member_info['max']))
			{
				$team_email[$team_id] .= "\nAlready Served Preferred Amount of Weeks:\n";
				foreach($member_info['max'] as $member)
				{
					$team_email[$team_id] .=  $member['Member']['name']."\t\t".$member['Member']['email']."\t\t".Member::phone($member['Member']['phone'],false)."\n";
				}

			}
			if(!empty($member_info['archived']))
			{
				$team_email[$team_id] .= "\nArchived:\n";
				foreach($member_info['archived'] as $member)
				{
					$team_email[$team_id] .=  $member['Member']['name']."\t\t".$member['Member']['email']."\t\t".Member::phone($member['Member']['phone'],false)."\n";
				}

			}
		}


	}

$team_member = Core::instantiate('TeamMember');

	$team_member->belongsTo = array("Member");
	$team_member->hasMany = array();

	foreach($team_email as $team_id=>$email)
	{

		$team_member->options['fields'] = array("Member"=>array('id','email'),"TeamMember"=>array('id','team_id'));

		$members = $team_member->findByTeamIdAndTeamMemberTypeId($team_id,1);

		if($team_member->success)
		{

			foreach($members as $member)
			{


				echo "<pre>";
				var_dump('$member',$member);
				echo "</pre>";

			}

		}

	}

?>