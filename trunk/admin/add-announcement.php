<?php
	require $_SERVER['DOCUMENT_ROOT'] . "/resources/scripts/initialize.php";
	gtRequireOnce("scripts/requireAdmin.php");
	
	if (isset($_POST))
	{
		
	}
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
		<form id="frmAnnouncement" name="frmAnnouncement" method="post" action="add-announcement.php">
			<table>
				<tr>
					<td>Title:</td>
					<td><input id="title" name="title" type="text" size="100" maxlength="255" autofocus="autofocus" /></td>
				</tr>
				<tr>
					<td>Announcement:</td>
					<td><textarea id="announcement" name="announcement" cols="100" rows="4"></textarea></td>
				</tr>
			</table>
			
			<input type="submit" />
		</form>
	</div>
	<?php gtInclude("includes/foot.php"); ?>
</div>
</body>
</html>