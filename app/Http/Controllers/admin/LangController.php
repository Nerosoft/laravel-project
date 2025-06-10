<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\language\share\DeleteModel;
use App\Models\Rays;
use App\Menu;
use Illuminate\Validation\Rule;
use App\MyLanguage;

class LangController extends DeleteModel
{
    public function __construct(){
        $ob = Rays::find(request()->session()->get('userId'));
        if(Route::currentRouteName() === 'language.change'){
            request()->validate([
            'id' =>['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['AllNamesLanguage']))]
            ], [
                'id.required' => $ob[$ob['Setting']['Language']]['Error']['ChangeLanguageRequired'],
                'id.in' => $ob[$ob['Setting']['Language']]['Error']['ChangeLanguageInvalid']
            ]);
            $setting = $ob['Setting'];
            $setting['Language'] = request()->input('id');
            $ob['Setting'] = $setting;
            $ob->save();
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Message']['ChangeLanguage'];
        }else if(Route::currentRouteName() === 'language.copy'){
            request()->validate([
            'id' =>['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['AllNamesLanguage']))],
            'lang_name' =>['required', 'min:3']
            ], [
                'lang_name.required' => $ob[$ob['Setting']['Language']]['Error']['NewLangNameRequired'],
                'lang_name.min' => $ob[$ob['Setting']['Language']]['Error']['NewLangNameInvalid'],
                'id.required' => $ob[$ob['Setting']['Language']]['Error']['ChangeLanguageRequired'],
                'id.in' => $ob[$ob['Setting']['Language']]['Error']['ChangeLanguageInvalid']
            ]);
            $newKey = $this->generateUniqueIdentifier();
            foreach ($ob[$ob['Setting']['Language']]['AllNamesLanguage'] as $key=>$value) {
                $myLang = $ob[$key];
                $myLang['AllNamesLanguage'][$newKey] = request()->input('lang_name');
                $ob[$key] = $myLang;
            }
            //after add new language name
            $ob[$newKey] = $ob[request()->input('id')];
            $ob->save();
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Message']['CopyLanguage'];
        }else if(Route::currentRouteName() === 'language.delete'){
            request()->validate([
                'id' =>['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['AllNamesLanguage'])), Rule::notIn([$ob['Setting']['Language'], array_keys($ob[$ob['Setting']['Language']]['AllNamesLanguage'])[0], array_keys($ob[$ob['Setting']['Language']]['AllNamesLanguage'])[1]])]
            ], [
                'id.required' => $ob[$ob['Setting']['Language']]['Error']['ChangeLanguageRequired'],
                'id.in' => $ob[$ob['Setting']['Language']]['Error']['ChangeLanguageInvalid'],
                'id.not_in' => $ob[$ob['Setting']['Language']]['Error']['ChangeLanguageUsed'],
            ]);
            foreach ($ob[$ob['Setting']['Language']]['AllNamesLanguage'] as $key=>$value) {
                $myLang = $ob[$key];
                unset($myLang['AllNamesLanguage'][request()->input('id')]);
                $ob[$key] = $myLang;
            }
            unset($ob[request()->input('id')]);
            $ob->save();
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Message']['DeleteLanguage'];
        }else{
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['Title']['DeleteLanguageMessage'],
            $ob[$ob['Setting']['Language']]['Label']['DeleteLanguageMessage'],
            $ob[$ob['Setting']['Language']]['Button']['DeleteLanguageMessage'],
            route('language.delete'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Title']['ChangeLanguage'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            $ob['Branch']?$ob['Branch']:Rays::find(request()->session()->get('userLogout'))['Branch'],
            new Menu($ob[$ob['Setting']['Language']]['Menu']));
            $this->error1 = $ob[$this->language]['Error']['NewLangNameRequired'];
            $this->error2 = $ob[$this->language]['Error']['NewLangNameInvalid'];
            //init table
            $this->IdLangaue = $ob[$this->language]['Table']['IdLangaue'];
            $this->NameLangaue = $ob[$this->language]['Table']['NameLangaue'];
            $this->EditLangaue = $ob[$this->language]['Table']['EditLangaue'];
            //init label
            $this->label3 = $ob[$this->language]['Label']['LanguageInfo'];     
            $this->label4 = $ob[$this->language]['Label']['LanguageSelect'];
            $this->label5 = $ob[$this->language]['Label']['ChangeLanguageMessage'];
            $this->label6 = $ob[$this->language]['Label']['CopyLanguageMessage'];
            $this->label7 = $ob[$this->language]['Label']['NewLangName'];
            //hint
            $this->hint1 = $ob[$this->language]['Hint']['NewLangName'];
            //init button
            $this->button4 = $ob[$this->language]['Button']['ChangeLanguageMessage'];
            $this->button5 = $ob[$this->language]['Button']['CopyLanguageMessage'];
            $this->title2 = $ob[$this->language]['Title']['ChangeLanguageMessage'];
            $this->title3 = $ob[$this->language]['Title']['CopyLanguageMessage'];
            //init lang
            $this->myRadios = array();
            foreach ($ob[$this->language]['AllNamesLanguage'] as $key => $value)
                $this->myRadios[$key] = new MyLanguage($value);
        }
    }
    public function index(){
        return view('admin.change_language',[
                'lang'=>$this,
                'active'=>'ChangeLanguage',
        ]);
    }
    public function action(){
        return back()->with('success', $this->successfully1);
    }
}
