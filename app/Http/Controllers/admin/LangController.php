<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\language\share\Page;
use App\Models\Rays;
use App\MyLanguage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

use App\Http\interface\ValidRule;
use App\Http\interface\PageTable;

class LangController extends Page implements ValidRule, PageTable
{
    public function getDataBase(){
        return $this->ob;
    }
    public function getTableData(){
        $tableData = array();
        foreach (array_reverse($this->allNames) as $key => $value)
            $tableData[$key] = new MyLanguage($value);
        return $tableData;
    }
    public function getRouteDelete(){
        return route('language.delete');
    }
     public function getValidRule(){
        $this->successfulyMessage = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['ChangeLanguage']['MessageModelEdit'];
        array_push($this->roll['id'], Rule::in(array_keys($this->allNames)));
        $this->initValid();
    }
    public function initView(){
        //init table
        $this->NameLangaue = $this->getDataBase()[$this->language]['ChangeLanguage']['NameLangaue'];
        //init label
        $this->label3 = $this->getDataBase()[$this->language]['ChangeLanguage']['LanguageInfo'];     
        $this->label4 = $this->getDataBase()[$this->language]['ChangeLanguage']['LanguageSelect'];
        $this->label5 = $this->getDataBase()[$this->language]['ChangeLanguage']['LabelChangeLanguageMessage'];
        $this->label6 = $this->getDataBase()[$this->language]['ChangeLanguage']['LabelCopyLanguageMessage'];
        $this->LabelNameLanguage = $this->getDataBase()[$this->language]['ChangeLanguage']['LabelCreateLanguage'];
        $this->HintCopyLanguage = $this->getDataBase()[$this->language]['ChangeLanguage']['HintCopyLangName'];
        $this->label7 = $this->getDataBase()[$this->language]['ChangeLanguage']['LabelNewLangName'];
        //hint
        $this->hint1 = $this->getDataBase()[$this->language]['ChangeLanguage']['HintNewLangName'];
        //init button
        $this->button4 = $this->getDataBase()[$this->language]['ChangeLanguage']['ButtonChangeLanguageMessage'];
        $this->title2 = $this->getDataBase()[$this->language]['ChangeLanguage']['TitleChangeLanguageMessage'];
    }
    public function initValid(){
        $this->roll['lang_name'] = ['required', 'min:3'];
        $this->message['lang_name.required'] = $this->error1;
        $this->message['lang_name.min'] = $this->error2;
        $this->newKey = $this->generateUniqueIdentifier();
        foreach ($this->allNames as $key=>$value) {
            $myLang = $this->getDataBase()[$key];
            $myLang['AllNamesLanguage'][$this->newKey] = request()->input('lang_name');
            $this->getDataBase()[$key] = $myLang;
        }
    }
    public function __construct(){
        $this->ob = Rays::find(request()->session()->get('userId'));
        $this->error1 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['ChangeLanguage']['NewLangNameRequired'];
        $this->error2 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['ChangeLanguage']['NewLangNameInvalid'];
        $this->allNames = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['AllNamesLanguage'];
        parent::__construct($this, 'ChangeLanguage');
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
        $myLanguage = $this->getDataBase()['MyLanguage'];
        $myLanguage['AllNamesLanguage'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['AllNamesLanguage'];
        $this->getDataBase()[$this->newKey] = $myLanguage;
        $this->getDataBase()->save();
        return back()->with('success', $this->successfulyMessage.request()->input('lang_name'));
    }
    public function makeCopyLanguage(){
        request()->validate($this->roll, $this->message);
        //after add new language name
        $this->getDataBase()[$this->newKey] = $this->getDataBase()[request()->input('id')];
        $this->getDataBase()->save();
        return back()->with('success', $this->successfulyMessage.$this->getDataBase()[$this->getDataBase()['Setting']['Language']]['AllNamesLanguage'][request()->input('id')]);
    }
}
