<?php
	gtRequireOnce("scripts/startSession.php");
	
	if (!isset($_SESSION['user']))
	{
		gtRequireOnce("constants.php");
		
		global $SERVER;
		
		header("Location: http://" . $SERVER . "/users/login.php?returnURL=" . $_SERVER['PHP_SELF']);
	}
?>