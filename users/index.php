<?php
	require $_SERVER['DOCUMENT_ROOT'] . "/resources/scripts/initialize.php";
	gtRequireOnce("scripts/requireLogin.php");
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
	<div class="primaryFGColor contentBox">
		Welcome <?php print(SessionController::getCurrentUsersUsername()); ?>!
	</div>
	<?php gtInclude("includes/foot.php"); ?>
</div>
</body>
</html>