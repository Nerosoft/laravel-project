<?php

namespace App\language\admin\reception;
use App\instance\admin\reception\MyKnows;
use App\Models\Rays;
use App\language\share\Page;
use App\Menu;
class Knows extends Page
{
    public $knows = array();
    public function __construct($state)
    {        
        $ob = Rays::find(request()->session()->get('userId'));
        parent::__construct($ob[$ob['Setting']['Language']]['Error'], 
        $state, 
        $ob['Setting']['Language'], $ob['AppId'],

        $ob[$ob['Setting']['Language']]['Title']['KnowsDelete'],
        $ob[$ob['Setting']['Language']]['Label']['KnowsDelete'],
        $ob[$ob['Setting']['Language']]['Button']['KnowsDelete'],
        route('deleteKnows'),
        $ob[$ob['Setting']['Language']]['TableInfo'],
        

        $ob[$ob['Setting']['Language']]['Title']['Knows'],

        $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
        $ob[$ob['Setting']['Language']]['Html']['Direction'],

        $ob['Branch'], $ob['AppId'] !== $ob['_id'] ? false : true, $ob['_id'],
        new Menu($ob[$ob['Setting']['Language']]['Menu'], 'Admin'),
        $ob[$ob['Setting']['Language']]['Title']['KnowsCreate'],
        $ob[$ob['Setting']['Language']]['Title']['KnowsEdit'],
        $ob[$ob['Setting']['Language']]['Button']['KnowsCreate'],
        $ob[$ob['Setting']['Language']]['Button']['KnowsAdd'],
        $ob[$ob['Setting']['Language']]['Button']['KnowsEdit'],
        $ob[$ob['Setting']['Language']]['Table']['KnowsId'],
        $ob[$ob['Setting']['Language']]['Table']['KnowsEdit']);
       
        //init table
        $this->table8 = $ob[$this->language]['Table']['KnowsName'];
       
        //init label
        $this->label3 = $ob[$this->language]['Label']['KnowsName'];
        //init hint
        $this->hint1 = $ob[$this->language]['Hint']['KnowsName'];
        //---------------
        if(isset($ob['Knows']))
            foreach ($ob['Knows'] as $key => $knows)
                $this->knows[$key] = new MyKnows($knows['Name']);
    }
}