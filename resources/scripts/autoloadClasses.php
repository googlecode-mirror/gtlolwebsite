<?php
	//use this to set up classes to automatically be loaded when needed
	
	function autoloadClasses($classname)
	{
		gtRequireOnce('classes/' . $classname . '.class.php');
	}
?>