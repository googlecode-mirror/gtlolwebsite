<?php
	require $_SERVER['DOCUMENT_ROOT'] . "/resources/scripts/initialize.php";
	gtRequireOnce("scripts/requireAdmin.php");
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
		<h1>Administrator Home Page</h1>
		<ul>
			<li>
				<a href="manage-announcements.php">Manage Announcements</a>
			</li>
		</ul>
	</div>
	<?php gtInclude("includes/foot.php"); ?>
</div>
</body>
</html>