<?php
namespace App\language;
use App\Menu;
use App\language\share\TableSetting;
use App\Models\Rays;
class AllLanguage extends TableSetting
{
    public $myAllLanguage = array();
    /**
     * Create a new class instance.
     */
    public function __construct($state, $title)
    {   
        $ob = Rays::find(request()->session()->get('userId'));
        //---------------------------------------------
        parent::__construct($ob[$ob['Setting']['Language']]['Error'],
            $state,
            $ob['Setting']['Language'],

            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],

            $ob['Branch'],

            $ob[$ob['Setting']['Language']]['TitleCustomLang'][$title],
            $ob[$ob['Setting']['Language']]['TableInfo'],

            new Menu($ob[$ob['Setting']['Language']]['Menu'], 'Language',
            $ob[$ob['Setting']['Language']]['CutomLang'],
            $ob[$ob['Setting']['Language']]['AllNamesLanguage']), $ob, $title);

            //label
            $this->myDirectionOption = $state !== 'AllLanguage' ?  $ob[$this->language]['Direction'] : $this->myAllLanguage[$this->language]['Direction'];
            //init label
            $this->label3 = $state !== 'AllLanguage' ? $ob[$this->language]['Label']['Text'] : $this->myAllLanguage[$this->language]['Label']['Text'];
            $this->label4 = $state !== 'AllLanguage' ? $ob[$this->language]['Label']['DirectionPage'] : $this->myAllLanguage[$this->language]['Label']['DirectionPage']; 
            //table
            $this->table7 = $state !== 'AllLanguage' ? $ob[$this->language]['Table']['LanguageValue'] : $this->myAllLanguage[$this->language]['Table']['LanguageValue'];
            $this->table8 = $state !== 'AllLanguage' ? $ob[$this->language]['Table']['LanguageEvent'] : $this->myAllLanguage[$this->language]['Table']['LanguageEvent'];
            $this->table9 = $state !== 'AllLanguage' ? $ob[$this->language]['Table']['LanguageId'] : $this->myAllLanguage[$this->language]['Table']['LanguageId'];
            $this->table10 = $state !== 'AllLanguage' ? $ob[$this->language]['Table']['LanguageName'] : $this->myAllLanguage[$this->language]['Table']['LanguageName'];
            //model
            $this->model1 = $state !== 'AllLanguage' ? $ob[$this->language]['Model']['Title'] : $this->myAllLanguage[$this->language]['Model']['Title'];
            $this->model2 = $state !== 'AllLanguage' ? $ob[$this->language]['Model']['TitleDirection'] : $this->myAllLanguage[$this->language]['Model']['TitleDirection'];
            //button
            $this->button2 = $state !== 'AllLanguage' ? $ob[$this->language]['Button']['SaveDirection'] : $this->myAllLanguage[$this->language]['Button']['SaveDirection'];
            $this->button3 = $state !== 'AllLanguage' ? $ob[$this->language]['Button']['SaveText'] : $this->myAllLanguage[$this->language]['Button']['SaveText'];
    }
}
