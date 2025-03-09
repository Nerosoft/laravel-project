<?php
namespace App\language\admin\action\branch;
use App\language\admin\action\AppModel;
class EditBranch extends AppModel{
    public function __construct($error, $state, $message, $key, $size){
        parent::__construct(true, $error, $state, $message, $key);
        $this->initError3($state);
        $this->size1 = $size; 
    }
}