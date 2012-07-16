<?php
	class DBConnection
	{
		private static $connection = null;
		
		public static function getConnection()
		{
			if (self::$connection === null)
			{
				self::$connection = new PDO('mysql:host=localhost;port=3307;dbname=gtlol', 'gtloladmin', 'poppy');
				return new PDO('mysql:host=localhost;port=3307;dbname=gtlol', 'gtloladmin', 'poppy');
			}
			else
			{
				return self::$connection;
			}
		}
	}
?>