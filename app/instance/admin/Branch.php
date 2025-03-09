<?php
namespace App\instance\admin;
use App\instance\share\SearchId;
class Branch extends SearchId
{
    /**
     * Create a new class instance.
     */
    private $Name;
    private $Phone;
    private $Governments;
    private $City;
    private $Street;
    private $Building;
    private $Address;
    private $Country;
    private $Follow;
    private $id;
    public function __construct($Name, $Phone, $Governments,
    $City, $Street, $Building, $Address, $Country, $Follow, $id)
    {
        $this->Name = $Name;
        $this->Phone = $Phone;
        $this->Governments = $Governments;
        $this->City = $City;
        $this->Street = $Street;
        $this->Building = $Building;
        $this->Address = $Address;
        $this->Country = $Country;
        $this->Follow = $Follow;
        $this->id = $id;
    }
    public function getName(){
        return $this->Name;
    }
    public function getPhone(){
        return $this->Phone;
    }
    public function getGovernments(){
        return $this->Governments;
    }
    public function getCity(){
        return $this->City;
    }
    public function getStreet(){
        return $this->Street;
    }
    public function getBuilding(){
        return $this->Building;
    }
    public function getAddress(){
        return $this->Address;
    }
    public function getCountry(){
        return $this->Country;
    }
    public function getFollowId(){
        return $this->Follow;
    }
    public function getFollow(){
        return $this->getValue($this->Follow, 'SelectBranchBox');
    }
    public function getId(){
        return $this->id;
    }
}
