<?php
namespace App\language\share;
use App\MyLanguage;
class EmailPassInformaion extends InitPage{
    protected function __construct($help, $reqEmail, $invEmail, $reqPass, $invPass, $labelUserEmail, $labelUserPassword, $hintUserEmail, $hintUserPassword, $settingLanguage, $changeLang, $saveLanguage, $loginUser, $myRadios, $raysId, $language, $title, $direction){
        parent::__construct($language, $title, $direction);
        $this->button1 = $changeLang;
        $this->button2 = $saveLanguage;
        $this->button3 = $loginUser;
        $this->label4 = $settingLanguage;
        $this->myRadios = array();
        foreach ($myRadios as $key => $value)
            $this->myRadios[$key] = new MyLanguage($value);
        $this->RaysId = $raysId;
        $this->error1 = $invEmail;
        $this->error2 = $reqEmail;
        $this->error3 = $invPass;
        $this->error4 = $reqPass;
        $this->label1 = $labelUserEmail;
        $this->label2 = $labelUserPassword;
        $this->hint1 = $hintUserEmail;
        $this->hint2 = $hintUserPassword;
        $this->help = $help;
    }
}