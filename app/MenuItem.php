<?php
namespace App;
class MenuItem
{
    /**
     * Create a new class instance.
     */
    public $Name;
    public $Item;
    public function __construct($name, $item)
    {
        $this->Name = $name;
        $this->Item = $item;
    }
}
