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
}

?>