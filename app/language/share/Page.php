<?php
namespace App\language\share;
use App\Models\Rays;
use Illuminate\Support\Facades\Route;
use App\Menu;

class Page extends TableSetting{
    protected function __construct($state, $ob, $tableData){
        parent::__construct($ob[$ob['Setting']['Language']][$state]['Title'], new Menu($ob[$ob['Setting']['Language']]['Menu']), $ob, $tableData);
        $this->title2 = $ob[$this->language][$state]['ScreenModelCreate'];
        $this->title3 = $ob[$this->language][$state]['ScreenModelEdit'];
        $this->button1 = $ob[$this->language][$state]['ButtonModelCreate'];
        $this->button2 = $ob[$this->language][$state]['ButtonModelAdd'];
        $this->button3 = $ob[$this->language][$state]['ButtonModelEdit'];
        $this->table7 = $ob[$this->language][$state]['TableId'];
        $this->table11 = $ob[$this->language][$state]['TabelEvent'];
        $this->titleModelDelete = $ob[$this->language][$state]['ScreenModelDelete'];
        $this->messageModelDelete = $ob[$this->language][$state]['MessageModelDelete'];
        $this->buttonModelDelete = $ob[$this->language][$state]['ButtonModelDelete'];
        $this->actionDelete = route('deleteItem', $state);
    }
}