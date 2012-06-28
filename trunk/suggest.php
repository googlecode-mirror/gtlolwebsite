<?php
	require $_SERVER['DOCUMENT_ROOT'] . "/resources/functions/include.php";
	
	gtRequire("scripts/requireLogin.php");
?>

<!DOCTYPE html>

<html>
<head>
	<title>Make Suggestion for GTLoL</title>
	<!-- allows users to submit a request to GT LoL 
		will post to self
		self will send email if necessary then disable all form elements with the sent values also added
			need to add javascript or html that prevents user from resubmitting.
		Bad idea because what if they refresh? need to post to another page that redirects to self if want to do this
			need to store post data in $_SESSION
	-->
	<?php gtInclude("includes/head.php"); ?>
	
	<style type="text/css">
		#frmFeedback
		{
			width:50%;
			margin:1em auto;
			text-align:center;
			padding:1em;
			border-radius:1em;
		}
		
		#frmFeedback > table
		{
			width:100%;
			margin:auto;
		}
		
		#frmFeedback td
		{
			text-align:left;
		}
		
		#frmFeedback td:first-child
		{
			text-align:right;
			width:40%;
		}
		
		#frmFeedback td > span
		{
			display:none;	
			color:red;
		}
	</style>
</head>
<body>
<div id="main">
	<?php gtInclude("includes/top.php"); ?>
	
	<form id="frmFeedback" class="secondaryFGColor" action="register.php" method="post">
		
	</form>
	
	<?php gtInclude("includes/foot.php"); ?>
</div>
</body>
</html>