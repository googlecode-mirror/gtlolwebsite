<?php
	//only visitors who are not logged in are allowed to continue
	
	session_start();
	
	if (isset($_SESSION['userID']))
	{
		//user is logged in
		
		if (isset($_GET['returnURL']))
		{
			$url = $_GET['returnURL'];
		}
		else
		{
			$url = $_SERVER['DOCUMENT_ROOT'];
		}
		
		header("Location: $url");
	}
?>