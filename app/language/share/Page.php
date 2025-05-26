<?php
namespace App\language\share;
class Page extends DeleteModel{
    protected function __construct($Language, $TitleDeleteTest, $LabelDeleteTest, $ButtonDeleteTest, $RouteDeleteTest, $TableInfo, $Title, $AppSettingAdmin, $Direction, $Branch, $Menu, $title2, $title3, $button1, $button2, $button3, $table7, $table11){
        parent::__construct($Language, $TitleDeleteTest, $LabelDeleteTest, $ButtonDeleteTest, $RouteDeleteTest, $TableInfo, $Title, $AppSettingAdmin, $Direction, $Branch, $Menu);
        $this->title2 = $title2;
        $this->title3 = $title3;
        $this->button1 = $button1;
        $this->button2 = $button2;
        $this->button3 = $button3;
        $this->table7 = $table7;
        $this->table11 = $table11;
    }
}