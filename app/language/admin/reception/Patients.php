<?php
namespace App\language\admin\reception;
use App\instance\admin\contracts\Contracts;
use App\Models\Rays;
use App\instance\admin\reception\Patent;
use App\language\share\PatientInfo;
use App\Menu;
class Patients extends PatientInfo
{
    /**
     * Create a new class instance.
     */    
    public $myPatent = array();
    public $arr1 = array();
    public function __construct($state)
    {
        $ob = Rays::find(request()->session()->get('userId'));
        parent::__construct($ob[$ob['Setting']['Language']]['Error'], $state, 
            $ob['Setting']['Language'], 
            $ob[$ob['Setting']['Language']]['Title']['PatentDelete'],
            $ob[$ob['Setting']['Language']]['Label']['PatentDelete'],
            $ob[$ob['Setting']['Language']]['Button']['PatentDelete'],
            route('deletePatent'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            

            $ob[$ob['Setting']['Language']]['Title']['Patients'],

            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            
    $ob['Branch']?$ob['Branch']:Rays::find(request()->session()->get('userLogout'))['Branch'],
            new Menu($ob[$ob['Setting']['Language']]['Menu'], 'Admin'),
            $ob[$ob['Setting']['Language']]['Title']['AddPatent'],
            $ob[$ob['Setting']['Language']]['Title']['PatentEdit'],
            $ob[$ob['Setting']['Language']]['Button']['PatentAvatar'],
            $ob[$ob['Setting']['Language']]['Button']['AddPatent'],
            $ob[$ob['Setting']['Language']]['Button']['CreatePatent'],
            $ob[$ob['Setting']['Language']]['Table']['PatentEdit'],
            $ob[$ob['Setting']['Language']]['Table']['PatentId'],

            $ob[$ob['Setting']['Language']]['Label']['PatentName'],
            $ob[$ob['Setting']['Language']]['Hint']['PatentName'],
            $ob[$ob['Setting']['Language']]['Label']['PatentNationalId'],
            $ob[$ob['Setting']['Language']]['Hint']['PatentNationalId'],
            $ob[$ob['Setting']['Language']]['Label']['PatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Hint']['PatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Label']['PatentEmail'],
            $ob[$ob['Setting']['Language']]['Hint']['PatentEmail'],
            $ob[$ob['Setting']['Language']]['Label']['PatentPhone'],
            $ob[$ob['Setting']['Language']]['Hint']['PatentPhone'],
            $ob[$ob['Setting']['Language']]['Label']['PatentPhone2'],
            $ob[$ob['Setting']['Language']]['Hint']['PatentPhone2'],
            $ob[$ob['Setting']['Language']]['Label']['PatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Hint']['PatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Label']['PatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Hint']['PatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Label']['PatentAddress'],
            $ob[$ob['Setting']['Language']]['Hint']['PatentAddress'],
            $ob[$ob['Setting']['Language']]['Label']['PatentFastingGours'],
            $ob[$ob['Setting']['Language']]['Hint']['PatentFastingGours'],
            $ob[$ob['Setting']['Language']]['CheckBox'],
            $ob[$ob['Setting']['Language']]['Label']['PatentOther'],
            $ob[$ob['Setting']['Language']]['Hint']['PatentOther']);

            $this->title5 = $ob[$this->language]['Title']['PatentIamge'];
            //init table
            $this->table24 = $ob[$this->language]['Table']['PatentCode'];
            $this->table8 = $ob[$this->language]['Table']['PatentAvatar'];
            $this->table9 = $ob[$this->language]['Table']['PatentName'];
            $this->table10 = $ob[$this->language]['Table']['PatentNationality'];
            $this->table22 = $ob[$this->language]['Table']['PatentNationalId'];
            $this->table12 = $ob[$this->language]['Table']['PatentPassportNo'];
            $this->table13 = $ob[$this->language]['Table']['PatentEmail'];
            $this->table14 = $ob[$this->language]['Table']['PatentPhone'];
            $this->table15 = $ob[$this->language]['Table']['PatentPhone2'];
            $this->table16 = $ob[$this->language]['Table']['PatentGender'];
            $this->table17 = $ob[$this->language]['Table']['PatentLastPeriodDate'];
            $this->table18 = $ob[$this->language]['Table']['PatentDateBirth'];
            $this->table19 = $ob[$this->language]['Table']['PatentContracting'];
            $this->table20 = $ob[$this->language]['Table']['PatentHours'];
            $this->table21 = $ob[$this->language]['Table']['PatentDisease'];
            $this->table23 = $ob[$this->language]['Table']['PatentAddress'];
            //init label
            $this->label3 = $ob[$this->language]['Label']['PatentAvatar'];
            $this->label4 = $ob[$this->language]['Label']['PatentNationality'];
            $this->label9 = $ob[$this->language]['Label']['PatentGender'];
            $this->label13 = $ob[$this->language]['Label']['PatentContracting'];
            $this->nationality = $ob[$this->language]['SelectNationalityBox'];
            $this->gender = $ob[$this->language]['SelectGenderBox'];
            $this->selectBox1 = $ob[$this->language]['SelectBox']['PatentNationality'];
            $this->selectBox2 = $ob[$this->language]['SelectBox']['PatentGender'];
            $this->selectBox5 = $ob[$this->language]['SelectBox']['PatentContracting'];
            //make button
            $this->button4 = $ob[$this->language]['Button']['PatentEdit'];
            //make patent
            if(isset($ob['Patent']))
                foreach ($ob['Patent'] as $key => $patent)
                    $this->myPatent[$key] = new Patent($key, $patent['Avatar'], $patent['Name'], $patent['Nationality'],
                    $patent['NationalId'], $patent['PassportNo'], $patent['Email'], $patent['Phone'],
                    $patent['Phone2'], $patent['Gender'], $patent['LastPeriodDate'], $patent['DateBirth'],
                    $patent['Address'], $patent['Contracting'], $patent['Hours'], $patent['Disease']);
            if(isset($ob['Contracts']))
                foreach ($ob['Contracts'] as $key => $value)
                    $this->arr1[$key] = new Contracts($value['Name']); 
    }
}