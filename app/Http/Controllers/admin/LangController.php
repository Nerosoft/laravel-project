<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\language\share\Page;
use App\Models\Rays;
use App\Menu;
use Illuminate\Validation\Rule;
use App\MyLanguage;
use App\instance\admin\Branch;

class LangController extends Page
{
    public function __construct(){
        $this->ob = Rays::find(request()->session()->get('userId'));
        if(Route::currentRouteName() === 'language.copy' || Route::currentRouteName() === 'lang.createLanguage'){
            $this->roll = ['lang_name' =>['required', 'min:3']];
            $this->message = [
                'lang_name.required' => $this->ob[$this->ob['Setting']['Language']]['ChangeLanguage']['NewLangNameRequired'],
                'lang_name.min' => $this->ob[$this->ob['Setting']['Language']]['ChangeLanguage']['NewLangNameInvalid'],
            ];
            $this->newKey = $this->generateUniqueIdentifier();
            foreach ($this->ob[$this->ob['Setting']['Language']]['AllNamesLanguage'] as $key=>$value) {
                $myLang = $this->ob[$key];
                $myLang['AllNamesLanguage'][$this->newKey] = request()->input('lang_name');
                $this->ob[$key] = $myLang;
            }
        }else if(Route::currentRouteName() === 'language.change' || Route::currentRouteName() === 'language.delete'){
            $this->roll = [
                'id' =>['required', Rule::in(array_keys($this->ob[$this->ob['Setting']['Language']]['AllNamesLanguage']))]
            ];
            $this->message = [
                'id.required' => $this->ob[$this->ob['Setting']['Language']]['ChangeLanguage']['ChangeLanguageRequired'],
                'id.in' => $this->ob[$this->ob['Setting']['Language']]['ChangeLanguage']['ChangeLanguageInvalid']
            ];
        }else{
            $myRadios = array();
            foreach (array_reverse($this->ob[$this->ob['Setting']['Language']]['AllNamesLanguage']) as $key => $value)
                $myRadios[$key] = new MyLanguage($value);
            parent::__construct(route('language.delete'), 'ChangeLanguage', $this->ob, $myRadios);
            $this->error1 = $this->ob[$this->language]['ChangeLanguage']['NewLangNameRequired'];
            $this->error2 = $this->ob[$this->language]['ChangeLanguage']['NewLangNameInvalid'];
            //init table
            $this->NameLangaue = $this->ob[$this->language]['ChangeLanguage']['NameLangaue'];
            //init label
            $this->label3 = $this->ob[$this->language]['ChangeLanguage']['LanguageInfo'];     
            $this->label4 = $this->ob[$this->language]['ChangeLanguage']['LanguageSelect'];
            $this->label5 = $this->ob[$this->language]['ChangeLanguage']['LabelChangeLanguageMessage'];
            $this->label6 = $this->ob[$this->language]['ChangeLanguage']['LabelCopyLanguageMessage'];
            $this->LabelNameLanguage = $this->ob[$this->language]['ChangeLanguage']['LabelCreateLanguage'];
            $this->HintCopyLanguage = $this->ob[$this->language]['ChangeLanguage']['HintCopyLangName'];
            $this->label7 = $this->ob[$this->language]['ChangeLanguage']['LabelNewLangName'];
            //hint
            $this->hint1 = $this->ob[$this->language]['ChangeLanguage']['HintNewLangName'];
            //init button
            $this->button4 = $this->ob[$this->language]['ChangeLanguage']['ButtonChangeLanguageMessage'];
            $this->title2 = $this->ob[$this->language]['ChangeLanguage']['TitleChangeLanguageMessage'];
        }  
    }
    public function index(){
        return view('admin.change_language',[
                'lang'=>$this,
                'active'=>'ChangeLanguage',
        ]);
    }
    public function makeAddLanguage(){
        request()->validate($this->roll, $this->message);
        //after add new language name
        $myLanguage = $this->ob['MyLanguage'];
        $myLanguage['AllNamesLanguage'] = $this->ob[$this->ob['Setting']['Language']]['AllNamesLanguage'];
        $this->ob[$this->newKey] = $myLanguage;
        $this->ob->save();
        return back()->with('success', $this->ob[$this->ob['Setting']['Language']]['ChangeLanguage']['NewLanguageMessage'].request()->input('lang_name'));
    }
    public function makeCopyLanguage(){
        $this->roll['id'] = ['required', Rule::in(array_keys($this->ob[$this->ob['Setting']['Language']]['AllNamesLanguage']))];
        $this->message['id.required'] = $this->ob[$this->ob['Setting']['Language']]['ChangeLanguage']['ChangeLanguageRequired'];
        $this->message['id.in'] = $this->ob[$this->ob['Setting']['Language']]['ChangeLanguage']['ChangeLanguageInvalid'];
        request()->validate($this->roll, $this->message);
        //after add new language name
        $this->ob[$this->newKey] = $this->ob[request()->input('id')];
        $this->ob->save();
        return back()->with('success', $this->ob[$this->ob['Setting']['Language']]['ChangeLanguage']['CopyLanguage'].$this->ob[$this->ob['Setting']['Language']]['AllNamesLanguage'][request()->input('id')]);
    }
    public function makeChangeLanguage(){
        request()->validate($this->roll, $this->message);
        $setting = $this->ob['Setting'];
        $setting['Language'] = request()->input('id');
        $this->ob['Setting'] = $setting;
        $this->ob->save();
        return back()->with('success',  $this->ob[$this->ob['Setting']['Language']]['ChangeLanguage']['ChangeLang'].$this->ob[$this->ob['Setting']['Language']]['AllNamesLanguage'][request()->input('id')]);        
    }
    public function makeDeleteLanguage(){
        $this->roll['id'] = ['required', Rule::in(array_keys($this->ob[$this->ob['Setting']['Language']]['AllNamesLanguage'])), Rule::notIn([$this->ob['Setting']['Language'], array_keys($this->ob[$this->ob['Setting']['Language']]['AllNamesLanguage'])[0], array_keys($this->ob[$this->ob['Setting']['Language']]['AllNamesLanguage'])[1]])];
        $this->message['id.not_in'] = $this->ob[$this->ob['Setting']['Language']]['ChangeLanguage']['ChangeLanguageUsed'];
        request()->validate($this->roll, $this->message);
        $langName = $this->ob[$this->ob['Setting']['Language']]['AllNamesLanguage'][request()->input('id')];
        foreach ($this->ob[$this->ob['Setting']['Language']]['AllNamesLanguage'] as $key=>$value) {
            $myLang = $this->ob[$key];
            unset($myLang['AllNamesLanguage'][request()->input('id')]);
            $this->ob[$key] = $myLang;
        }
        unset($this->ob[request()->input('id')]);
        $this->ob->save();
        return back()->with('success', $this->ob[$this->ob['Setting']['Language']]['ChangeLanguage']['DeleteLanguage'].$langName);    
    }
}
