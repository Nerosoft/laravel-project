<?php

namespace App\instance\admin\reception;
use App\Models\Rays;
use Illuminate\Support\Str;
use Carbon\Carbon;
class Patent
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
    protected $PatentCode;
    
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
    public function getObjectPateint(){
        return get_object_vars($this);
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
    public function getLastPeriodDate(){
        return $this->LastPeriodDate;
    }
    public function getDateBirth(){
        return $this->DateBirth;
    }
    public function getDateBirth2(){
        return (int)Carbon::parse($this->getDateBirth())->diffInYears(Carbon::now());
    }
    public function getAddress(){
        return $this->Address;
    }
    public function getContractingId(){
        return $this->Contracting;
    }
    public function getHours(){
        return $this->Hours;
    }
    public function getDiseaseId(){
        return $this->Disease;
    }
    public static function fromArray(array $data, $contract, $gender, $nationality, $dis): array {
        $patent = array();
        foreach ($data as $key=>$data){
            if(is_string($data['Disease']))
                $patent[$key] = new Patent($key, $data['Avatar'], $data['Name'], 
                $nationality[$data['Nationality']],
                $data['NationalId'], $data['PassportNo'], $data['Email'], $data['Phone'],
                $data['Phone2'],
                $gender[$data['Gender']], $data['LastPeriodDate'], $data['DateBirth'],
                $data['Address'],
                isset($contract[$data['Contracting']])?$contract[$data['Contracting']]->getName():null,
                $data['Hours'],
                $data['Disease']);
            else{
                $myDis = array();
                foreach ($data['Disease'] as $value)
                    $myDis[$value] = $dis[$value];
                $patent[$key] = new Patent($key, $data['Avatar'], $data['Name'], 
                $nationality[$data['Nationality']],
                $data['NationalId'], $data['PassportNo'], $data['Email'], $data['Phone'],
                $data['Phone2'],
                $gender[$data['Gender']], $data['LastPeriodDate'], $data['DateBirth'],
                $data['Address'],
                isset($contract[$data['Contracting']])?$contract[$data['Contracting']]->getName():null,
                $data['Hours'],
                $myDis);
            }
        }
        return $patent;
    }
}
