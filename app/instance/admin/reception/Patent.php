<?php

namespace App\instance\admin\reception;
use App\instance\share\SearchId;
use App\Models\Rays;
use Illuminate\Support\Str;
class Patent extends SearchId
{
    /**
     * Create a new class instance.
     */
    private $Avatar;
    private $Name;
    private $Nationality;
    private $NationalId;
    private $PassportNo;
    private $Email;
    private $Phone;
    private $Phone2;
    private $Gender;
    private $LastPeriodDate;
    private $DateBirth;
    private $Address;
    private $Contracting;
    private $Hours;
    private $Disease;
    private $PatentCode;
    
    public function __construct($PatentCode, $Avatar, $Name = null, $Nationality = null, $NationalId = null, $PassportNo = null,
    $Email = null, $Phone = null, $Phone2 = null, $Gender = null, $LastPeriodDate = null,
    $DateBirth = null, $Address = null, $Contracting = null, $Hours = null,
    $Disease = null)
    {
        $this->Name = $Name;
        $this->Nationality = $Nationality;
        $this->NationalId = $NationalId;
        $this->PassportNo = $PassportNo;
        $this->Email = $Email;
        $this->Phone = $Phone;
        $this->Phone2 = $Phone2;
        $this->Gender = $Gender;
        $this->LastPeriodDate = $LastPeriodDate;
        $this->DateBirth = $DateBirth;
        $this->Address = $Address;
        $this->Contracting = $Contracting;
        $this->Hours = $Hours;
        $this->Disease = $Disease;
        $this->Avatar = $Avatar;
        $this->PatentCode = $PatentCode;
    }
    public function getObject2(){
        $pat = get_object_vars($this);
        $pat['Nationality'] = $this->getNationality();
        $pat['Gender'] = $this->getGender();
        $pat['Contracting'] = $this->getContracting();
        return $pat;
    }
    public function getPatentCode(){
        return $this->PatentCode;
    }
    public function getAvatar(){
        return $this->Avatar;
    }
    public function getName(){
        return $this->Name;
    }
    public function getNationalityId(){
        return $this->Nationality;
    }
    public function getNationality(){
        //if pateint not exsist vaue is empty like '' inside receipt
        return $this->getValue($this->Nationality, 'SelectNationalityBox');
    }
    public function getNationalId(){
        return $this->NationalId;
    }
    public function getPassportNo(){
        return $this->PassportNo;
    }
    public function getEmail(){
        return $this->Email;
    }
    public function getPhone(){
        return $this->Phone;
    }
    public function getPhone2(){
        return $this->Phone2;
    }
    public function getGenderId(){
        return $this->Gender;
    }
    public function getGender(){
        //if pateint not exsist vaue is empty like '' inside receipt
        return $this->getValue($this->Gender, 'SelectGenderBox');
    }
    public function getLastPeriodDate(){
        return $this->LastPeriodDate;
    }
    public function getDateBirth(){
        return $this->DateBirth;
    }
    public function getAddress(){
        return $this->Address;
    }
    public function getContractingId(){
        return $this->Contracting;
    }
    public function getContracting(){
        return $this->getValue('Name', $this->Contracting, 'Contracts');
    }
    public function getHours(){
        return $this->Hours;
    }
    public function getDiseaseId(){
        return $this->Disease;
    }
    public function getDisease(){
        if(is_array($this->Disease)){
            $ob = Rays::find(request()->session()->get('userId'));
            $arr = array();
            foreach ($this->Disease as $value)
                array_push($arr, $this->getValue($value, 'CheckBox'));
            return $arr;
        }else
            return $this->Disease;
    }
}
