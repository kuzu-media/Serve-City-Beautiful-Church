<?php
	/**
	 * Initialize the soft deletion extension
	 * @category Extensions
 	 * @package  Extensions
 	 * @subpackage Scafolding
	 * @author     Rachel Higley <me@rachelhigley.com>
	 * @copyright  2013 Framework Simple
	 * @license    http://www.opensource.org/licenses/mit-license.php MIT
	 * @link       http://rachelhigley.com/framework
	 */

	Core::add_classes("Twilio",array(
		"TwilioController"     =>"controllers/TwilioController.php",
		"Services_Twilio"      =>"controllers/Twilio.php",
		"Services_Twilio_AutoPagingIterator"=>"controllers/Twilio/AutoPagingIterator.php",
		"Services_Twilio_Capability"=>"controllers/Twilio/Capability.php",
		"Services_Twilio_InstanceResource"=>"controllers/Twilio/InstanceResource.php",
		"Services_Twilio_ListResource"=>"controllers/Twilio/ListResource.php",
		"Services_Twilio_Page"=>"controllers/Twilio/Page.php",
		"Services_Twilio_PartialApplicationHelper"=>"controllers/Twilio/PartialApplicationHelper.php",
		"Services_Twilio_RequestValidator"=>"controllers/Twilio/RequestValidator.php",
		"Services_Twilio_Resource"=>"controllers/Twilio/Resource.php",
		"Services_Twilio_RestException"=>"controllers/Twilio/RestException.php",
		"Services_Twilio_TimeRangeResource"=>"controllers/Twilio/TimeRangeResource.php",
		"Services_Twilio_TinyHttp"=>"controllers/Twilio/TinyHttp.php",
		"Services_Twilio_Twiml"=>"controllers/Twilio/Twiml.php",
		"Services_Twilio_UsageResource"=>"controllers/Twilio/UsageResource.php",
		"Services_Twilio_Rest_Account"=>"controllers/Twilio/Rest/Account.php",
		"Services_Twilio_Rest_Accounts"=>"controllers/Twilio/Rest/Accounts.php",
		"Services_Twilio_Rest_Application"=>"controllers/Twilio/Rest/Application.php",
		"Services_Twilio_Rest_Applications"=>"controllers/Twilio/Rest/Applications.php",
		"Services_Twilio_Rest_AuthorizedConnectApp"=>"controllers/Twilio/Rest/AuthorizedConnectApp.php",
		"Services_Twilio_Rest_AuthorizedConnectApps"=>"controllers/Twilio/Rest/AuthorizedConnectApps.php",
		"Services_Twilio_Rest_AvailablePhoneNumber"=>"controllers/Twilio/Rest/AvailablePhoneNumber.php",
		"Services_Twilio_Rest_AvailablePhoneNumbers"=>"controllers/Twilio/Rest/AvailablePhoneNumbers.php",
		"Services_Twilio_Rest_Call"=>"controllers/Twilio/Rest/Call.php",
		"Services_Twilio_Rest_Calls"=>"controllers/Twilio/Rest/Calls.php",
		"Services_Twilio_Rest_Conference"=>"controllers/Twilio/Rest/Conference.php",
		"Services_Twilio_Rest_Conferences"=>"controllers/Twilio/Rest/Conferences.php",
		"Services_Twilio_Rest_ConnectApp"=>"controllers/Twilio/Rest/ConnectApp.php",
		"Services_Twilio_Rest_ConnectApps"=>"controllers/Twilio/Rest/ConnectApps.php",
		"Services_Twilio_Rest_IncomingPhoneNumber"=>"controllers/Twilio/Rest/IncomingPhoneNumber.php",
		"Services_Twilio_Rest_IncomingPhoneNumbers"=>"controllers/Twilio/Rest/IncomingPhoneNumbers.php",
		"Services_Twilio_Rest_Member"=>"controllers/Twilio/Rest/Member.php",
		"Services_Twilio_Rest_Members"=>"controllers/Twilio/Rest/Members.php",
		"Services_Twilio_Rest_Notifcation"=>"controllers/Twilio/Rest/Notifcation.php",
		"Services_Twilio_Rest_Notifications"=>"controllers/Twilio/Rest/Notifications.php",
		"Services_Twilio_Rest_OutgoingCallerId"=>"controllers/Twilio/Rest/OutgoingCallerId.php",
		"Services_Twilio_Rest_OutgoingCallerIds"=>"controllers/Twilio/Rest/OutgoingCallerIds.php",
		"Services_Twilio_Rest_Participant"=>"controllers/Twilio/Rest/Participant.php",
		"Services_Twilio_Rest_Participants"=>"controllers/Twilio/Rest/Participants.php",
		"Services_Twilio_Rest_Queue"=>"controllers/Twilio/Rest/Queue.php",
		"Services_Twilio_Rest_Queues"=>"controllers/Twilio/Rest/Queues.php",
		"Services_Twilio_Rest_Recording"=>"controllers/Twilio/Rest/Recording.php",
		"Services_Twilio_Rest_Recordings"=>"controllers/Twilio/Rest/Recordings.php",
		"Services_Twilio_Rest_Sandbox"=>"controllers/Twilio/Rest/Sandbox.php",
		"Services_Twilio_Rest_ShortCode"=>"controllers/Twilio/Rest/ShortCode.php",
		"Services_Twilio_Rest_ShortCodes"=>"controllers/Twilio/Rest/ShortCodes.php",
		"Services_Twilio_Rest_SmsMessage"=>"controllers/Twilio/Rest/SmsMessage.php",
		"Services_Twilio_Rest_SmsMessages"=>"controllers/Twilio/Rest/SmsMessages.php",
		"Services_Twilio_Rest_Transcription"=>"controllers/Twilio/Rest/Transcription.php",
		"Services_Twilio_Rest_Transcriptions"=>"controllers/Twilio/Rest/Transcriptions.php",
		"Services_Twilio_Rest_UsageRecord"=>"controllers/Twilio/Rest/UsageRecord.php",
		"Services_Twilio_Rest_UsageRecords"=>"controllers/Twilio/Rest/UsageRecords.php",
		"Services_Twilio_Rest_UsageTrigger"=>"controllers/Twilio/Rest/UsageTrigger.php",
		"Services_Twilio_Rest_UsageTriggers"=>"controllers/Twilio/Rest/UsageTriggers.php",

		)
	);