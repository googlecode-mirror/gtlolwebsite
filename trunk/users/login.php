<?php
	require $_SERVER['DOCUMENT_ROOT'] . "/resources/functions/include.php";
	
	//header("Location: http://localhost:8080");
	
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
		if (isset($_POST['frmLoginBtn']))
		{
			//from form in login.php (ie. this file)
			
			$username = $_POST['frmUsername'];
			$password = $_POST['frmPassword'];
		}
		else //if (isset($_POST['btnLogin']))
		{
			//from form in top.php
			
			$username = $_POST['username'];
			$password = $_POST['password'];
		}
		$username = strtolower($username);
		
		//validate data
		if (!usernameIsValidLength($username))
		{
			$errors['longUsername'] = true;
		}
		
		if (!passwordIsValidLength($password))
		{
			$errors['longPassword'] = true;
		}
		
		if (!isset($errors))
		{
			gtRequire("functions/connectToDB.php");
			gtRequire("functions/encrypt.php");
			
			$dbh = getConnection();
			
			$statement = $dbh->prepare("SELECT id, username, password, name FROM Users WHERE username=:username");
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
				gtRequire('classes/User.php');
				
				global $SERVER;
				
				$user = new User($result['id'], $result['username'], $result['name']);
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
	<script type="text/javascript" src="/resources/scripts/validate.js"></script>
	<script type="text/javascript">
		function formIsValid()
		{
			var isValid = true;
		
			var username = document.getElementById("frmUsername").value;
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
			
			var password = document.getElementById("frmPassword").value;
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
				<td><input type="text" id="frmUsername" name="frmUsername" size="22" required="required" placeholder="eg. GTLoLUser" /></td>
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
				<td><input type="password" id="frmPassword" name="frmPassword" size="22" required="required" placeholder="eg. mypassword01" /></td>
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
		<button type="submit" name="frmLoginBtn" id="frmLoginBtn">Login</button><button name="btnRegister" id="btnRegister" formaction="/users/register.php">Register</button>
	</form>
	<?php gtInclude("includes/foot.php"); ?>
</div>
</body>
</html>