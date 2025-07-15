<?php
namespace App\language\share;
use App\language\menu\AdminTopMenu;
use App\Http\interface\LangObject;
use App\instance\admin\Branch;
use App\Models\Rays;
use Illuminate\Support\Str;

class TableSetting extends AdminTopMenu
{
    protected function __construct($title, $menu, $ob, $tableData){
        
        parent::__construct($ob['Setting']['Language'],
        $ob[$ob['Setting']['Language']]['AppSettingAdmin'], 
        $ob[$ob['Setting']['Language']]['Html']['Direction'], 
        $ob['Branch']||Rays::find(request()->session()->get('userLogout'))['Branch']?Branch::makeBranch($ob['Branch']?$ob['Branch']:Rays::find(request()->session()->get('userLogout'))['Branch'],$ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']):Branch::makeMainBranch($ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']),
        $title, $menu);
        $this->table1 = $ob[$this->language]['TableInfo']['Ssearch'];
        $this->table2 = $ob[$this->language]['TableInfo']['InfoEmpty'];
        $this->table3 = $ob[$this->language]['TableInfo']['ZeroRecords'];
        $this->table4 = $ob[$this->language]['TableInfo']['Info'];
        $this->table5 = $ob[$this->language]['TableInfo']['LengthMenu'];
        $this->table6 = $ob[$this->language]['TableInfo']['InfoFiltered'];
        $this->tableData = $tableData;
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
    protected function getEditDataBase($model, $item, LangObject $newObject){
        $arr = $model[$item];
        $arr[request()->input('id')] = $newObject->getMyObject();
        $model[$item] = $arr;
        $model->save();
    }
}
