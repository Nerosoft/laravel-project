<?php

namespace App\language\admin\contracts;
use App\instance\admin\contracts\Contracts;
use App\language\share\Page;
use App\Models\Rays;
use App\Menu;
class PackagesContracts extends Page
{
    /**
     * Create a new class instance.
     */
    public $myContract = array();
    public function __construct($state)
    {
        $ob = Rays::find(request()->session()->get('userId'));
        parent::__construct($ob[$ob['Setting']['Language']]['Error'], 
        $state, 
        $ob['Setting']['Language'], 

        $ob[$ob['Setting']['Language']]['Title']['DeleteContract'],
        $ob[$ob['Setting']['Language']]['Label']['DeleteContract'],
        $ob[$ob['Setting']['Language']]['Button']['DeleteContract'],
        route('deleteContract'),
        $ob[$ob['Setting']['Language']]['TableInfo'],
       

        $ob[$ob['Setting']['Language']]['Title']['PackagesContracts'],
        
        $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
        $ob[$ob['Setting']['Language']]['Html']['Direction'],

        $ob['Branch'],
        
        new Menu($ob[$ob['Setting']['Language']]['Menu'], 'Admin'),
        $ob[$ob['Setting']['Language']]['Title']['CreateContract'],
        $ob[$ob['Setting']['Language']]['Title']['EditContract'],
        $ob[$ob['Setting']['Language']]['Button']['CreateContract'],
        $ob[$ob['Setting']['Language']]['Button']['AddContract'],
        $ob[$ob['Setting']['Language']]['Button']['EditContract'],
        $ob[$ob['Setting']['Language']]['Table']['ContractId'],
        $ob[$ob['Setting']['Language']]['Table']['ContractEdit']);

         //init table
        $this->table8 = $ob[$this->language]['Table']['ContractName'];
        $this->table9 = $ob[$this->language]['Table']['ContractGovernorate'];
        $this->table10 = $ob[$this->language]['Table']['ContractArea'];
       
         //init label
        $this->label3 = $ob[$this->language]['Label']['ContractName'];
        $this->label4 = $ob[$this->language]['Label']['ContractGovernorate'];
        $this->label5 = $ob[$this->language]['Label']['ContractArea'];
         //init hint
        $this->hint1 = $ob[$this->language]['Hint']['ContractName'];
        $this->hint2 = $ob[$this->language]['Hint']['ContractGovernorate'];
        $this->hint3 = $ob[$this->language]['Hint']['ContractArea'];
        if(isset($ob['Contracts']))
            foreach ($ob['Contracts'] as $key => $value)
                $this->myContract[$key] = new Contracts($value['Name'], $value['Governorate'], $value['Area']);
    }
}