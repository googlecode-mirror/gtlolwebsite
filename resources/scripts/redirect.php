<?php
global $SERVER;

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