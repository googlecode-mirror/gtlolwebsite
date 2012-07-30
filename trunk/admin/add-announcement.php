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
		<h2>Add Announcement</h2>
		<form id="frmAnnouncement" name="frmAnnouncement" method="post">
			<!-- TODO: make this a table -->
			Title: <input id="title" name="title" type="text" size="100" maxlength="255" autofocus="autofocus" />
			Announcement: <textarea id="announcement" name="announcement" cols="100" rows="4"></textarea>
		</form>
	</div>
	<?php gtInclude("includes/foot.php"); ?>
</div>
</body>
</html>