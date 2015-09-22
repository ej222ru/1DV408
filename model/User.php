<?php

namespace model;

class User {
    private $name = "Admin";
    private $password = "Password";
    private $isLoggedIn = false;
    
    public function __construct() {

    }
    public function validateUser($loginName, $loginPw) {
        if (($loginName == $this->name) && ($loginPw == $this->password)){
            $this->isLoggedIn = true;
        }
        else {
            $this->isLoggedIn = false;
        }
        return $this->isLoggedIn;
    }
    public function isLoggedIn(){
        return $this->isLoggedIn;
    }
    
}
