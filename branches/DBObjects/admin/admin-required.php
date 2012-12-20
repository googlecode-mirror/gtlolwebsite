<?php require $_SERVER['DOCUMENT_ROOT'] . "/resources/scripts/initialize.php"; ?>

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
		<p>
			You must be logged in as an administrator to view this page.
			Please <a href="/users/logout.php<?php print(isset($_GET['returnURL']) ? "?returnURL=" . $_GET['returnURL'] : ""); ?>">logout</a> and login as an administrator.
		</p>
	</div>
	<?php gtInclude("includes/foot.php"); ?>
</div>
</body>
</html>