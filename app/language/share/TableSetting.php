<?php
namespace App\language\share;
use App\language\menu\AdminTopMenu;
use Illuminate\Support\Str;
use App\Http\interface\LangObject;
class TableSetting extends AdminTopMenu
{
    protected function __construct($Language, $AppSettingAdmin, $Direction, $Branch, $Title, $TableInfo, $Menu){
        parent::__construct($Language, $AppSettingAdmin, $Direction, $Branch, $Title, $Menu);
        $this->table1 = $TableInfo['Ssearch'];
        $this->table2 = $TableInfo['InfoEmpty'];
        $this->table3 = $TableInfo['ZeroRecords'];
        $this->table4 = $TableInfo['Info'];
        $this->table5 = $TableInfo['LengthMenu'];
        $this->table6 = $TableInfo['InfoFiltered'];
    }
    protected function getEditDataBase($model, $item, LangObject $newObject){
        $arr = $model[$item];
        $arr[request()->input('id')] = $newObject->getMyObject();
        $model[$item] = $arr;
        $model->save();
    }
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
