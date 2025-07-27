<?php
namespace App\language\share;
use App\language\menu\AdminTopMenu;
use App\Http\interface\LangObject;
use App\Http\interface\DbRays;

class TableSetting extends AdminTopMenu
{
    protected function __construct(DbRays $ob, $state){
        parent::__construct($ob, $state);
        $this->table1 = $ob->getDataBase()[$this->language]['TableInfo']['Ssearch'];
        $this->table2 = $ob->getDataBase()[$this->language]['TableInfo']['InfoEmpty'];
        $this->table3 = $ob->getDataBase()[$this->language]['TableInfo']['ZeroRecords'];
        $this->table4 = $ob->getDataBase()[$this->language]['TableInfo']['Info'];
        $this->table5 = $ob->getDataBase()[$this->language]['TableInfo']['LengthMenu'];
        $this->table6 = $ob->getDataBase()[$this->language]['TableInfo']['InfoFiltered'];
        $ob->initView();
        $this->tableData = $ob->getTableData();
    }
   
    protected function getEditDataBase($model, $item, LangObject $newObject){
        $arr = $model[$item];
        $arr[request()->input('id')] = $newObject->getMyObject();
        $model[$item] = $arr;
        $model->save();
    }
}
