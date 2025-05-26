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

class SystemLangController extends TableSetting
{
    public function __construct(){
        $ob = Rays::find(request()->session()->get('userId'));
        $this->error1 = $ob[$ob['Setting']['Language']]['Error']['TextRequired'];
        $this->error2 = $ob[$ob['Setting']['Language']]['Error']['TextLenght'];
        if(Route::currentRouteName() === 'edit.editAllLanguage'){
            Validator::make([...request()->all(), 'myLang'=>request()->route('lang'), 'id'=>request()->route('id'), 'name'=>request()->route('name'), 'item'=>request()->route('item')],
            [
                'word' => ['required', request()->route('id') !== 'Html' ? 'min:2' : Rule::in(['ltr', 'rtl'])],
                'myLang'=>['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['AllNamesLanguage']))],
                'id'=>['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['CutomLang']))],
                'name'=>['required', function ($attribute, $value, $fail)use($ob) {
                    if(!isset($ob[request()->route('lang')][request()->route('id')][request()->route('name')]['Item'][request()->route('item')]) && request()->route('item') !== null){
                        $fail($ob[$ob['Setting']['Language']]['Error']['EditKeyInvalid']);
                        $fail($ob[$ob['Setting']['Language']]['Error']['EditKey2Invalid']);
                    }else if(!isset($ob[request()->route('lang')][request()->route('id')][request()->route('name')]))
                        $fail($ob[$ob['Setting']['Language']]['Error']['EditKeyInvalid']);
                }],
            ],        
            request()->route('id') !== 'Html' ? [
                'word.required' => $this->error1,
                'word.min' => $this->error2,
                'myLang.required'=>$ob[$ob['Setting']['Language']]['Error']['EditLanguageRequired'],
                'id.required'=>$ob[$ob['Setting']['Language']]['Error']['EditTableRequired'],
                'myLang.in'=>$ob[$ob['Setting']['Language']]['Error']['EditLanguageInvalid'],
                'id.in'=>$ob[$ob['Setting']['Language']]['Error']['EditTableInvalid'],
                'name.required'=>$ob[$ob['Setting']['Language']]['Error']['EditKeyRequired'],
            ] : [
                'word.required' => $this->error1,
                'word.in' => $this->error2,
                'myLang.required'=>$ob[$ob['Setting']['Language']]['Error']['EditLanguageRequired'],
                'id.required'=>$ob[$ob['Setting']['Language']]['Error']['EditTableRequired'],
                'myLang.in'=>$ob[$ob['Setting']['Language']]['Error']['EditLanguageInvalid'],
                'id.in'=>$ob[$ob['Setting']['Language']]['Error']['EditTableInvalid'],
                'name.required'=>$ob[$ob['Setting']['Language']]['Error']['EditKeyRequired'],
            ])->validate();
            $var1 = $ob[request()->route('lang')];
            //make array first order importaint
            if(request()->route('id') === 'Menu' && request()->route('item') === null && is_array($var1[request()->route('id')][request()->route('name')]))
                $var1[request()->route('id')][request()->route('name')]['Name'] = request()->input('word');
            else if(request()->route('id') === 'Menu' && request()->route('item') !== null)
                $var1[request()->route('id')][request()->route('name')]['Item'][request()->route('item')] = request()->input('word');
            else
                $var1[request()->route('id') === request()->route('lang') ? request()->route('lang') : request()->route('id')][request()->route('name')] = request()->input('word');
            //my key of site aut and this key not like my key in database
            //svae data using new object and send my data to constructor and call setValue to save new value and return object                
            $ob[request()->route('lang')] = $var1;
            $ob->save();
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Message']['AllLanguageEdit'];
        }else if(isset($ob[request()->route('lang')][request()->route('id')])){
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            $ob['Branch']?$ob['Branch']:Rays::find(request()->session()->get('userLogout'))['Branch'],
            $ob[$ob['Setting']['Language']]['CutomLang'][request()->route('id')],
            $ob[$ob['Setting']['Language']]['TableInfo'],
            new Menu($ob[$ob['Setting']['Language']]['Menu'], 'Language',
            $ob[$ob['Setting']['Language']]['CutomLang'],
            $ob[$ob['Setting']['Language']]['AllNamesLanguage']));
            $this->myAllLanguage = $ob[request()->route('lang')][request()->route('id')];
            $this->myDirectionOption = $ob[$this->language]['Direction'];
            //init label
            $this->label3 = $ob[$this->language]['Label']['Text'];
            $this->label4 = $ob[$this->language]['Label']['DirectionPage']; 
            //table
            $this->table7 = $ob[$this->language]['Table']['LanguageValue'];
            $this->table8 = $ob[$this->language]['Table']['LanguageEvent'];
            $this->table9 = $ob[$this->language]['Table']['LanguageId'];
            $this->table10 = $ob[$this->language]['Table']['LanguageName'];
            //model
            $this->model1 = $ob[$this->language]['Model']['Title'];
            $this->model2 = $ob[$this->language]['Model']['TitleDirection'];
            //button
            $this->button2 = $ob[$this->language]['Button']['SaveDirection'];
            $this->button3 = $ob[$this->language]['Button']['SaveText'];
        }else{
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            $ob['Branch']?$ob['Branch']:Rays::find(request()->session()->get('userLogout'))['Branch'],
            $ob[$ob['Setting']['Language']]['Title']['SystemLang'],
            $ob[$ob['Setting']['Language']]['TableInfo'],
            new Menu($ob[$ob['Setting']['Language']]['Menu'], 'Language',
            $ob[$ob['Setting']['Language']]['CutomLang'],
            $ob[$ob['Setting']['Language']]['AllNamesLanguage']));
            foreach ($ob[$ob['Setting']['Language']]['AllNamesLanguage'] as $key=>$value)
                $this->myAllLanguage[$key] = $ob[$key];
            //label
            $this->myDirectionOption = $this->myAllLanguage[$this->language]['Direction'];
            //init label
            $this->label3 = $this->myAllLanguage[$this->language]['Label']['Text'];
            $this->label4 = $this->myAllLanguage[$this->language]['Label']['DirectionPage']; 
            //table
            $this->table7 = $this->myAllLanguage[$this->language]['Table']['LanguageValue'];
            $this->table8 = $this->myAllLanguage[$this->language]['Table']['LanguageEvent'];
            $this->table9 = $this->myAllLanguage[$this->language]['Table']['LanguageId'];
            $this->table10 = $this->myAllLanguage[$this->language]['Table']['LanguageName'];
            //model
            $this->model1 = $this->myAllLanguage[$this->language]['Model']['Title'];
            $this->model2 = $this->myAllLanguage[$this->language]['Model']['TitleDirection'];
            //button
            $this->button2 = $this->myAllLanguage[$this->language]['Button']['SaveDirection'];
            $this->button3 = $this->myAllLanguage[$this->language]['Button']['SaveText'];
        }
    }
    public function index($nameLanguage = null, $id = 'SystemLang'){
        return view('admin.all_language', $nameLanguage === null?[
            'lang'=> $this,
            'active'=>$id,
            'logOut'=>route('admin.logout')
        ]:[
            'lang'=> $this,
            'active'=>$nameLanguage,
            'activeItem'=>$id,
            'logOut'=>route('admin.logout')
        ]);
    }
    public function action(){
        return back()->with('success', $this->successfully1);
    }
}
