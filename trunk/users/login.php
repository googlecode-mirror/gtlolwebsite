<?php require $_SERVER['DOCUMENT_ROOT'] . "/resources/scripts/include.php"; ?>

<!DOCTYPE html>

<html>
<head>
	<title>Login</title>
	<?php gtInclude("/includes/head.php"); ?>
	<style type="text/css">
		#frmLogin
		{
			width:50%;
			margin:1em auto;
			text-align:center;
			padding:1em;
		}
	</style>
</head>
<body>
<div id="main">
	<?php gtInclude("includes/top.php"); ?>
	<form id="frmLogin" class="goldBG" action="/resources/scripts/login.php" method="post">
		You must login to continue.<br />
		Username: <input type="text" id="username" name="username" size="22" /><br />
		Password: <input type="password" id="password" name="password" size="22" /><br />
		<button type="submit" name="btnLogin" id="btnLogin">Login</button><button name="btnRegister" id="btnRegister" type="submit" formaction="/users/register.php">Register</button>
	</form>
	<?php gtInclude("includes/foot.php"); ?>
</div>
</body>
</html>