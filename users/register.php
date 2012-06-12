<?php
	require $_SERVER['DOCUMENT_ROOT'] . "/resources/scripts/include.php";

	if (array_key_exists('doRegister', $_POST) && $_POST['doRegister'] == true)
	{
		//validate inputs
		
		//connect to database
		//try to insert into database
	}
?>

<!DOCTYPE html>

<html>
<head>
	<title>Register</title>
	<?php gtInclude("/includes/head.php"); ?>
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
		function validate()
		{
			var isValid = true;
			
			var errNoUsername = document.getElementById("errNoUsername");
			var username = document.getElementById("newUsername").value;
			if (username == "")
			{
				errNoUsername.style.display = "inline";
				isValid = false;
			}
			else
			{
				errNoUsername.style.display = "none";
			}
			
			var password1 = document.getElementById("newPassword").value;
			var password2 = document.getElementById("retypePassword").value;
			
			var errNoPassword = document.getElementById("errNoPassword");
			if (password1 == "")
			{
				errNoPassword.style.display = "inline";
				isValid = false;
			}
			else
			{
				errNoPassword.style.display = "none";
			}
			
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
			
			var email1 = document.getElementById("email").value;
			var email2 = document.getElementById("retypeEmail").value;
			
			var errNoEmail = document.getElementById("errNoEmail");
			if (email1 == "")
			{
				errNoEmail.style.display = "inline";
				isValid = false;
			}
			else
			{
				errNoEmail.style.display = "none";
			}
			
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
	<form id="frmLogin" class="goldBG" action="register.php" method="post" onsubmit="return validate();">
		<input type="hidden" name="doRegister" value="true" />
		If you already have an account, click <a href="/users/login.php">here</a> to login.<br />
		
		<!-- TODO: put errors in separate column in table -->
		
		<table>
			<tr>
				<td>Username:</td>
				<td>
					<input type="text" id="newUsername" name="newUsername" size="22" placeholder="Username" />
					<span id="errNoUsername">You must enter a username.</span>
				</td>
			</tr>
			<tr>
				<td>Password:</td>
				<td>
					<input type="password" id="newPassword" name="newPassword" size="22" placeholder="Password" />
					<span id="errNoPassword">You must enter a password.</span>
				</td>
			</tr>
			<tr>
				<td>Retype password:</td>
				<td>
					<input type="password" id="retypePassword" name="retypePassword" size="22" placeholder="Retype password" />
					<span id="errPasswordMismatch">Your two passwords do not match.</span>
				</td>
			</tr>
			<tr>
				<td>Email:</td>
				<td>
					<input type="text" id="email" name="email" size="30" placeholder="Email address" />
					<span id="errNoEmail">You must enter an email address.</span>
					<span id="errInvalidEmail">Your email address is not valid.</span>
				</td>
			</tr>
			<tr>
				<td>Retype Email:</td>
				<td>
					<input type="text" id="retypeEmail" name="retypeEmail" size="30" placeholder="Retype email address" />
					<span id="errEmailMismatch">Your two email addresses do not match.</span>
				</td>
			</tr>
		</table>
		<button type="submit" name="btnRegister" id="btnRegister">Register</button>
	</form>
	<?php gtInclude("includes/foot.php"); ?>
</div>
</body>
</html>