<?php
namespace App\language\admin\reception;
use App\instance\admin\contracts\Contracts;
use App\Models\Rays;
use App\instance\admin\reception\Patent;
use App\language\share\Page;
use App\Menu;
class Patients extends Page
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
            $ob[$ob['Setting']['Language']]['Table']['PatentId']);

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
            $this->label5 = $ob[$this->language]['Label']['PatentNationalId'];
            $this->label6 = $ob[$this->language]['Label']['PatentPassportNo'];
            $this->label7 = $ob[$this->language]['Label']['PatentPhone'];
            $this->label8 = $ob[$this->language]['Label']['PatentPhone2'];
            $this->label9 = $ob[$this->language]['Label']['PatentGender'];
            $this->label10 = $ob[$this->language]['Label']['PatentLastPeriodDate'];
            $this->label11 = $ob[$this->language]['Label']['PatentDateBirth'];
            $this->label12 = $ob[$this->language]['Label']['PatentAddress'];
            $this->label13 = $ob[$this->language]['Label']['PatentContracting'];
            $this->label14 = $ob[$this->language]['Label']['PatentFastingGours'];
            $this->label15 = $ob[$this->language]['Label']['PatentOther'];
            $this->label16 = $ob[$this->language]['Label']['PatentName'];
            $this->label17 = $ob[$this->language]['Label']['PatentEmail'];

            $this->nationality = $ob[$this->language]['SelectNationalityBox'];
            $this->gender = $ob[$this->language]['SelectGenderBox'];
            $this->dis = $ob[$this->language]['CheckBox'];

            $this->selectBox1 = $ob[$this->language]['SelectBox']['PatentNationality'];
            $this->selectBox2 = $ob[$this->language]['SelectBox']['PatentGender'];
            $this->selectBox5 = $ob[$this->language]['SelectBox']['PatentContracting'];
            //make button
           
            $this->button4 = $ob[$this->language]['Button']['PatentEdit'];
            //make hint
            $this->hint1 = $ob[$this->language]['Hint']['PatentName'];
            $this->hint2 = $ob[$this->language]['Hint']['PatentEmail'];
            $this->hint4 = $ob[$this->language]['Hint']['PatentNationalId'];
            $this->hint5 = $ob[$this->language]['Hint']['PatentPassportNo'];
            $this->hint6 = $ob[$this->language]['Hint']['PatentPhone'];
            $this->hint7 = $ob[$this->language]['Hint']['PatentPhone2'];
            $this->hint9 = $ob[$this->language]['Hint']['PatentLastPeriodDate'];
            $this->hint10 = $ob[$this->language]['Hint']['PatentDateBirth'];
            $this->hint11 = $ob[$this->language]['Hint']['PatentAddress'];
            $this->hint3 = $ob[$this->language]['Hint']['PatentFastingGours'];
            $this->hint8 = $ob[$this->language]['Hint']['PatentOther'];
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