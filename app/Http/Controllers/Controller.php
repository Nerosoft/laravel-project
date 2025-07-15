<?php
namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Http\interface\LangObject;
abstract class Controller
{
     protected function getCreateDataBase($model, $item, $Id, LangObject $newObject){
        if(isset($model[$item])){
            $arr = $model[$item];
            $arr[$Id] = $newObject->getMyObject();
            $model[$item] = $arr;
        }else
            $model[$item] = array($Id=>$newObject->getMyObject());
        $model->save();
    }
    protected function generateUniqueIdentifier($length = 8){
        return Str::random($length - 6) . substr(uniqid(), -6);
    }
}
