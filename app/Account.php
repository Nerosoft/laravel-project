<?php

namespace App;
class Account
{
    /**
     * Create a new class instance.
     */
    private $Key;
    private $Password;
    private $Email;
    public function __construct($key, $password, $email)
    {
        $this->Key = $key;
        $this->Password = $password;
        $this->Email = $email;
    }
    public function getObject(){
        return get_object_vars($this);
    }
    public function getKey(){
        return $this->Key;
    }
    public function getPassword(){
        return $this->Password;
    }
    public function getEmail(){
        return $this->Email;
    }
}
