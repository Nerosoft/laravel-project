<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\language\share\Page;
use App\Models\Rays;
use App\MyLanguage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

class LangController extends Page
{
    public function initView(){
        foreach (array_reverse($this->allNames) as $key => $value)
            $this->tableData[$key] = new MyLanguage($value);
        $this->actionDelete = route('language.delete');
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
    public function initValid(){
        $this->roll['lang_name'] = ['required', 'min:3'];
        $this->message['lang_name.required'] = $this->error1;
        $this->message['lang_name.min'] = $this->error2;
        $this->newKey = $this->generateUniqueIdentifier();
        foreach ($this->allNames as $key=>$value) {
            $myLang = $this->ob[$key];
            $myLang['AllNamesLanguage'][$this->newKey] = request()->input('lang_name');
            $this->ob[$key] = $myLang;
        }
    }
    public function __construct(){
        $this->ob = Rays::find(request()->session()->get('userId'));
        $this->error1 = $this->ob[$this->ob['Setting']['Language']]['ChangeLanguage']['NewLangNameRequired'];
        $this->error2 = $this->ob[$this->ob['Setting']['Language']]['ChangeLanguage']['NewLangNameInvalid'];
        $this->allNames = $this->ob[$this->ob['Setting']['Language']]['AllNamesLanguage'];
        parent::__construct('ChangeLanguage', $this->ob);
    }
    public function index(){
        $this->initView();
        return view('admin.change_language',[
                'lang'=>$this,
                'active'=>'ChangeLanguage',
        ]);
    }
    public function makeAddLanguage(){
        $this->initValid();
        request()->validate($this->roll, $this->message);
        //after add new language name
        $myLanguage = $this->ob['MyLanguage'];
        $myLanguage['AllNamesLanguage'] = $this->ob[$this->ob['Setting']['Language']]['AllNamesLanguage'];
        $this->ob[$this->newKey] = $myLanguage;
        $this->ob->save();
        return back()->with('success', $this->successfulyMessage.request()->input('lang_name'));
    }
    public function makeCopyLanguage(){
        $this->initValid();
        array_push($this->roll['id'], Rule::in(array_keys($this->allNames)));
        request()->validate($this->roll, $this->message);
        //after add new language name
        $this->ob[$this->newKey] = $this->ob[request()->input('id')];
        $this->ob->save();
        return back()->with('success', $this->ob[$this->ob['Setting']['Language']]['ChangeLanguage']['MessageModelEdit'].$this->ob[$this->ob['Setting']['Language']]['AllNamesLanguage'][request()->input('id')]);
    }
}
