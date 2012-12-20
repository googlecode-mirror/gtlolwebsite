<?php
	//only visitors who are not logged in are allowed to continue
	
	if (SessionController::userIsLoggedIn())
	{
		gtRequire("scripts/redirect.php");
	}
?>