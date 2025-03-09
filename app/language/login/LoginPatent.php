<?php
namespace App\language\login;
use App\language\share\AuthError;
class LoginPatent extends AuthError
{
    /**
     * Create a new class instance.
     */
    public function __construct($ob, $state = null, $myLang = null)
    {
        parent::__construct($ob[$myLang]['Error'], $state, $myLang, $ob[$myLang]['Title']['LoginPatent'], $ob[$myLang]['Html']['Direction']);
        $this->label1 = $ob[$this->language]['Label']['LoginPatent'];
        $this->label2 = $ob[$this->language]['Label']['PatentCode'];
        $this->label3 = $ob[$this->language]['Label']['SettingLanguage'];
        $this->RaysId = $ob['_id'];
        $this->hint1 = $ob[$this->language]['Hint']['CodePatent'];
        $this->button1 = $ob[$this->language]['Button']['SearchPatent'];
        $this->button2 = $ob[$this->language]['Button']['CloseLanguage'];
        $this->button3 = $ob[$this->language]['Button']['SaveLanguage'];
        $this->button4 = $ob[$this->language]['Button']['Language'];
        $this->myLanguage = $ob[$this->language][$this->language];
    }
}
