<?php
	//receives the post data from /suggest.php then redirects to /suggest.php with a response
	
	require $_SERVER['DOCUMENT_ROOT'] . "/resources/scripts/initialize.php";
	gtRequireOnce('scripts/startSession.php');
	gtRequireOnce('constants.php');
	
	extract($_POST);
	$mailSuccessful = mail("jdreddaway@gatech.edu", $subject, $message);
	$_SESSION['success'] = $mailSuccessful;
	
	if ($mailSuccessful)
	{
		$_SESSION['message'] = "Your suggestion was successfully sent!
								Note: abusing this suggestion system will result in a permanent ban on your account.";
	}
	else
	{
		$_SESSION['message'] = "An error occurred while sending your suggestion.
								Please try again later or contact the web developer if the problem persists.";
	}
	
	header("Location: http://" . $SERVER . "/suggest.php");
?>