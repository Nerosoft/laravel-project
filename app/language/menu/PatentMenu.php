<?php

namespace App\language\menu;
use App\language\share\SetupMenu;
class PatentMenu extends SetupMenu
{
    /**
     * Create a new class instance.
     */
    protected function __construct($language, $PatientMenu, $AppSettingPatient, $Direction, $title)
    {
        parent::__construct($language, $title, $Direction, $PatientMenu, $AppSettingPatient);
    }
}
