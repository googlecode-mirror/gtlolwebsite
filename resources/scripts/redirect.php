<?php
global $SERVER;

gtRequireOnce('constants.php');

if (isset($_GET['returnURL']))
{
	$url = $SERVER . $_GET['returnURL'];
}
else
{
	$url = $SERVER;
}

header("Location: http://$url");
?>