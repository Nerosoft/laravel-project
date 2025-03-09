<?php
namespace App\language\admin\action\change_language;
use App\language\admin\action\AppModel;
class CopyLanguage extends AppModel{
    public function __construct($error, $state, $message, $key, $ob){
        parent::__construct(false, $error,  $state, $message, null, null, null, null, $key);
        $this->initMyAllLanguage($ob);
    }
}