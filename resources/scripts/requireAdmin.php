<?php
	gtRequireOnce("scripts/requireLogin.php");
	
	$adminRole = new Role(Roles::ADMIN);
	$user = $_SESSION['user'];
	if (!$adminRole->userHasRole($user))
	{
		header("Location: admin-required.php?returnURL=" . $_SERVER['PHP_SELF']);
	}
?>