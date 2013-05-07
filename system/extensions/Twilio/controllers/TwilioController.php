<?php

Class TwilioController extends Services_Twilio
{

	public function __construct()
	{
		$sid = 'AC5ce6419b16f869e4d59e36456d022aaa';
		$token = 'a80601eb7fb9ed4d1ff1214d9042a13b';

		parent::__construct($sid,$token);
	}

}