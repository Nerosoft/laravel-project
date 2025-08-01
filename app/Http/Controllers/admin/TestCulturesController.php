<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\interface\LangObject;
use App\language\share\Page;
use Illuminate\Support\Facades\Route;
use App\instance\admin\test_cultures\Test;
use App\Models\Rays;

use App\Http\interface\ValidRule;
use App\Http\interface\PageTable;

use App\instance\admin\reception\MyKnows;
use App\instance\admin\contracts\Contracts;
use App\instance\admin\reception\Patent;
use App\instance\admin\reception\Receipt;
use App\instance\admin\Branch;
use Illuminate\Support\Str;

class TestCulturesController extends Page implements LangObject, ValidRule, PageTable
{
    public function getDataBase(){
        return $this->ob;
    }
    public function getTableData(){
        if(request()->route('id') === 'Knows')
            return $this->getDataBase()[request()->route('id')]?MyKnows::fromArray(array_reverse($this->getDataBase()[request()->route('id')])):array();
        else if(request()->route('id') === 'Contracts')
            return $this->getDataBase()[request()->route('id')]?Contracts::fromArray(array_reverse($this->getDataBase()[request()->route('id')])):array();
        else if(request()->route('id') === 'Patent'){
            $this->myContract = isset($this->getDataBase()['Contracts'])?Contracts::fromArray($this->getDataBase()['Contracts']):array();                
            return $this->myPat?Patent::fromArray(array_reverse($this->myPat), $this->myContract, $this->getDataBase()[$this->language]['SelectGenderBox'], $this->getDataBase()[$this->language]['SelectNationalityBox'], $this->dis):array();     
        }
        else if(request()->route('id') === 'Receipt'){
            $this->myPatent = isset($this->myPat)?Patent::fromArray($this->myPat, isset($this->getDataBase()['Contracts'])?Contracts::fromArray($this->getDataBase()['Contracts']):array(), $this->getDataBase()[$this->language]['SelectGenderBox'], $this->getDataBase()[$this->language]['SelectNationalityBox'], $this->getDataBase()[$this->language]['CheckBox']):array();
            $this->arr1 = isset($this->getDataBase()['Knows']) ? MyKnows::fromArray($this->getDataBase()['Knows']):array();        
            return $this->getDataBase()[request()->route('id')]?Receipt::fromArray2(array_reverse($this->getDataBase()[request()->route('id')]),$this->myPatent, $this->arr1, $this->getDataBase()[$this->language]['SelectTestBox'],$this->payment):array();
        }
        else if(request()->route('id') === 'Branch')
            return Rays::find(request()->session()->get('userLogout'))['Branch']?Branch::fromArray(array_reverse(Rays::find(request()->session()->get('userLogout'))['Branch']), $this->getDataBase()[$this->language]['SelectBranchBox']):array();
        else
            return $this->getDataBase()[request()->route('id')]?Test::fromArray(array_reverse($this->getDataBase()[request()->route('id')]), $this->inputOutPut):array();
    }
    public function getRouteDelete(){
        if(request()->route('id') === 'Branch')
            return route('branch.delete');
        else
            return route('deleteItem', request()->route('id'));
    }
    public function getValidRule(){
        $this->successfulyMessage = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['MessageModelEdit'];
        if(request()->route('id') === 'Branch')
            array_push($this->roll['id'], Rule::in(array_keys((array)Rays::find(request()->session()->get('userLogout'))['Branch'])));
        else
            array_push($this->roll['id'], Rule::in(array_keys((array)$this->getDataBase()[request()->route('id')])));
        $this->initValid();
    }
    public function initView(){
        if(request()->route('id') === 'Knows'){
            $this->table8 = $this->getDataBase()[$this->language]['Knows']['TableKnowsName'];
            $this->label3 = $this->getDataBase()[$this->language]['Knows']['LabelKnowsName'];
            $this->hint1 = $this->getDataBase()[$this->language]['Knows']['HintKnowsName'];
        }
        else if(request()->route('id') === 'Contracts'){
            $this->table8 = $this->getDataBase()[$this->language]['Contracts']['TableContractName'];
            $this->table9 = $this->getDataBase()[$this->language]['Contracts']['TableContractGovernorate'];
            $this->table10 = $this->getDataBase()[$this->language]['Contracts']['TableContractArea'];
            $this->label3 = $this->getDataBase()[$this->language]['Contracts']['LabelContractName'];
            $this->label4 = $this->getDataBase()[$this->language]['Contracts']['LabelContractGovernorate'];
            $this->label5 = $this->getDataBase()[$this->language]['Contracts']['LabelContractArea'];
            $this->hint1 = $this->getDataBase()[$this->language]['Contracts']['HintContractName'];
            $this->hint2 = $this->getDataBase()[$this->language]['Contracts']['HintContractGovernorate'];
            $this->hint3 = $this->getDataBase()[$this->language]['Contracts']['HintContractArea'];
        }
        else if(request()->route('id') === 'Patent'){
            $this->callConst();
            $this->title5 = $this->getDataBase()[$this->language]['Patent']['PatentIamge'];
            $this->ButtonImage = $this->getDataBase()[$this->language]['Patent']['ButtonImage'];
            //init table
            $this->table24 = $this->getDataBase()[$this->language]['Patent']['TablePatentCode'];
            $this->table8 = $this->getDataBase()[$this->language]['Patent']['TablePatentAvatar'];
            $this->table9 = $this->getDataBase()[$this->language]['Patent']['TablePatentName'];
            $this->table10 = $this->getDataBase()[$this->language]['Patent']['TablePatentNationality'];
            $this->table22 = $this->getDataBase()[$this->language]['Patent']['TablePatentNationalId'];
            $this->table12 = $this->getDataBase()[$this->language]['Patent']['TablePatentPassportNo'];
            $this->table13 = $this->getDataBase()[$this->language]['Patent']['TablePatentEmail'];
            $this->table14 = $this->getDataBase()[$this->language]['Patent']['TablePatentPhone'];
            $this->table15 = $this->getDataBase()[$this->language]['Patent']['TablePatentPhone2'];
            $this->table16 = $this->getDataBase()[$this->language]['Patent']['TablePatentGender'];
            $this->table17 = $this->getDataBase()[$this->language]['Patent']['TablePatentLastPeriodDate'];
            $this->table18 = $this->getDataBase()[$this->language]['Patent']['TablePatentDateBirth'];
            $this->table19 = $this->getDataBase()[$this->language]['Patent']['TablePatentContracting'];
            $this->table20 = $this->getDataBase()[$this->language]['Patent']['TablePatentHours'];
            $this->table21 = $this->getDataBase()[$this->language]['Patent']['TablePatentDisease'];
            $this->table23 = $this->getDataBase()[$this->language]['Patent']['TablePatentAddress'];
            //init label
            $this->label4 = $this->getDataBase()[$this->language]['Patent']['LabelPatentNationality'];
            $this->label9 = $this->getDataBase()[$this->language]['Patent']['LabelPatentGender'];
            $this->label13 = $this->getDataBase()[$this->language]['Patent']['LabelPatentContracting'];
            $this->selectBox1 = $this->getDataBase()[$this->language]['Patent']['SelectBoxPatentNationality'];
            $this->selectBox2 = $this->getDataBase()[$this->language]['Patent']['SelectBoxPatentGender'];
            $this->selectBox5 = $this->getDataBase()[$this->language]['Patent']['SelectBoxPatentContracting'];
        }
        else if(request()->route('id') === 'Receipt'){
            $this->callConst();
            $this->title5 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatient'];  
            $this->myCodePatient = $this->getDataBase()[$this->language][request()->route('id')]['PatientCode'];
            //init table
            $this->table13 = $this->getDataBase()[$this->language][request()->route('id')]['PatientRaysName'];
            $this->table14 = $this->getDataBase()[$this->language][request()->route('id')]['PatientRaysPrice'];
            $this->table15 = $this->getDataBase()[$this->language][request()->route('id')]['PatientRaysInOut'];
            $this->table16 = $this->getDataBase()[$this->language][request()->route('id')]['PatientRaysShortcut'];
            $this->table17 = $this->getDataBase()[$this->language][request()->route('id')]['PatientRaysDelete'];
            $this->table18 = $this->getDataBase()[$this->language][request()->route('id')]['PatientRaysSubtotal'];
            $this->table19 = $this->getDataBase()[$this->language][request()->route('id')]['PatientRaysDiscount'];
            $this->table20 = $this->getDataBase()[$this->language][request()->route('id')]['PatientRaysTotalDiscount'];
            $this->table21 = $this->getDataBase()[$this->language][request()->route('id')]['PatientRaysTotal'];
            $this->table22 = $this->getDataBase()[$this->language][request()->route('id')]['PatientRaysPaid'];
            $this->table23 = $this->getDataBase()[$this->language][request()->route('id')]['PatientRaysDue'];
            $this->table24 = $this->getDataBase()[$this->language][request()->route('id')]['PatientRaysDelayedMoney'];
            $this->table25 = $this->getDataBase()[$this->language][request()->route('id')]['PatientRaysDueUser'];
            $this->table26 = $this->getDataBase()[$this->language][request()->route('id')]['PatientRaysEGP'];
            $this->table27 = $this->getDataBase()[$this->language][request()->route('id')]['PatientRaysPercent'];
            $this->table29 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatientCode'];
            $this->table30 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatientName'];
            $this->table31 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatientAge'];
            $this->table32 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatientPhone'];
            $this->table33 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatientTest'];
            $this->table34 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatientSubtotal'];
            $this->table35 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatientDiscount'];
            $this->table36 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatientTotalDiscount'];
            $this->table37 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatientTotal'];
            $this->table38 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatientPaid'];
            $this->table39 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatientDue'];
            $this->table40 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatientDelayedMoney'];
            $this->table41 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatientDueUser'];
            $this->table42 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatientPaymentDate'];
            $this->table43 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatientAmountPaid'];
            $this->table44 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatientPaymentMethod'];
            $this->error1 = $this->getDataBase()[$this->language][request()->route('id')]['PatientRegisterationTestRequired'];
            $this->error8 = $this->getDataBase()[$this->language][request()->route('id')]['PatientRegisterationNameRequired'];
            $this->button5 = $this->getDataBase()[$this->language][request()->route('id')]['PatientAddTest'];
            $this->button4 = $this->getDataBase()[$this->language][request()->route('id')]['PatientDeleteTest'];
            //init label
            $this->label3 = $this->getDataBase()[$this->language][request()->route('id')]['PatentNationality'];
            $this->label9 = $this->getDataBase()[$this->language][request()->route('id')]['PatentGender'];
            $this->label13 = $this->getDataBase()[$this->language][request()->route('id')]['PatentContracting'];
            $this->PatientNameServices = $this->getDataBase()[$this->language][request()->route('id')]['PatientNameServices'];
            $this->label18 = $this->getDataBase()[$this->language][request()->route('id')]['PatientReceipt'];
            $this->label19 = $this->getDataBase()[$this->language][request()->route('id')]['PatientKnow'];
            $this->label20 = $this->getDataBase()[$this->language][request()->route('id')]['PatientNewItem'];
            $this->label21 = $this->getDataBase()[$this->language][request()->route('id')]['PatientRaysName'];
            $this->label22 = $this->getDataBase()[$this->language][request()->route('id')]['PatientRaysOption'];
            $this->label23 = $this->getDataBase()[$this->language][request()->route('id')]['PatientPaymentDetails'];
            $this->label24 = $this->getDataBase()[$this->language][request()->route('id')]['PatientPaymentDate'];
            $this->label25 = $this->getDataBase()[$this->language][request()->route('id')]['PatientAmountPaid'];
            $this->label26 = $this->getDataBase()[$this->language][request()->route('id')]['PatientPaymentMethod'];
            $this->label27 = $this->getDataBase()[$this->language][request()->route('id')]['PatientEndReceipt'];
            $this->label29 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptNumber'];
            $this->label30 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptDate'];
            $this->label31 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatentName'];
            $this->label32 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatentCode'];
            $this->label33 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatentTestName'];
            $this->label34 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatentTestPrice'];
            $this->label35 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatentSubtotal'];
            $this->label36 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatentTotalDiscount'];
            $this->label37 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatentTotal'];
            $this->label38 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatentPaymentDate'];
            $this->label39 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatentAmountPaid'];
            $this->label40 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatentPaymentMethod'];
            $this->label41 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatentDue'];
            $this->label42 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatentInfo'];
            $this->label43 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatientTitle'];
            $this->hint12 = $this->getDataBase()[$this->language][request()->route('id')]['HintPatientCode'];
            $this->hint13 = $this->getDataBase()[$this->language][request()->route('id')]['HintPatientNationality'];
            $this->hint14 = $this->getDataBase()[$this->language][request()->route('id')]['HintPatientGender'];
            $this->hint15 = $this->getDataBase()[$this->language][request()->route('id')]['HintPatientContracting'];
            $this->hint16 = $this->getDataBase()[$this->language][request()->route('id')]['HintpatientAmountPaid'];
            //init selectbox
            $this->selectBox1 = $this->getDataBase()[$this->language][request()->route('id')]['PatientPaymentMethod'];
            $this->selectBox2 = $this->getDataBase()[$this->language][request()->route('id')]['PatientNameServices'];
            $this->selectBox5 = $this->getDataBase()[$this->language][request()->route('id')]['Patientknow'];
            $this->selectBox6 = $this->getDataBase()[$this->language][request()->route('id')]['PatientTest'];
            $this->selectBox7 = $this->getDataBase()[$this->language][request()->route('id')]['ReceiptPatientPrint'];
            $this->allTests = $this->getDataBase()[$this->language]['OptionTestBox'];
            //add test
            if(!empty($this->arr2))
                foreach ($this->arr2 as $key=>$test)
                    $this->arr2[$key]['InputOutputLab'] = $this->getDataBase()[$this->language]['SelectTestBox'][$test['InputOutputLab']];
            if(!empty($this->arr3))
                foreach ($this->arr3 as $key => $cultures)
                    $this->arr3[$key]['InputOutputLab'] = $this->getDataBase()[$this->language]['SelectTestBox'][$cultures['InputOutputLab']];
            //init Packages
            if(!empty($this->arr4))
                foreach ($this->arr4 as $key => $packages)
                    $this->arr4[$key]['InputOutputLab'] = $this->getDataBase()[$this->language]['SelectTestBox'][$packages['InputOutputLab']];
            
        }else if(request()->route('id') === 'Branch'){
            $this->table8 = $this->getDataBase()[$this->language]['Branch']['BranchStreet'];
            $this->table9 = $this->getDataBase()[$this->language]['Branch']['BranchName'];
            $this->table10 = $this->getDataBase()[$this->language]['Branch']['BranchPhone'];
            $this->table16 = $this->getDataBase()[$this->language]['Branch']['BranchGovernments'];
            $this->table17 = $this->getDataBase()[$this->language]['Branch']['BranchCity'];
            $this->table12 = $this->getDataBase()[$this->language]['Branch']['BranchBuilding'];
            $this->table13 = $this->getDataBase()[$this->language]['Branch']['BranchAddress'];
            $this->table14 = $this->getDataBase()[$this->language]['Branch']['BranchCountry'];
            $this->table15 = $this->getDataBase()[$this->language]['Branch']['BranchFollow'];
            //get all hint
            $this->hint1 = $this->getDataBase()[$this->language]['Branch']['BranchRaysName'];
            $this->hint2 = $this->getDataBase()[$this->language]['Branch']['BranchRaysPhone'];
            $this->hint3 = $this->getDataBase()[$this->language]['Branch']['BranchRaysCountry'];
            $this->hint4 = $this->getDataBase()[$this->language]['Branch']['BranchRaysGovernments'];
            $this->hint5 = $this->getDataBase()[$this->language]['Branch']['BranchRaysCity'];
            $this->hint6 = $this->getDataBase()[$this->language]['Branch']['BranchRaysStreet'];
            $this->hint7 = $this->getDataBase()[$this->language]['Branch']['BranchRaysBuilding'];
            $this->hint8 = $this->getDataBase()[$this->language]['Branch']['BranchRaysAddress'];
            $this->selectBox1 = $this->getDataBase()[$this->language]['Branch']['WithRaysOut'];
        }
        else{
            $this->table8 = $this->getDataBase()[$this->language][request()->route('id')]['TableName'];
            $this->table9 = $this->getDataBase()[$this->language][request()->route('id')]['TablePrice'];
            $this->table10 = $this->getDataBase()[$this->language][request()->route('id')]['TableInputOutput'];
            $this->table12 = $this->getDataBase()[$this->language][request()->route('id')]['TableShortcut'];
            $this->label3 = $this->getDataBase()[$this->language][request()->route('id')]['LabelName'];
            $this->label4 = $this->getDataBase()[$this->language][request()->route('id')]['LabelPrice'];
            $this->label5 = $this->getDataBase()[$this->language][request()->route('id')]['LabelInputOutLab'];
            $this->label7 = $this->getDataBase()[$this->language][request()->route('id')]['LabelShortcut'];
            $this->selectBox1 = $this->getDataBase()[$this->language][request()->route('id')]['InputOutLab'];
            $this->hint1 = $this->getDataBase()[$this->language][request()->route('id')]['HintName'];
            $this->hint2 = $this->getDataBase()[$this->language][request()->route('id')]['HintPrice'];
            $this->hint3 = $this->getDataBase()[$this->language][request()->route('id')]['HintShortcut'];
        }
    }
    public function initValid(){
        if(request()->route('id') === 'Knows'){
            $this->roll['name'] = ['required', 'min:3'];
            $this->message['name.required'] = $this->error1;
            $this->message['name.min'] = $this->error2;
        }
        else if(request()->route('id') === 'Contracts'){
            $this->roll['name'] = ['required', 'min:3'];
            $this->roll['governorate'] = ['required', 'min:3'];
            $this->roll['area'] = ['required', 'min:3'];
            $this->message['name.required'] = $this->error1;
            $this->message['name.min'] = $this->error2;
            $this->message['governorate.required'] = $this->error3;
            $this->message['governorate.min'] = $this->error4;
            $this->message['area.required'] = $this->error5;
            $this->message['area.min'] = $this->error6;
        }
        else if(request()->route('id') === 'Patent'){
            $this->roll['avatar' ] = ['image', 'mimes:jpg,png', 'max:1024', 'dimensions:min_width=300,min_height=300'];
            $this->roll['patent-name' ] = ['required', 'min:3'];
            $this->roll['patent-nationality' ] = ['required', Rule::in(array_keys($this->nationality))];
            $this->roll['patent-national-id' ] = ['required', 'min:3'];
            $this->roll['patent-passport-no' ] = ['required', 'min:3'];
            $this->roll['patent-email' ] = ['required', 'email'];
            $this->roll['patent-phone' ] = ['required', 'regex:/^[0-9]{11}$/'];
            $this->roll['patent-phone2' ] = ['required', 'regex:/^[0-9]{11}$/'];
            $this->roll['patent-gender' ] = ['required', Rule::in(array_keys($this->gender))];
            $this->roll['last-period-date' ] = ['required', 'date'];
            $this->roll['date-birth' ] = ['required', 'date'];
            $this->roll['patent-address' ] = ['required', 'min:3'];
            $this->roll['patent-contracting' ] = ['required', Rule::in(array_keys((array)$this->getDataBase()['Contracts']))];
            $this->roll['patent-hours' ] = ['required', 'integer'];
            $this->roll['choices' ] = ['required_without:patent-other', 'array']; // Ensure at least one checkbox is selected
            $this->roll['choices.*'] = [Rule::in(array_keys($this->dis))];
            $this->roll['patent-other'] = ['required_without:choices', 'nullable', 'min:3'];
            $this->message['patent-name.required'] = $this->error1;
            $this->message['patent-name.min'] = $this->error2;
            $this->message['patent-national-id.required'] = $this->error3;
            $this->message['patent-national-id.min'] = $this->error4;
            $this->message['patent-passport-no.required'] = $this->error5;
            $this->message['patent-passport-no.min'] = $this->error6;
            $this->message['patent-email.required'] = $this->error7;
            $this->message['patent-email.email'] = $this->error8;
            $this->message['patent-phone.required'] = $this->error9;
            $this->message['patent-phone.regex'] = $this->error10;
            $this->message['patent-phone2.required'] = $this->error11;
            $this->message['patent-phone2.regex'] = $this->error12;
            $this->message['patent-address.required'] =$this->error13;
            $this->message['patent-address.min' ] = $this->error14; 
            $this->message['patent-hours.required'] = $this->error15;
            $this->message['patent-hours.integer' ] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentFastingHoursInvalid'];
            $this->message['avatar.dimensions' ] = $this->PatentAvatarDimensions;
            $this->message['patent-nationality.required'] =$this->error17;
            $this->message['patent-nationality.in'] =$this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentNationalityInvalid'];
            $this->message['patent-gender.required'] =$this->error18;
            $this->message['patent-gender.in'] =$this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentGenderInvalid'];
            $this->message['last-period-date.required'] =$this->error19;
            $this->message['last-period-date.date' ] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentLastPeriodDateInvalid'];
            $this->message['date-birth.required'] =$this->error20;
            $this->message['date-birth.date' ] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentDateBirthInvalid'];
            $this->message['patent-contracting.required'] =$this->error21;
            $this->message['patent-contracting.in' ] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentContractingInvalid']; 
            $this->message['choices.array' ] =$this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentDiseaseInvalid'];
            $this->message['choices.*.in' ] =$this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentDiseaseInvalid'];
            $this->message['patent-other.min'] =$this->error22;
            $this->message['avatar.image'] = $this->error23;
            $this->message['avatar.mimes'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentAvatarMimes'];
            $this->message['avatar.max'] = $this->error32;
            $this->message['avatar.uploaded'] =$this->error23;
            $this->message['choices.required_without'] =$this->error16;
            $this->message['patent-other.required_without'] =$this->error16;
        }
        else if(request()->route('id') === 'Receipt'){
            $this->testArr = array();
            $this->roll['item'] = ['required', 'array'];
            $this->roll['item.*'] = ['required',
                function ($attribute, $value, $fail) {// use for loop
                    if (isset($this->arr2[$value]))
                        array_push($this->testArr, new Test($this->arr2[$value]['Name'], $this->arr2[$value]['Shortcut'], $this->arr2[$value]['Price'], $this->arr2[$value]['InputOutputLab'], $this->arr2[$value]['Id']));
                    else if(isset($this->arr4[$value]))
                        array_push($this->testArr, new Test($this->arr4[$value]['Name'], $this->arr4[$value]['Shortcut'], $this->arr4[$value]['Price'], $this->arr4[$value]['InputOutputLab'], $this->arr4[$value]['Id']));
                    else if(isset($this->arr3[$value]))
                        array_push($this->testArr, new Test($this->arr3[$value]['Name'], $this->arr3[$value]['Shortcut'], $this->arr3[$value]['Price'], $this->arr3[$value]['InputOutputLab'], $this->arr3[$value]['Id']));
                    else
                        $fail($this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Receipt']['PatientRegisterationItemInvalid']);
                },];
            $this->roll['patentCode'] = ['required', Rule::in(array_keys($this->myPat))];
            $this->roll['know'] = ['required', Rule::in(array_keys((array)$this->getDataBase()['Knows']))];
            $this->roll['discount'] = ['required', 'numeric', 'min:0'];
            $this->roll['delayedMoney'] = ['required', 'numeric', 'min:0'];
            $this->roll['paymentDate'] = ['required', 'date'];
            $this->roll['paymentAmount'] = ['required', 'numeric', 'min:0'];
            $this->roll['paymentMethod'] = ['required', Rule::in(array_keys($this->payment))];
            $this->message['item.required'] = $this->error5;
            $this->message['item.array'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Receipt']['PatientRegisterationItemInvalid'];
            $this->message['patentCode.required'] = $this->error3;
            $this->message['patentCode.in'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Receipt']['PatientRegisterationPatentCodeInvalid'];
            $this->message['know.required'] = $this->error4;
            $this->message['know.in'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Receipt']['PatientRegisterationKnowInvalid'];
            $this->message['discount.required'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Receipt']['PatientRegisterationDiscountRequired'];
            $this->message['discount.numeric'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Receipt']['PatientRegisterationDiscountInvalid'];
            $this->message['discount.min'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Receipt']['PatientRegisterationDiscountInvalid'];
            $this->message['delayedMoney.required'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Receipt']['PatientRegisterationDelayedMoneyRequired'];
            $this->message['delayedMoney.numeric'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Receipt']['PatientRegisterationDelayedMoneyInvalid'];
            $this->message['delayedMoney.min'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Receipt']['PatientRegisterationDelayedMoneyInvalid'];
            $this->message['paymentDate.required'] = $this->error6;
            $this->message['paymentDate.date'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Receipt']['PatientRegisterationPaymentDateInvalid'];
            $this->message['paymentAmount.required'] = $this->error7;
            $this->message['paymentAmount.numeric'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Receipt']['PatientRegisterationPaymentAmountInvalid'];
            $this->message['paymentAmount.min'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Receipt']['PatientRegisterationPaymentAmountInvalid'];
            $this->message['paymentMethod.required'] = $this->error2;
            $this->message['paymentMethod.in'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Receipt']['PatientRegisterationPaymentMethodInvalid'];
            $this->message['item.*.required'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Receipt']['PatientRegisterationItemInvalid'];
        }else if(request()->route('id') === 'Branch'){
            $this->roll['brance_rays_name'] = ['required', 'min:3'];
            $this->roll['brance_rays_phone'] = ['required', 'regex:/^[0-9]{11}$/'];
            $this->roll['brance_rays_governments'] = ['required', 'min:3'];
            $this->roll['brance_rays_city'] = ['required', 'min:3'];
            $this->roll['brance_rays_street'] = ['required', 'min:3'];
            $this->roll['brance_rays_building'] = ['required', 'min:3'];
            $this->roll['brance_rays_address'] = ['required', 'min:3'];
            $this->roll['brance_rays_country'] = ['required', 'min:3'];
            $this->roll['brance_rays_follow'] = ['required', Rule::in(array_keys($this->branchInputOutput))];
            $this->message['brance_rays_name.min'] = $this->error10;
            $this->message['brance_rays_name.required'] = $this->error1;
            $this->message['brance_rays_phone.regex'] = $this->error11;
            $this->message['brance_rays_phone.required'] = $this->error2;
            $this->message['brance_rays_governments.min'] = $this->error12;
            $this->message['brance_rays_governments.required'] = $this->error3;
            $this->message['brance_rays_city.min'] = $this->error13;
            $this->message['brance_rays_city.required'] = $this->error4;
            $this->message['brance_rays_street.min'] = $this->error14;
            $this->message['brance_rays_street.required'] = $this->error5;
            $this->message['brance_rays_building.min'] = $this->error15;
            $this->message['brance_rays_building.required'] = $this->error6;
            $this->message['brance_rays_address.min'] = $this->error16;
            $this->message['brance_rays_address.required'] = $this->error7;
            $this->message['brance_rays_country.min'] = $this->error17;
            $this->message['brance_rays_country.required'] = $this->error8;
            $this->message['brance_rays_follow.required'] = $this->error9;
            $this->message['brance_rays_follow.in'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Branch']['BranceRaysFollowValue'];
        }
        else{
            $this->roll['name'] = ['required', 'min:3'];
            $this->roll['shortcut'] = ['required', 'min:3'];
            $this->roll['price'] = ['required', 'integer'];
            $this->roll['input-output-lab'] = ['required', Rule::in(array_keys($this->inputOutPut))];
            $this->message['name.required'] = $this->error1;
            $this->message['name.min'] = $this->error2;
            $this->message['shortcut.required'] = $this->error9;
            $this->message['shortcut.min'] = $this->error10;
            $this->message['price.required'] = $this->error3;
            $this->message['price.integer'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PriceInvalid'];
            $this->message['input-output-lab.required'] = $this->error4;
            $this->message['input-output-lab.in'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['InputOutputLabInvalid'];
        }
    }
    public function __construct(){
        $this->ob = Rays::find(request()->session()->get('userId'));
        if(request()->route('id') === 'Knows'){
            $this->error1 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['KnowsNameRequired'];
            $this->error2 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['KnowsNameInvalid'];
        }else if(request()->route('id') === 'Contracts'){
            $this->error1 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['ContractNameRequired'];
            $this->error2 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['ContractNameInvalid'];
            $this->error3 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['ContractGovernorateRequired'];
            $this->error4 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['ContractGovernorateInvalid'];
            $this->error5 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['ContractAreaRequired'];
            $this->error6 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['ContractAreaInvalid'];
        }else if(request()->route('id') === 'Patent'){
            $this->error1 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentNameRequired'];
            $this->error2 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentNameInvalid'];
            $this->error3 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentNationalIdRequired'];
            $this->error4 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentNationalIdInvalid'];
            $this->error5 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentPassportNoRequired'];
            $this->error6 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentPassportNoInvalid'];
            $this->error7 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentEmailRequired'];
            $this->error8 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentEmailInvalid'];
            $this->error9 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentPhoneRequired'];
            $this->error10 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentPhoneInvalid'];
            $this->error11 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentPhone2Required'];
            $this->error12 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentPhone2Invalid'];
            $this->error13 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentAddressRequired'];
            $this->error14 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentAddressInvalid'];
            $this->error15 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentFastingHoursRequired'];
            $this->error16 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentDiseaseRequired'];
            $this->error17 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentNationalityRequired'];
            $this->error18 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentGenderRequired'];
            $this->error19 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentLastPeriodDateRequired'];
            $this->error20 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentDateBirthRequired'];
            $this->error21 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentContractingRequired'];
            $this->error22 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentDiseasOtherInvalid'];
            $this->error23 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentAvatarImage'];
            $this->error32 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentAvatarMax'];
            $this->PatentAvatarDimensions = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PatentAvatarDimensions'];
            $this->gender = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['SelectGenderBox'];
            $this->nationality = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['SelectNationalityBox'];
            $this->myPat = (array)$this->getDataBase()['Patent'];
            $this->dis = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['CheckBox']; 
        }else if(request()->route('id') === 'Receipt'){
            $this->error2 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Receipt']['PatientRegisterationPaymentMethodRequired'];
            $this->error3 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Receipt']['PatientRegisterationPatentCodeRequired'];
            $this->error4 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Receipt']['PatientRegisterationKnowRequired'];
            $this->error5 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Receipt']['PatientRegisterationItemRequired'];
            $this->error6 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Receipt']['PatientRegisterationPaymentDateRequired'];
            $this->error7 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Receipt']['PatientRegisterationPaymentAmountRequired'];
            $this->payment = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['PaymentMethodBox'];
            $this->arr2 = (array)$this->getDataBase()['Test'];
            $this->arr3 = (array)$this->getDataBase()['Cultures'];
            $this->arr4 = (array)$this->getDataBase()['Packages'];
            $this->myPat = (array)$this->getDataBase()['Patent'];
            $this->dis = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['CheckBox']; 
        }else if(request()->route('id') === 'Branch'){
            $this->error1 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Branch']['BranceRaysNameRequired'];
            $this->error2 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Branch']['BranceRaysPhoneRequired'];
            $this->error3 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Branch']['BranceRaysGovernmentsRequired'];
            $this->error4 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Branch']['BranceRaysCityRequired'];
            $this->error5 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Branch']['BranceRaysStreetRequired'];
            $this->error6 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Branch']['BranceRaysBuildingRequired'];
            $this->error7 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Branch']['BranceRaysAddressRequired'];
            $this->error8 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Branch']['BranceRaysCountryRequired'];
            $this->error9 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Branch']['BranceRaysFollowRequired'];
            $this->error10 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Branch']['BranceRaysNameLength'];
            $this->error11 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Branch']['BranceRaysPhoneLength'];
            $this->error12 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Branch']['BranceRaysGovernmentsLength'];
            $this->error13 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Branch']['BranceRaysCityLength'];
            $this->error14 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Branch']['BranceRaysStreetLength'];
            $this->error15 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Branch']['BranceRaysBuildingLength'];
            $this->error16 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Branch']['BranceRaysAddressLength'];
            $this->error17 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Branch']['BranceRaysCountryLength'];
            $this->branchInputOutput = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['SelectBranchBox'];
        }
        else{
            $this->error1 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['NameRequired'];
            $this->error2 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['NameInvalid'];
            $this->error9 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['ShortcutRequired'];
            $this->error10 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['ShortcutInvalid'];
            $this->error3 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['PriceRequired'];
            $this->error4 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['InputOutputLabRequired'];
            $this->inputOutPut = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['SelectTestBox'];
        }
        parent::__construct($this, request()->route('id'));
    }
    public function index($id){
        if($id === 'Knows')
            return view('admin.contracts.knows',[
                    'lang'=> $this,
                    'active'=>'TestCultures',
                    'activeItem'=>$id,        
            ]);
        else if($id === 'Contracts')
            return view('admin.contracts.packages_contracts',[
                    'lang'=> $this,
                    'active'=>'TestCultures',
                    'activeItem'=>$id,        
            ]);
        else if($id === 'Patent')
            return view('admin.reception.patients',[
                    'lang'=> $this,
                    'active'=>'TestCultures',
                    'activeItem'=>$id,        
            ]);
        else if($id === 'Receipt')
        return view('admin.reception.patientRegisteration', [
                    'lang'=> $this,
                    'active'=>'TestCultures',
                    'activeItem'=>$id,        
            ]);
        else if($id === 'Branch')
            return view('admin.branches',[
                'lang'=> $this,
                'active'=>'TestCultures',
                'activeItem'=>$id,
            ]);
        else
            return view('admin.test_cultures.all_test_cultures',[
                    'lang'=> $this,
                    'active'=>'TestCultures',
                    'activeItem'=>$id,        
            ]);
    }
    public function makeAddTest($id){
        $this->getCreateDataBase($id === 'Branch'?Rays::find(request()->session()->get('userLogout')):$this->getDataBase(), $id, $id === 'Branch'?Str::uuid()->toString():$this->generateUniqueIdentifier(), $this);
        if($id === 'Receipt')
            return response()->json([
                'success' => true,
                'message'=>$this->successfulyMessage
            ]);
        else if($id === 'Branch'){
            //conver model database to array        
            $myBranch = $this->getDataBase()->toArray();
            //delete object user
            unset($myBranch['User']);
            unset($myBranch['Branch']);
            //save brance name in _id 
            $myBranch['_id'] = array_keys(Rays::find(request()->session()->get('userLogout'))['Branch'])[count(Rays::find(request()->session()->get('userLogout'))['Branch']) - 1];
            //insert the object in database
            Rays::insert($myBranch);
        }
        return back()->with('success', $this->successfulyMessage);
    }
    public function makeEditTest($id){
        $this->getEditDataBase($id === 'Branch'?Rays::find(request()->session()->get('userLogout')):$this->getDataBase(), $id, $this);
        return $id === 'Receipt'?response()->json([
            'success' => true,
            'message'=>$this->successfulyMessage
        ]):back()->with('success', $this->successfulyMessage);
    }
    public function getMyObject($myDbId = null){
        request()->validate($this->roll, $this->message);
        if(request()->route('id') === 'Knows')
            return array('Name'=>request()->input('name'));
        else if(request()->route('id') === 'Contracts')
            return array('Name'=>request()->input('name'), 'Governorate'=>request()->input('governorate'), 'Area'=>request()->input('area'));
        else if(request()->route('id') === 'Patent')
            return array('PatentCode'=>$myDbId?$myDbId:request()->input('id'), 'Avatar'=>request()->file('avatar') ? $this->setupImage():(isset($this->myPat[request()->input('id')]['Avatar'])?$this->myPat[request()->input('id')]['Avatar']:null),'Name'=>request()->input('patent-name'), 'Nationality'=>request()->input('patent-nationality'), 'NationalId'=>request()->input('patent-national-id'), 'PassportNo'=>request()->input('patent-passport-no'), 'Email'=>request()->input('patent-email'), 'Phone'=>request()->input('patent-phone'), 'Phone2'=>request()->input('patent-phone2'), 'Gender'=>request()->input('patent-gender'), 'LastPeriodDate'=>request()->input('last-period-date'), 'DateBirth'=>request()->input('date-birth'), 'Address'=>request()->input('patent-address'), 'Contracting'=>request()->input('patent-contracting'), 'Hours'=>request()->input('patent-hours'), 'Disease'=>request()->input('patent-other') ? request()->input('patent-other'): request()->input('choices'));
        else if(request()->route('id') === 'Receipt')
            return (new Receipt(request()->input('know'), $this->testArr, (int)request()->input('discount'), (int)request()->input('delayedMoney'), request()->input('paymentDate'), (int)request()->input('paymentAmount'), request()->input('paymentMethod'), request()->input('patentCode')))->getObject();
        else if(request()->route('id') === 'Branch')
            return array('Name'=>request()->input('brance_rays_name'),
            'Phone'=>request()->input('brance_rays_phone'),
            'Governments'=>request()->input('brance_rays_governments'),
            'City'=>request()->input('brance_rays_city'),
            'Street'=>request()->input('brance_rays_street'),
            'Building'=>request()->input('brance_rays_building'),
            'Address'=>request()->input('brance_rays_address'),
            'Country'=>request()->input('brance_rays_country'),
            'Follow'=>request()->input('brance_rays_follow'));
        else
            return array('Name'=>request()->input('name'), 'Shortcut'=>request()->input('shortcut'), 'Price'=>request()->input('price'), 'InputOutputLab'=>request()->input('input-output-lab'), 'Id'=>$myDbId?$myDbId:request()->input('id'));
    }
    private function setupImage(){
        return 'data:' . request()->file('avatar')->getClientMimeType() . ';base64,' . base64_encode(file_get_contents(request()->file('avatar')));
    }
    protected function callConst(){
        $this->labelPatient = $this->getDataBase()[$this->language][request()->route('id')]['LabelPatentAvatar'];
        $this->label16 = $this->getDataBase()[$this->language][request()->route('id')]['LabelPatentName'];
        $this->hint1 = $this->getDataBase()[$this->language][request()->route('id')]['HintPatentName'];
        $this->label5 = $this->getDataBase()[$this->language][request()->route('id')]['LabelPatentNationalId'];
        $this->hint4 = $this->getDataBase()[$this->language][request()->route('id')]['HintPatentNationalId'];
        $this->label6 = $this->getDataBase()[$this->language][request()->route('id')]['LabelPatentPassportNo'];
        $this->hint5 = $this->getDataBase()[$this->language][request()->route('id')]['HintPatentPassportNo'];
        $this->label17 = $this->getDataBase()[$this->language][request()->route('id')]['LabelPatentEmail'];
        $this->hint2 = $this->getDataBase()[$this->language][request()->route('id')]['HintPatentEmail'];
        $this->label7 = $this->getDataBase()[$this->language][request()->route('id')]['LabelPatentPhone'];
        $this->hint6 = $this->getDataBase()[$this->language][request()->route('id')]['HintPatentPhone'];
        $this->label8 = $this->getDataBase()[$this->language][request()->route('id')]['LabelPatentPhone2'];
        $this->hint7 = $this->getDataBase()[$this->language][request()->route('id')]['HintPatentPhone2'];
        $this->label10 = $this->getDataBase()[$this->language][request()->route('id')]['LabelPatentLastPeriodDate'];
        $this->hint9 = $this->getDataBase()[$this->language][request()->route('id')]['HintPatentLastPeriodDate'];
        $this->label11 = $this->getDataBase()[$this->language][request()->route('id')]['LabelPatentDateBirth'];
        $this->hint10 = $this->getDataBase()[$this->language][request()->route('id')]['HintPatentDateBirth'];
        $this->label12 = $this->getDataBase()[$this->language][request()->route('id')]['LabelPatentAddress'];
        $this->hint11 = $this->getDataBase()[$this->language][request()->route('id')]['HintPatentAddress'];
        $this->label14 = $this->getDataBase()[$this->language][request()->route('id')]['LabelPatentFastingGours'];
        $this->hint3 = $this->getDataBase()[$this->language][request()->route('id')]['HintPatentFastingGours'];
        $this->label15 = $this->getDataBase()[$this->language][request()->route('id')]['LabelPatentOther'];
        $this->hint8 = $this->getDataBase()[$this->language][request()->route('id')]['HintPatentOther'];
    }
}
