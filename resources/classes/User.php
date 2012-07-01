<?php
class User
{
	private $id;
	private $username;
	private $name;

	public function __construct($id, $username, $name)
	{
		$this->id = $id;
		$this->username = $username;
		$this->name = $name;
	}
	
	public function getName() { return $name; }
	
	public function getID() { return $id; }
}
?>