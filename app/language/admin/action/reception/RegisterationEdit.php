<?php
namespace App\language\admin\action\reception;
use App\language\admin\action\AppModel;
class RegisterationEdit extends AppModel{
    public function __construct($error, $state, $message, $var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8){
        parent::__construct(true, $error, $state, $message, $var1, $var2, $var3, null, $var5, $var6, $var7, $var8);
        $this->initError3($state);
        $this->size1 = $var4;
    }
}