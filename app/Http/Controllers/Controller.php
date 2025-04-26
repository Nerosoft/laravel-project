<?php
namespace App\Http\Controllers;
use App\Models\Rays;
use Illuminate\Support\Str;
use App\MyLanguage;
use App\Http\interface\LangObject;
abstract class Controller
{
    protected function getDeleteDatabade($item){
        $model = Rays::find(request()->session()->get('userId'));
        if(count($model[$item]) === 1)
            unset($model[$item]);
        else{
            $arr = $model[$item];
            unset($arr[request()->input('id')]);
            $model[$item] = $arr;
        }
        $model->save();
    }
    protected function getEditDataBase($item, LangObject $newObject, $image = null){
        $model = Rays::find(request()->session()->get('userId'));
        $arr = $model[$item];
        $arr[request()->input('id')] = $newObject->getMyObject($item, $image);
        $model[$item] = $arr;
        $model->save();
    }
    protected function getCreateDataBase($item, LangObject $newObject, $image = null){
        $model = Rays::find(request()->session()->exists('userId') ? request()->session()->get('userId') : request()->input('userId'));
        $Id = $this->generateUniqueIdentifier();
        if(isset($model[$item])){
            $arr = $model[$item];
            $arr[$Id] = $newObject->getMyObject($item, $image, $Id);
            $model[$item] = $arr;
        }else
            $model[$item] = array($Id=>$newObject->getMyObject($item, $image, $Id));
        $model->save();
    }
    protected function generateUniqueIdentifier($length = 8){
        return Str::random($length - 6) . substr(uniqid(), -6);
    }
    protected function setupRadios($language){
        $array = array();
        foreach ($language as $key => $value)
            $array[$key] = new MyLanguage($value);
        return $array; 
    }
}
