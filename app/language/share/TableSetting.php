<?php
namespace App\language\share;
use App\language\menu\AdminTopMenu;
use App\Http\interface\LangObject;
use App\instance\admin\Branch;
use App\Models\Rays;
use App\Http\interface\ActionInit;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class TableSetting extends AdminTopMenu
{
    protected function __construct(ActionInit $actionInit, $title, $menu, $ob){
        if(Route::currentRouteName() === 'edit.editAllLanguage'){
            $this->roll = [
                'id'=>['required', Rule::in(array_keys($this->ob[$this->ob['Setting']['Language']]['CutomLang']))],
            ];
            $this->message = [
                'id.required'=>$this->ob[$this->ob['Setting']['Language']]['SystemLang']['EditTableRequired'],
                'id.in'=>$this->ob[$this->ob['Setting']['Language']]['SystemLang']['EditTableInvalid'],
            ];
            $actionInit->initValid();
        }else{
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'], 
            $ob[$ob['Setting']['Language']]['Html']['Direction'], 
            Rays::find(request()->session()->get('userLogout'))['Branch']?Branch::makeBranch(Rays::find(request()->session()->get('userLogout'))['Branch'],$ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']):Branch::makeMainBranch($ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']),
            $title, $menu);
            $this->table1 = $ob[$this->language]['TableInfo']['Ssearch'];
            $this->table2 = $ob[$this->language]['TableInfo']['InfoEmpty'];
            $this->table3 = $ob[$this->language]['TableInfo']['ZeroRecords'];
            $this->table4 = $ob[$this->language]['TableInfo']['Info'];
            $this->table5 = $ob[$this->language]['TableInfo']['LengthMenu'];
            $this->table6 = $ob[$this->language]['TableInfo']['InfoFiltered'];
            $actionInit->initView();
        }
    }
   
    protected function getEditDataBase($model, $item, LangObject $newObject){
        $arr = $model[$item];
        $arr[request()->input('id')] = $newObject->getMyObject();
        $model[$item] = $arr;
        $model->save();
    }
}
