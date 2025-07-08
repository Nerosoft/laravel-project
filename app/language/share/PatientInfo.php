<?php
namespace App\language\share;
class PatientInfo extends Page{
    protected function __construct($Language, $TitleDeleteTest, $LabelDeleteTest, $ButtonDeleteTest, $RouteDeleteTest, $TableInfo, $Title, $AppSettingAdmin, $Direction, $Branch, $Menu, $title2, $title3, $button1, $button2, $button3, $table7, $table11,
    $labelPatient, $label16, $hint1, $label5, $hint4, $label6, $hint5, $label17, $hint2,
    $label7, $hint6, $label8, $hint7, $label10, $hint9, $label11, $hint10,
    $label12, $hint11, $label14, $hint3, $dis, $label15, $hint8, $tableData = array()){
        parent::__construct($Language, $TitleDeleteTest, $LabelDeleteTest, $ButtonDeleteTest, $RouteDeleteTest, $TableInfo, $Title, $AppSettingAdmin, $Direction, $Branch, $Menu, $title2, $title3, $button1, $button2, $button3, $table7, $table11, $tableData);
        $this->labelPatient = $labelPatient;
        $this->label16 = $label16;
        $this->hint1 = $hint1; 
        $this->label5 = $label5; 
        $this->hint4 = $hint4; 
        $this->label6 = $label6; 
        $this->hint5 = $hint5; 
        $this->label17 = $label17; 
        $this->hint2 = $hint2;
        $this->label7 = $label7; 
        $this->hint6 = $hint6; 
        $this->label8 = $label8; 
        $this->hint7 = $hint7; 
        $this->label10 = $label10; 
        $this->hint9 = $hint9; 
        $this->label11 = $label11; 
        $this->hint10 = $hint10;
        $this->label12 = $label12; 
        $this->hint11 = $hint11; 
        $this->label14 = $label14; 
        $this->hint3 = $hint3; 
        $this->dis = $dis; 
        $this->label15 = $label15; 
        $this->hint8 = $hint8;
    }
}