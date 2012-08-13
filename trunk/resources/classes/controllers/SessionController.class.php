<?php

class SessionController
{
	public static function userIsLoggedIn()
	{
		$session = Session::getCurrentSession();
		$userIsLoggedIn = $session->userIsLoggedIn();
		return $userIsLoggedIn;
	}
	
	/**
		returns true if successful; an array of problems if the inputs are invalid
	*/
	public static function login($username, $password)
	{
		$session = Session::getCurrentSession();
		$result = $session->login($username, $password);
		return $result;
	}
	
	public static function logout()
	{
		$session = Session::getCurrentSession();
		$session->logout();
	}
	
	public static function currentUserIsAdmin()
	{
		$session = Session::getCurrentSession();
		$user = $session->getUser();
		$adminRole = new Role(Roles::ADMIN);
		$isAdmin = $adminRole->userHasRole($user);
		return $isAdmin;
	}
	
	public static function getCurrentUsersName()
	{
		$session = Session::getCurrentSession();
		$name = $session->getUser()->getName();
		return $name;
	}
	
	public static function getCurrentUsersUsername()
	{
		$session = Session::getCurrentSession();
		$user = $session->getUser();
		$username = $user->getUsername();
		return $username;
	}
}

?>