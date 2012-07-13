<?php //should be called using require_once

	//autoloading classes must come before session_start
	function autoloadClasses($classname)
	{
		gtRequireOnce('classes/' . $classname . '.class.php');
	}
	
	spl_autoload_register('autoloadClasses');
	
	session_start();
?>