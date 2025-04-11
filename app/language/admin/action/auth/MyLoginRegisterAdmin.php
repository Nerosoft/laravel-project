<?php
namespace App\language\admin\action\auth;
use App\language\share\AuthError;
use App\Account;
class MyLoginRegisterAdmin extends AuthError{
    public function __construct($error, $state, $user){
        $this->error = $error;
        $this->User = array();
        if(isset($user))
            foreach ($user as $key => $value)
                array_push($this->User, new Account($value['Key'], $value['Password'], $value['Email']));
        $this->initError($state);
        $this->initError2($state);
    }
}