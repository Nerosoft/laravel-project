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
    public function setName($value){
        $this->Name = $value;
        return $this;
    }
    public function setItem($id, $value){
        $this->Item[$id] = $value;
        return $this;
    }
}
