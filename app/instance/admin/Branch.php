<?php
namespace App\instance\admin;
class Branch
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
    public function __construct($Name, $Phone = null, $Governments = null,
    $City = null, $Street = null, $Building = null, $Address = null, $Country = null, $Follow = null)
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
    public static function fromArray($branch, $inout){
        $allBranch = array();
        foreach ($branch as $key => $branch)
            $allBranch[$key] = new Branch($branch['Name'], $branch['Phone'], $branch['Governments'],
                $branch['City'], $branch['Street'], $branch['Building'], $branch['Address'],
                $branch['Country'], $inout[$branch['Follow']]);        
        return $allBranch;
    }
}
