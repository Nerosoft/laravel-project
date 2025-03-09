<?php
namespace App\language\admin\action\test;
use App\language\admin\action\AppModel;
class TestEdit extends AppModel{
    public function __construct($error, $state, $message, $var1 = null, $var2 = null){
        parent::__construct(true, $error, $state, $message, $var1);
        $this->initError3($state);
        $this->size1 = $var2;
    }
}