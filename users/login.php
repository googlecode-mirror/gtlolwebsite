<?php
	require $_SERVER['DOCUMENT_ROOT'] . "/resources/scripts/initialize.php";
	
	gtRequire("scripts/requireNoLogin.php");
	gtRequire("functions/validate.php");
	
	function addVisibleStyle($errName)
	{
		global $errors;
		
		if (isset($errors) && isset($errors[$errName]))
		{
			print('style="display:inline"');
		}
	}
	
	//prepare form-action return url
	$returnURL = isset($_GET['returnURL']) ? $_GET['returnURL'] : "";
	$returnURLAddition = ""; //part that is added to form action
	
	if ($returnURL != "")
	{
		$returnURLAddition = "?returnURL=$returnURL";
	}
	
	//get data from either frmLogin or login
	if (isset($_POST['frmLoginBtn']) || isset($_POST['btnLogin']))
	{
		extract($_POST); //gets $username and $password
		
		if (!isset($errors))
		{
			gtRequire("functions/connectToDB.php");
			gtRequire("functions/encrypt.php");
			
			$dbh = getConnection();
			
			$statement = $dbh->prepare("SELECT id, username, password, name FROM Users WHERE LOWER(username)=LOWER(:username)");
			$statement->bindParam(':username', $username);
			$statement->execute();
			$result = $statement->fetch();

			if ($result == null)
			{
				$errors['badUsername'] = true;
			}
			else if ($result['password'] != gtCrypt($password))
			{
				$errors['badPassword'] = true;
			}
			else
			{
				//login successful
				$user = new User($result['id'], $result['username'], $result['password'], $result['name']);
				$_SESSION['user'] = $user;
				
				gtInclude("scripts/redirect.php");
			}
		}
	}
?>

<!DOCTYPE html>

<html>
<head>
	<title>Login</title>
	<?php gtInclude("includes/head.php"); ?>
	<style type="text/css">
		#frmLogin
		{
			width:50%;
			margin:1em auto;
			text-align:center;
			padding:1em;
			border-radius:1em;
		}
		
		#frmLogin > table
		{
			width:100%;
			margin:auto;
		}
		
		#frmLogin td
		{
			text-align:left;
		}
		
		#frmLogin td:first-child
		{
			text-align:right;
			width:40%;
		}
		
		#frmLogin td > span
		{
			display:none;
			color:red;
		}
	</style>
	<script type="text/javascript" src="/resources/js/validate.js"></script>
	<script type="text/javascript">
		function formIsValid()
		{
			var isValid = true;
		
			var username = document.getElementById("username").value;
			var errLongUsername = document.getElementById("errLongUsername");
			if (!usernameIsValidLength(username))
			{
				errLongUsername.style.display = "inline";
				isValid = false;
			}
			else
			{
				errLongUsername.style.display = "none";
			}
			
			var password = document.getElementById("password").value;
			var errLongPassword = document.getElementById("errLongPassword");
			if (!passwordIsValidLength(password))
			{
				errLongPassword.style.display = "inline";
				isValid = false;
			}
			else
			{
				errLongUsername.style.display = "none";
			}
			
			return isValid;
		}
	</script>
</head>
<body>
<div id="main">
	<?php gtInclude("includes/top.php"); ?>
	<form id="frmLogin" name="frmLogin" class="secondaryFGColor" action="login.php<?php print($returnURLAddition); ?>" method="post" onsubmit="return formIsValid();">
		You must login to continue.<br />
		<table>
			<tr>
				<td>Username:</td>
				<td>
					<input type="text" id="username" name="username" <?php if (isset($username)) print("value='$username'"); ?> size="22" required="required" placeholder="eg. GTLoLUser" />
				</td>
				<td>
					<span id="errLongUsername" <?php addVisibleStyle("longUsername"); ?>>Your username is too long.</span>
					<?php
						if (isset($errors['badUsername']))
						{
					?>
							<span id="errBadUsername" style="display:inline;">This username was not found in the database.</span>
					<?php } ?>
				</td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" id="password" name="password" size="22" required="required" placeholder="eg. mypassword01" /></td>
				<td>
					<span id="errLongPassword" <?php addVisibleStyle("longPassword"); ?>>Your password is too long.</span>
					<?php
						if (isset($errors['badPassword']))
						{
					?>
							<span id="errBadPassword" style="display:inline;">The entered password is incorrect for the entered username.</span>
					<?php } ?>
				</td>
			</tr>
		</table>
		<input type="submit" name="frmLoginBtn" id="frmLoginBtn" value="Login" />
		<input type="submit" name="btnRegisterLink" id="btnRegisterLink" formaction="/users/register.php" value="Register" />
	</form>
	<?php gtInclude("includes/foot.php"); ?>
</div>
</body>
</html>