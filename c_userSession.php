<?php
class userSession{
	//////////////////////////
	//Class dedicated to managing user login information and session control
	//////////////////////////
	//Member functions
	//sessionStatus() - returns true if there is an active session with a logged in user.  False otherwise 
	//initUser() - initializes user data in this class... pulls the info from the database for user throughout the site
	//login(user,pass) - logs a user in.
	//logout() - logs a user out
	//register (user, pass, email) - register a username
	//////////////////////////
	
	// TO DO
	// setters for access level
	
	//////////////////////////
	//Variables
	//////////////////////////
	
	public $user_id;		// User ID number
	public $user_name;	// Username // not using user name for this site
	public $user_accessLevel; // Access level of user
	public $user_email; /// not using email for this site.  Users will use their email for user name
	public $isLogged = 0; // is user logged in?
	
	public function initUser(){
		global $db;
		
		$this->isLogged = 0;
		
		if (isset($_SESSION['username'])){
			if (md5($_SESSION['username']) == $_SESSION['secureID']){ // check for a session high jack
				$dbR = $db->query("SELECT * FROM users WHERE username = '{$_SESSION['username']}'");
				$result = $dbR->fetch_assoc();
				
				$this->user_id = $result['userid'];
				$this->user_name = $result['username'];
				$this->user_accessLevel = $result['accessID'];
				$this->user_email = $result['email'];
				$this->isLogged = 1;
				
				return True;
			}
		}
		return False;	
	}
	
	public function sessionStatus(){
		if ($this->isLogged){
			return True;
		}else{
			return False;
		}
	}
	
	public function login($username, $password){
		
		global $db;
		$password = md5($password);
		
		if ($dbR = $db->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'")) {
			if ($dbR->num_rows == 1){
				// If there is a username and password match
				// set session variables, username and challenge code 
				$_SESSION['username'] = $username;
				$_SESSION['secureID'] = md5($username);
				
				// call initUser function
				$this->initUser();
				
				// Set the logged status and return true
				$this->isLogged=1;
				return True;
			}else{
				return False; // function returns false if the login fails
			}
		}
	}
	
	function registerUser($username, $password, $email){
		
		global $db;

		$password = md5($password);

		$dbR = $db->query("SELECT * FROM users WHERE username = '$username'");
		
		if($dbR->num_rows == 0){
			$dbR = $db->query("INSERT INTO users (username, password, email, accessID) VALUES ('$username','$password','$email', 0)");
			return true; 
		}else{
			return false; 
		}
	}

	function changePassword($oldPass, $newPass){
		global $db;

		$oldPass = md5($oldPass);
		$dbR = $db->query("SELECT * FROM users WHERE username = '$this->user_name' AND password = '$oldPass'");

		if($dbR->num_rows == 1){
			// match, change password

			$newPass = md5($newPass);
			$dbR2 = $db->query("UPDATE users SET password='$newPass' WHERE username = '$this->user_name'");
			return true;
		}else{
			// no password match, reject
			return false;
		}
	}
	
	function logout(){
		session_unset();
		session_destroy();
	}
}
