<?php

class Role
{
	private $roleID;
	
	public function __construct($roleID)
	{
		$this->roleID = $roleID;
	}
	
	/**
		returns true if $user has this role
	*/
	public function userHasRole($user)
	{
		$userHasRole = RolesRepository::userHasRole($user, $this);
		return $userHasRole;
	}
	
	public function equals($other)
	{
		return $this->role == $other->role;
	}
	
	public function getID() { return $roleID; }
}

?>