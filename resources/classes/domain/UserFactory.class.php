<?php
	class UserFactory
	{
		/**
			returns a map (key = error name; value = true) if there are errors or a User if it was successfully created
		*/
		public static function createUser($username, $password, $retypedPassword, $email, $retyptedEmail)
		{
			$errors = null;
			
			$result = self::inputIsValid($username, $password, $retypedPassword, $email, $retyptedEmail);

			if ($result !== true)
			{
				return $result;
			}
			else
			{
				if (!self::usernameIsAvailable($username))
				{
					$errors['usernameTaken'] = true;
					return $errors;
				}
				else
				{
					$successful = self::insertUserIntoDB($username, $password, $email);
					
					if($successful)
					{
						$user = UserRepository::retrieveUserByUsername($username);
						return $user;
					}
					else
					{
						$errors['databaseError'] = true;
						return $errors;
					}
				}
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
			
			$successful = $statement->execute(); //true if successful; false if unsuccessful
			
			return $successful;
		}
		
		private static function usernameIsAvailable($username)
		{
			$connection = DBConnection::getConnection();
			$statement = $connection->prepare("SELECT 1 FROM Users WHERE LOWER(username)=LOWER(:username)");
			$statement->bindParam(":username", $username);
			$statement->execute();
			$result = $statement->fetch();
			
			return ($result == null);
		}
		
		/**
			returns true if the input is valid; an array of errors (key is error name, value is true) if invalid
		*/
		private static function inputIsValid($username, $password, $retypedPassword, $email, $retypedEmail)
		{
			if ($username == "")
			{
				$errors['noUsername'] = true;
			}
			
			if (!Validator::usernameIsValidLength($username))
			{
				$errors['longUsername'] = true;
			}

			if ($password == "")
			{
				$errors['noPassword'] = true;
			}
			
			if (!Validator::passwordIsValidLength($password))
			{
				$errors['longPassword'] = true;
			}

			//password mismatch
			if ($password != $retypedPassword)
			{
				$errors['passwordMismatch'] = true;
			}

			if ($email == "")
			{
				$errors['noEmail'] = true;
			}
			
			if (!Validator::isValidEmail($email))
			{
				$errors['invalidEmail'] = true;
			}
			
			if ($email != $retypedEmail)
			{
				$errors['emailMismatch'] = true;
			}
			
			return (isset($errors) ? $errors : true);
		}
	}
?>