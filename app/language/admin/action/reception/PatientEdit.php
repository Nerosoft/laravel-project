<?php
namespace App\language\admin\action\reception;
use App\language\admin\action\AppModel;
use App\instance\admin\reception\Patent;
class PatientEdit extends AppModel{
    public function __construct($error, $state, $message, $var1, $var2, $var3, $var4, $myPatent, $Patent){
        parent::__construct(true, $error, $state, $message, $var1, $var2, $var3, $var4);
        $this->initError3($state);
        $this->size1 = $Patent;
        $this->myPatent = array();
        if($myPatent)
            foreach ($myPatent as $key => $patent)
                $this->myPatent[$key] = new Patent($patent['PatentCode'], $patent['Avatar']);
    }
}