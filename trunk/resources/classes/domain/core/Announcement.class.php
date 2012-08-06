<?php
class Announcement
{
	private $id;
	private $title;
	private $text;
	
	public function __construct($id, $title, $text)
	{
		$this->id = $id;
		$this->title = $title;
		$this->text = $text;
	}
	
	public static function getUsersTopNAnnouncements($numAnnouncements, $userID)
	{
		//TODO finish
	}
}
?>