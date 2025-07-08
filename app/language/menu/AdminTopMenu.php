<?php

namespace App\language\menu;
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
        // make object branch
        $this->MyBranch = $branch;
    }
}
