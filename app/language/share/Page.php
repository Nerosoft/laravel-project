<?php
namespace App\language\share;
use App\Menu;
class Page extends TableSetting{
    protected function __construct($state, $ob){
        if(request()->input('id')){
            $this->roll= [
                'id'=>['required']
            ];
            $this->message = [
                'id.required'=>$ob[$ob['Setting']['Language']][$state]['IdIsReq'],
                'id.in'=>$ob[$ob['Setting']['Language']][$state]['IdIsInv']
            ];
        }
        else if(request()->all())
            $this->successfulyMessage = $ob[$ob['Setting']['Language']][$state]['MessageModelCreate'];
        else{
            parent::__construct($ob[$ob['Setting']['Language']][$state]['Title'], new Menu($ob[$ob['Setting']['Language']]['Menu']), $ob);
            $this->title2 = $ob[$this->language][$state]['ScreenModelCreate'];
            $this->title3 = $ob[$this->language][$state]['ScreenModelEdit'];
            $this->button1 = $ob[$this->language][$state]['ButtonModelCreate'];
            $this->button2 = $ob[$this->language][$state]['ButtonModelAdd'];
            $this->button3 = $ob[$this->language][$state]['ButtonModelEdit'];
            $this->table7 = $ob[$this->language][$state]['TableId'];
            $this->table11 = $ob[$this->language][$state]['TabelEvent'];
            $this->titleModelDelete = $ob[$this->language][$state]['ScreenModelDelete'];
            $this->messageModelDelete = $ob[$this->language][$state]['MessageModelDelete'];
            $this->buttonModelDelete = $ob[$this->language][$state]['ButtonModelDelete'];
            $this->successfully1 = $ob[$this->language][$state]['LoadMessage'];
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