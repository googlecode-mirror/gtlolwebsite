<?php
	//TODO populate username field with username from login.php or the form in top.php 

	require $_SERVER['DOCUMENT_ROOT'] . "/resources/functions/include.php";
	
	gtRequire("functions/validate.php");
	
	$errors = array(0);
	$areErrors = false;
	
	/// adds style="display:inline" if necessary
	function addVisibleStyle($errName, $errs)
	{
		if (isset($errs[$errName]) && $errs[$errName] == true)
		{
			print('style="display:inline"');
		}
	}
	
	/// adds the initial value of a form if necessary
	function addOriginalValue($name)
	{
		if (isset($_POST[$name]))
		{
			print "value='$_POST[$name]'";
		}
	}

	if (isset($_POST) && isset($_POST['btnRegister']))
	{
		extract($_POST);
	
		if ($newUsername == "")
		{
			$errors['noUsername'] = true;
			$areErrors = true;
		}
		
		if (!usernameIsValidLength($newUsername))
		{
			$errors['longUsername'] = true;
			$areErrors = true;
		}

		if ($newPassword == "")
		{
			$errors['noPassword'] = true;
			$areErrors = true;
		}
		
		if (!passwordIsValidLength($newPassword))
		{
			$errors['longPassword'] = true;
			$areErrors = true;
		}

		if ($newPassword != $retypePassword)
		{
			$errors['passwordMismatch'] = true;
			$areErrors = true;
		}

		if ($email == "")
		{
			$errors['noEmail'] = true;
			$areErrors = true;
		}
		
		if (!isValidEmail($email))
		{
			$errors['invalidEmail'] = true;
			$areErrors = true;
		}
		
		if ($email != $retypeEmail)
		{
			$errors['emailMismatch'] = true;
			$areErrors = true;
		}
		
		if (!$areErrors)
		{
			gtRequire("functions/connectToDB.php");
			gtRequire("functions/encrypt.php");
			
			$dbh = getConnection();
			
			$statement = $dbh->prepare("SELECT 1 FROM Users WHERE LOWER(username)=LOWER(?)");
			$statement->execute(array($username));
			$result = $statement->fetch();
			
			if ($result != null) //username already exists
			{
				$errors['usernameTaken'] = true;
			}
			else
			{
				//try adding to database
				$statement = $dbh->prepare('INSERT INTO Users (username, email, password) VALUES (:username, :email, :password)');
				$statement->bindParam(':username', $username);
				$statement->bindParam(':email', $email);
				$statement->bindParam(':password', gtCrypt($newPassword));
				
				if ($statement->execute())
				{
					header('Location: register-successful.php');
				}
				
				//if successful, redirect to register-successful.php
			}
			
			$pdo = null;
		}
	}
?>

<!DOCTYPE html>

<html>
<head>
	<title>Register</title>
	<?php gtInclude("includes/head.php"); ?>
	<style type="text/css">
		#frmRegister
		{
			width:50%;
			margin:1em auto;
			text-align:center;
			padding:1em;
			border-radius:1em;
		}
		
		#frmRegister > table
		{
			width:100%;
			margin:auto;
		}
		
		#frmRegister td
		{
			text-align:left;
		}
		
		#frmRegister td:first-child
		{
			text-align:right;
			width:40%;
		}
		
		#frmRegister td > span
		{
			display:none;	
			color:red;
		}
	</style>
	<script type="text/javascript" src="/resources/scripts/validate.js"></script>
	<script type="text/javascript">
		function validate()
		{
			var isValid = true;
			
			var newUsername = document.getElementById("newUsername").value;
			var errLongUsername = document.getElementById("errLongUsername");
			if (!usernameIsValidLength(newUsername))
			{
				errLongUsername.style.display = "inline";
				isValid = false;
			}
			else
			{
				errLongUsername.style.display = "none";
			}
			
			var password1 = document.getElementById("newPassword").value;
			var password2 = document.getElementById("retypePassword").value;
			
			var errPasswordMismatch = document.getElementById("errPasswordMismatch");
			if (!isMatch(password1, password2))
			{
				errPasswordMismatch.style.display = "inline";
				isValid = false;
			}
			else
			{
				errPasswordMismatch.style.display = "none";
			}
			
			var errLongPassword = document.getElementById("errLongPassword");
			if (!passwordIsValidLength(password1))
			{
				errLongPassword.style.display = "inline";
				isValid = false;
			}
			else
			{
				errLongPassword.style.display = "none";
			}
			
			var email1 = document.getElementById("email").value;
			var email2 = document.getElementById("retypeEmail").value;
			
			var errInvalidEmail = document.getElementById("errInvalidEmail");
			if (!isValidEmail(email1))
			{
				errInvalidEmail.style.display = "inline";
				isValid = false;
			}
			else
			{
				errInvalidEmail.style.display = "none";
			}
			
			var errEmailMismatch = document.getElementById("errEmailMismatch");
			if (!isMatch(email1, email2))
			{
				errEmailMismatch.style.display = "inline";
				isValid = false;
			}
			else
			{
				errEmailMismatch.style.display = "none";
			}
			
			return isValid;
		}
	</script>
