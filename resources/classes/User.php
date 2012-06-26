<?php
public class User
{
	private var $id, $name;

	public function __construct($name, $id)
	{
		$this->id = $id;
		$this->name = $name;
	}
	
	public function getName() { return $name; }
	
	public function getID() { return $id; }
}
?>