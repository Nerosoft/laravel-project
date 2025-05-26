<?php

namespace App\language\share;
use App\Http\Controllers\Controller;
class InitPage extends Controller
{
    protected function __construct($language, $title, $direction)
    {
        $this->title1 = $title;
        $this->direction = $direction;
        $this->language = $language;
    }
}
