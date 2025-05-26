<?php
namespace App\language\share;
use App\MyLanguage;
class ModelLanguage extends InitPage{
    protected function __construct($settingLanguage, $changeLang, $saveLanguage, $loginUser, $myRadios, $raysId, $language, $title, $direction){
        parent::__construct($language, $title, $direction);
        $this->button1 = $changeLang;
        $this->button2 = $saveLanguage;
        $this->button3 = $loginUser;
        $this->label4 = $settingLanguage;
        $this->myRadios = array();
        foreach ($myRadios as $key => $value)
            $this->myRadios[$key] = new MyLanguage($value);
        $this->RaysId = $raysId;
    }
}