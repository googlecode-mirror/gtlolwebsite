<?php
	class UserRepository
	{
		public static function addUser($username, $password, $email)
		{
			$insertSuccessful = self::insertUserIntoDB($username, $password, $email);
			
			if ($insertSuccessful)
			{
				$user = UserRepository::retrieveUserByUsername($username);
				return $user;
			}
			else
			{
				return null;
			}
		}
		
		public static function removeUserById($id)
		{
			//TODO finish
		}
	
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
		
		public static function updateUser()
		{
			//TODO complete
		}
		
		//returns true if the user was successfully added into the database
		private static function insertUserIntoDB($username, $password, $email)
		{
			$connection = DBConnection::getConnection();
			$encryptedPassword = Encryptor::encrypt($password);
			$statement = $connection->prepare('INSERT INTO Users (username, email, password) VALUES (:username, :email, :password)');
			$statement->bindParam(':username', $username);
			$statement->bindParam(':email', $email);
			$statement->bindParam(':password', $encryptedPassword);
			
			$successful = $statement->execute();
			
			return $successful;
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

			if ($result === null)
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