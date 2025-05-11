<?php

namespace App\language\admin\salary_details;
use App\language\menu\AdminTopMenu;
use App\Models\Rays;
use App\Menu;
class ThProducts extends AdminTopMenu
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

       
$ob['Branch']?$ob['Branch']:Rays::find(request()->session()->get('userLogout'))['Branch'],

        $ob[$ob['Setting']['Language']]['Title']['ThProducts'],
        
        new Menu($ob[$ob['Setting']['Language']]['Menu'], 'Admin'));
    }
    
}