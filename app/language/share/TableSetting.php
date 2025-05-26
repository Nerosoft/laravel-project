<?php
namespace App\language\share;
use App\language\menu\AdminTopMenu;
class TableSetting extends AdminTopMenu
{
    protected function __construct($Language, $AppSettingAdmin, $Direction, $Branch, $Title, $TableInfo, $Menu){
        parent::__construct($Language, $AppSettingAdmin, $Direction, $Branch, $Title, $Menu);
        $this->table1 = $TableInfo['Ssearch'];
        $this->table2 = $TableInfo['InfoEmpty'];
        $this->table3 = $TableInfo['ZeroRecords'];
        $this->table4 = $TableInfo['Info'];
        $this->table5 = $TableInfo['LengthMenu'];
        $this->table6 = $TableInfo['InfoFiltered'];
    }
}
