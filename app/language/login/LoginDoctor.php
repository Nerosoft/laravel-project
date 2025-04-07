<?php
namespace App\language\login;
use App\language\share\AuthError;
class LoginDoctor extends AuthError
{
    public function __construct($ob, $state = null, $myLang = null)
    {    
        parent::__construct($ob[$myLang]['Error'], $state, $myLang, $ob[$myLang]['Title']['LoginDoctor'], $ob[$myLang]['Html']['Direction']);
        $this->label1 = $ob[$this->language]['Label']['UserEmail'];
        $this->label2 = $ob[$this->language]['Label']['UserPassword'];
        $this->label3 = $ob[$this->language]['Label']['LoginDoctor'];
        $this->label4 = $ob[$this->language]['Label']['SettingLanguage'];
        $this->hint1 = $ob[$this->language]['Hint']['UserEmail'];
        $this->hint2 = $ob[$this->language]['Hint']['UserPassword'];
        $this->button1 = $ob[$this->language]['Button']['Language'];
        $this->button2 = $ob[$this->language]['Button']['SaveLanguage'];
        $this->button3 = $ob[$this->language]['Button']['LoginUser'];
        $this->myLanguage = $ob[$this->language]['AllNamesLanguage'];
        $this->RaysId = $ob['_id'];
    }
}
