<?php
include("../system/core/Core.php");
include("../system/Settings.php");

define("SYSTEM_PATH", "../system/");

spl_autoload_register('Core::autoloader');

include("../system/extensions/Twilio/bootstrap.php");

$database = Core::instantiate("Database");

$today = Date("w");
$sunday = Date("m/d/y",strtotime("next Sunday"));

$statement = "Select team.name, member.phone, date.date, shift.time from shift_member LEFT JOIN shift ON shift_member.shift_id = shift.id LEFT JOIN member ON shift_member.member_id = member.id LEFT JOIN date ON shift.date_id = date.id LEFT JOIN team on shift.team_id = team.id WHERE member.reminder_day_id = :reminder_day_id AND date.date = :date ";
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
			$message = "Don't forget you signed up to serve this Sunday (".$result['date'].") on the ".$result['name']." team at ".$result['time'].".";

			$phone = preg_replace('/[\D]/', "", $result['phone']);

			// send a message using twilio
			$twilio = Core::instantiate("TwilioController");
			$message = $twilio->account->sms_messages->create("4073783757",$phone,$message);
		}


	}




}

?>