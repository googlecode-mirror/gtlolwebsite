<?php
	//TODO populate username field with username from login.php or the form in top.php 

	require $_SERVER['DOCUMENT_ROOT'] . "/resources/scripts/initialize.php";
	gtIncludeOnce('scripts/requireNoLogin.php');
	
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
	
	//main code
	$errors = array(0);
	
	if (isset($_POST['btnRegister']))
	{
		extract($_POST);

		$result = UserFactory::createUser($newUsername, $newPassword, $retypePassword, $email, $retypeEmail); //array if errors; User if successful
	
		if (gettype($result) == "array")
		{
			$errors = $result;
		}
		else //successful
		{
			gtRequireOnce('scripts/startSession.php');
			
			$_SESSION['user'] = $result;
		
			header('Location: register-successful.php');
		}
	}
	else if (isset($_POST['btnRegisterLink']))
	{
		//from login form in top.php or login.php
		
		$_POST['newUsername'] = $_POST['username']; //so that addOriginalValue() can add the corect value
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
	<script type="text/javascript" src="/resources/js/validate.js"></script>
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
		<input type="submit" name="btnRegister" id="btnRegister" value="Register" />
	</form>
	<?php gtInclude("includes/foot.php"); ?>
</div>
</body>
</html>