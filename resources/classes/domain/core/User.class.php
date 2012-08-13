<?php
class User
{
	private $id;
	private $username;
	private $name;
	private $encryptedPassword;

	public function __construct($id, $username, $encryptedPassword, $name)
	{
		$this->id = $id;
		$this->username = $username;
		$this->name = $name;
		$this->encryptedPassword = $encryptedPassword;
	}
	
	public function getName() { return $this->name; }
	
	public function getID() { return $this->id; }
	
	public function getUsername() { return $this->username; }
	
	public function passwordMatches($password)
	{
		return ($this->encryptedPassword === Encryptor::encrypt($password));
	}
	
	/**
		returns an array of errors if unsuccessful or a User if successful
	*/
	public static function registerUser($username, $password, $retypedPassword, $email, $retyptedEmail)
	{
		$errors = null;
			
		$result = self::registerInputIsValid($username, $password, $retypedPassword, $email, $retyptedEmail);

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
				$result = UserRepository::addUser($username, $password, $email);
				
				if($result !== null)
				{
					return $result;
				}
				else
				{
					$errors['databaseError'] = true;
					return $errors;
				}
			}
		}
	}

	/**
		returns true if the input is valid; an array of errors (key is error name, value is true) if invalid
	*/
	private static function registerInputIsValid($username, $password, $retypedPassword, $email, $retypedEmail)
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
	
	private static function usernameIsAvailable($username)
	{
		$result = UserRepository::retrieveUserByUsername($username);
		$usernameIsAvailable = $result === null;
		return $usernameIsAvailable;
	}
}
?>