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
	
	public function getID() { return $this-id; }
	
	public function getUsername() { return $this->username; }
	
	public function passwordMatches($password)
	{
		return ($this->encryptedPassword === Encryptor::encrypt($password));
	}
	
	/**
		returns a User with $username if successful; an array of problems if the inputs are invalid
	*/
	public static function login($username, $password)
	{
		$result = self::loginInputIsValid($username, $password);
		
		if ($result !== true)
		{
			return $result;
		}
		else
		{
			$user = UserRepository::retrieveUserByUsername($username);
			
			if ($user === null)
			{
				$problem = array('badUsername' => true);
				return $problem;
			}
			else
			{
				if ($user->passwordMatches($password))
				{
					return $user;
				}
				else
				{
					$problem = array('badPassword' => true);
					return $problem;
				}
			}
		}
	}
	
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
				$result = UserFactory::createUser($username, $password, $email);
				
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
		returns true if the inputs are valid; an array of errors (key = error name; value = true) if inputs are invalid
	*/
	private static function loginInputIsValid($username, $password)
	{
		//validate data
		if (!usernameIsValidLength($username))
		{
			$errors['longUsername'] = true;
		}
		
		if (!passwordIsValidLength($password))
		{
			$errors['longPassword'] = true;
		}
		
		return (isset($errors) ? $errors : true);
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