<?php
	if (!SessionController::userIsLoggedIn())
	{
		gtRequireOnce("constants.php");
		
		global $SERVER;
		
		header("Location: http://" . $SERVER . "/users/login.php?returnURL=" . $_SERVER['PHP_SELF']);
	}
?>