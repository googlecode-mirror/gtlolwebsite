<?php
	require $_SERVER['DOCUMENT_ROOT'] . "/resources/functions/include.php";

	session_start();
	session_destroy();

	gtRequire("scripts/redirect.php");
?>