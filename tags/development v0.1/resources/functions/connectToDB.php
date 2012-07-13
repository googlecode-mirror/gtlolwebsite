<?php
	function getConnection()
	{
		try
		{
			return new PDO('mysql:host=localhost;port=3307;dbname=gtlol', 'gtloladmin', 'poppy');
		} catch (PDOException $pdoe)
		{
			print("ERROR: " . $pdoe->getMessage() . "<br />");
			die();
		}
	}
?>