<?php
	require $_SERVER['DOCUMENT_ROOT'] . "/resources/scripts/initialize.php";
	
	gtRequire("scripts/requireLogin.php");
	
	$hasResponse = false;
	
	if (isset($_SESSION['success']))
	{
		$hasResponse = true;
		$message = $_SESSION['message'];
		$success = $_SESSION['success'];
		
		unset($_SESSION['message']);
		unset($_SESSION['success']);
	}
?>

<!DOCTYPE html>

<html>
<head>
	<title>Make Suggestion for GTLoL</title>
	<?php gtInclude("includes/head.php"); ?>
	<style type="text/css">
		#frmFeedback
		{
			width:50%;
			margin:1em auto;
			text-align:center;
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
		
		/* width */
		#subject, #suggestion
		{
			width:20em;
		}
		
		#suggestion
		{
			height:6em;
		}
	</style>
</head>
<body>
<div id="main">
	<?php gtInclude("includes/top.php"); ?>
	<form id="frmFeedback" class="secondaryFGColor contentBox" action="/resources/form-actions/suggest.php" method="post">
		<?php
			if($hasResponse)
			{
		?>
				<p style="color:<?php if($success) { print("green"); } else { print("red"); } ?>">
					<?php print($message); ?>
				</p>
		<?php } ?>
		<table>
			<tr>
				<td>Subject:</td>
				<td><input type="text" id="subject" name="subject" autofocus="autofocus" /></td>
			</tr>
			<tr>
				<td>Suggestion:</td>
				<td><textarea id="suggestion" name="suggestion"></textarea></td>
			</tr>
		</table>
		<input type="submit" value="Make Suggestion" />
	</form>
	
	<?php gtInclude("includes/foot.php"); ?>
</div>
</body>
</html>