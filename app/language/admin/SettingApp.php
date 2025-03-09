<?php

namespace App\language\admin;
use App\language\menu\AdminTopMenu;
use App\Models\Rays;
use App\Menu;
class SettingApp extends AdminTopMenu
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

       
        $ob['Branch'], $ob['AppId'],
        $ob['AppId'] !== $ob['_id'] ? false : true,
        $ob['_id'],

        $ob[$ob['Setting']['Language']]['Title']['SettingApp'],
        
        new Menu($ob[$ob['Setting']['Language']]['Menu'], 'Admin'));
    }
    
}
