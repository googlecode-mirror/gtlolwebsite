<?php
	class UserRepository
	{
		/**
			returns a User if the user is found or null otherwise
		*/
		public static function retrieveUserById($id)
		{
			$where = "id=:value";
			$user = self::retrieveUserWhere($where, $id);
			return $user;
		}
		
		/**
			returns a User if the user is found or null otherwise
		*/
		public static function retrieveUserByUsername($username)
		{
			$where = "LOWER(username)=LOWER(:value)";
			$user = self::retrieveUserWhere($where, $username);
			return $user;
		}
		
		//TODO complete
		public static function updateUser()
		{
		}
		
		/**
			$where = 'WHERE [column_name]=:value'
			$value = what should replace ':value' in $where
			returns a User if the user is found or null otherwise
		*/
		private static function retrieveUserWhere($where, $value)
		{
			$connection = DBConnection::getConnection();
				
			$statement = $connection->prepare("SELECT id, username, password, name FROM Users WHERE $where");
			$statement->bindParam(':value', $value);
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
?>