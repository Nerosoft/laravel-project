<?php

namespace App\language\share;
class TableSetting extends TestParent
{
    protected function __construct($error, $myState, $Language, $AppSettingAdmin, $Direction, $Branch, $AppId, $StateAppId, $_id, $Title, $TableInfo, $Menu, $ob = null, $var1 = null, $var2 = null, $var3 = null, $var4 = null, $var5 = null, $var6 = null){
        parent::__construct($error, $myState, $AppId, $Language, $AppSettingAdmin, $Direction, $Branch, $StateAppId, $_id, $Title, $Menu, $ob, $var1, $var2, $var3, $var4, $var5, $var6);
        $this->table1 = $TableInfo['Ssearch'];
        $this->table2 = $TableInfo['InfoEmpty'];
        $this->table3 = $TableInfo['ZeroRecords'];
        $this->table4 = $TableInfo['Info'];
        $this->table5 = $TableInfo['LengthMenu'];
        $this->table6 = $TableInfo['InfoFiltered'];
    }
}
