<?php

class RolesRepository
{
	public function retrieveRolesForUser($user)
	{
		$connection = DBConnection::getConnection();
		
		$userID = $user->getID();
		$statement = $connection->prepare("SELECT role_id FROM UserRoles WHERE user_id = :userID");
		$statement->bindParam(":userID", $userID);
		
		$statement->execute();
		
		$roles = array();
		$i = 0;
		
		while ($row = $statement->fetch())
		{
			$roles[$i++] = new Role($row[0]);
		}
		
		return $roles;
	}
	
	/**
		returns true if $user has $role; false if $user does not have $role
	*/
	public function userHasRole($user, $role)
	{
		$connection = DBConnection::getConnection();
		
		$userID = $user->getID();
		$roleID = $role->getID();
		$statement = $connection->prepare("SELECT role_id FROM UserRoles WHERE user_id = :userID AND role_id = :roleID");
		$statement->bindParam(":userID", $userID);
		$statement->bindParam(":roleID", $roleID);
		
		$statement->execute();
		$result = $statement->fetch();
		
		$userHasRole = $result !== false;
		
		return $userHasRole;
	}
}

?>