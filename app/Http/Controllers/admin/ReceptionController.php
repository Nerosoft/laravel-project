<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rays;
use Illuminate\Validation\Rule;
use App\instance\admin\reception\Receipt;
use App\instance\admin\reception\Patent;
use App\instance\admin\contracts\Contracts;
use App\Http\interface\LangObject;
use App\instance\admin\reception\MyKnows;
use App\language\share\PatientInfo;
use Illuminate\Support\Facades\Route;
use App\Menu;
use App\instance\admin\test_cultures\Test;
use App\instance\admin\test_cultures\Packages;
use App\instance\admin\test_cultures\Cultures;
use Illuminate\Support\Facades\Log;

class ReceptionController extends PatientInfo implements LangObject
{
    private $testArr = array();
    public function __construct(){
        $ob = Rays::find(request()->session()->get('userId'));
        if(Route::currentRouteName() === 'createPatent'){
            request()->validate([
                'avatar' => ['image', 'mimes:jpg,png', 'max:1024', 'dimensions:min_width=300,min_height=300'],
                'patent-name' => ['required', 'min:3'],
                'patent-nationality' => ['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['SelectNationalityBox']))],
                'patent-national-id' => ['required', 'min:3'],
                'patent-passport-no' => ['required', 'min:3'],
                'patent-email' => ['required', 'email'],
                'patent-phone' => ['required', 'regex:/^[0-9]{11}$/'],
                'patent-phone2' => ['required', 'regex:/^[0-9]{11}$/'],
                'patent-gender' => ['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['SelectGenderBox']))],
                'last-period-date' => ['required', 'date'],
                'date-birth' => ['required', 'date'],
                'patent-address' => ['required', 'min:3'],
                'patent-contracting' => ['required', Rule::in(isset($ob['Contracts'])?array_keys($ob['Contracts']):null)],
                'patent-hours' => ['required', 'integer'],
                'choices' => ['required_without:patent-other', 'array'], // Ensure at least one checkbox is selected
                'choices.*'=>[Rule::in(array_keys($ob[$ob['Setting']['Language']]['CheckBox']))],
                'patent-other'=>['required_without:choices', 'nullable', 'min:3'],
                    ], [
                    'patent-name.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentNameRequired'],
                    'patent-name.min'=>$ob[$ob['Setting']['Language']]['Error']['PatentNameInvalid'],
                    'patent-national-id.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentNationalIdRequired'],
                    'patent-national-id.min'=>$ob[$ob['Setting']['Language']]['Error']['PatentNationalIdInvalid'],
                    'patent-passport-no.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentPassportNoRequired'],
                    'patent-passport-no.min'=>$ob[$ob['Setting']['Language']]['Error']['PatentPassportNoInvalid'],
                    'patent-email.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentEmailRequired'],
                    'patent-email.email'=>$ob[$ob['Setting']['Language']]['Error']['PatentEmailInvalid'],
                    'patent-phone.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentPhoneRequired'],
                    'patent-phone.regex'=>$ob[$ob['Setting']['Language']]['Error']['PatentPhoneInvalid'],
                    'patent-phone2.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentPhone2Required'],
                    'patent-phone2.regex'=>$ob[$ob['Setting']['Language']]['Error']['PatentPhone2Invalid'],
                    'patent-address.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentAddressRequired'],
                    'patent-address.min' => $ob[$ob['Setting']['Language']]['Error']['PatentAddressInvalid'], 
                    'patent-hours.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentFastingHoursRequired'],
                    'patent-hours.integer' => $ob[$ob['Setting']['Language']]['Error']['PatentFastingHoursInvalid'],
                    'avatar.dimensions' => $ob[$ob['Setting']['Language']]['Error']['PatentAvatarDimensions'],
                    'patent-nationality.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentNationalityRequired'],
                    'patent-nationality.in'=>$ob[$ob['Setting']['Language']]['Error']['PatentNationalityInvalid'],
                    'patent-gender.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentGenderRequired'],
                    'patent-gender.in'=>$ob[$ob['Setting']['Language']]['Error']['PatentGenderInvalid'],
                    'last-period-date.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentLastPeriodDateRequired'],
                    'last-period-date.date' => $ob[$ob['Setting']['Language']]['Error']['PatentLastPeriodDateInvalid'],
                    'date-birth.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentDateBirthRequired'],
                    'date-birth.date' => $ob[$ob['Setting']['Language']]['Error']['PatentDateBirthInvalid'],
                    'patent-contracting.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentContractingRequired'],
                    'patent-contracting.in' => $ob[$ob['Setting']['Language']]['Error']['PatentContractingInvalid'], 
                    'choices.array' =>$ob[$ob['Setting']['Language']]['Error']['PatentDiseaseInvalid'],
                    'choices.*.in' =>$ob[$ob['Setting']['Language']]['Error']['PatentDiseaseInvalid'],
                    'patent-other.min'=>$ob[$ob['Setting']['Language']]['Error']['PatentDiseasOtherInvalid'],
                    'avatar.image'=> $ob[$ob['Setting']['Language']]['Error']['PatentAvatarImage'],
                    'avatar.mimes'=> $ob[$ob['Setting']['Language']]['Error']['PatentAvatarMimes'],
                    'avatar.max'=> $ob[$ob['Setting']['Language']]['Error']['PatentAvatarMax'],
                    'avatar.uploaded'=>$ob[$ob['Setting']['Language']]['Error']['PatentAvatarImage'],
                    'choices.required_without'=>$ob[$ob['Setting']['Language']]['Error']['PatentDiseaseRequired'],
                    'patent-other.required_without'=>$ob[$ob['Setting']['Language']]['Error']['PatentDiseaseRequired'],
                ]);
            $this->avatar = request()->file('avatar') ? $this->setupImage():null;
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Message']['PatientsAdd'];
            $this->myDbId = $this->generateUniqueIdentifier();
            $this->getCreateDataBase($ob, 'Patent', $this->myDbId, $this);
        }else if(Route::currentRouteName() === 'editPatent'){
            request()->validate([
                'id' => ['required', Rule::in(isset($ob['Patent'])?array_keys($ob['Patent']):array())],
                'avatar' => ['image', 'mimes:jpg,png', 'max:1024', 'dimensions:min_width=300,min_height=300'],
                'patent-name' => ['required', 'min:3'],
                'patent-nationality' => ['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['SelectNationalityBox']))],
                'patent-national-id' => ['required', 'min:3'],
                'patent-passport-no' => ['required', 'min:3'],
                'patent-email' => ['required', 'email'],
                'patent-phone' => ['required', 'regex:/^[0-9]{11}$/'],
                'patent-phone2' => ['required', 'regex:/^[0-9]{11}$/'],
                'patent-gender' => ['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['SelectGenderBox']))],
                'last-period-date' => ['required', 'date'],
                'date-birth' => ['required', 'date'],
                'patent-address' => ['required', 'min:3'],
                'patent-contracting' => ['required', Rule::in(isset($ob['Contracts'])?array_keys($ob['Contracts']):null)],
                'patent-hours' => ['required', 'integer'],
                'choices' => ['required_without:patent-other', 'array'], // Ensure at least one checkbox is selected
                'choices.*'=>[Rule::in(array_keys($ob[$ob['Setting']['Language']]['CheckBox']))],
                'patent-other'=>['required_without:choices', 'nullable', 'min:3'],
                    ], [
                    'id.required' => $ob[$ob['Setting']['Language']]['Error']['PatentIdRequired'],
                    'id.in' => $ob[$ob['Setting']['Language']]['Error']['PatentIdInvalid'],
                    'patent-name.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentNameRequired'],
                    'patent-name.min'=>$ob[$ob['Setting']['Language']]['Error']['PatentNameInvalid'],
                    'patent-national-id.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentNationalIdRequired'],
                    'patent-national-id.min'=>$ob[$ob['Setting']['Language']]['Error']['PatentNationalIdInvalid'],
                    'patent-passport-no.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentPassportNoRequired'],
                    'patent-passport-no.min'=>$ob[$ob['Setting']['Language']]['Error']['PatentPassportNoInvalid'],
                    'patent-email.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentEmailRequired'],
                    'patent-email.email'=>$ob[$ob['Setting']['Language']]['Error']['PatentEmailInvalid'],
                    'patent-phone.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentPhoneRequired'],
                    'patent-phone.regex'=>$ob[$ob['Setting']['Language']]['Error']['PatentPhoneInvalid'],
                    'patent-phone2.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentPhone2Required'],
                    'patent-phone2.regex'=>$ob[$ob['Setting']['Language']]['Error']['PatentPhone2Invalid'],
                    'patent-address.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentAddressRequired'],
                    'patent-address.min' => $ob[$ob['Setting']['Language']]['Error']['PatentAddressInvalid'], 
                    'patent-hours.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentFastingHoursRequired'],
                    'patent-hours.integer' => $ob[$ob['Setting']['Language']]['Error']['PatentFastingHoursInvalid'],
                    'avatar.dimensions' => $ob[$ob['Setting']['Language']]['Error']['PatentAvatarDimensions'],
                    'patent-nationality.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentNationalityRequired'],
                    'patent-nationality.in'=>$ob[$ob['Setting']['Language']]['Error']['PatentNationalityInvalid'],
                    'patent-gender.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentGenderRequired'],
                    'patent-gender.in'=>$ob[$ob['Setting']['Language']]['Error']['PatentGenderInvalid'],
                    'last-period-date.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentLastPeriodDateRequired'],
                    'last-period-date.date' => $ob[$ob['Setting']['Language']]['Error']['PatentLastPeriodDateInvalid'],
                    'date-birth.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentDateBirthRequired'],
                    'date-birth.date' => $ob[$ob['Setting']['Language']]['Error']['PatentDateBirthInvalid'],
                    'patent-contracting.required'=>$ob[$ob['Setting']['Language']]['Error']['PatentContractingRequired'],
                    'patent-contracting.in' => $ob[$ob['Setting']['Language']]['Error']['PatentContractingInvalid'], 
                    'choices.array' =>$ob[$ob['Setting']['Language']]['Error']['PatentDiseaseInvalid'],
                    'choices.*.in' =>$ob[$ob['Setting']['Language']]['Error']['PatentDiseaseInvalid'],
                    'patent-other.min'=>$ob[$ob['Setting']['Language']]['Error']['PatentDiseasOtherInvalid'],
                    'avatar.image'=> $ob[$ob['Setting']['Language']]['Error']['PatentAvatarImage'],
                    'avatar.mimes'=> $ob[$ob['Setting']['Language']]['Error']['PatentAvatarMimes'],
                    'avatar.max'=> $ob[$ob['Setting']['Language']]['Error']['PatentAvatarMax'],
                    'avatar.uploaded'=>$ob[$ob['Setting']['Language']]['Error']['PatentAvatarImage'],
                    'choices.required_without'=>$ob[$ob['Setting']['Language']]['Error']['PatentDiseaseRequired'],
                    'patent-other.required_without'=>$ob[$ob['Setting']['Language']]['Error']['PatentDiseaseRequired'],
                ]);
            $this->avatar = request()->file('avatar') ? $this->setupImage() : $ob['Patent'][request()->input('id')]['Avatar'];
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Message']['PatientsEdit'];
            $this->getEditDataBase($ob, 'Patent', $this);
        }else if(Route::currentRouteName() === 'createPatientServices'){
            request()->validate([
            'item' => ['required', 'array'],
            'item.*' => ['required',
            function ($attribute, $value, $fail) use($ob) {// use for loop
                if (isset($ob['Test'][$value]))
                    array_push($this->testArr, new Test($ob['Test'][$value]['Name'], $ob['Test'][$value]['Shortcut'], $ob['Test'][$value]['Price'], $ob['Test'][$value]['InputOutputLab'], $ob['Test'][$value]['Id']));
                else if(isset($ob['Packages'][$value]))
                    array_push($this->testArr, new Test($ob['Packages'][$value]['Name'], $ob['Packages'][$value]['Shortcut'], $ob['Packages'][$value]['Price'], $ob['Packages'][$value]['InputOutputLab'], $ob['Packages'][$value]['Id']));
                else if(isset($ob['Cultures'][$value]))
                    array_push($this->testArr, new Test($ob['Cultures'][$value]['Name'], $ob['Cultures'][$value]['Shortcut'], $ob['Cultures'][$value]['Price'], $ob['Cultures'][$value]['InputOutputLab'], $ob['Cultures'][$value]['Id']));
                else
                    $fail($ob[$ob['Setting']['Language']]['Error']['PatientRegisterationItemInvalid']);
            },],
            'patentCode' => ['required', Rule::in(isset($ob['Patent'])?array_keys($ob['Patent']):null)],
            'know' => ['required', Rule::in(isset($ob['Knows'])?array_keys($ob['Knows']):null)],
            'discount' => ['required', 'numeric', 'min:0'],
            'delayedMoney' => ['required', 'numeric', 'min:0'],
            'paymentDate' => ['required', 'date'],
            'paymentAmount' => ['required', 'numeric', 'min:0'],
            'paymentMethod' => ['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['PaymentMethodBox']))],
            ],[
                'item.required'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationItemRequired'],
                'item.array'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationItemInvalid'],
                'patentCode.required'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationPatentCodeRequired'],
                'patentCode.in'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationPatentCodeInvalid'],
                'know.required'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationKnowRequired'],
                'know.in'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationKnowInvalid'],
                'discount.required'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationDiscountRequired'],
                'discount.numeric'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationDiscountInvalid'],
                'discount.min'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationDiscountInvalid'],
                'delayedMoney.required'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationDelayedMoneyRequired'],
                'delayedMoney.numeric'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationDelayedMoneyInvalid'],
                'delayedMoney.min'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationDelayedMoneyInvalid'],
                'paymentDate.required'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationPaymentDateRequired'],
                'paymentDate.date'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationPaymentDateInvalid'],
                'paymentAmount.required'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationPaymentAmountRequired'],
                'paymentAmount.numeric'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationPaymentAmountInvalid'],
                'paymentAmount.min'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationPaymentAmountInvalid'],
                'paymentMethod.required'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationPaymentMethodRequired'],
                'paymentMethod.in'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationPaymentMethodInvalid'],
                'item.*.required'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationItemInvalid']
            ]);
            $this->getCreateDataBase($ob, 'Receipt', $this->generateUniqueIdentifier(), $this);
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Message']['PatientRegisterationAdd'];
        }else if(Route::currentRouteName() === 'editPatientServices'){
            request()->validate([
            'id' => ['required', Rule::in(isset($ob['Receipt'])?array_keys($ob['Receipt']):null)],
            'item' => ['required', 'array'],
            'item.*' => ['required',
            function ($attribute, $value, $fail) use($ob) {// use for loop
                if (isset($ob['Test'][$value]))
                    array_push($this->testArr, new Test($ob['Test'][$value]['Name'], $ob['Test'][$value]['Shortcut'], $ob['Test'][$value]['Price'], $ob['Test'][$value]['InputOutputLab'], $ob['Test'][$value]['Id']));
                else if(isset($ob['Packages'][$value]))
                    array_push($this->testArr, new Test($ob['Packages'][$value]['Name'], $ob['Packages'][$value]['Shortcut'], $ob['Packages'][$value]['Price'], $ob['Packages'][$value]['InputOutputLab'], $ob['Packages'][$value]['Id']));
                else if(isset($ob['Cultures'][$value]))
                    array_push($this->testArr, new Test($ob['Cultures'][$value]['Name'], $ob['Cultures'][$value]['Shortcut'], $ob['Cultures'][$value]['Price'], $ob['Cultures'][$value]['InputOutputLab'], $ob['Cultures'][$value]['Id']));
                else
                    $fail($ob[$ob['Setting']['Language']]['Error']['PatientRegisterationItemInvalid']);
            },],
            'patentCode' => ['required', Rule::in(isset($ob['Patent'])?array_keys($ob['Patent']):null)],
            'know' => ['required', Rule::in(isset($ob['Knows'])?array_keys($ob['Knows']):null)],
            'discount' => ['required', 'numeric', 'min:0'],
            'delayedMoney' => ['required', 'numeric', 'min:0'],
            'paymentDate' => ['required', 'date'],
            'paymentAmount' => ['required', 'numeric', 'min:0'],
            'paymentMethod' => ['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['PaymentMethodBox']))],
            ],[
                'id.required'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationIdRequired'],
                'id.in'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationIdInvalid'],
                'item.required'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationItemRequired'],
                'item.array'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationItemInvalid'],
                'patentCode.required'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationPatentCodeRequired'],
                'patentCode.in'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationPatentCodeInvalid'],
                'know.required'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationKnowRequired'],
                'know.in'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationKnowInvalid'],
                'discount.required'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationDiscountRequired'],
                'discount.numeric'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationDiscountInvalid'],
                'discount.min'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationDiscountInvalid'],
                'delayedMoney.required'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationDelayedMoneyRequired'],
                'delayedMoney.numeric'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationDelayedMoneyInvalid'],
                'delayedMoney.min'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationDelayedMoneyInvalid'],
                'paymentDate.required'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationPaymentDateRequired'],
                'paymentDate.date'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationPaymentDateInvalid'],
                'paymentAmount.required'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationPaymentAmountRequired'],
                'paymentAmount.numeric'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationPaymentAmountInvalid'],
                'paymentAmount.min'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationPaymentAmountInvalid'],
                'paymentMethod.required'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationPaymentMethodRequired'],
                'paymentMethod.in'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationPaymentMethodInvalid'],
                'item.*.required'=>$ob[$ob['Setting']['Language']]['Error']['PatientRegisterationItemInvalid']
            ]);
            $this->getEditDataBase($ob, 'Receipt', $this);
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Message']['PatientRegisterationEdit'];
        }else if(Route::currentRouteName() === 'Reception' && request()->route('id') === 'PatientRegisteration'){
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['Title']['DeleteReceipt'],
            $ob[$ob['Setting']['Language']]['Label']['DeleteReceipt'],
            $ob[$ob['Setting']['Language']]['Button']['DeleteReceipt'],
            route('deleteItem', 'Receipt'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Title']['PatientRegisteration'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            $ob['Branch']?$ob['Branch']:Rays::find(request()->session()->get('userLogout'))['Branch'],
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Title']['AddPatientServices'],
            $ob[$ob['Setting']['Language']]['Title']['EditReceipt'],
            $ob[$ob['Setting']['Language']]['Button']['PatientServices'],
            $ob[$ob['Setting']['Language']]['Button']['AddPatientServices'],
            $ob[$ob['Setting']['Language']]['Button']['EditReceipt'],
            $ob[$ob['Setting']['Language']]['Table']['ReceiptId'],
            $ob[$ob['Setting']['Language']]['Table']['ReceiptPatientEdit'],
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
            $this->title5 = $ob[$this->language]['Title']['ReceiptPatient'];  
            $this->myCodePatient = $ob[$this->language]['Label']['PatientCode'];
            //init table
            $this->table28 = $ob[$this->language]['Table']['PatientTestName'];
            $this->table8 = $ob[$this->language]['Table']['PatientTestShortcut'];
            $this->table9 = $ob[$this->language]['Table']['PatientTestState'];
            $this->table10 = $ob[$this->language]['Table']['PatientTestCostBefore'];
            $this->table45 = $ob[$this->language]['Table']['PatientTestCostAfetr'];
            $this->table12 = $ob[$this->language]['Table']['PatientTestDelete'];
            $this->table13 = $ob[$this->language]['Table']['PatientRaysName'];
            $this->table14 = $ob[$this->language]['Table']['PatientRaysPrice'];
            $this->table15 = $ob[$this->language]['Table']['PatientRaysInOut'];
            $this->table16 = $ob[$this->language]['Table']['PatientRaysShortcut'];
            $this->table17 = $ob[$this->language]['Table']['PatientRaysDelete'];
            $this->table18 = $ob[$this->language]['Table']['PatientRaysSubtotal'];
            $this->table19 = $ob[$this->language]['Table']['PatientRaysDiscount'];
            $this->table20 = $ob[$this->language]['Table']['PatientRaysTotalDiscount'];
            $this->table21 = $ob[$this->language]['Table']['PatientRaysTotal'];
            $this->table22 = $ob[$this->language]['Table']['PatientRaysPaid'];
            $this->table23 = $ob[$this->language]['Table']['PatientRaysDue'];
            $this->table24 = $ob[$this->language]['Table']['PatientRaysDelayedMoney'];
            $this->table25 = $ob[$this->language]['Table']['PatientRaysDueUser'];
            $this->table26 = $ob[$this->language]['Table']['PatientRaysEGP'];
            $this->table27 = $ob[$this->language]['Table']['PatientRaysPercent'];
            $this->table29 = $ob[$this->language]['Table']['ReceiptPatientCode'];
            $this->table30 = $ob[$this->language]['Table']['ReceiptPatientName'];
            $this->table31 = $ob[$this->language]['Table']['ReceiptPatientAge'];
            $this->table32 = $ob[$this->language]['Table']['ReceiptPatientPhone'];
            $this->table33 = $ob[$this->language]['Table']['ReceiptPatientTest'];
            $this->table34 = $ob[$this->language]['Table']['ReceiptPatientSubtotal'];
            $this->table35 = $ob[$this->language]['Table']['ReceiptPatientDiscount'];
            $this->table36 = $ob[$this->language]['Table']['ReceiptPatientTotalDiscount'];
            $this->table37 = $ob[$this->language]['Table']['ReceiptPatientTotal'];
            $this->table38 = $ob[$this->language]['Table']['ReceiptPatientPaid'];
            $this->table39 = $ob[$this->language]['Table']['ReceiptPatientDue'];
            $this->table40 = $ob[$this->language]['Table']['ReceiptPatientDelayedMoney'];
            $this->table41 = $ob[$this->language]['Table']['ReceiptPatientDueUser'];
            $this->table42 = $ob[$this->language]['Table']['ReceiptPatientPaymentDate'];
            $this->table43 = $ob[$this->language]['Table']['ReceiptPatientAmountPaid'];
            $this->table44 = $ob[$this->language]['Table']['ReceiptPatientPaymentMethod'];
            $this->error1 = $ob[$this->language]['Error']['PatientRegisterationTestRequired'];
            $this->error8 = $ob[$this->language]['Error']['PatientRegisterationNameRequired'];
            $this->button5 = $ob[$this->language]['Button']['PatientAddTest'];
            $this->button4 = $ob[$this->language]['Button']['PatientDeleteTest'];
            //init label
            $this->label3 = $ob[$this->language]['Label']['PatentNationality'];
            $this->label9 = $ob[$this->language]['Label']['PatentGender'];
            $this->label13 = $ob[$this->language]['Label']['PatentContracting'];
            $this->PatientNameServices = $ob[$this->language]['Label']['PatientNameServices'];
            $this->label18 = $ob[$this->language]['Label']['PatientReceipt'];
            $this->label19 = $ob[$this->language]['Label']['PatientKnow'];
            $this->label20 = $ob[$this->language]['Label']['PatientNewItem'];
            $this->label21 = $ob[$this->language]['Label']['PatientRaysName'];
            $this->label22 = $ob[$this->language]['Label']['PatientRaysOption'];
            $this->label23 = $ob[$this->language]['Label']['PatientPaymentDetails'];
            $this->label24 = $ob[$this->language]['Label']['PatientPaymentDate'];
            $this->label25 = $ob[$this->language]['Label']['PatientAmountPaid'];
            $this->label26 = $ob[$this->language]['Label']['PatientPaymentMethod'];
            $this->label27 = $ob[$this->language]['Label']['PatientEndReceipt'];
            $this->label29 = $ob[$this->language]['Label']['ReceiptNumber'];
            $this->label30 = $ob[$this->language]['Label']['ReceiptDate'];
            $this->label31 = $ob[$this->language]['Label']['ReceiptPatentName'];
            $this->label32 = $ob[$this->language]['Label']['ReceiptPatentCode'];
            $this->label33 = $ob[$this->language]['Label']['ReceiptPatentTestName'];
            $this->label34 = $ob[$this->language]['Label']['ReceiptPatentTestPrice'];
            $this->label35 = $ob[$this->language]['Label']['ReceiptPatentSubtotal'];
            $this->label36 = $ob[$this->language]['Label']['ReceiptPatentTotalDiscount'];
            $this->label37 = $ob[$this->language]['Label']['ReceiptPatentTotal'];
            $this->label38 = $ob[$this->language]['Label']['ReceiptPatentPaymentDate'];
            $this->label39 = $ob[$this->language]['Label']['ReceiptPatentAmountPaid'];
            $this->label40 = $ob[$this->language]['Label']['ReceiptPatentPaymentMethod'];
            $this->label41 = $ob[$this->language]['Label']['ReceiptPatentDue'];
            $this->label42 = $ob[$this->language]['Label']['ReceiptPatentInfo'];
            $this->label43 = $ob[$this->language]['Label']['ReceiptPatientTitle'];
            $this->label45 = $ob[$this->language]['Label']['PatentAvatar'];
            $this->hint12 = $ob[$this->language]['Hint']['PatientCode'];
            $this->hint13 = $ob[$this->language]['Hint']['PatientNationality'];
            $this->hint14 = $ob[$this->language]['Hint']['PatientGender'];
            $this->hint15 = $ob[$this->language]['Hint']['PatientContracting'];
            $this->hint16 = $ob[$this->language]['Hint']['patientAmountPaid'];
            //init selectbox
            $this->selectBox1 = $ob[$this->language]['SelectBox']['PatientPaymentMethod'];
            $this->selectBox2 = $ob[$this->language]['SelectBox']['PatientNameServices'];
            $this->selectBox5 = $ob[$this->language]['SelectBox']['Patientknow'];
            $this->selectBox6 = $ob[$this->language]['SelectBox']['PatientTest'];
            $this->selectBox7 = $ob[$this->language]['SelectBox']['ReceiptPatientPrint'];
            $this->payment = $ob[$this->language]['PaymentMethodBox'];
            $this->allTests = $ob[$this->language]['OptionTestBox'];
            $this->error2 = $ob[$this->language]['Error']['PatientRegisterationPaymentMethodRequired'];
            $this->error3 = $ob[$this->language]['Error']['PatientRegisterationPatentCodeRequired'];
            $this->error4 = $ob[$this->language]['Error']['PatientRegisterationKnowRequired'];
            $this->error5 = $ob[$this->language]['Error']['PatientRegisterationItemRequired'];
            $this->error6 = $ob[$this->language]['Error']['PatientRegisterationPaymentDateRequired'];
            $this->error7 = $ob[$this->language]['Error']['PatientRegisterationPaymentAmountRequired'];
            //add test
            $this->arr2 = isset($ob['Test'])?(array)$ob['Test']:null;
            $this->arr3 = isset($ob['Cultures'])?(array)$ob['Cultures']:null;
            $this->arr4 = isset($ob['Packages'])?(array)$ob['Packages']:null;
            if($this->arr2)
                foreach ($this->arr2 as $key=>$test)
                    $this->arr2[$key]['InputOutputLab'] = $ob[$ob['Setting']['Language']]['SelectTestBox'][$test['InputOutputLab']];
            if($this->arr3)
                foreach ($this->arr3 as $key => $cultures)
                    $this->arr3[$key]['InputOutputLab'] = $ob[$ob['Setting']['Language']]['SelectTestBox'][$test['InputOutputLab']];
            //init Packages
            if($this->arr4)
                foreach ($this->arr4 as $key => $packages)
                    $this->arr4[$key]['InputOutputLab'] = $ob[$ob['Setting']['Language']]['SelectTestBox'][$test['InputOutputLab']];
            $this->myPatent = isset($ob['Patent'])?Patent::fromArray($ob['Patent'], isset($ob['Contracts'])?Contracts::fromArray($ob['Contracts']):array(), $ob[$ob['Setting']['Language']]['SelectGenderBox'], $ob[$ob['Setting']['Language']]['SelectNationalityBox'], $ob[$ob['Setting']['Language']]['CheckBox']):array();
            $this->arr1 = isset($ob['Knows']) ? MyKnows::fromArray($ob['Knows']):array();
            $this->arr6 = isset($ob['Receipt'])?Receipt::fromArray2($ob['Receipt'], $this->myPatent, $this->arr1, $ob[$ob['Setting']['Language']]['SelectTestBox'], $ob[$ob['Setting']['Language']]['PaymentMethodBox']):array();
        }else //if(Route::currentRouteName() === 'Reception' && request()->route('id') === 'Patients')
        {
            parent::__construct($ob['Setting']['Language'], 
            $ob[$ob['Setting']['Language']]['Title']['PatentDelete'],
            $ob[$ob['Setting']['Language']]['Label']['PatentDelete'],
            $ob[$ob['Setting']['Language']]['Button']['PatentDelete'],
            route('deleteItem', 'Patent'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Title']['Patients'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            $ob['Branch']?$ob['Branch']:Rays::find(request()->session()->get('userLogout'))['Branch'],
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
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
            $this->error1 = $ob[$this->language]['Error']['PatentNameRequired'];
            $this->error2 = $ob[$this->language]['Error']['PatentNameInvalid'];
            $this->error3 = $ob[$this->language]['Error']['PatentNationalIdRequired'];
            $this->error4 = $ob[$this->language]['Error']['PatentNationalIdInvalid'];
            $this->error5 = $ob[$this->language]['Error']['PatentPassportNoRequired'];
            $this->error6 = $ob[$this->language]['Error']['PatentPassportNoInvalid'];
            $this->error7 = $ob[$this->language]['Error']['PatentEmailRequired'];
            $this->error8 = $ob[$this->language]['Error']['PatentEmailInvalid'];
            $this->error9 = $ob[$this->language]['Error']['PatentPhoneRequired'];
            $this->error10 = $ob[$this->language]['Error']['PatentPhoneInvalid'];
            $this->error11 = $ob[$this->language]['Error']['PatentPhone2Required'];
            $this->error12 = $ob[$this->language]['Error']['PatentPhone2Invalid'];
            $this->error13 = $ob[$this->language]['Error']['PatentAddressRequired'];
            $this->error14 = $ob[$this->language]['Error']['PatentAddressInvalid'];
            $this->error15 = $ob[$this->language]['Error']['PatentFastingHoursRequired'];
            $this->error16 = $ob[$this->language]['Error']['PatentDiseaseRequired'];
            $this->error17 = $ob[$this->language]['Error']['PatentNationalityRequired'];
            $this->error18 = $ob[$this->language]['Error']['PatentGenderRequired'];
            $this->error19 = $ob[$this->language]['Error']['PatentLastPeriodDateRequired'];
            $this->error20 = $ob[$this->language]['Error']['PatentDateBirthRequired'];
            $this->error21 = $ob[$this->language]['Error']['PatentContractingRequired'];
            $this->error22 = $ob[$this->language]['Error']['PatentDiseasOtherInvalid'];
            $this->error23 = $ob[$this->language]['Error']['PatentAvatarImage'];
            $this->error32 = $ob[$this->language]['Error']['PatentAvatarMax'];
            $this->PatentAvatarDimensions = $ob[$this->language]['Error']['PatentAvatarDimensions'];
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
            $this->myContract = isset($ob['Contracts'])?Contracts::fromArray($ob['Contracts']):array();
            $this->myPatent = isset($ob['Patent'])?Patent::fromArray($ob['Patent'], $this->myContract, $ob[$ob['Setting']['Language']]['SelectGenderBox'], $ob[$ob['Setting']['Language']]['SelectNationalityBox'], $ob[$ob['Setting']['Language']]['CheckBox']):array();
        }
    }
    public function index($id){
        return view($id !== 'Patients'? 'admin.reception.patientRegisteration':'admin.reception.patients', [
            'lang'=> $this,
            'active'=>'Reception',
            'activeItem'=>$id,
        ]);
    }  
    public function action(){
        return back()->with('success', $this->successfully1);
    }
    public function action2(){
         return response()->json([
                'success' => true,
                'message'=>$this->successfully1
            ]);
    }
    private function setupImage(){
        return 'data:' . request()->file('avatar')->getClientMimeType() . ';base64,' . base64_encode(file_get_contents(request()->file('avatar')));
    }
    public function getMyObject(){
        if(Route::currentRouteName() === 'createPatientServices' || Route::currentRouteName() === 'editPatientServices')
            return (new Receipt(request()->input('know'), $this->testArr, (int)request()->input('discount'), (int)request()->input('delayedMoney'), request()->input('paymentDate'), (int)request()->input('paymentAmount'), request()->input('paymentMethod'), request()->input('patentCode')))->getObject();
        else
            return array('PatentCode'=>isset($this->myDbId)?$this->myDbId:request()->input('id'), 'Avatar'=>$this->avatar, 'Name'=>request()->input('patent-name'), 'Nationality'=>request()->input('patent-nationality'), 'NationalId'=>request()->input('patent-national-id'), 'PassportNo'=>request()->input('patent-passport-no'), 'Email'=>request()->input('patent-email'), 'Phone'=>request()->input('patent-phone'), 'Phone2'=>request()->input('patent-phone2'), 'Gender'=>request()->input('patent-gender'), 'LastPeriodDate'=>request()->input('last-period-date'), 'DateBirth'=>request()->input('date-birth'), 'Address'=>request()->input('patent-address'), 'Contracting'=>request()->input('patent-contracting'), 'Hours'=>request()->input('patent-hours'), 'Disease'=>request()->input('patent-other') ? request()->input('patent-other'): request()->input('choices'));
    }
}
