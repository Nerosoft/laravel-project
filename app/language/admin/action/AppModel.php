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
            $this->initError3($state, $state !== 'Patients' ? ($state !== 'PatientRegisteration' ? $var2 : $var4) : $var5);
        }else if($option === 'option3')
            $this->initError($state, $var5, $var6, $var7, $var8);
        else if($option === 'option7')
            $this->initError2($state, $var1, $var2, $var3, $var4);
        else if($option === 'option8'){
            $this->initError2($state, $var1, $var2, $var3, $var4);
            $this->initError3($state, $var1, $var2);
        }
        else //delete
            $this->initError3($state, $var1);
    }
    public function findPatient($code){
        return new Patent(Rays::find(request()->session()->get('userId'))['Patent'][$code]['PatentCode'], Rays::find(request()->session()->get('userId'))['Patent'][$code]['Avatar']);
    }
}