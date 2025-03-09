<?php

namespace App\language\doctor;
use App\language\menu\DoctorMenu;
use App\Models\Rays;
use App\Menu;
class TheDoctorReport extends DoctorMenu
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $ob = Rays::find(request()->session()->get('doctorId'));
        parent::__construct($ob['Setting']['Language'],
        new Menu($ob[$ob['Setting']['Language']]['Menu']),
        $ob[$ob['Setting']['Language']]['AppSettingDoctor'],
        $ob[$ob['Setting']['Language']]['Html']['Direction'],
        $ob[$ob['Setting']['Language']]['Title']['TheDoctorReport']);
    }
}

