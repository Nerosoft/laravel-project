<?php

namespace App\language\patent;
use App\language\menu\PatentMenu;
use App\Models\Rays;
use App\Menu;
class OurBranches extends PatentMenu
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $ob = Rays::find(request()->session()->get('patentId'));
        parent::__construct($ob['Setting']['Language'],
        new Menu($ob[$ob['Setting']['Language']]['Menu'],'Patient'),
        $ob[$ob['Setting']['Language']]['AppSettingPatient'],
        $ob[$ob['Setting']['Language']]['Html']['Direction'],
        $ob[$ob['Setting']['Language']]['Title']['PatentOurBranches']);
    }
}
