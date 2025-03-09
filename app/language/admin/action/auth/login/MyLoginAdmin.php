<?php
namespace App\language\admin\action\auth\login;
use App\language\share\AuthError;
use App\Account;
class MyLoginAdmin extends AuthError{
    public function __construct($error, $state, $myUser){
        $this->error = $error;
        $this->User = array();
        foreach ($myUser as $key => $value)
            array_push($this->User, new Account($value['Key'], $value['Password'], $value['Email']));
        $this->initError($state);
        $this->initError2($state);
    }
}