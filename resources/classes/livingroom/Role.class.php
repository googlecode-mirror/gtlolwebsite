<?php

class Role
{
	private $role;
	
	public function __construct($role)
	{
		$this->role = $role;
	}
	
	/**
		returns true if $user has this role
	*/
	public function userHasRole($user)
	{
		$userRoles = RolesRepository::retrieveRolesForUser($user);
		
		$i = 0;
		while($i < count($userRoles))
		{
			if ($this->equals($userRoles[$i]))
			{
				return true;
			}
			$i++;
		}
		
		return false;
	}
	
	public function equals($other)
	{
		return $this->role == $other->role;
	}
	
	public static function getRole($role)
	{
		return new Role($role);
	}
}

?>