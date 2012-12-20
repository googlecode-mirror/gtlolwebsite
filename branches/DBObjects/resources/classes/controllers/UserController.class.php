<?php

class UserController
{
	/**
		returns a list of errors if unsuccessful or true if successful
	*/
	public function registerUser($username, $password, $retypedPassword, $email, $retyptedEmail)
	{
		$result = User::registerUser($username, $password, $retypedPassword, $email, $retyptedEmail);
		
		if (is_array($result))
		{
			//there are errors
			return $result;
		}
		else
		{
			return true;
		}
	}
}

?>