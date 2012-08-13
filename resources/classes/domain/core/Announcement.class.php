<?php
class Announcement
{
	private $id;
	private $title;
	private $text;
	private $timeCreated;
	private $announcerID;
	
	/**
		$timeCreated is a PHP datetime
	*/
	public function __construct($id, $title, $text, $timeCreated, $announcerID)
	{
		$this->id = $id;
		$this->title = $title;
		$this->text = $text;
		$this->timeCreated = $timeCreated;
		$this->announcerID = $announcerID;
	}
	
	/**
		returns the User who created the announcement
	*/
	public function getAnnouncer()
	{
		$user = UserRepository::retrieveUserById($announcerID);
		return $user;
	}
	
	public function getTitle()
	{
		return $title;
	}
	
	public function getText()
	{
		return $text;
	}
	
	public function getTimeCreated()
	{
		return $timeCreated;
	}
}
?>