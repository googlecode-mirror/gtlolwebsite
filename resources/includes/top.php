<form id="login" name="login" action="/users/login.php?returnURL=<?php print($_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]); ?>" method="post">
	<a id="adminlink" href="#">Admin</a><input id="username" name="username" type="text" size="22" placeholder="Username" /><input id="password" name="password" type="password" size="22" placeholder="Password" />
	<button id="btnLogin">Login</button>
	<button id="btnRegister">Register</button>
</form>
<div id="banner">
	<img id="lolLogo" alt="League of Legends Logo" src="/resources/images/logo.png" />
</div>
<div id="navbar">
	<div><a href="index.html">Home</a></div>
	<div><a href="#">News</a></div>
	<div><a href="#">About</a></div>
	<div><a href="#">Contact</a></div>
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
	<div><a href="#">Sponsors</a></div>
</div>