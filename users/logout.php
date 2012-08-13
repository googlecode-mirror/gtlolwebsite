<?php
	require $_SERVER['DOCUMENT_ROOT'] . "/resources/scripts/initialize.php";

	SessionController::logout();

	gtRequire("scripts/redirect.php");
?>