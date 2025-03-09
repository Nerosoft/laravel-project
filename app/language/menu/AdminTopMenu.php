<?php

namespace App\language\menu;
use App\instance\admin\Branch;
use App\language\share\SetupMenu;
class AdminTopMenu extends SetupMenu
{
    /**
     * Create a new class instance.
    */
    public $MyBranch = array();
    protected function __construct($language, $AppSetting, $direction, $branch, $id, $active1, $_id, $title, $myMenuApp){
        parent::__construct($language, $title, $direction, $myMenuApp, $AppSetting);
        //make active
        $this->active1 = $active1;
        //make id2
        $this->id2 = $_id;
        //make id
        $this->id1 = $id;
        //init select box
        $this->selectBox3 = $AppSetting['BranchesCompany'];
        //init branch main
        $this->selectBox4 = $AppSetting['BranchMain'];
        // make object branch
        if(isset($branch))
            foreach ($branch as $key => $branch)
                $this->MyBranch[$key] = new Branch($branch['Name'], $branch['Phone'], $branch['Governments'],
                $branch['City'], $branch['Street'], $branch['Building'], $branch['Address'],
                $branch['Country'], $branch['Follow'], $branch['id']);
    }
}
