<?php
	require $_SERVER['DOCUMENT_ROOT'] . "/resources/scripts/initialize.php";

	gtRequireOnce("scripts/startSession.php");
	session_destroy();

	gtRequire("scripts/redirect.php");
?>