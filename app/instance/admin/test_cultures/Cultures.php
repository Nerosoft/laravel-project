<?php
namespace App\instance\admin\test_cultures;
class Cultures
{
     /**
     * Create a new class instance.
     */
    //order var important
    private $Name;
    private $Shortcut;
    private $Price;
    private $InputOutputLab;
    private $Id;
    //----------------------
    public function __construct($Name, $Shortcut, $Price, $InputOutputLab, $id = null)
    {
        $this->Name = $Name;
        $this->Shortcut = $Shortcut;
        $this->Price = $Price;
        $this->InputOutputLab = $InputOutputLab;
        $this->Id = $id;
    }
    public function getMyId(){
        return $this->Id;
    }
    public function getShortcut(){
        return $this->Shortcut;
    }
    public function getName(){
        return $this->Name;
    }
    public function getPrice(){
        return $this->Price;
    }
    public function getInputOutputLabId(){
        return $this->InputOutputLab;
    }
    public static function fromArray(array $data, $inputOutput): array {
        $cultures = array();
        foreach ($data as $key=>$data) 
            $cultures[$key] = new Cultures($data['Name'], $data['Shortcut'], $data['Price'], $inputOutput[$data['InputOutputLab']]);
        return $cultures;
    }
}
