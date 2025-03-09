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
    public function __construct($state, $title = null)
    {   
        $ob = Rays::find(request()->session()->get('userId'));
        //---------------------------------------------
        parent::__construct($ob[$ob['Setting']['Language']]['Error'],
            $state,
            $ob['Setting']['Language'],

            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],

            $ob['Branch'], $ob['AppId'],
            $ob['AppId'] !== $ob['_id'] ? false : true,
            $ob['_id'],

            isset($ob[$ob['Setting']['Language']]['TitleCustomLang'][$title]) ? $ob[$ob['Setting']['Language']]['TitleCustomLang'][$title] : '',
            $ob[$ob['Setting']['Language']]['TableInfo'],

            new Menu($ob[$ob['Setting']['Language']]['Menu'], 'Language',
            $ob[$ob['Setting']['Language']]['CutomLang'],
            $ob[$ob['Setting']['Language']]['MyNameLanguage']), $ob);

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
            //error
            // $this->initError($this->myAllLanguage[$this->language]['Error']);
            $this->error6 = $this->myAllLanguage[$this->language]['Error']['PageError'];
            //model
            $this->model1 = $this->myAllLanguage[$this->language]['Model']['Title'];
            $this->model2 = $this->myAllLanguage[$this->language]['Model']['TitleDirection'];
            //button
            //$this->button1 = $this->myAllLanguage[$this->language]['Button']['SelectDirection'];
            $this->button2 = $this->myAllLanguage[$this->language]['Button']['SaveDirection'];
            $this->button3 = $this->myAllLanguage[$this->language]['Button']['SaveText'];
    }
}
