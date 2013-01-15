<?php
class User extends DBObject
{
	private $id = null;
	private $username = null;
	private $name = null;
	private $encryptedPassword = null;
	
	/**
		if $isID
			$arg1 is the user's id
		else
			$arg1 is the whereSQL to select that user
	*/
	public function __construct($arg1, $isID)
	{
		if ($isID)
		{
			parent::__construct("id='$id'");
			$this->id = $id;
		}
		else
		{
			parent::__construct($this->whereSQL);
		}
	}
	
	public function commit()
	{
		commitHelper("Users");
	}

	/* TODO remove
	public function __construct($id, $username, $encryptedPassword, $name)
	{
		$this->id = $id;
		$this->username = $username;
		$this->name = $name;
		$this->encryptedPassword = $encryptedPassword;
	}
	*/
	
	public function getName()
	{
		if ($this->name == null)
		{
			populateFields();
		}
		return $this->name;
	}
	
	public function getID()
	{
		if ($this->id == null)
		{
			populateFields();
		}
		return $this->id;
	}
	
	public function getIDSQL()
	{
		return "SELECT id FROM Users WHERE $this->whereSQL";
	}
	
	public function getUsername()
	{
		if ($this->username == null)
		{
			populateFields();
		}
		return $this->username;
	}
	
	protected function getEncryptedPassword()
	{
		if ($this->encryptedPassword == null)
		{
			populateFields();
		}
		return $this->encryptedPassword;
	}
	
	public function passwordMatches($password)
	{
		return ($this->encryptedPassword === Encryptor::encrypt($password));
	}
	
	public function populateFields()
	{
		$statement = DBConnection::executeSQLSelect("SELECT * FROM Users WHERE $whereSQL", null);
		
		if ($result = $statement->fetch())
		{
			$this->id = $result['id'];
			$this->username = $result['username'];
			$this->name = $result['name'];
			$this->encryptedPassword = $result['password'];
			$this->whereSQL = "id='$this->id'";
		}
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