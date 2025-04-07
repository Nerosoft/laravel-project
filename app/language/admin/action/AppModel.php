<?php
namespace App\language\admin\action;
use App\Models\Rays;
use App\language\share\TestParent;
use App\instance\admin\reception\Patent;
//contract and know and all language
class AppModel extends TestParent{
    public function __construct($option, $error, $state, $message, $var1 = null, $var2 = null, $var3 = null, $var4 = null, $var5 = null, $var6 = null, $var7 = null, $var8 = null){
        $this->successfully1 = $message;
        $this->error = $error;
        if($option === 'option1'){
            $this->initError($state, $var5, $var6, $var7, $var8);
            $this->initError2($state, $var1, $var2, $var3, $var4);
        }else if($option === 'option2'){
            $this->initError($state, $var5, $var6, $var7, $var8);
            $this->initError2($state, $var1, $var2, $var3, $var4);
            $this->initError3($state, $var2);
        }else if($option === 'option3')
            $this->initError($state, $var5, $var6, $var7, $var8);
        else if($option === 'option4'){
            $this->initError($state, $var5, $var6, $var7, $var8);
            $this->initError2($state, $var1, $var2, $var3, $var4);
            $this->initError3($state, $var6);
            $this->myPatent = array();
            if($var5)
                foreach ($var5 as $key => $patent)
                    $this->myPatent[$key] = new Patent($patent['PatentCode'], $patent['Avatar']);
        }else if($option === 'option5'){
            $this->initError($state, $var5, $var6, $var7, $var8);
            $this->initError2($state, $var1, $var2, $var3, $var4);
            $this->initError3($state, $var4);
        }else if($option === 'option6'){
            $this->initError($state, $var5, $var6, $var7, $var8);
            $this->initError2($state, $var1, $var2, $var3, $var4);
            $this->id1 = $var2;
        }
        else if($option === 'option7'){
            $this->initError2($state, $var1, $var2, $var3, $var4);
            //dont put in initError2 function bucase option8 not define language
            $this->language = $var2;
        }
        else if($option === 'option8'){
            $this->initError($state, $var5, $var6, $var7, $var8);
            $this->initError2($state, $var1, $var2, $var3, $var4);
            $this->myAllLanguage = $var2;
        }else if($option === 'option9'){
            $this->initError2($state, $var1, $var2, $var3, $var4);
            $this->initError3($state, $var1);
            $this->language = $var3;
            unset($this->size1[0]);
            unset($this->size1[1]);
            $this->myAllLanguage = $var2;
        }
        else //delete
            $this->initError3($state, $var1);
    }
}