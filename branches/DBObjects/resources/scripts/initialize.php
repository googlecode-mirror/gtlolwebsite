<?php	
	$ROOT = $_SERVER['DOCUMENT_ROOT'];

	/*
		$path is the path relative to the "resources" folder
		eg. "script/initialize.php"
	*/
	function gtInclude($path)
	{
		include compilePath($path);
	}
	
	function gtIncludeOnce($path)
	{
		include_once compilePath($path);
	}
	
	// same syntax as gtInclude()
	function gtRequire($path)
	{
		require compilePath($path);
	}
	
	function gtRequireOnce($path)
	{
		require_once compilePath($path);
	}
	
	function compilePath($path)
	{
		global $ROOT;
		return $ROOT . "/resources/" . $path;
	}
	
	//autoloading classes must come before session_start
	//upon creating a class, you should add to this method
	function autoloadClasses($classname)
	{
		switch($classname)
		{
			// CONTROLLERS
			case 'AnnouncementController':
			case 'SessionController':
			case 'UserController':
				$classpath = 'controllers/';
				break;
		
			// DOMAIN CORE
			case 'Announcement':
			case 'Encryptor':
			case 'Role':
			case 'Roles':
			case 'Session':
			case 'User':
			case 'Validator':
				$classpath = 'domain/core/';
				break;
			
			// DOMAIN CORE SEEDS
			case 'AnnouncementsRepository':
			case 'RolesRepository':
			case 'UserRepository':
				$classpath = 'domain/core/seeds/';
				break;
			
			// INFRASTRUCTURE
			case 'DBConnection':
				$classpath = 'infrastructure/';
				break;
			default:
				//an option is to search the classes directory for the class using readdir(), opendir(), and is_dir(). Should switch below to E_USER_WARNING if this is implemented
				trigger_error("$classname was not found in the list of classes. Please add $classname to autoloadClasses()", E_USER_ERROR);
		}
		
		gtRequireOnce('classes/' . $classpath . $classname . '.class.php');
	}
	
	spl_autoload_register('autoloadClasses');
?>