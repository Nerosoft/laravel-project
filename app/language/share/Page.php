<?php
namespace App\language\share;
use App\Http\interface\DbRays;
class Page extends TableSetting{
    protected function __construct(DbRays $ob, $state){
        if(request()->input('id')){
            $this->roll = [
                'id'=>['required']
            ];
            $this->message = [
                'id.required'=>$ob->getDataBase()[$ob->getDataBase()['Setting']['Language']][$state]['IdIsReq'],
                'id.in'=>$ob->getDataBase()[$ob->getDataBase()['Setting']['Language']][$state]['IdIsInv']
            ];
            $ob->getValidRule();
        }
        else if(request()->all()){
            $this->successfulyMessage = $ob->getDataBase()[$ob->getDataBase()['Setting']['Language']][$state]['MessageModelCreate'];
            $ob->initValid();
        }
        else{
            parent::__construct($ob, $state);
            $this->title2 = $ob->getDataBase()[$this->language][$state]['ScreenModelCreate'];
            $this->title3 = $ob->getDataBase()[$this->language][$state]['ScreenModelEdit'];
            $this->button1 = $ob->getDataBase()[$this->language][$state]['ButtonModelCreate'];
            $this->button2 = $ob->getDataBase()[$this->language][$state]['ButtonModelAdd'];
            $this->button3 = $ob->getDataBase()[$this->language][$state]['ButtonModelEdit'];
            $this->table7 = $ob->getDataBase()[$this->language][$state]['TableId'];
            $this->table11 = $ob->getDataBase()[$this->language][$state]['TabelEvent'];
            $this->titleModelDelete = $ob->getDataBase()[$this->language][$state]['ScreenModelDelete'];
            $this->messageModelDelete = $ob->getDataBase()[$this->language][$state]['MessageModelDelete'];
            $this->buttonModelDelete = $ob->getDataBase()[$this->language][$state]['ButtonModelDelete'];
            $this->successfully1 = $ob->getDataBase()[$this->language][$state]['LoadMessage'];
            $this->actionDelete = $ob->getRouteDelete();
        }
        
    }
    protected function getDeleteDatabade($model, $item){
        if(count($model[$item]) === 1)
            unset($model[$item]);
        else{
            $arr = $model[$item];
            unset($arr[request()->input('id')]);
            $model[$item] = $arr;
        }
        $model->save();
    }
}