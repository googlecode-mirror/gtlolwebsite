<?php
	$ROOT = $_SERVER['DOCUMENT_ROOT'];

	/*
		$path is the path relative to the "resources" folder
		eg. "script/include.php"
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
?>