<?php

class Role
{
	private $role;
	
	public function __construct($role)
	{
		$this->role = $role;
	}
	
	public static function getRole($role)
	{
		return new Role($role);
	}
}

?>