<?php

namespace model;

class User {
    private $name = "Admin";
    private $password = "Password";
    
    public function __construct() {

    }
    public function validateUser($loginName, $loginPw) {
        if (($loginName == $this->name) && ($loginPw == $this->password)){
            return true;
        }
        else {
            return false;
        }
    }
}
