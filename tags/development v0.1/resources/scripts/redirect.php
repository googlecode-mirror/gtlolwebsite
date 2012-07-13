<?php
	gtRequireOnce('constants.php');

	global $SERVER;

	if (isset($_GET['returnURL']))
	{
		print($SERVER);
		$url = $SERVER . $_GET['returnURL'];
	}
	else
	{
		$url = $SERVER;
	}

	header("Location: http://$url");
?>