<?php
namespace App\language\share;
class PatientInfo extends Page{
    protected function __construct($state, $ob, $tableData){
        parent::__construct(route('deleteItem', $state), $state, $ob, $tableData);
        $this->labelPatient = $ob[$ob['Setting']['Language']][$state]['LabelPatentAvatar'];
        $this->label16 = $ob[$ob['Setting']['Language']][$state]['LabelPatentName'];
        $this->hint1 = $ob[$ob['Setting']['Language']][$state]['HintPatentName'];
        $this->label5 = $ob[$ob['Setting']['Language']][$state]['LabelPatentNationalId'];
        $this->hint4 = $ob[$ob['Setting']['Language']][$state]['HintPatentNationalId'];
        $this->label6 = $ob[$ob['Setting']['Language']][$state]['LabelPatentPassportNo'];
        $this->hint5 = $ob[$ob['Setting']['Language']][$state]['HintPatentPassportNo'];
        $this->label17 = $ob[$ob['Setting']['Language']][$state]['LabelPatentEmail'];
        $this->hint2 = $ob[$ob['Setting']['Language']][$state]['HintPatentEmail'];
        $this->label7 = $ob[$ob['Setting']['Language']][$state]['LabelPatentPhone'];
        $this->hint6 = $ob[$ob['Setting']['Language']][$state]['HintPatentPhone'];
        $this->label8 = $ob[$ob['Setting']['Language']][$state]['LabelPatentPhone2'];
        $this->hint7 = $ob[$ob['Setting']['Language']][$state]['HintPatentPhone2'];
        $this->label10 = $ob[$ob['Setting']['Language']][$state]['LabelPatentLastPeriodDate'];
        $this->hint9 = $ob[$ob['Setting']['Language']][$state]['HintPatentLastPeriodDate'];
        $this->label11 = $ob[$ob['Setting']['Language']][$state]['LabelPatentDateBirth'];
        $this->hint10 = $ob[$ob['Setting']['Language']][$state]['HintPatentDateBirth'];
        $this->label12 = $ob[$ob['Setting']['Language']][$state]['LabelPatentAddress'];
        $this->hint11 = $ob[$ob['Setting']['Language']][$state]['HintPatentAddress'];
        $this->label14 = $ob[$ob['Setting']['Language']][$state]['LabelPatentFastingGours'];
        $this->hint3 = $ob[$ob['Setting']['Language']][$state]['HintPatentFastingGours'];
        $this->dis = $ob[$ob['Setting']['Language']]['CheckBox'];
        $this->label15 = $ob[$ob['Setting']['Language']][$state]['LabelPatentOther'];
        $this->hint8 = $ob[$ob['Setting']['Language']][$state]['HintPatentOther'];
    }
}