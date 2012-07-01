<?php
	$ROOT = $_SERVER['DOCUMENT_ROOT'];
	$SERVER = 'localhost:8080'; //eg google.com

	/*
		$path is the path relative to the "resources" folder
		eg. "script/include.php"
	*/
	function gtInclude($path)
	{
		global $ROOT;
		include $ROOT . "/resources/" . $path;
	}
	
	// same syntax as gtInclude()
	function gtRequire($path)
	{
		global $ROOT;
		require $ROOT . "/resources/" . $path;
	}
?>