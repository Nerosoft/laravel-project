<?php

namespace App\language\menu;
use App\language\share\SetupMenu;
class DoctorMenu extends SetupMenu
{
    /**
     * Create a new class instance.
     */
    protected function __construct($language, $DoctorMenu, $AppSettingDoctor, $Direction, $title){
        parent::__construct($language, $title, $Direction, $DoctorMenu, $AppSettingDoctor);
    }
}
