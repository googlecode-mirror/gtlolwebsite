<?php
	require $_SERVER['DOCUMENT_ROOT'] . "/resources/functions/include.php";

	gtRequireOnce("scripts/startSession.php");
	session_destroy();

	gtRequire("scripts/redirect.php");
?>