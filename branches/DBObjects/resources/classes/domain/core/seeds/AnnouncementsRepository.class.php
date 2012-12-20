<?php

class AnnouncementsRepository
{
	/**
		Adds the announcement to the database.
		returns true if the announcement was inserted successfully
	*/
	public static function addAnnouncement($title, $text, $creatorID)
	{
		$sql =
		"
			INSERT INTO Announcements
			(
				announcer_id,
				title,
				announcement,
				created_date
			)
			VALUES
			(
				:announcer_id,
				:title,
				:announcement,
				:created_date
			)
		";
		
		$dateCreated = new DateTime();
		$strDateCreated = $dateCreated->format('Y-m-d G:i:s');
	
		$connection = DBConnection::getConnection();
		$statement = $connection->prepare($sql);
		$statement->bindParam(":announcer_id", $creatorID);
		$statement->bindParam(":title", $title);
		$statement->bindParam(":announcement", $text);
		$statement->bindParam(":created_date", $strDateCreated);
		
		$insertWasSuccessful = $statement->execute();
		return $insertWasSuccessful;
	}

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
		
		$statement = DBConnection::executeSQLSelect($strSQL, $parameters);
		$announcements = array();
		$i = 0;
		
		while ($row = $statement->fetch())
		{
			$announcements[$i++] = self::convertRowToAnnouncement($row);
		}
		
		return $announcements;
	}
	
	public static function updateAnnouncement($id, $title, $text)
	{
		//TODO finish
	}
	
	public static function deleteAnnouncement($id)
	{
		//TODO finish
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
		
		$strSQL = "SELECT * FROM Announcements $whereClause";
		
		if ($maxNumAnnouncements != null && $maxNumAnnouncements > 0)
		{
			$strSQL .= " LIMIT $maxNumAnnouncements";
		}
		
		$result = array($strSQL, $parameters);
		return $result;
	}
	
	private static function convertRowToAnnouncement($arr)
	{
		$id = $arr['id'];
		$announcerID = $arr['announcer_id'];
		$title = $arr['title'];
		$text = $arr['announcement'];
		$createdDate = $arr['created_date'];
		
		$announcement = new Announcement($id, $title, $text, $createdDate, $announcerID);
		return $announcement;
	}
}

?>