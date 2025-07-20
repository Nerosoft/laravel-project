<?php
namespace App\language\share;
use App\Http\interface\ActionInit;

class PatientInfo extends Page{
    protected function __construct(ActionInit $actionInit, $state, $ob){
        parent::__construct($actionInit, $state, $ob);
        $this->labelPatient = $this->ob[$this->ob['Setting']['Language']][$state]['LabelPatentAvatar'];
        $this->label16 = $this->ob[$this->ob['Setting']['Language']][$state]['LabelPatentName'];
        $this->hint1 = $this->ob[$this->ob['Setting']['Language']][$state]['HintPatentName'];
        $this->label5 = $this->ob[$this->ob['Setting']['Language']][$state]['LabelPatentNationalId'];
        $this->hint4 = $this->ob[$this->ob['Setting']['Language']][$state]['HintPatentNationalId'];
        $this->label6 = $this->ob[$this->ob['Setting']['Language']][$state]['LabelPatentPassportNo'];
        $this->hint5 = $this->ob[$this->ob['Setting']['Language']][$state]['HintPatentPassportNo'];
        $this->label17 = $this->ob[$this->ob['Setting']['Language']][$state]['LabelPatentEmail'];
        $this->hint2 = $this->ob[$this->ob['Setting']['Language']][$state]['HintPatentEmail'];
        $this->label7 = $this->ob[$this->ob['Setting']['Language']][$state]['LabelPatentPhone'];
        $this->hint6 = $this->ob[$this->ob['Setting']['Language']][$state]['HintPatentPhone'];
        $this->label8 = $this->ob[$this->ob['Setting']['Language']][$state]['LabelPatentPhone2'];
        $this->hint7 = $this->ob[$this->ob['Setting']['Language']][$state]['HintPatentPhone2'];
        $this->label10 = $this->ob[$this->ob['Setting']['Language']][$state]['LabelPatentLastPeriodDate'];
        $this->hint9 = $this->ob[$this->ob['Setting']['Language']][$state]['HintPatentLastPeriodDate'];
        $this->label11 = $this->ob[$this->ob['Setting']['Language']][$state]['LabelPatentDateBirth'];
        $this->hint10 = $this->ob[$this->ob['Setting']['Language']][$state]['HintPatentDateBirth'];
        $this->label12 = $this->ob[$this->ob['Setting']['Language']][$state]['LabelPatentAddress'];
        $this->hint11 = $this->ob[$this->ob['Setting']['Language']][$state]['HintPatentAddress'];
        $this->label14 = $this->ob[$this->ob['Setting']['Language']][$state]['LabelPatentFastingGours'];
        $this->hint3 = $this->ob[$this->ob['Setting']['Language']][$state]['HintPatentFastingGours'];
        $this->dis = $this->ob[$this->ob['Setting']['Language']]['CheckBox'];
        $this->label15 = $this->ob[$this->ob['Setting']['Language']][$state]['LabelPatentOther'];
        $this->hint8 = $this->ob[$this->ob['Setting']['Language']][$state]['HintPatentOther'];
    }
}