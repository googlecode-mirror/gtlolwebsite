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
		return ($encryptedPassword === Encryptor::encrypt($password));
	}
	
	/**
		ret
	*/
	public static function login($username, $password)
	{
		$result = self::inputsAreValid($username, $password);
		
		if ($result !== true)
		{
			return $result;
		}
	}
	
	/**
		returns true if the inputs are valid; an array of errors (key = error name; value = true) if inputs are invalid
	*/
	private static function inputsAreValid($username, $password)
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
}
?>