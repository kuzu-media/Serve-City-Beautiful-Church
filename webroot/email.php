<?php

define("SYSTEM_PATH", "../../serve_cbc/");
define("SYSTEM_PATH","../system/");

include(SYSTEM_PATH."core/Core.php");
include(SYSTEM_PATH."Settings.php");

spl_autoload_register('Core::autoloader');

include(SYSTEM_PATH."extensions/Twilio/bootstrap.php");

$database = Core::instantiate("Database");

$today = Date("w");
$sunday = Date("m/d/y",strtotime("Sunday"));

$statement = "Select team.name AS team_name, member.name, member.phone, member.email, member.alert_type_id, date.date, shift.time from shift_member LEFT JOIN shift ON shift_member.shift_id = shift.id LEFT JOIN member ON shift_member.member_id = member.id LEFT JOIN date ON shift.date_id = date.id LEFT JOIN team on shift.team_id = team.id WHERE member.reminder_day_id = :reminder_day_id AND date.date = :date ";
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





?>