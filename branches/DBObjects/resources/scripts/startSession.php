<?php //should be called using require_once. PHP will throw a notice if session_start() is called multiple times.
	if (session_id() === '')
	{
		session_start();
	}
?>