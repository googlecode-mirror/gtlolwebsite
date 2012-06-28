<?php

	/*
		$path is the path relative to the "resources" folder
		eg. "script/include.php"
	*/
	function gtInclude($path)
	{
		include $_SERVER['DOCUMENT_ROOT'] . "/resources/" . $path;
	}
	
	// same syntax as gtInclude()
	function gtRequire($path)
	{
		require $_SERVER['DOCUMENT_ROOT'] . "/resources/" . $path;
	}
?>