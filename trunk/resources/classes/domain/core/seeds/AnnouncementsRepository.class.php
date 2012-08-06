<?php

class AnnouncementsRepository
{
	/**
		$afterDateTime: The earliest date/time that the announcement(s) was created; null if no restriction
		$maxNumAnnouncements: The maximum number of announcements to return; null if no limit;
		$userID: The id of the user who created the announcement(s); null if no restriction
	*/
	public static function retrieveAnnouncements($afterDateTime = null, $maxNumAnnouncements = null, $userID = null)
	{
		$result = buildRetrieveSQL($afterDateTime, $maxNumAnnouncements, $userID);
		$strSQL = $result[0];
		$parameters = $result[1];
		
		$connection = DBConnection::getConnection();
		$statement = $connection->prepare($strSQL);
		DBConnection::bindParameters($statement, $parameters);
		$statement->execute();
	}
	
	/**
		returns an array where arr[0] => sql query as a string and arr[1] = parameters that need to be bound to the statement
	*/
	private static function buildRetrieveSQL($afterDateTime, $maxNumAnnouncements, $userID)
	{
		$sqlConditions = array();
		$parameters = array();
		
		if ($afterDateTime != null)
		{
			$parameters['sqlDateTime'] = $afterDateTime->format('Y-m-d G:i:s');
			$sqlConditions[] = "created_date >= :sqlDateTime";
		}
		
		if ($userID != null)
		{
			$parameters['userID'] = $userID;
			$sqlConditions[] = "announcer_id = :userID";
		}
		
		$condition = DBConnection::createExclusiveCondition($sqlConditions);
		
		$whereClause = $condition == null ? "" : "WHERE $condition";
		
		//TODO finish
		
		if ($maxNumAnnouncements != null && $maxNumAnnouncements > 0)
		{
			//add LIMIT clause
		}
	}
	
	private 
}

?>