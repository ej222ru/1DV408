<?php

class UserController {
   
    private $layoutView;
    private $loginView;
    private $dateTimeView;
    private $user;
    
    public function __construct($layoutViewObject, $loginViewObject, $dateTimeViewObject) {
        $this->user = new model\User();
        $this->layoutView       = $layoutViewObject;
        $this->loginView        = $loginViewObject;
        $this->dateTimeView     = $dateTimeViewObject;
    }
    
    /*
     * Actual start point for user triggered login/logout actions 
     */
    public function startLoginApplikation() {
        
        /*
         * First decide if the user is already logged in
         * Set messages and decide if a login is authenticated
         * and if a logout is accepted depending on state i.e. 
         * user is already logged in
         */
        if (!$this->loginView->getSessionUserLoggedIn()){
            // Only manage logins if not already logged in
            if ($this->loginView->getRequestLogin()){

                 if ($this->loginView->getRequestUserName() == ''){
                     $this->loginView->assignMessage(1);
                 }
                 else if ($this->loginView->getRequestPassword() == ''){
                     $this->loginView->assignMessage(2);
                 }
                 else if (!$this->validateLogin($this->loginView->getRequestUserName(), $this->loginView->getRequestPassword())){
                     $this->loginView->assignMessage(3);
                }
                else {
                    $this->loginView->setSessionUserLoggedIn("true");
                    $this->loginView->assignMessage(4);
                }
            }
            else {
                 $this->loginView->assignMessage(0);
            }            
        }
        else {
             // Only manage logouts if already logged in
            if ($this->loginView->getRequestLogout()){
                $this->loginView->setSessionUserLoggedIn("false");
                $this->loginView->assignMessage(5);
            }
            else {
                $this->loginView->assignMessage(0);
            }                 
        }                
        // Render the form
        $this->layoutView->render($this->loginView->getSessionUserLoggedIn(), $this->loginView, $this->dateTimeView);
    }
    
    // Call User model for actual validation (Authentication)
     public function validateLogin($loginName, $loginPw) {
        return $this->user->validateUser($loginName, $loginPw);
    }
    
}
