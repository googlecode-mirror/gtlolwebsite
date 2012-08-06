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
	
	/**
		$statement: the PDOStatement to which the parameters will be bound
		$parameters: an array of parameters where the key is the identifier in the SQL query and the value is its value
	*/
	public static function bindParameters(&$statement, $parameters)
	{
		$keys = array_keys($parameters);
		
		foreach($keys as $key)
		{
			$statement->bindParam(":$key", $parameter[$key]);
		}
	}
	
	/**
		$conditions: an array of conditions (eg. array('id = :id', 'name like :somename') )
		returns a string with the conditions joined by ANDs or null if there are no conditions
	*/
	public static function createExclusiveCondition($conditions)
	{
		$count = count($conditions);
	
		if ($count == 0)
		{
			return null;
		}
		else
		{
			$i = 0;
			$strCondition = $conditions[$i++];
			
			while ($i < $count)
			{
				$strCondition .= $conditions[$i++];
			}
			
			return $strCondition;
		}
	}
}

?>