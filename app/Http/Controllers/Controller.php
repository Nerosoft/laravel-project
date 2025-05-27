<?php
namespace App\Http\Controllers;
// use App\Models\Rays;
// use Illuminate\Support\Str;
// use App\MyLanguage;
// use App\Http\interface\LangObject;
abstract class Controller
{

    // protected function getEditDataBase($model, $item, LangObject $newObject){
    //     $arr = $model[$item];
    //     $arr[request()->input('id')] = $newObject->getMyObject();
    //     $model[$item] = $arr;
    //     $model->save();
    // }
    // protected function getCreateDataBase($model, $item, $Id, LangObject $newObject){
    //     if(isset($model[$item])){
    //         $arr = $model[$item];
    //         $arr[$Id] = $newObject->getMyObject();
    //         $model[$item] = $arr;
    //     }else
    //         $model[$item] = array($Id=>$newObject->getMyObject());
    //     $model->save();
    // }
    // protected function generateUniqueIdentifier($length = 8){
    //     return Str::random($length - 6) . substr(uniqid(), -6);
    // }
}
