<?php

class UserController {
   
    private $layV;
    private $logV;
    private $dtv;
    private $user;
    
    public function __construct($lv, $v, $dtv) {

        $this->user = new model\User();
        $this->layV   = $lv;
        $this->logV   = $v;
        $this->dtv    = $dtv;
        
    }
    
    public function startLogin() {
        $logInStatus = $this->logV->getSessionUserLoggedIn();
        
   //      echo "Ett*" . $logInStatus . "*";
        if (!$logInStatus && $this->logV->getRequestLogin()){

           $this->logV->setSessionClientId();
            
            if ($this->logV->getRequestUserName() == ''){
                $this->logV->assignMessage(1);
            }
            else if ($this->logV->getRequestPassword() == ''){
                $this->logV->assignMessage(2);
            }
            else if (!$this->validateLogin($this->logV->getRequestUserName(), $this->logV->getRequestPassword())){
                $this->logV->assignMessage(3);
            }
            else {
                $this->logV->setSessionUserLoggedIn("true");
                $this->logV->assignMessage(4);
            }
        }
        else {
            $this->logV->assignMessage(0);
        }
        if ($this->logV->getRequestLogout()){
            if ($logInStatus){
                $this->logV->setSessionUserLoggedIn("false");
               $this->logV->assignMessage(5);
           }
           else{
               $this->logV->assignMessage(0);
           }
        }
                

        $this->layV->render($this->logV->getSessionUserLoggedIn(), $this->logV, $this->dtv);
    }
    
    
     public function validateLogin($loginName, $loginPw) {
        return $this->user->validateUser($loginName, $loginPw);
    }
    
}
