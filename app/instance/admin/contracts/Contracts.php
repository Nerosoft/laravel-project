<?php
namespace App\instance\admin\contracts;
class Contracts
{
    /**
     * Create a new class instance.
     */
    private $Name;
    private $Governorate;
    private $Area;
    public function __construct($name, $governorate = null, $area = null)
    {
        $this->Name = $name;
        $this->Governorate = $governorate;
        $this->Area = $area;
    }
    public function getName(){
        return $this->Name;
    }
    public function getGovernorate(){
        return $this->Governorate;
    }
    public function getArea(){
        return $this->Area;
    }
    public static function fromArray(array $data): array {
        $contracts = array();
        foreach ($data as $key=>$data) 
            $contracts[$key] = new Contracts($data['Name'], $data['Governorate'], $data['Area']);
        return $contracts;
    }
}
