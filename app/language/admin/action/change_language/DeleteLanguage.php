<?php
namespace App\language\admin\action\change_language;
use App\language\admin\action\AppModel;
class DeleteLanguage extends AppModel{
    public function __construct($error, $state, $message, $key, $ob){
        parent::__construct(null, $error,  $state, $message, $key);
        $this->language = $ob['Setting']['Language'];
        unset($this->size1[0]);
        unset($this->size1[1]);
        $this->initMyAllLanguage($ob);
    }
}