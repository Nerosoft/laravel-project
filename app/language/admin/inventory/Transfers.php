<?php

namespace App\language\admin\inventory;
use App\language\menu\AdminTopMenu;
use App\Models\Rays;
use App\Menu;
class Transfers extends AdminTopMenu
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $ob = Rays::find(request()->session()->get('userId'));
        parent::__construct($ob['Setting']['Language'],
       $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
        $ob[$ob['Setting']['Language']]['Html']['Direction'],

       
        $ob['Branch'],

        $ob[$ob['Setting']['Language']]['Title']['Transfers'],
        
        new Menu($ob[$ob['Setting']['Language']]['Menu'], 'Admin'));
    }
    
}