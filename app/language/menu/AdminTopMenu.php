<?php

namespace App\language\menu;
use App\instance\admin\Branch;
use App\language\share\SetupMenu;
class AdminTopMenu extends SetupMenu
{
    /**
     * Create a new class instance.
    */
    protected function __construct($language, $AppSetting, $direction, $branch, $title, $myMenuApp){
        parent::__construct($language, $title, $direction, $myMenuApp, $AppSetting);
        $this->MyBranch = array();
        //init select box
        $this->selectBox3 = $AppSetting['BranchesCompany'];
        //init branch main
        $this->selectBox4 = $AppSetting['BranchMain'];
        // make object branch
        if(isset($branch))
            foreach ($branch as $key => $branch)
                $this->MyBranch[$key] = new Branch($branch['Name']);
    }
}
