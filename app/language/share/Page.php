<?php
namespace App\language\share;
class Page extends DeleteModel{
    protected function __construct($error, $state, $Language, $AppId, $TitleDeleteTest, $LabelDeleteTest, $ButtonDeleteTest, $RouteDeleteTest, $TableInfo, $Title, $AppSettingAdmin, $Direction, $Branch, $StateAppId, $_id, $Menu, $title2, $title3, $button1, $button2, $button3, $table7, $table11, $ob = null, $var1 = null, $var2 = null, $var3 = null, $var4 = null, $var5 = null, $var6 = null){
        parent::__construct($error, $state, $Language, $AppId, $TitleDeleteTest, $LabelDeleteTest, $ButtonDeleteTest, $RouteDeleteTest, $TableInfo, $Title, $AppSettingAdmin, $Direction, $Branch, $StateAppId, $_id, $Menu, $ob, $var1, $var2, $var3, $var4, $var5, $var6);
        $this->title2 = $title2;
        $this->title3 = $title3;
        $this->button1 = $button1;
        $this->button2 = $button2;
        $this->button3 = $button3;
        $this->table7 = $table7;
        $this->table11 = $table11;
    }
}