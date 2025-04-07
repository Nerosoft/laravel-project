<?php
namespace App\language\share;
class SetupMenu extends InitPage{
    protected function __construct($language, $title, $direction, $myMenuApp, $AppSetting)
    {
        parent::__construct($language, $title, $direction);
        $this->myMenuApp = $myMenuApp;
        $this->title101 = $AppSetting['Offcanvas'];
        $this->label1 = $AppSetting['Logout'];
        $this->label2 = $AppSetting['AdminDashboard'];
    }
}
