<?php
	/**
		DBObjects allow work to be done in a single SQL statement instead of multiple small statements
		it is suggested to have a method along the lines of DBObject->getIDSQL() which makes creating nested SQL statements easy
	*/
	abstract class DBObject
	{
		protected $whereSQL; // conditions used to select this object; does not include "where"; required if updating
		protected $updateChanges = array();
		
		protected function __construct($whereSQL)
		{
			$this->whereSQL = $whereSQL;
		}
		
		public function getWhereSql() { return $whereSQL; }
		
		/**
			uses $updateChanges to update the database
			returns whether the update was successful
		*/
		protected function commitHelper($tableName)
		{
			$keys = array_keys($updateChanges);
			$sql = "UPDATE $tableName SET ";
			$isFirst = true;
			
			foreach ($keys as $col)
			{
				if (!$isFirst)
				{
					$sql += ", ";
				}
				else
				{
					$isFirst = false;
				}
				
				$sql += "$col=:$col";
			}
			
			$sql += " WHERE $this->whereSQL";
			
			$wasSuccessful = DBConnection::executeSQLCommand($sql, $updateChanges);
			
			if ($wasSuccessful)
			{
				$updateChanges = array();
			}
			
			return $wasSuccessful;
		}
		
		protected function addChange($colName, $value)
		{
			$updateChanges["$colName"] = $value;
		}
		
		/**
			updates all of the fields related to this object from the database
		*/
		abstract public function populateFields();
		
		/**
			uses commitHelper to update the database
		*/
		abstract public function commit();
	}
?>