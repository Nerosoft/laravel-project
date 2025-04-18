<?php
namespace App\Http\Controllers;
use App\Models\Rays;
use Illuminate\Support\Str;
use App\MyLanguage;
abstract class Controller
{
    protected function getDeleteDatabade($item){
        $model = Rays::find(request()->session()->get('userId'));
            foreach ($model[$item] as $key => $value)
                if($key == request()->input('id') && count($model[$item]) === 1){
                    unset($model[$item]);
                    break;
                }else if ($key == request()->input('id')){
                    $arr = $model[$item];
                    unset($arr[$key]);
                    $model[$item] = $arr;
                    break;
                }
        $model->save();
    }
    protected function getEditDataBase($item, $newObject){
        $model = Rays::find(request()->session()->get('userId'));
        $arr = $model[$item];
        $arr[request()->input('id')] = $newObject;
        $model[$item] = $arr;
        $model->save();
    }
    protected function getCreateDataBase($item, $newObject, $Id = null){
        $model = Rays::find(request()->session()->exists('userId') ? request()->session()->get('userId') : request()->input('userId'));
        if(isset($model[$item])){
            $arr = $model[$item];
            $arr[$Id !== null ? $Id : $this->generateUniqueIdentifier()] = $newObject;
            $model[$item] = $arr;
        }else
            $model[$item] = array($Id !== null ? $Id : $this->generateUniqueIdentifier()=>$newObject);
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
