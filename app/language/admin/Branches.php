<?php

namespace App\language\admin;
use App\language\share\Page;
use App\Models\Rays;
use App\Menu;
class Branches extends Page
{
    /**
     * Create a new class instance.
     */
    //---------------
    public function __construct($state)
    {
        $ob = Rays::find(request()->session()->get('userId'));
        parent::__construct($ob[$ob['Setting']['Language']]['Error'],
            $state,
            $ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['Title']['BranchRaysDelete'],
            $ob[$ob['Setting']['Language']]['Label']['BranchRaysDelete'],
            $ob[$ob['Setting']['Language']]['Button']['BranchRaysDelete'],
            route('deleteBranchRays'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Title']['Branches'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            $ob['Branch'],
            new Menu($ob[$ob['Setting']['Language']]['Menu'], 'Admin'),
            $ob[$ob['Setting']['Language']]['Title']['BranchRays'],
            $ob[$ob['Setting']['Language']]['Title']['BranchRaysEdit'],
            $ob[$ob['Setting']['Language']]['Button']['CreateBranche'],
            $ob[$ob['Setting']['Language']]['Button']['AddBranchRays'],
            $ob[$ob['Setting']['Language']]['Button']['EditBranchRays'],
            $ob[$ob['Setting']['Language']]['Table']['BranchRaysId'],
            $ob[$ob['Setting']['Language']]['Table']['LanguageEvent']);
            //init label
            $this->table8 = $ob[$this->language]['Table']['BranchStreet'];
            $this->table9 = $ob[$this->language]['Table']['BranchName'];
            $this->table10 = $ob[$this->language]['Table']['BranchPhone'];
            $this->table16 = $ob[$this->language]['Table']['BranchGovernments'];
            $this->table17 = $ob[$this->language]['Table']['BranchCity'];
            $this->table12 = $ob[$this->language]['Table']['BranchBuilding'];
            $this->table13 = $ob[$this->language]['Table']['BranchAddress'];
            $this->table14 = $ob[$this->language]['Table']['BranchCountry'];
            $this->table15 = $ob[$this->language]['Table']['BranchFollow'];
            //get all hint
            $this->hint1 = $ob[$this->language]['Hint']['BranchRaysName'];
            $this->hint2 = $ob[$this->language]['Hint']['BranchRaysPhone'];
            $this->hint3 = $ob[$this->language]['Hint']['BranchRaysCountry'];
            $this->hint4 = $ob[$this->language]['Hint']['BranchRaysGovernments'];
            $this->hint5 = $ob[$this->language]['Hint']['BranchRaysCity'];
            $this->hint6 = $ob[$this->language]['Hint']['BranchRaysStreet'];
            $this->hint7 = $ob[$this->language]['Hint']['BranchRaysBuilding'];
            $this->hint8 = $ob[$this->language]['Hint']['BranchRaysAddress'];
            $this->branchInputOutput = $ob[$this->language]['SelectBranchBox'];
            $this->selectBox1 = $ob[$this->language]['SelectBox']['WithRaysOut'];
        }
}