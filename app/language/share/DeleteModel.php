<?php

namespace App\language\share;
use App\language\share\TableSetting;
class DeleteModel extends TableSetting
{
    /**
     * Create a new class instance.
     */
    protected function __construct($error, $state, $language, $titleModelDelete, $messageModelDelete, $buttonModelDelete, $actionDelete, $TableInfo, $title, $AppSettingAdmin, $direction, $branch, $myMenuApp, $ob = null, $var1 = null, $var2 = null, $var3 = null, $var4 = null, $var5 = null, $var6 = null)
    {
        parent::__construct($error, $state, $language, $AppSettingAdmin, $direction, $branch, $title, $TableInfo, $myMenuApp, $ob, $var1, $var2, $var3, $var4, $var5, $var6);
        $this->titleModelDelete = $titleModelDelete;
        $this->messageModelDelete = $messageModelDelete;
        $this->buttonModelDelete = $buttonModelDelete;
        $this->actionDelete = $actionDelete;
    }
}
