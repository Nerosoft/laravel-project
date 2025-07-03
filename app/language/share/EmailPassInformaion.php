<?php
namespace App\language\share;
use App\MyLanguage;
class EmailPassInformaion extends InitPage{
    protected function __construct($errorUserEmail, $errorUserEmailRequired, 
    $errorUserPassword, $errorUserPasswordRequired = null, $help = null, $labelUserEmail = null, $labelUserPassword = null, 
    $hintUserEmail = null, $hintUserPassword = null, 
    $settingLanguage = null, $changeLang = null, $saveLanguage = null,
     $loginUser = null, $myRadios = null, $raysId = null, $language = null, $title = null, $direction = null){
        $this->errorUserEmail = $errorUserEmail;
        $this->errorUserEmailRequired = $errorUserEmailRequired;
        $this->errorUserPassword = $errorUserPassword;
        $this->errorUserPasswordRequired = $errorUserPasswordRequired;
        // dd($help);
        if($help !== null){
            parent::__construct($language, $title, $direction);
            $this->button1 = $changeLang;
            $this->button2 = $saveLanguage;
            $this->button3 = $loginUser;
            $this->label4 = $settingLanguage;
            $this->myRadios = array();
            foreach ($myRadios as $key => $value)
                $this->myRadios[$key] = new MyLanguage($value);
            $this->RaysId = $raysId;
            $this->label1 = $labelUserEmail;
            $this->label2 = $labelUserPassword;
            $this->hint1 = $hintUserEmail;
            $this->hint2 = $hintUserPassword;
            $this->help = $help;
        }
    }
}