</head>
<body>
<div id="main">
	<?php gtInclude("includes/top.php"); ?>
	<form id="frmRegister" class="secondaryFGColor" action="register.php" method="post" onsubmit="return validate();">
		If you already have an account, click <a href="/users/login.php">here</a> to login.<br />
		<table>
			<tr>
				<td>Username:</td>
				<td><input type="text" id="newUsername" name="newUsername" size="22" placeholder="Username" required="required" <?php addOriginalValue("newUsername"); ?> /></td>
				<td>
					<span id="errNoUsername" <?php addVisibleStyle("noUsername", $errors); ?>>You must enter a username.</span>
					<span id="errLongUsername" <?php addVisibleStyle("longUsername", $errors); ?>>Your username must be less than 30 characters long.</span>
					<?php
						if (isset($errors) && isset($errors['usernameTaken']) && $errors['usernameTaken'] == true)
						{
					?>
					<span id="errUsernameTaken" style="display:inline;">That username has already been taken. Please choose a different one.</span>
					<?php
						}
					?>
				</td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" id="newPassword" name="newPassword" size="22" placeholder="Password" required="required" <?php addOriginalValue("newPassword"); ?> /></td>
				<td>
					<span id="errNoPassword" <?php addVisibleStyle("noPassword", $errors); ?>>You must enter a password.</span>
					<span id="errLongPassword" <?php addVisibleStyle("longPassword", $errors); ?>>Your password must be less than 50 characters long.</span>
				</td>
			</tr>
			<tr>
				<td>Retype password:</td>
				<td><input type="password" id="retypePassword" name="retypePassword" size="22" placeholder="Retype password" required="required" <?php addOriginalValue("retypePassword"); ?> /></td>
				<td><span id="errPasswordMismatch" <?php addVisibleStyle("passwordMismatch", $errors); ?>>Your two passwords do not match.</span></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><input type="text" id="email" name="email" size="30" placeholder="Email address" required="required" <?php addOriginalValue("email"); ?> /></td>
				<td>
					<span id="errNoEmail" <?php addVisibleStyle("noEmail", $errors); ?>>You must enter an email address.</span>
					<span id="errInvalidEmail" <?php addVisibleStyle("invalidEmail", $errors); ?>>Your email address is not valid.</span>
				</td>
			</tr>
			<tr>
				<td>Retype Email:</td>
				<td><input type="text" id="retypeEmail" name="retypeEmail" size="30" placeholder="Retype email address" required="required" <?php addOriginalValue("retypeEmail"); ?> /></td>
				<td><span id="errEmailMismatch" <?php addVisibleStyle("emailMismatch", $errors); ?>>Your two email addresses do not match.</span></td>
			</tr>
		</table>
		<button type="submit" name="btnRegister" id="btnRegister">Register</button>
	</form>
	<?php gtInclude("includes/foot.php"); ?>
</div>
</body>
</html>