<?php
	gtRequireOnce("scripts/requireLogin.php");
	
	if (!SessionController::currentUserIsAdmin())
	{
		header("Location: admin-required.php?returnURL=" . $_SERVER['PHP_SELF']);
	}
?>