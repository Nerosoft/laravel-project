<?php
namespace App\language\share;
class AppDelete extends TestParent{
    public function __construct($error, $state, $message, $var1){
        $this->successfully1 = $message;
        $this->error = $error;
        $this->initError3($state);
        $this->size1 = $var1;
    }
}