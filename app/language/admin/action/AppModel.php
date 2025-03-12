<?php
namespace App\language\admin\action;
use App\Models\Rays;
use App\language\share\TestParent;
//contract and know and all language
class AppModel extends TestParent{
    public function __construct($option, $error, $state, $message, $var1 = null, $var2 = null, $var3 = null, $var4 = null, $var5 = null, $var6 = null, $var7 = null, $var8 = null){
        $this->successfully1 = $message;
        $this->error = $error;
        if($option === true){
            $this->initError($state, $var5, $var6, $var7, $var8);
            $this->initError2($state, $var1, $var2, $var3, $var4);
        }else if($option === false)
            $this->initError($state, $var5, $var6, $var7, $var8);
        else if($option === 'changeLang')
            $this->initError2($state, $var1, $var2, $var3, $var4);
        else{
            $this->initError2($state, $var1, $var2, $var3, $var4);
            $this->initError3($state);
        }
    }
}