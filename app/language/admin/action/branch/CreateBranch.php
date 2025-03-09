<?php
namespace App\language\admin\action\branch;
use App\language\admin\action\AppModel;
class CreateBranch extends AppModel{
    public function __construct($error, $state, $message, $key, $appId){
        parent::__construct(true, $error,  $state, $message, $key);
        $this->id1 = $appId;
    }
}