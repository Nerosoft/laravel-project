<?php
namespace App\language\share;
use App\Http\Controllers\Controller;
class InitPage extends Controller{
    protected function __construct($language, $title1, $direction){
        $this->language = $language;
        $this->title1 = $title1;
        $this->direction = $direction;
    }
}