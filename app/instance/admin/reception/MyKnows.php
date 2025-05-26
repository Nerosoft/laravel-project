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
    public static function fromArray(array $data): array {
        $myKnows = array();
        foreach ($data as $key=>$data) 
            $myKnows[$key] = new MyKnows($data['Name']);
        return $myKnows;
    }
}
