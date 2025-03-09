<?php
namespace App\language\admin\action\auth\login;
use App\language\share\AuthError;
class MyLoginPatient extends AuthError{
    public function __construct($error, $state){
        $this->error = $error;
        $this->initError($state);
        $this->initError2($state);
    }
}