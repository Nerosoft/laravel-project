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
use App\instance\admin\Branch;

class LangController extends DeleteModel
{
    public function __construct(){
        $ob = Rays::find(request()->session()->get('userId'));
        if(Route::currentRouteName() === 'language.change'){
            request()->validate([
            'id' =>['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['AllNamesLanguage']))]
            ], [
                'id.required' => $ob[$ob['Setting']['Language']]['ChangeLanguage']['ChangeLanguageRequired'],
                'id.in' => $ob[$ob['Setting']['Language']]['ChangeLanguage']['ChangeLanguageInvalid']
            ]);
            $setting = $ob['Setting'];
            $setting['Language'] = request()->input('id');
            $ob['Setting'] = $setting;
            $ob->save();
            $this->successfully1 = $ob[$ob['Setting']['Language']]['ChangeLanguage']['ChangeLang'].$ob[$ob['Setting']['Language']]['AllNamesLanguage'][request()->input('id')];
        }else if(Route::currentRouteName() === 'language.copy'){
            request()->validate([
            'id' =>['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['AllNamesLanguage']))],
            'lang_name' =>['required', 'min:3']
            ], [
                'lang_name.required' => $ob[$ob['Setting']['Language']]['ChangeLanguage']['NewLangNameRequired'],
                'lang_name.min' => $ob[$ob['Setting']['Language']]['ChangeLanguage']['NewLangNameInvalid'],
                'id.required' => $ob[$ob['Setting']['Language']]['ChangeLanguage']['ChangeLanguageRequired'],
                'id.in' => $ob[$ob['Setting']['Language']]['ChangeLanguage']['ChangeLanguageInvalid']
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
            $this->successfully1 = $ob[$ob['Setting']['Language']]['ChangeLanguage']['CopyLanguage'].$ob[$ob['Setting']['Language']]['AllNamesLanguage'][request()->input('id')];;
        }else if(Route::currentRouteName() === 'lang.createLanguage'){
            request()->validate([
                'lang_name' =>['required', 'min:3']
            ], [
                'lang_name.required' => $ob[$ob['Setting']['Language']]['ChangeLanguage']['NewLangNameRequired'],
                'lang_name.min' => $ob[$ob['Setting']['Language']]['ChangeLanguage']['NewLangNameInvalid'],
            ]);
            $newKey = $this->generateUniqueIdentifier();
            $model = Rays::find(request()->session()->get('userId'));
            foreach (array_keys($model[$model['Setting']['Language']]['AllNamesLanguage']) as $key2) {
                $myLang = $model[$key2];
                $myLang['AllNamesLanguage'][$newKey] = request()->input('lang_name');
                $model[$key2] = $myLang;
            }
            //after add new language name
            $myLanguage = $model['MyLanguage'];
            $myLanguage['AllNamesLanguage'] = $model[$model['Setting']['Language']]['AllNamesLanguage'];
            $model[$newKey] = $myLanguage;
            $model->save();
            $this->successfully1 = $ob[$ob['Setting']['Language']]['ChangeLanguage']['NewLanguageMessage'].request()->input('lang_name');
        }else if(Route::currentRouteName() === 'language.delete'){
            request()->validate([
                'id' =>['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['AllNamesLanguage'])), Rule::notIn([$ob['Setting']['Language'], array_keys($ob[$ob['Setting']['Language']]['AllNamesLanguage'])[0], array_keys($ob[$ob['Setting']['Language']]['AllNamesLanguage'])[1]])]
            ], [
                'id.required' => $ob[$ob['Setting']['Language']]['ChangeLanguage']['ChangeLanguageRequired'],
                'id.in' => $ob[$ob['Setting']['Language']]['ChangeLanguage']['ChangeLanguageInvalid'],
                'id.not_in' => $ob[$ob['Setting']['Language']]['ChangeLanguage']['ChangeLanguageUsed'],
            ]);
            $langName = $ob[$ob['Setting']['Language']]['AllNamesLanguage'][request()->input('id')];
            foreach ($ob[$ob['Setting']['Language']]['AllNamesLanguage'] as $key=>$value) {
                $myLang = $ob[$key];
                unset($myLang['AllNamesLanguage'][request()->input('id')]);
                $ob[$key] = $myLang;
            }
            unset($ob[request()->input('id')]);
            $ob->save();
            $this->successfully1 = $ob[$ob['Setting']['Language']]['ChangeLanguage']['DeleteLanguage'].$langName;
        }else if($ob['Branch']){
            $myRadios = array();
            foreach (array_reverse($ob[$ob['Setting']['Language']]['AllNamesLanguage']) as $key => $value)
                $myRadios[$key] = new MyLanguage($value);
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['ChangeLanguage']['TitleDeleteLanguageMessage'],
            $ob[$ob['Setting']['Language']]['ChangeLanguage']['LabelDeleteLanguageMessage'],
            $ob[$ob['Setting']['Language']]['ChangeLanguage']['ButtonDeleteLanguageMessage'],
            route('language.delete'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['ChangeLanguage']['ChangeLanguage'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeBranch($ob['Branch'], $ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            new Menu($ob[$ob['Setting']['Language']]['Menu']), $myRadios);
            $this->NewLanguage = $ob[$this->language]['ChangeLanguage']['NewLanguage'];
            $this->TitleNewLang = $ob[$this->language]['ChangeLanguage']['TitleNewLang'];
            $this->ButtonNewLang = $ob[$this->language]['ChangeLanguage']['ButtonNewLang'];
            $this->error1 = $ob[$this->language]['ChangeLanguage']['NewLangNameRequired'];
            $this->error2 = $ob[$this->language]['ChangeLanguage']['NewLangNameInvalid'];
            //init table
            $this->IdLangaue = $ob[$this->language]['ChangeLanguage']['IdLangaue'];
            $this->NameLangaue = $ob[$this->language]['ChangeLanguage']['NameLangaue'];
            $this->EditLangaue = $ob[$this->language]['ChangeLanguage']['EditLangaue'];
            //init label
            $this->label3 = $ob[$this->language]['ChangeLanguage']['LanguageInfo'];     
            $this->label4 = $ob[$this->language]['ChangeLanguage']['LanguageSelect'];
            $this->label5 = $ob[$this->language]['ChangeLanguage']['LabelChangeLanguageMessage'];
            $this->label6 = $ob[$this->language]['ChangeLanguage']['LabelCopyLanguageMessage'];
            $this->LabelNameLanguage = $ob[$this->language]['ChangeLanguage']['LabelCreateLanguage'];
            $this->HintCopyLanguage = $ob[$this->language]['ChangeLanguage']['HintCopyLangName'];
            $this->label7 = $ob[$this->language]['ChangeLanguage']['LabelNewLangName'];
            //hint
            $this->hint1 = $ob[$this->language]['ChangeLanguage']['HintNewLangName'];
            //init button
            $this->button4 = $ob[$this->language]['ChangeLanguage']['ButtonChangeLanguageMessage'];
            $this->button5 = $ob[$this->language]['ChangeLanguage']['ButtonCopyLanguageMessage'];
            $this->title2 = $ob[$this->language]['ChangeLanguage']['TitleChangeLanguageMessage'];
            $this->title3 = $ob[$this->language]['ChangeLanguage']['TitleCopyLanguageMessage'];
            //init lang
            
        }else if(Rays::find(request()->session()->get('userLogout'))['Branch']){
            $myRadios = array();
            foreach (array_reverse($ob[$ob['Setting']['Language']]['AllNamesLanguage']) as $key => $value)
                $myRadios[$key] = new MyLanguage($value);
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['ChangeLanguage']['TitleDeleteLanguageMessage'],
            $ob[$ob['Setting']['Language']]['ChangeLanguage']['LabelDeleteLanguageMessage'],
            $ob[$ob['Setting']['Language']]['ChangeLanguage']['ButtonDeleteLanguageMessage'],
            route('language.delete'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['ChangeLanguage']['ChangeLanguage'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeBranch(Rays::find(request()->session()->get('userLogout'))['Branch'], $ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            new Menu($ob[$ob['Setting']['Language']]['Menu']), $myRadios);
            $this->NewLanguage = $ob[$this->language]['ChangeLanguage']['NewLanguage'];
            $this->TitleNewLang = $ob[$this->language]['ChangeLanguage']['TitleNewLang'];
            $this->ButtonNewLang = $ob[$this->language]['ChangeLanguage']['ButtonNewLang'];
            $this->error1 = $ob[$this->language]['ChangeLanguage']['NewLangNameRequired'];
            $this->error2 = $ob[$this->language]['ChangeLanguage']['NewLangNameInvalid'];
            //init table
            $this->IdLangaue = $ob[$this->language]['ChangeLanguage']['IdLangaue'];
            $this->NameLangaue = $ob[$this->language]['ChangeLanguage']['NameLangaue'];
            $this->EditLangaue = $ob[$this->language]['ChangeLanguage']['EditLangaue'];
            //init label
            $this->label3 = $ob[$this->language]['ChangeLanguage']['LanguageInfo'];     
            $this->label4 = $ob[$this->language]['ChangeLanguage']['LanguageSelect'];
            $this->label5 = $ob[$this->language]['ChangeLanguage']['LabelChangeLanguageMessage'];
            $this->label6 = $ob[$this->language]['ChangeLanguage']['LabelCopyLanguageMessage'];
            $this->LabelNameLanguage = $ob[$this->language]['ChangeLanguage']['LabelCreateLanguage'];
            $this->HintCopyLanguage = $ob[$this->language]['ChangeLanguage']['HintCopyLangName'];
            $this->label7 = $ob[$this->language]['ChangeLanguage']['LabelNewLangName'];
            //hint
            $this->hint1 = $ob[$this->language]['ChangeLanguage']['HintNewLangName'];
            //init button
            $this->button4 = $ob[$this->language]['ChangeLanguage']['ButtonChangeLanguageMessage'];
            $this->button5 = $ob[$this->language]['ChangeLanguage']['ButtonCopyLanguageMessage'];
            $this->title2 = $ob[$this->language]['ChangeLanguage']['TitleChangeLanguageMessage'];
            $this->title3 = $ob[$this->language]['ChangeLanguage']['TitleCopyLanguageMessage'];
            //init lang
            
        }else{
            $myRadios = array();
            foreach (array_reverse($ob[$ob['Setting']['Language']]['AllNamesLanguage']) as $key => $value)
                $myRadios[$key] = new MyLanguage($value);
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['ChangeLanguage']['TitleDeleteLanguageMessage'],
            $ob[$ob['Setting']['Language']]['ChangeLanguage']['LabelDeleteLanguageMessage'],
            $ob[$ob['Setting']['Language']]['ChangeLanguage']['ButtonDeleteLanguageMessage'],
            route('language.delete'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['ChangeLanguage']['ChangeLanguage'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeMainBranch($ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            new Menu($ob[$ob['Setting']['Language']]['Menu']), $myRadios);
            $this->NewLanguage = $ob[$this->language]['ChangeLanguage']['NewLanguage'];
            $this->TitleNewLang = $ob[$this->language]['ChangeLanguage']['TitleNewLang'];
            $this->ButtonNewLang = $ob[$this->language]['ChangeLanguage']['ButtonNewLang'];
            $this->error1 = $ob[$this->language]['ChangeLanguage']['NewLangNameRequired'];
            $this->error2 = $ob[$this->language]['ChangeLanguage']['NewLangNameInvalid'];
            //init table
            $this->IdLangaue = $ob[$this->language]['ChangeLanguage']['IdLangaue'];
            $this->NameLangaue = $ob[$this->language]['ChangeLanguage']['NameLangaue'];
            $this->EditLangaue = $ob[$this->language]['ChangeLanguage']['EditLangaue'];
            //init label
            $this->label3 = $ob[$this->language]['ChangeLanguage']['LanguageInfo'];     
            $this->label4 = $ob[$this->language]['ChangeLanguage']['LanguageSelect'];
            $this->label5 = $ob[$this->language]['ChangeLanguage']['LabelChangeLanguageMessage'];
            $this->label6 = $ob[$this->language]['ChangeLanguage']['LabelCopyLanguageMessage'];
            $this->LabelNameLanguage = $ob[$this->language]['ChangeLanguage']['LabelCreateLanguage'];
            $this->HintCopyLanguage = $ob[$this->language]['ChangeLanguage']['HintCopyLangName'];
            $this->label7 = $ob[$this->language]['ChangeLanguage']['LabelNewLangName'];
            //hint
            $this->hint1 = $ob[$this->language]['ChangeLanguage']['HintNewLangName'];
            //init button
            $this->button4 = $ob[$this->language]['ChangeLanguage']['ButtonChangeLanguageMessage'];
            $this->button5 = $ob[$this->language]['ChangeLanguage']['ButtonCopyLanguageMessage'];
            $this->title2 = $ob[$this->language]['ChangeLanguage']['TitleChangeLanguageMessage'];
            $this->title3 = $ob[$this->language]['ChangeLanguage']['TitleCopyLanguageMessage'];
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
