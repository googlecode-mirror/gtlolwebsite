<?php
	//only visitors who are not logged in are allowed to continue
	
	gtRequireOnce("scripts/startSession.php");
	
	if (isset($_SESSION['user']))
	{
		//user is logged in
		gtRequire("scripts/redirect.php");
	}
?>