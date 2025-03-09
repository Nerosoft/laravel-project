<?php

namespace App\language\login;
use App\language\share\AuthError;
class RegisterAdmin extends AuthError
{
    /**
     * Create a new class instance.
     */
    public function __construct($ob, $state = null, $myLang = null)
    {   
        parent::__construct($ob[$myLang]['Error'], $state, $myLang, $ob[$myLang]['Title']['RegisterUser'], $ob[$myLang]['Html']['Direction']);
        $this->label1 = $ob[$this->language]['Label']['RegisterUser'];
        $this->label2 = $ob[$this->language]['Label']['UserEmail'];
        $this->label3 = $ob[$this->language]['Label']['UserPassword'];
        $this->label4 = $ob[$this->language]['Label']['UserRepeatPassword'];
        $this->label5 = $ob[$this->language]['Label']['UserCodePassword'];
        $this->label6 = $ob[$this->language]['Label']['SettingLanguage'];
        $this->hint1 = $ob[$this->language]['Hint']['UserEmail'];
        $this->hint2 = $ob[$this->language]['Hint']['UserPassword'];
        $this->hint3 = $ob[$this->language]['Hint']['UserRepeatPassword'];
        $this->hint4 = $ob[$this->language]['Hint']['UserCodePassword'];
        $this->button1 = $ob[$this->language]['Button']['UserRegister'];
        $this->button2 = $ob[$this->language]['Button']['Language'];
        $this->button3 = $ob[$this->language]['Button']['CloseLanguage'];
        $this->button4 = $ob[$this->language]['Button']['SaveLanguage'];
        $this->myLanguage = $ob[$this->language][$this->language];
        $this->RaysId = $ob['_id'];
    }
}
