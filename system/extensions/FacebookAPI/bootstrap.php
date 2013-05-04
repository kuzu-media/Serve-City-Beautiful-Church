<?php
	/**
	 * Initialize the facebook plugin
	 * @category Extensions
 	 * @package  Extensions
 	 * @subpackage Facebook
	 * @author     Rachel Higley <me@rachelhigley.com>
	 * @copyright  2013 Framework Simple
	 * @license    http://www.opensource.org/licenses/mit-license.php MIT
	 * @link       http://rachelhigley.com/framework
	 */

	include "Settings.php";

	Core::add_classes("FacebookAPI",array(
		"FacebookAPIController" => "controllers/FacebookAPIController.php",
		"Facebook"     =>"controllers/facebook.php",
		"BaseFacebook"     =>"models/base_facebook.php",
		)
	);