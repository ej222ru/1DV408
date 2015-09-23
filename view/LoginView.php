<?php

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';
	private static $userLoggedIn = 'LoginView::UserLoggedIn';

        private $message = '';
        
	public function __construct() {

	}

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response($isLoggedIn) {

                if ($isLoggedIn){
                    $response = $this->generateLogoutButtonHTML($this->message);
                }
                else {
                    $response = $this->generateLoginFormHTML($this->message);
                }
		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . filter_input(INPUT_POST, self::$name) . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
        
	public function setSessionClientId() {
            $ip = filter_input(INPUT_SERVER,'HTTP_CLIENT_IP');
            $browser = "";
            if (isset($_REQUEST['self::$Browser'])){
                $browser = $_REQUEST['self::$Browser'];
            }
            
            $_SESSION["clientIP"] =  $ip;
            $_SESSION["clientBrowser"] =  $browser;
 
        }

	public function getSessionUser() {
            return isset($_SESSION["userSessionId"]);
       }
        
	public function setSessionUser() {
            $_SESSION["userSessionId"] =  session_id();
       }
	public function setSessionUserLoggedIn($value) {
      //      echo "setSessionUserLoggedIn";
            $_SESSION[self::$userLoggedIn] =  $value;
            if ($value == "false"){
                session_destroy();
/*		setcookie(self::$cookieName, '', time() - 4600);
		setcookie(self::$cookiePassword, '', time() - 4600);
		// And then unset it.
		unset($_COOKIE[self::$cookieName]);
		unset($_COOKIE[self::$cookiePassword]);  
 * 
 */              
                // $_SESSION=array();
            }
       }
	public function getSessionUserLoggedIn() {
            if (isset($_SESSION[self::$userLoggedIn])){
                if ($_SESSION[self::$userLoggedIn] == "true"){
                    return true;
                }
                else {
                    return false;
                }
            }
            else{
                return false;
                
            }
       }
        
       
        
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	public function getRequestLogin() {
            return filter_input(INPUT_POST, self::$login);
 	}
	public function getRequestLogout() {
            return filter_input(INPUT_POST, self::$logout);
	}
	public function getRequestUserName() {
            return filter_input(INPUT_POST, self::$name);
	}
	public function getRequestPassword() {
            return filter_input(INPUT_POST, self::$password);
	}
        public function assignMessage($id){
            switch ($id){
                case 0:
                    $this->message = "";
                    break;
                case 1:
                    $this->message = "Username is missing";
                    break;
                case 2:
                    $this->message = "Password is missing";
                    break;
                case 3:
                    $this->message = "Wrong name or password";
                    break;
                case 4:
                    $this->message = "Welcome";
                    break;
                case 5:
                    $this->message = "Bye bye!";
                    break;
            }
        }
}