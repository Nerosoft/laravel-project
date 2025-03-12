<?php

namespace App\language\admin;
use App\Models\Rays;
use App\language\share\DeleteModel;
use App\Menu;
class ChangeLanguage extends DeleteModel
{
    public $label3;
    public $label4;
    public $label5;
    public $label6;
    
    public $button4;
    public $button5;
    
    public $title2;
    public $title3;
    
    public $IdLangaue;
    public $NameLangaue;
    public $EditLangaue;
    //----------------
    public $size1;
    //------------------
    public $error1;
    public $error2;
    //--------------------
    public $myAllLanguage;
    //--------------------
    public $successfully1;
    /**
     * Create a new class instance.
     */
    public function __construct($state)
    {   
        $ob = Rays::find(request()->session()->get('userId'));
        parent::__construct($ob[$ob['Setting']['Language']]['Error'],
            $state,
            $ob['Setting']['Language'],
            $ob['AppId'],
            $ob[$ob['Setting']['Language']]['Title']['DeleteLanguageMessage'],
            $ob[$ob['Setting']['Language']]['Label']['DeleteLanguageMessage'],
            $ob[$ob['Setting']['Language']]['Button']['DeleteLanguageMessage'],
            route('language.delete'),
            
            $ob[$ob['Setting']['Language']]['TableInfo'],

            $ob[$ob['Setting']['Language']]['Title']['ChangeLanguage'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            $ob['Branch'],  $ob['AppId'] !== $ob['_id'] ? false : true,
            $ob['_id'],
            new Menu($ob[$ob['Setting']['Language']]['Menu'], 'Language',
            $ob[$ob['Setting']['Language']]['CutomLang'],
            $ob[$ob['Setting']['Language']]['MyNameLanguage']));


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
            $this->myLanguage = $ob[$this->language][$this->language];
    }
}
