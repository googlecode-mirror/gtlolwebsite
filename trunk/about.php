<?php
	require $_SERVER['DOCUMENT_ROOT'] . "/resources/scripts/initialize.php";
	
	gtIncludeOnce('constants.php');
	
	global $PRESIDENT, $VICE_PRESIDENT, $TREASURER, $SECRETARY, $WEB_MASTER;
?>

<!DOCTYPE html>

<html>
<head>
	<title>Login</title>
	<?php gtInclude("includes/head.php"); ?>
</head>
<body>
<div id="main">
	<?php gtInclude("includes/top.php"); ?>
	<div id="content" class="primaryFGColor contentBox">
		<p>
			GTLoL is a legitimate League of Legends club at Georgia Tech.
			We have meetings and host tournaments (both online and on campus).
		</p>
		<h2>Leaders</h2>
		<p>
			President: <?php print($PRESIDENT); ?><br />
			Vice President: <?php print($VICE_PRESIDENT); ?><br />
			Treasurer: <?php print($TREASURER); ?><br />
			Secretary: <?php print($SECRETARY); ?><br />
			Web Master: <?php print($WEB_MASTER); ?><br />
		</p>
	</div>
	<?php gtInclude("includes/foot.php"); ?>
</div>
</body>
</html>