<?php

namespace App\instance\admin\reception;
class MyKnows
{
    /**
     * Create a new class instance.
     */
    private $Name;
    public function __construct($name)
    {
        $this->Name = $name;
    }
    public function getName(){
        return $this->Name;
    }
}
