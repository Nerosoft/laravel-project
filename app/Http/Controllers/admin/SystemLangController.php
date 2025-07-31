<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rays;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use App\language\share\TableSetting;
use Illuminate\Support\Facades\Validator;
use App\Http\interface\initView;
class SystemLangController extends TableSetting implements initView
{
    public function getTableData(){
        if(isset($this->getDataBase()[request()->route('lang')][request()->route('id')]))
            return $this->getDataBase()[request()->route('lang')][request()->route('id')];
        else{
            $tableData = array();
            foreach ($this->getDataBase()[$this->language]['AllNamesLanguage'] as $key=>$value)
                $tableData[$key] = $this->getDataBase()[$key];
            return $tableData;
        }
    }
    public function getDataBase(){
        return $this->ob;
    }
    public function initView(){
        
        $this->Left = $this->getDataBase()[$this->language]['SystemLang']['ltr'];
        $this->Right = $this->getDataBase()[$this->language]['SystemLang']['rtl'];
        //init label
        $this->label3 = $this->getDataBase()[$this->language]['SystemLang']['Text'];
        $this->label4 = $this->getDataBase()[$this->language]['SystemLang']['DirectionPage']; 
        //table
        $this->table7 = $this->getDataBase()[$this->language]['SystemLang']['LanguageValue'];
        $this->table8 = $this->getDataBase()[$this->language]['SystemLang']['LanguageEvent'];
        $this->table9 = $this->getDataBase()[$this->language]['SystemLang']['LanguageId'];
        $this->table10 = $this->getDataBase()[$this->language]['SystemLang']['LanguageName'];
        //model
        $this->model1 = $this->getDataBase()[$this->language]['SystemLang']['Title'];
        $this->model2 = $this->getDataBase()[$this->language]['SystemLang']['TitleDirection'];
        //button
        $this->button2 = $this->getDataBase()[$this->language]['SystemLang']['SaveDirection'];
        $this->button3 = $this->getDataBase()[$this->language]['SystemLang']['SaveText'];
    }
    public function __construct(){
        $this->ob = Rays::find(request()->session()->get('userId'));
        $this->error1 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['SystemLang']['TextRequired'];
        $this->error2 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['SystemLang']['TextLenght'];
        if(Route::currentRouteName() === 'edit.editAllLanguage'){
            $this->roll = [
                'id'=>['required', Rule::in(array_keys($this->getDataBase()[$this->getDataBase()['Setting']['Language']]['CutomLang']))],
            ];
            $this->message = [
                'id.required'=>$this->getDataBase()[$this->getDataBase()['Setting']['Language']]['SystemLang']['EditTableRequired'],
                'id.in'=>$this->getDataBase()[$this->getDataBase()['Setting']['Language']]['SystemLang']['EditTableInvalid'],
            ];
                    $this->roll['word' ] = ['required', request()->route('id') !== 'Html' ? 'min:2' : Rule::in(['ltr', 'rtl'])];
            $this->roll['myLang'] = ['required', Rule::in(array_keys($this->getDataBase()[$this->getDataBase()['Setting']['Language']]['AllNamesLanguage']))];
            $this->roll['name'] = ['required', function ($attribute, $value, $fail){
                if(!isset($this->getDataBase()[request()->route('lang')][request()->route('id')][request()->route('name')]['Item'][request()->route('item')]) && request()->route('item') !== null){
                    $fail($this->getDataBase()[$this->getDataBase()['Setting']['Language']]['SystemLang']['EditKeyInvalid']);
                    $fail($this->getDataBase()[$this->getDataBase()['Setting']['Language']]['SystemLang']['EditKey2Invalid']);
                }else if(!isset($this->getDataBase()[request()->route('lang')][request()->route('id')][request()->route('name')]))
                    $fail($this->getDataBase()[$this->getDataBase()['Setting']['Language']]['SystemLang']['EditKeyInvalid']);
            }];
            $this->message['word.required'] = $this->error1;
            $this->message['word.'.(request()->route('id') !== 'Html' ?'min':'in')] = $this->error2;
            $this->message['myLang.required'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['SystemLang']['EditLanguageRequired'];
            $this->message['myLang.in'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['SystemLang']['EditLanguageInvalid'];
            $this->message['id.required'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['SystemLang']['EditTableRequired'];
            $this->message['id.in'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['SystemLang']['EditTableInvalid'];
            $this->message['name.required'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['SystemLang']['EditKeyRequired'];
            $this->successfulyMessage = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['SystemLang']['AllLanguageEdit'];
        }else
            parent::__construct($this, 'SystemLang');        
    }
    public function index($nameLanguage = null, $id = 'SystemLang'){
        return view('admin.all_language', $nameLanguage === null?[
            'lang'=> $this,
            'active'=>$id,
        ]:[
            'lang'=> $this,
            'active'=>$nameLanguage,
            'activeItem'=>$id,
        ]);
    }
    public function makeEditLanguage($lang, $id, $name, $item = null){
        Validator::make([...request()->all(), 'myLang'=>$lang, 'id'=>$id, 'name'=>$name, 'item'=>$item], $this->roll, $this->message)->validate();
        $var1 = $this->getDataBase()[$lang];
        //make array first order importaint
        if($id === 'Menu' && $item === null && is_array($var1[$id][$name]))
            $var1[$id][$name]['Name'] = request()->input('word');
        else if($id === 'Menu' && $item !== null)
            $var1[$id][$name]['Item'][$item] = request()->input('word');
        else
            $var1[$id === $lang ? $lang : $id][$name] = request()->input('word');
        //my key of site aut and this key not like my key in database
        //svae data using new object and send my data to constructor and call setValue to save new value and return object                
        $this->getDataBase()[$lang] = $var1;
        $this->getDataBase()->save();
        return back()->with('success', $this->successfulyMessage);
    }
}
