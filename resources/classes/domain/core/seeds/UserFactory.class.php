<?php
	class UserFactory
	{
		/**
			returns a User if successful; null if unsuccessful
		*/
		public static function createUser($username, $password, $email)
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
	}
?>