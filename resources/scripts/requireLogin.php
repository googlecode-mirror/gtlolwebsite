<?php
	gtRequireOnce("scripts/startSession.php");
	
	if (!(isset($_SESSION['userID']) && $_SESSION['userID'] > 0))
	{
		header("Location: " . $_SERVER['DOCUMENT_ROOT'] . "/users/login.php?returnURL=" . $_SERVER['PHP_SELF']);
	}
?>