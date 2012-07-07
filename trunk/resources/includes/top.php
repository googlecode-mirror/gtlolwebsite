<div id="accountInfo">
	<?php
		gtRequireOnce("scripts/startSession.php");

		if (isset($_SESSION['user'])) //user is logged in
		{
			$user = $_SESSION['user'];
	?>
			<a href="/users/">
				<?php print($user->getUsername()); ?>
			</a>|
			<a href="/users/logout.php?returnURL=<?php print($_SERVER['PHP_SELF']); ?>">logout</a>
	<?php
		}
		else
		{
	?>
			<form id="login" name="login" class="secondaryBGColor" action="/users/login.php?returnURL=<?php print($_SERVER['PHP_SELF']); ?>" method="post">
				<a id="adminlink" href="#">Admin</a>
				<input id="username" name="username" type="text" size="22" placeholder="Username" required="required" />
				<input id="password" name="password" type="password" size="22" placeholder="Password" required="required" />
				<input type="submit" id="btnLogin" name="btnLogin" value="Login" />
				<input type="submit" formaction="/users/register.php" id="btnRegisterLink" name="btnRegisterLink" value="Register" />
			</form>
	<?php
		}
	?>
</div>
<div id="banner">
	<img id="lolLogo" alt="League of Legends Logo" src="/resources/images/logo.png" />
</div>
<div id="navbar" class="tertiaryBGColor"> <!--  style="background-color:#888888" -->
	<div><a href="/">Home</a></div>
	<div><a href="/news.php">News</a></div>
	<div><a href="/about.php">About</a></div>
	<div><a href="/contact.php">Contact</a></div>
	<!--
	<div>
		<a href="#">Calendar</a>
	</div>
	<div>
		<a href="#">Social</a>
		<div>
			<a href="#">members</a>
			<a href="#">streams</a>
			<a href="#">photos</a>
			<a href="#">polls</a>
			<a href="#">forums</a>
		</div>
	</div>
	<div>
		<a href="#">Compete</a>
		<div>
			<a href="#">teams</a>
			<a href="#">ladder</a>
			<a href="#">tournaments</a>
		</div>
	</div>
	-->
	<div><a href="/sponsors.php">Sponsors</a></div>
</div>