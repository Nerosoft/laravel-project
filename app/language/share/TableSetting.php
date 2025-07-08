<?php
namespace App\language\share;
use App\language\menu\AdminTopMenu;
use App\Http\interface\LangObject;
class TableSetting extends AdminTopMenu
{
    protected function __construct($Language, $AppSettingAdmin, $Direction, $Branch, $Title, $TableInfo, $Menu, $tableData){
        parent::__construct($Language, $AppSettingAdmin, $Direction, $Branch, $Title, $Menu);
        $this->table1 = $TableInfo['Ssearch'];
        $this->table2 = $TableInfo['InfoEmpty'];
        $this->table3 = $TableInfo['ZeroRecords'];
        $this->table4 = $TableInfo['Info'];
        $this->table5 = $TableInfo['LengthMenu'];
        $this->table6 = $TableInfo['InfoFiltered'];
        $this->tableData = $tableData;
    }
    protected function getEditDataBase($model, $item, LangObject $newObject){
        $arr = $model[$item];
        $arr[request()->input('id')] = $newObject->getMyObject();
        $model[$item] = $arr;
        $model->save();
    }
}
