<?php

namespace model;

class User {
    private $name = "Admin";
    private $password = "Password";
    
    public function __construct($name, $password) {
            $this->name = $name;
            $this->password = $password;
    }
    
}
