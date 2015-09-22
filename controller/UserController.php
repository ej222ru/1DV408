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
        if ($this->logV->getRequestLogin()){

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
                $this->logV->assignMessage(4);
            }
        }
        else {
            $this->logV->assignMessage(0);
        }

        $this->layV->render($this->user->isLoggedIn(), $this->logV, $this->dtv);
    }
    
    
    
    public function validateLogin($loginName, $loginPw) {
        return $this->user->validateUser($loginName, $loginPw);
    }
    
}
