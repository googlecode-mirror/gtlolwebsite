<?php
	class Encryptor
	{
		public static function encrypt($str)
		{
			return crypt($str, "LoL");
		}
	}
?>