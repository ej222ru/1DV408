<?php

namespace model;

class User {
    /* 
     *  Class User i responsible for keeping accepted user and password
        and to validate that to users trying to login
     * 
     */ 
    private $name = "Admin";
    private $password = "Password";
    
    public function validateUser($loginName, $loginPw) {
        if (($loginName == $this->name) && ($loginPw == $this->password)){
            return true;
        }
        else {
            return false;
        }
    }
}
