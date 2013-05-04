<?php
Class FacebookAPIController extends Facebook
{
	public function __construct()
	{
		// setup facebook
		$config = array();
		$config['appId'] = APP_ID;
		$config['secret'] = SECRET;

		 parent::__construct($config);
	}
}