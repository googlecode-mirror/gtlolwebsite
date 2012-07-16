<?php
	class UserRepository
	{
		/**
			$identifier may be the user id or a username
			returns a User if the user is found or null otherwise
		*/
		public static function retrieveUser($identifier)
		{
			if (!is_string($identifier) && !is_numeric($identifier))
			{
				trigger_error("$identifier is an invalid argument for retrieveuser()", E_USER_ERROR);
			}
			else
			{
				if (is_string($identifier))
				{
					$where = "LOWER(username)=LOWER(:identifier)";
				}
				else //if (is_numeric($identifier))
				{
					$where = "id=:identifier"
				}
				
				$connection = DBConnection::getConnection();
				
				$statement = $connection->prepare("SELECT id, username, password, name FROM Users WHERE $where");
				$statement->bindParam(':identifier', $identifier);
				$statement->execute();
				$result = $statement->fetch();

				if ($result == null)
				{
					return null;
				}
				else
				{
					$user = new User($result['id'], $result['username'], $result['password'], $result['name']);
					return $user;
				}
			}
		}
		
		//TODO complete
		public static function updateUser()
		{
		}
	}
?>