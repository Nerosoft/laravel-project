<?php
namespace App\instance\admin\test_cultures;
use App\instance\share\SearchId;
class MyCurrentOffers extends SearchId
{
    //order var important
    private $Name;
    private $Shortcut;
    private $State;
    private $Price;
    private $DisplayPrice;
    private $Id;
    //---------------------
    public function __construct($Name, $Shortcut, $Price, $DisplayPrice, $State, $id = null)
    {
        $this->Name = $Name;
        $this->Shortcut = $Shortcut;
        $this->Price = $Price;
        $this->DisplayPrice = $DisplayPrice;
        $this->State = $State;
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
    public function getDisplayPrice(){
        return $this->DisplayPrice;
    }
    public function getStateId(){
        return $this->State;
    }
    public function getState(){
        return $this->getValue($this->State, 'SelectOfferBox');
    }
    public function getObject(){
        return get_object_vars($this);
    }
    public function getObject2(){
        $arr = get_object_vars($this);
        $arr['State'] = $this->getState();
        return $arr;
    }
}
