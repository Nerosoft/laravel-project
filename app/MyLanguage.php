<?php
namespace App;
class MyLanguage
{
    /**
     * Create a new class instance.
     */
    private $Name;
    public function __construct($name)
    {
        $this->Name=$name;
    }
    public function getName(){
        return $this->Name;
    }
}
