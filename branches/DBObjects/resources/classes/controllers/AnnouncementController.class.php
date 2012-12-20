<?php

class AnnouncementController
{
	/**
		returns an array of arrays that represent announcements.
			Each "announcement" has the following key/value pairs:
				title : String
				text : String
				time : DateTime
				announcer_username : String
	*/
	public static function getTopNLatestAnnouncements($n)
	{
		$announcements = AnnouncementsRepository::retrieveAnnouncements(null, $n);
		//TODO finish
	}
	
	private static function convertAnnouncementToArray($announcement)
	{
		//TODO finish
	}
}

?>