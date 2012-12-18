
<?php

Class Core {
	// holds all the classes that have been instantiated
	private static $instantiated = array();

	// variable for all the debug information
	public static $debug = array(
									"statements"=>array(),
									"instantiated" =>array(),
									"url"=>array(),
									"views"=>array()
								);

	// what extensions to include
	public static $extensions = array();

	// auto routes
	public static $routes = array();

	// loads all the classes automatically
	public static function autoloader($classname)
	{

		// framework specific files
		$files = array(
			"core" =>array(
				"Core"=>"Core.php",
				"Controller"=>"Controller.php",
				"CFDump"=>"CFDump.php",
				"FormHelper"=>"FormHelper.php",
				"Model"=>"Model.php",
				"ORM"=>"ORM.php",
				"Validation"=>"Validation.php",
				"Auth"=>"Auth.php",
				"Asset"=>"Asset.php",
				"Database"=>"Database.php",
				"View"=>"View.php",
				"Session"=>"Session.php")
		);

		// includes framework specific files
		foreach($files as $folder=>$file) {
			foreach($file as $name=>$filePath) {
				if($classname == $name) {
					include_once SYSTEM_PATH."/".$folder."/".$filePath;
					return ;
				}
			}
		}

		// if not in the framework list and includes the word controller instantiate a controller file
		if(strstr($classname,"Controller")) {
			if(strstr($classname,"Test")) {
				include SYSTEM_PATH."/tests/".$classname.".php";
				return;
			}else {
				include SYSTEM_PATH."/controllers/".$classname.".php";
				return;
			}

		}

		// else instantiate a model
		else {
			include SYSTEM_PATH."/models/".$classname.".php";
			return;
		}

	}

	// get all the url information
	public static function getURL()
	{

		// the method that was used to make the call
		$method = strtolower($_SERVER['REQUEST_METHOD']);

		// the url that was called
		$url = $_SERVER["REQUEST_URI"];

		// split on the the question mark if there is one
		// removes the get variables
		$url = preg_split("/[?]/", $url);

		// split on the period
		// get the extension
		$url = preg_split("/[.]/", $url[0]);

		// set the extension to the second half of the split so that we can use it later
		$extension = $url[1];

		// set the uri
		$uri = $url[0];

		// variable for the request that was made
		$request = explode('/',str_replace(dirname($_SERVER['SCRIPT_NAME'])."/",'',$uri));

		// variable for all the information of the url
		$info_of_url = array();

		// check if it is the root url
		// url : /
		if(count($request) === 0) {

			// if the routes has the root in it
			if(isset(Core::$routes['/'])) {

				// set the controller to the one in the route
				$info_of_url['controller'] = Core::$routes['/'][0].'Controller';

				// set the action to the one in the route
				$info_of_url['action'] = Core::$routes['/'][1];

				// if there are params
				if(isset(Core::$routes['/'][2]))$info_of_url['params'] = Core::$routes['/'][2];
			}
			else {

				// set the controller to the default
				$info_of_url['controller'] = ucfirst(Core::$defaultController).'Controller';

				// set the action to the default
				$info_of_url['action'] = Core::$defaultAction;

			}

		}
		// check if request is in the routes
		else if(isset(Core::$routes[strtolower($request[0]."/".$request[1])])) {


			// set the controller to the one in the route
			$info_of_url['controller'] = ucfirst(Core::$routes[strtolower($request[0]."/".$request[1])][0]).'Controller';

			// set the action to the one in the route
			$info_of_url['action'] = Core::$routes[strtolower($request[0]."/".$request[1])][1];

			// if there are params
			if(isset(Core::$routes[strtolower($request[0]."/".$request[1])][2]))$info_of_url['params'] = Core::$routes[strtolower($request[0]."/".$request[1])][2];


		}
		// check if controller exists
		else if(is_file(SYSTEM_PATH."/controllers/".ucfirst($request[0])."Controller.php"))
		{

			// set the controller
			$info_of_url['controller'] = ucfirst($request[0]).'Controller';

			// if there is an extension
			if($extension)

			{
				$info_of_url['ext'] = $extension;
			}

			// if there is an second value
			if (isset($request[1]))
			{

				// check if the action exists, if it does
				if(method_exists($info_of_url['controller'], $request[1]))
				{
					// set the action
					// url: /controller/action
					$info_of_url['action'] = $request[1];

					// if there is a third value
					if(isset($request[2]))
					{

						// set the params
						// url: /controller/action/param
						$info_of_url['params'] = $request[2];

					}

				}

				// if the second argument is numeric
				// url: /controller/param
				else if(is_numeric($request[1]))
				{

					// if rest is turned on and method is a method inside controller
					// url: /controller/param with request
					if(REST && method_exists($info_of_url['controller'], $method))
					{

						// set the action to the method
						$info_of_url['action'] = $method;

					}

					// if rest isn't on and default action is a method
					// url: /controller/param without request
					else if(method_exists($info_of_url['controller'], DEFAULT_ACTION))
					{

						// set the action to the default
						$info_of_url['action'] = DEFAULT_ACTION;

					}


					// set the params to the  second value
					$info_of_url['params'] = $request[1];

				}

			}

			// if there is no second value
			else
			{

				// if rest is turned on and method is a method inside controller
				// url: /controller with request
				if(REST && method_exists($info_of_url['controller'], $method))
				{

					// set the action to the method
					$info_of_url['action'] = $method;

				}

				// if rest isn't on and default action is a method
				// url: /controller without request
				else if(method_exists($info_of_url['controller'], DEFAULT_ACTION))
				{

					// set the action to the default
					$info_of_url['action'] = DEFAULT_ACTION;

				}

			}

		}
		if(DEBUG) {

			Core::$debug['url'] = $info_of_url;
		}
		// return the information
		return $info_of_url;

	}

	// create a new class
	public static function instantiate($classname)
	{
		// if it has already been instantiated
		if(isset(self::$instantiated[$classname]))
		{

			//return that one
			return self::$instantiated[$classname];

		}

		// if it hasn't been instantiated
		else
		{

			// push the name into array for debugging
			array_push(self::$debug['instantiated'],$classname);

			// instatiate it and put it in the array and then return it
			return self::$instantiated[$classname] = new $classname;
		}

	}


	// redirect to pages
	public static function redirect($controller,$action,$params=array())
	{
		$url = Asset::create_url($controller,$action,$params);
		header( "Location: $url" ) ;
	}

	// run the function
	public static function run()
	{

		// get all the information
		$info_of_url = self::getURL();

		// only do this if there is a controller and an action
		if(isset($info_of_url['controller']) && isset($info_of_url['action']))
		{
			// create the controller
			$controller = self::instantiate($info_of_url['controller']);

			// set up the request on the controller for later use
			$controller->request = array(
											"GET" => $_GET,
											"POST" => $_POST,
											"SERVER" => $_SERVER,
											"TYPE" => $_SERVER['REQUEST_METHOD'],
											"AJAX" => !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
										);

			// if rest is on and the request type was json
			if(REST && $controller->request['SERVER']['CONTENT_TYPE'] === "application/json")
			{

				// set the request type's data to the php input stream
				$controller->reqest[$controller->request['TYPE']] = json_decode(file_get_contents("php://input"));

			}
			//TODO: Add XML and other format support

			// call the before action method
			$controller->beforeAction();

			// set the view
			$controller::$viewname = $info_of_url['action'];

			// set the template if one is not set already
			$controller::$template = empty($controller::$template)?DEFAULT_TEMPLATE:$controller::$template;

			// if there are params
			if(isset($info_of_url['params']))
			{
				// pass them to the action
				$controller->$info_of_url['action'](implode(",", $data['params']));

			}

			// else pass any information that came through the request
			else
			{

				$controller->$info_of_url['action']($controller->request[$controller->request['TYPE']]);

			}

			// run the after action method
			$controller->afterAction();

			// name of the controller
			$controller_name = strtolower(str_replace("Controller", "", $info_of_url['controller']));

			// extension
			$extension = isset($info_of_url['ext'])?".".$info_of_url['ext']:DEFAULT_VIEW_TYPE;

			// path to view
			$file_name= "$controller_name/{$controller::$viewname}$extension";

			// set the template to false
			$template = false;

			// if it is not ajax
			if(!$controller->request['AJAX'])
			{

				// the template to be rendered
				$template = $controller::$template;

			}

			// render the page
			View::render($file_name,$controller::$view_info,$template,$controller::$layout_info);

		}

		// if there isn't' a controller or action doing the following
		else
		{

			// TODO: Put 404 Page saying not controller/action

		}

		// if debug is on
		if(DEBUG)
		{
			// render the debug stylesheet
			echo "<style type='text/css'>".View::get_contents(SYSTEM_PATH."/core/debug.css")."</style>";

			// create div to hold information
			echo "<div id='debuger'>";

			// loop through all the different key values in debug
			foreach(self::$debug as $title=>$info)
			{

				// set the key (title) to an h2
				echo "<h2>".$title."</h2>";

				// loop through the value (info)
				foreach ($info as $num => $para)
				{

					// echo out the index number and the value
					echo "<p><span>".$num."</span>".$para."</p>";

				}

			}

			// close the div
			echo "</div>";
		}

	}

	static public function encrypt($value) {

		if(SALT == "1a2b3c4d5e6f7g8h9i10j11k12l13m14n15o16p") {

			echo "Please change the salt in your settings to a unique set of characters";

		}else {

			return md5($value.SALT);
		}
	}

	// split on caps, add underscores and then convert it to lowercase
	static function toDB($string){

		$string = preg_replace('/\B([A-Z])/', '_$1', $string);
    	return strtolower($string);
	}

	// replace underscores with spaces and capitalize first letter
	static function toNorm($string) {
		$string = str_replace("_", " ", $string);
		return ucfirst($string);
	}

	// find the underscores and convert the following letter to and uppercase
	static function toCam($string) {
		$func = create_function('$c', 'return strtoupper($c[1]);');
    	$string = preg_replace_callback('/_([a-z])/', $func, $string);
		return ucfirst($string);
	}

}