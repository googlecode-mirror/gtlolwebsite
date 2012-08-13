<?php

/**
	Singleton
*/
class Session
{
	static $currentSession = null;
	
	private $currentUser = null;
	
	private function __construct() {}
	
	public function getUser()
	{
		return $this->currentUser;
	}
	
	/**
		Sets the current user if the credentials are correct.
		returns true if successful; an array of problems if the inputs are invalid
	*/
	public function login($username, $password)
	{
		$result = $this->loginInputIsValid($username, $password);
		
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
				
					print("logged in");
				
					$this->currentUser = $user;
					return true;
				}
				else
				{
					$problem = array('badPassword' => true);
					return $problem;
				}
			}
		}
	}
	
	public function logout()
	{
		$this->currentUser = null;
	}
	
	public function userIsLoggedIn()
	{
		$userIsLoggedIn = $this->currentUser !== null;
		
		return $userIsLoggedIn;
	}
	
	/**
		returns true if the inputs are valid; an array of errors (key = error name; value = true) if inputs are invalid
	*/
	private function loginInputIsValid($username, $password)
	{
		//validate data
		if (!Validator::usernameIsValidLength($username))
		{
			$errors['longUsername'] = true;
		}
		
		if (!Validator::passwordIsValidLength($password))
		{
			$errors['longPassword'] = true;
		}
		
		return (isset($errors) ? $errors : true);
	}
	
	public static function getCurrentSession()
	{
		self::startSessionIfNecessary();
	
		if (!isset($_SESSION['currentSession']) || $_SESSION['currentSession'] == null)
		{
			$_SESSION['currentSession'] = new Session();
		}
		
		return $_SESSION['currentSession'];
	}
	
	private static function startSessionIfNecessary()
	{
		if (session_id() === '')
		{
			session_start();
		}
	}
}

?>