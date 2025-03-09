<?php

namespace App\language\share;
class InitPage
{
    protected function __construct($language, $title, $direction)
    {
        $this->title1 = $title;
        $this->direction = $direction;
        $this->language = $language;
    }
}
