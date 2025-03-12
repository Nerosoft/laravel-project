<?php
namespace App\language\admin\action\change_language;
use App\language\admin\action\AppModel;
class MyChangeLanguage extends AppModel{
    public function __construct($error, $state, $message, $key, $language){
        parent::__construct('changeLang', $error,  $state, $message, $key);
        $this->language = $language;
    }
}