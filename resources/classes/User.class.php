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
	
	public function getName() { return $this->name; }
	
	public function getID() { return $this-id; }
	
	public function getUsername() { return $this->username; }
}
?>