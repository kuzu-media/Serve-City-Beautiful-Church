<?php

define("SYSTEM_PATH", "../../serve_cbc/");
// define("SYSTEM_PATH","../system/");


include(SYSTEM_PATH."core/Core.php");
include(SYSTEM_PATH."Settings.php");

spl_autoload_register('Core::autoloader');

include(SYSTEM_PATH."extensions/Twilio/bootstrap.php");

$database = Core::instantiate("Database");

$today = Date("w");
$sunday = Date("m/d/y",strtotime("Sunday"));

$statement = "Select team.name AS team_name, member.name, member.phone, member.email, member.alert_type_id, date.date, shift.time from shift_member LEFT JOIN shift ON shift_member.shift_id = shift.id LEFT JOIN member ON shift_member.member_id = member.id LEFT JOIN date ON shift.date_id = date.id LEFT JOIN team on shift.team_id = team.id WHERE member.reminder_day_id = :reminder_day_id AND date.date = :date  AND shift_member.shift_member_type_id NOT IN (3,4)";
$stmt = $database->db->prepare($statement);

// if the execution works
if($stmt->execute(array("reminder_day_id"=>$today,"date"=>$sunday)))
{

	// get all the columns
	$results = $stmt->fetchAll();

	if($results)
	{

		foreach ($results as $result)
		{
			$email = "";
			$message = "Remember you signed up to serve this Sunday (".$result['date'].") on the ".$result['team_name']." team at ".$result['time'].".";
			if($result['alert_type_id'] === "1")
			{
				$email .= "Hey ".$result['name']."!\n\n";
				$email .= $message;
				$email .= "\n\nSee You Then!";

				mail($result['email'],"Friendly Reminder!",$email,"From: serve@citybeautifulchurch.com");
			}
			else
			{

				$phone = preg_replace('/[\D]/', "", $result['phone']);

				// send a message using twilio
				$twilio = Core::instantiate("TwilioController");
				$message = $twilio->account->sms_messages->create("4073783757",$phone,$message);
			}


		}


	}

}

if($today ===  "3")
{

	Core::run_extenstions();

	$date_controller = Core::instantiate("DateController");

	$weeks = $date_controller->index();

	$current_week = $weeks[0];

	$team_email = array();
	$team_info = array();
	$team_id = 0;
	foreach($current_week['Shift'] as $shift)
	{
		$shift_members = $shift['ShiftMember'];
		$shift_members_info = $shift["Member"];
		$shift = $shift['Shift'];
		// if we have a new team
		if($shift['team_id'] !== $team_id)
		{
			$team_id = $shift['team_id'];
			$team_info[$team_id] = array();
			$team_email[$team_id] = "Hello Team Leader!\n\n";
			$team_email[$team_id] .= "Here are the members of your team that are serving this week.\n";

		}

		$team_email[$team_id].= "\nServing at ".$shift['time'].":\n";
		if($shift_members_info)
		{
			foreach($shift_members_info as $member){

				$team_email[$team_id] .= $member['name']."\n";
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
			"time" => $shift['time']
		);
		array_push($team_info[$team_id], $info);

	}

	$team_controller = Core::instantiate("TeamMemberController");

	foreach ($team_info as $team_id => $shifts) {

		$team_email[$team_id] .= "\nIf you are in need of more members reach out to the people below:\n";

		foreach($shifts as $shift)
		{
			$team_email[$team_id] .= "\nAvailable at ".$shift['time']."\n";

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
				mail($member['Member']['email'],"Team Leader Update!",$email,"From: serve@citybeautifulchurch.com");
			}

		}

	}

}

if(date("j") === "20")
{

	function send_email()
	{
		$requests = Core::instantiate('Request');

		$requests->options['where'] = array("Request.member_id = (SELECT member_id from request ORDER BY member_id LIMIT 1)");

		$member = $requests->findAll();

		if($requests->success)
		{
			$email_info = array("name"=>$member[0]['Request']['name']);
			$email_info['shifts'] = $member;

			// send the email
			mail($member[0]['Request']['email'], "You have been invited to serve!", View::render('emails/request',$email_info,array("render"=>false)),'MIME-Version: 1.0' . "\r\n".'Content-type: text/html; charset=iso-8859-1' . "\r\nFrom: serve@citybeautifulchurch.com");

			foreach($member as $member_delete)
			{
				$requests->delete($member_delete['Request']['id']);
			}

			send_email();
		}
	}

	send_email();


}

?>