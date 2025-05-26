<?php

namespace App\language\share;
use App\language\share\TableSetting;
class DeleteModel extends TableSetting
{
    /**
     * Create a new class instance.
     */
    protected function __construct($language, $titleModelDelete, $messageModelDelete, $buttonModelDelete, $actionDelete, $TableInfo, $title, $AppSettingAdmin, $direction, $branch, $myMenuApp)
    {
        parent::__construct($language, $AppSettingAdmin, $direction, $branch, $title, $TableInfo, $myMenuApp);
        $this->titleModelDelete = $titleModelDelete;
        $this->messageModelDelete = $messageModelDelete;
        $this->buttonModelDelete = $buttonModelDelete;
        $this->actionDelete = $actionDelete;
    }
}
