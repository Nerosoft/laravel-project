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
    protected function getEditDataBase($item, LangObject | array $newObject){
        $model = Rays::find(request()->session()->get('userId'));
        $arr = $model[$item];
        $arr[request()->input('id')] = is_array($newObject) ? $newObject : $newObject->getMyObject($item);
        $model[$item] = $arr;
        $model->save();
    }
    protected function getCreateDataBase($item, LangObject | array $newObject){
        $model = Rays::find(request()->session()->exists('userId') ? request()->session()->get('userId') : request()->input('userId'));
        $Id = $this->generateUniqueIdentifier();
        if(isset($model[$item])){
            $arr = $model[$item];
            $arr[$Id] = is_array($newObject) ? $newObject : $newObject->getMyObject($item, $Id);
            $model[$item] = $arr;
        }else
            $model[$item] = array($Id=>is_array($newObject) ? $newObject : $newObject->getMyObject($item, $Id));
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
