<?php
namespace App\instance\admin\test_cultures;
use App\instance\share\SearchId;
class Test extends SearchId
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
    public function getInputOutputLab(){
        return $this->getValue($this->InputOutputLab, 'SelectTestBox');
    }
    public function getObject(){
        return get_object_vars($this);
    }
    public function getObject2(){
        $arr = get_object_vars($this);
        $arr['InputOutputLab'] = $this->getInputOutputLab();
        return $arr;
    }
}
