<?php

namespace App\language\share;
use App\language\share\TableSetting;
class DeleteModel extends TableSetting
{
    /**
     * Create a new class instance.
     */
    protected function __construct($language, $titleModelDelete, $messageModelDelete, $buttonModelDelete, $actionDelete, $TableInfo, $title, $AppSettingAdmin, $direction, $branch, $myMenuApp, $tableData)
    {
        parent::__construct($language, $AppSettingAdmin, $direction, $branch, $title, $TableInfo, $myMenuApp, $tableData);
        $this->titleModelDelete = $titleModelDelete;
        $this->messageModelDelete = $messageModelDelete;
        $this->buttonModelDelete = $buttonModelDelete;
        $this->actionDelete = $actionDelete;

    }
}
