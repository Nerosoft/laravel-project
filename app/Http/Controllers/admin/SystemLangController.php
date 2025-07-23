<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rays;
use App\Menu;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use App\language\share\TableSetting;
use Illuminate\Support\Facades\Validator;
use App\Http\interface\ActionInit;
use App\Http\interface\ActionInit2;

class SystemLangController extends TableSetting implements ActionInit, ActionInit2
{
    public function getData(){
        $tableData = array();
        if(isset($this->ob[request()->route('lang')][request()->route('id')]))
            $tableData = $this->ob[request()->route('lang')][request()->route('id')];
        else
            foreach ($this->ob[$this->language]['AllNamesLanguage'] as $key=>$value)
                $tableData[$key] = $this->ob[$key];
        
        return $tableData;
    }
    public function initView(){
        $this->Left = $this->ob[$this->language]['SystemLang']['ltr'];
        $this->Right = $this->ob[$this->language]['SystemLang']['rtl'];
        //init label
        $this->label3 = $this->ob[$this->language]['SystemLang']['Text'];
        $this->label4 = $this->ob[$this->language]['SystemLang']['DirectionPage']; 
        //table
        $this->table7 = $this->ob[$this->language]['SystemLang']['LanguageValue'];
        $this->table8 = $this->ob[$this->language]['SystemLang']['LanguageEvent'];
        $this->table9 = $this->ob[$this->language]['SystemLang']['LanguageId'];
        $this->table10 = $this->ob[$this->language]['SystemLang']['LanguageName'];
        //model
        $this->model1 = $this->ob[$this->language]['SystemLang']['Title'];
        $this->model2 = $this->ob[$this->language]['SystemLang']['TitleDirection'];
        //button
        $this->button2 = $this->ob[$this->language]['SystemLang']['SaveDirection'];
        $this->button3 = $this->ob[$this->language]['SystemLang']['SaveText'];
    }
    public function initValid(){
        $this->roll['word' ] = ['required', request()->route('id') !== 'Html' ? 'min:2' : Rule::in(['ltr', 'rtl'])];
        $this->roll['myLang'] = ['required', Rule::in(array_keys($this->ob[$this->ob['Setting']['Language']]['AllNamesLanguage']))];
        $this->roll['name'] = ['required', function ($attribute, $value, $fail){
            if(!isset($this->ob[request()->route('lang')][request()->route('id')][request()->route('name')]['Item'][request()->route('item')]) && request()->route('item') !== null){
                $fail($this->ob[$this->ob['Setting']['Language']]['SystemLang']['EditKeyInvalid']);
                $fail($this->ob[$this->ob['Setting']['Language']]['SystemLang']['EditKey2Invalid']);
            }else if(!isset($this->ob[request()->route('lang')][request()->route('id')][request()->route('name')]))
                $fail($this->ob[$this->ob['Setting']['Language']]['SystemLang']['EditKeyInvalid']);
        }];
        $this->message['word.required'] = $this->error1;
        $this->message['word.'.(request()->route('id') !== 'Html' ?'min':'in')] = $this->error2;
        $this->message['myLang.required'] = $this->ob[$this->ob['Setting']['Language']]['SystemLang']['EditLanguageRequired'];
        $this->message['myLang.in'] = $this->ob[$this->ob['Setting']['Language']]['SystemLang']['EditLanguageInvalid'];
        $this->message['id.required'] = $this->ob[$this->ob['Setting']['Language']]['SystemLang']['EditTableRequired'];
        $this->message['id.in'] = $this->ob[$this->ob['Setting']['Language']]['SystemLang']['EditTableInvalid'];
        $this->message['name.required'] = $this->ob[$this->ob['Setting']['Language']]['SystemLang']['EditKeyRequired'];
    }
    public function __construct(){
        $this->ob = Rays::find(request()->session()->get('userId'));
        $this->error1 = $this->ob[$this->ob['Setting']['Language']]['SystemLang']['TextRequired'];
        $this->error2 = $this->ob[$this->ob['Setting']['Language']]['SystemLang']['TextLenght'];
        parent::__construct($this, 
        $this->ob[$this->ob['Setting']['Language']]['SystemLang']['SystemLang'],
         new Menu($this->ob[$this->ob['Setting']['Language']]['Menu'], 'Language',
            $this->ob[$this->ob['Setting']['Language']]['CutomLang'],
            $this->ob[$this->ob['Setting']['Language']]['AllNamesLanguage']),
            $this->ob);        
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
        $var1 = $this->ob[$lang];
        //make array first order importaint
        if($id === 'Menu' && $item === null && is_array($var1[$id][$name]))
            $var1[$id][$name]['Name'] = request()->input('word');
        else if($id === 'Menu' && $item !== null)
            $var1[$id][$name]['Item'][$item] = request()->input('word');
        else
            $var1[$id === $lang ? $lang : $id][$name] = request()->input('word');
        //my key of site aut and this key not like my key in database
        //svae data using new object and send my data to constructor and call setValue to save new value and return object                
        $this->ob[$lang] = $var1;
        $this->ob->save();
        return back()->with('success', $this->ob[$this->ob['Setting']['Language']]['SystemLang']['AllLanguageEdit']);
    }
}
