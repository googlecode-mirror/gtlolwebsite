<?php
	//receives the post data from /suggest.php then redirects to /suggest.php with a response
	
	require $_SERVER['DOCUMENT_ROOT'] . "/resources/scripts/initialize.php";
	gtRequireOnce('scripts/startSession.php');
	gtRequireOnce('constants.php');
	
	//send email
	
	$_SESSION['message'] = "Sorry! This functionality has not been completed yet.";
	$_SESSION['success'] = false;
	
	header("Location: http://" . $SERVER . "/suggest.php");
?>