<?php
namespace App\language\share;
class AuthError extends InitPage{
    protected $error;
    protected function __construct($error, $state, $language, $title, $direction){
        parent::__construct($language, $title, $direction);
        $this->error = $error;
        $this->initError($state);
    }
    protected function initError($state){
        if($state === 'login'){//admin
            $this->error1 = $this->error['UserEmail'];
            $this->error2 = $this->error['UserEmailRequired'];
            $this->error3 = $this->error['UserPassword'];
            $this->error4 = $this->error['UserPasswordRequired'];
        }
        else if($state === 'doctor'){
            $this->error1 = $this->error['UserEmail'];
            $this->error2 = $this->error['UserEmailRequired'];
            $this->error3 = $this->error['UserPassword'];
            $this->error4 = $this->error['UserPasswordRequired'];
        }else if($state === 'register'){
            $this->error1 = $this->error['UserRepeatPassword'];
            $this->error2 = $this->error['UserEmail'];
            $this->error3 = $this->error['UserEmailRequired'];
            $this->error4 = $this->error['UserRepeatPasswordRequired'];
            $this->error5 = $this->error['UserPassword'];//len
            $this->error6 = $this->error['UserPasswordRequired'];
            $this->error7 = $this->error['UserPasswordDntMatch'];
            $this->error8 = $this->error['UserCodePasswordRequired'];
            $this->error9 = $this->error['UserCodePassword'];
        }else{//patent
            $this->error1 = $this->error['LoginPatentLength'];
            $this->error2 = $this->error['LoginPatentCodeRequired'];
        }
    }
    protected function initError2($state){
        if($state === 'login')//admin
            $this->error5 = $this->error['UserPasswordDntMatch'];
        else if($state === 'doctor')
            $this->error5 = $this->error['UserPasswordDntMatch'];
        else if($state === 'register')
            $this->error10 = $this->error['UserEmailExist'];       
        else//patent
            $this->error3 = $this->error['LoginPatentCode'];
    }
}