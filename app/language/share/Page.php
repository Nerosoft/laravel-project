<?php
namespace App\language\share;
use App\Menu;
use App\Http\interface\ActionInit;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use App\Models\Rays;
class Page extends TableSetting{
    protected function __construct($actionInit, $state, $ob){
        if(request()->input('id')){
            $this->roll = [
                'id' =>['required', Route::currentRouteName() === 'branchMain'?Rule::in(Rays::find(request()->session()->get('userLogout'))[$state]?array_merge([request()->session()->get('userLogout')], array_keys(Rays::find(request()->session()->get('userLogout'))[$state])):[request()->session()->get('userLogout')]):Rule::in($state === 'ChangeLanguage' || $ob[$state] || Rays::find(request()->session()->get('userLogout'))['Branch']?(array_keys($state === 'ChangeLanguage' ?$ob[$ob['Setting']['Language']]['AllNamesLanguage']:($ob[$state]?$ob[$state]:Rays::find(request()->session()->get('userLogout'))[$state]))):null)]
            ];
            $this->message = [
                'id.required' => $ob[$ob['Setting']['Language']][$state]['IdIsReq'],
                'id.in' => $ob[$ob['Setting']['Language']][$state]['IdIsInv']
            ];
            $actionInit->initValid();
        }
        else if(request()->all()){
            $this->successfulyMessage = $ob[$ob['Setting']['Language']][$state]['MessageModelCreate'];
            $actionInit->initValid();
        }
        else{
            parent::__construct($this, $ob[$ob['Setting']['Language']][$state]['Title'], new Menu($ob[$ob['Setting']['Language']]['Menu']), $ob);
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
            $this->actionDelete = route($state === 'ChangeLanguage'?'language.delete':'deleteItem', $state);
            $this->successfully1 = $ob[$this->language][$state]['LoadMessage'];
        }
    }
}