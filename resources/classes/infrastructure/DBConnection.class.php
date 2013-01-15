<?php

class DBConnection
{
	private static $connection = null;
	
	/**
		consider making private (which forces you to use executeSQLSelect() and executeSQLCommand()
	*/
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
		indices in parameters are ":param" parts in $strSQL (without the colon)
		$isGeneric is if $strSQL uses question marks for the parameters
		returns an executed PDOStatement object that you can use to fetch results
	*/
	public static function executeSQLSelect($strSQL, $parameters=null, $isGeneric=false)
	{
		print("SQL: $strSQL"); // TODO remove
	
		$connection = self::getConnection();
		$statement = $connection->prepare($strSQL);
		self::bindParameters($statement, $parameters);
		$statement->execute();
		
		return $statement;
	}
	
	/**
		$isGeneric is if $strSQL uses question marks for the parameters
		returns the result of executing $strSQL
	*/
	public static function executeSQLCommand($strSQL, $parameters=null, $isGeneric=false)
	{
		$connection = self::getConnection();
		$statement = $connection->prepare($strSQL);
		
		if ($isGeneric)
		{
			$values = array_values($parameters);
			for ($i = 1; $i <= count($values); $i++)
			{
				$statement->bindParam(i, $values[i]);
			}
		}
		else
		{
			self::bindParameters($statement, $parameters);
		}
		$wasSuccessful = $statement->execute();
		
		return $wasSuccessful;
	}
	
	/**
		$statement: the PDOStatement to which the parameters will be bound
		$parameters: an array of parameters where the key is the identifier in the SQL query and the value is its value; can be null if there are no parameters to bind
	*/
	private static function bindParameters(&$statement, $parameters)
	{
		if ($parameters != null)
		{
			$keys = array_keys($parameters);
			
			foreach($keys as $key)
			{
				$statement->bindParam(":$key", $parameter[$key]);
			}
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