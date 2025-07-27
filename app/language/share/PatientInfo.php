<?php
namespace App\language\share;
use App\Http\interface\ValidRule;
use App\Http\interface\initValid;
use App\Http\interface\initView;
class PatientInfo extends Page{
    protected function __construct(ValidRule|initView|initValid $ob, $state){
        $this->myPat = $ob->getDataBase()['Patent'];
        $this->dis = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['CheckBox'];
        parent::__construct($ob, $state);

    }
    public function getDataBase(){
        return $this->ob;
    }
    protected function callConst($state){
        $this->labelPatient = $this->getDataBase()[$this->language][$state]['LabelPatentAvatar'];
        $this->label16 = $this->getDataBase()[$this->language][$state]['LabelPatentName'];
        $this->hint1 = $this->getDataBase()[$this->language][$state]['HintPatentName'];
        $this->label5 = $this->getDataBase()[$this->language][$state]['LabelPatentNationalId'];
        $this->hint4 = $this->getDataBase()[$this->language][$state]['HintPatentNationalId'];
        $this->label6 = $this->getDataBase()[$this->language][$state]['LabelPatentPassportNo'];
        $this->hint5 = $this->getDataBase()[$this->language][$state]['HintPatentPassportNo'];
        $this->label17 = $this->getDataBase()[$this->language][$state]['LabelPatentEmail'];
        $this->hint2 = $this->getDataBase()[$this->language][$state]['HintPatentEmail'];
        $this->label7 = $this->getDataBase()[$this->language][$state]['LabelPatentPhone'];
        $this->hint6 = $this->getDataBase()[$this->language][$state]['HintPatentPhone'];
        $this->label8 = $this->getDataBase()[$this->language][$state]['LabelPatentPhone2'];
        $this->hint7 = $this->getDataBase()[$this->language][$state]['HintPatentPhone2'];
        $this->label10 = $this->getDataBase()[$this->language][$state]['LabelPatentLastPeriodDate'];
        $this->hint9 = $this->getDataBase()[$this->language][$state]['HintPatentLastPeriodDate'];
        $this->label11 = $this->getDataBase()[$this->language][$state]['LabelPatentDateBirth'];
        $this->hint10 = $this->getDataBase()[$this->language][$state]['HintPatentDateBirth'];
        $this->label12 = $this->getDataBase()[$this->language][$state]['LabelPatentAddress'];
        $this->hint11 = $this->getDataBase()[$this->language][$state]['HintPatentAddress'];
        $this->label14 = $this->getDataBase()[$this->language][$state]['LabelPatentFastingGours'];
        $this->hint3 = $this->getDataBase()[$this->language][$state]['HintPatentFastingGours'];
        $this->label15 = $this->getDataBase()[$this->language][$state]['LabelPatentOther'];
        $this->hint8 = $this->getDataBase()[$this->language][$state]['HintPatentOther'];
    }
}