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
use App\instance\admin\Branch;

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
                    'patent-name.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentNameRequired'],
                    'patent-name.min'=>$ob[$ob['Setting']['Language']]['Patent']['PatentNameInvalid'],
                    'patent-national-id.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentNationalIdRequired'],
                    'patent-national-id.min'=>$ob[$ob['Setting']['Language']]['Patent']['PatentNationalIdInvalid'],
                    'patent-passport-no.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentPassportNoRequired'],
                    'patent-passport-no.min'=>$ob[$ob['Setting']['Language']]['Patent']['PatentPassportNoInvalid'],
                    'patent-email.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentEmailRequired'],
                    'patent-email.email'=>$ob[$ob['Setting']['Language']]['Patent']['PatentEmailInvalid'],
                    'patent-phone.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentPhoneRequired'],
                    'patent-phone.regex'=>$ob[$ob['Setting']['Language']]['Patent']['PatentPhoneInvalid'],
                    'patent-phone2.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentPhone2Required'],
                    'patent-phone2.regex'=>$ob[$ob['Setting']['Language']]['Patent']['PatentPhone2Invalid'],
                    'patent-address.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentAddressRequired'],
                    'patent-address.min' => $ob[$ob['Setting']['Language']]['Patent']['PatentAddressInvalid'], 
                    'patent-hours.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentFastingHoursRequired'],
                    'patent-hours.integer' => $ob[$ob['Setting']['Language']]['Patent']['PatentFastingHoursInvalid'],
                    'avatar.dimensions' => $ob[$ob['Setting']['Language']]['Patent']['PatentAvatarDimensions'],
                    'patent-nationality.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentNationalityRequired'],
                    'patent-nationality.in'=>$ob[$ob['Setting']['Language']]['Patent']['PatentNationalityInvalid'],
                    'patent-gender.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentGenderRequired'],
                    'patent-gender.in'=>$ob[$ob['Setting']['Language']]['Patent']['PatentGenderInvalid'],
                    'last-period-date.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentLastPeriodDateRequired'],
                    'last-period-date.date' => $ob[$ob['Setting']['Language']]['Patent']['PatentLastPeriodDateInvalid'],
                    'date-birth.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentDateBirthRequired'],
                    'date-birth.date' => $ob[$ob['Setting']['Language']]['Patent']['PatentDateBirthInvalid'],
                    'patent-contracting.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentContractingRequired'],
                    'patent-contracting.in' => $ob[$ob['Setting']['Language']]['Patent']['PatentContractingInvalid'], 
                    'choices.array' =>$ob[$ob['Setting']['Language']]['Patent']['PatentDiseaseInvalid'],
                    'choices.*.in' =>$ob[$ob['Setting']['Language']]['Patent']['PatentDiseaseInvalid'],
                    'patent-other.min'=>$ob[$ob['Setting']['Language']]['Patent']['PatentDiseasOtherInvalid'],
                    'avatar.image'=> $ob[$ob['Setting']['Language']]['Patent']['PatentAvatarImage'],
                    'avatar.mimes'=> $ob[$ob['Setting']['Language']]['Patent']['PatentAvatarMimes'],
                    'avatar.max'=> $ob[$ob['Setting']['Language']]['Patent']['PatentAvatarMax'],
                    'avatar.uploaded'=>$ob[$ob['Setting']['Language']]['Patent']['PatentAvatarImage'],
                    'choices.required_without'=>$ob[$ob['Setting']['Language']]['Patent']['PatentDiseaseRequired'],
                    'patent-other.required_without'=>$ob[$ob['Setting']['Language']]['Patent']['PatentDiseaseRequired'],
                ]);
            $this->avatar = request()->file('avatar') ? $this->setupImage():null;
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Patent']['PatientsAdd'];
            $this->myDbId = $this->generateUniqueIdentifier();
            $this->getCreateDataBase($ob, 'Patent', $this->myDbId, $this);
        }else if(Route::currentRouteName() === 'editPatent' && $ob['Patent']){
            request()->validate([
                'id' => ['required', Rule::in(array_keys($ob['Patent']))],
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
                    'id.required' => $ob[$ob['Setting']['Language']]['Patent']['IdIsReq'],
                    'id.in' => $ob[$ob['Setting']['Language']]['Patent']['IdIsInv'],
                    'patent-name.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentNameRequired'],
                    'patent-name.min'=>$ob[$ob['Setting']['Language']]['Patent']['PatentNameInvalid'],
                    'patent-national-id.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentNationalIdRequired'],
                    'patent-national-id.min'=>$ob[$ob['Setting']['Language']]['Patent']['PatentNationalIdInvalid'],
                    'patent-passport-no.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentPassportNoRequired'],
                    'patent-passport-no.min'=>$ob[$ob['Setting']['Language']]['Patent']['PatentPassportNoInvalid'],
                    'patent-email.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentEmailRequired'],
                    'patent-email.email'=>$ob[$ob['Setting']['Language']]['Patent']['PatentEmailInvalid'],
                    'patent-phone.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentPhoneRequired'],
                    'patent-phone.regex'=>$ob[$ob['Setting']['Language']]['Patent']['PatentPhoneInvalid'],
                    'patent-phone2.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentPhone2Required'],
                    'patent-phone2.regex'=>$ob[$ob['Setting']['Language']]['Patent']['PatentPhone2Invalid'],
                    'patent-address.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentAddressRequired'],
                    'patent-address.min' => $ob[$ob['Setting']['Language']]['Patent']['PatentAddressInvalid'], 
                    'patent-hours.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentFastingHoursRequired'],
                    'patent-hours.integer' => $ob[$ob['Setting']['Language']]['Patent']['PatentFastingHoursInvalid'],
                    'avatar.dimensions' => $ob[$ob['Setting']['Language']]['Patent']['PatentAvatarDimensions'],
                    'patent-nationality.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentNationalityRequired'],
                    'patent-nationality.in'=>$ob[$ob['Setting']['Language']]['Patent']['PatentNationalityInvalid'],
                    'patent-gender.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentGenderRequired'],
                    'patent-gender.in'=>$ob[$ob['Setting']['Language']]['Patent']['PatentGenderInvalid'],
                    'last-period-date.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentLastPeriodDateRequired'],
                    'last-period-date.date' => $ob[$ob['Setting']['Language']]['Patent']['PatentLastPeriodDateInvalid'],
                    'date-birth.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentDateBirthRequired'],
                    'date-birth.date' => $ob[$ob['Setting']['Language']]['Patent']['PatentDateBirthInvalid'],
                    'patent-contracting.required'=>$ob[$ob['Setting']['Language']]['Patent']['PatentContractingRequired'],
                    'patent-contracting.in' => $ob[$ob['Setting']['Language']]['Patent']['PatentContractingInvalid'], 
                    'choices.array' =>$ob[$ob['Setting']['Language']]['Patent']['PatentDiseaseInvalid'],
                    'choices.*.in' =>$ob[$ob['Setting']['Language']]['Patent']['PatentDiseaseInvalid'],
                    'patent-other.min'=>$ob[$ob['Setting']['Language']]['Patent']['PatentDiseasOtherInvalid'],
                    'avatar.image'=> $ob[$ob['Setting']['Language']]['Patent']['PatentAvatarImage'],
                    'avatar.mimes'=> $ob[$ob['Setting']['Language']]['Patent']['PatentAvatarMimes'],
                    'avatar.max'=> $ob[$ob['Setting']['Language']]['Patent']['PatentAvatarMax'],
                    'avatar.uploaded'=>$ob[$ob['Setting']['Language']]['Patent']['PatentAvatarImage'],
                    'choices.required_without'=>$ob[$ob['Setting']['Language']]['Patent']['PatentDiseaseRequired'],
                    'patent-other.required_without'=>$ob[$ob['Setting']['Language']]['Patent']['PatentDiseaseRequired'],
                ]);
            $this->avatar = request()->file('avatar') ? $this->setupImage() : $ob['Patent'][request()->input('id')]['Avatar'];
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Patent']['PatientsEdit'];
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
                    $fail($ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationItemInvalid']);
            },],
            'patentCode' => ['required', Rule::in(isset($ob['Patent'])?array_keys($ob['Patent']):null)],
            'know' => ['required', Rule::in(isset($ob['Knows'])?array_keys($ob['Knows']):null)],
            'discount' => ['required', 'numeric', 'min:0'],
            'delayedMoney' => ['required', 'numeric', 'min:0'],
            'paymentDate' => ['required', 'date'],
            'paymentAmount' => ['required', 'numeric', 'min:0'],
            'paymentMethod' => ['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['PaymentMethodBox']))],
            ],[
                'item.required'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationItemRequired'],
                'item.array'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationItemInvalid'],
                'patentCode.required'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationPatentCodeRequired'],
                'patentCode.in'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationPatentCodeInvalid'],
                'know.required'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationKnowRequired'],
                'know.in'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationKnowInvalid'],
                'discount.required'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationDiscountRequired'],
                'discount.numeric'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationDiscountInvalid'],
                'discount.min'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationDiscountInvalid'],
                'delayedMoney.required'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationDelayedMoneyRequired'],
                'delayedMoney.numeric'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationDelayedMoneyInvalid'],
                'delayedMoney.min'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationDelayedMoneyInvalid'],
                'paymentDate.required'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationPaymentDateRequired'],
                'paymentDate.date'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationPaymentDateInvalid'],
                'paymentAmount.required'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationPaymentAmountRequired'],
                'paymentAmount.numeric'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationPaymentAmountInvalid'],
                'paymentAmount.min'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationPaymentAmountInvalid'],
                'paymentMethod.required'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationPaymentMethodRequired'],
                'paymentMethod.in'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationPaymentMethodInvalid'],
                'item.*.required'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationItemInvalid']
            ]);
            $this->getCreateDataBase($ob, 'Receipt', $this->generateUniqueIdentifier(), $this);
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationAdd'];
        }else if(Route::currentRouteName() === 'editPatientServices' && $ob['Receipt']){
            request()->validate([
            'id' => ['required', Rule::in(array_keys($ob['Receipt']))],
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
                    $fail($ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationItemInvalid']);
            },],
            'patentCode' => ['required', Rule::in(isset($ob['Patent'])?array_keys($ob['Patent']):null)],
            'know' => ['required', Rule::in(isset($ob['Knows'])?array_keys($ob['Knows']):null)],
            'discount' => ['required', 'numeric', 'min:0'],
            'delayedMoney' => ['required', 'numeric', 'min:0'],
            'paymentDate' => ['required', 'date'],
            'paymentAmount' => ['required', 'numeric', 'min:0'],
            'paymentMethod' => ['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['PaymentMethodBox']))],
            ],[
                'id.required'=>$ob[$ob['Setting']['Language']]['Receipt']['IdIsReq'],
                'id.in'=>$ob[$ob['Setting']['Language']]['Receipt']['IdIsInv'],
                'item.required'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationItemRequired'],
                'item.array'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationItemInvalid'],
                'patentCode.required'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationPatentCodeRequired'],
                'patentCode.in'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationPatentCodeInvalid'],
                'know.required'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationKnowRequired'],
                'know.in'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationKnowInvalid'],
                'discount.required'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationDiscountRequired'],
                'discount.numeric'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationDiscountInvalid'],
                'discount.min'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationDiscountInvalid'],
                'delayedMoney.required'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationDelayedMoneyRequired'],
                'delayedMoney.numeric'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationDelayedMoneyInvalid'],
                'delayedMoney.min'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationDelayedMoneyInvalid'],
                'paymentDate.required'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationPaymentDateRequired'],
                'paymentDate.date'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationPaymentDateInvalid'],
                'paymentAmount.required'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationPaymentAmountRequired'],
                'paymentAmount.numeric'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationPaymentAmountInvalid'],
                'paymentAmount.min'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationPaymentAmountInvalid'],
                'paymentMethod.required'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationPaymentMethodRequired'],
                'paymentMethod.in'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationPaymentMethodInvalid'],
                'item.*.required'=>$ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationItemInvalid']
            ]);
            $this->getEditDataBase($ob, 'Receipt', $this);
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Receipt']['PatientRegisterationEdit'];
        }else if(request()->route('id') === 'Receipt' && $ob['Receipt'] && $ob['Branch']){
            $this->myPatent = isset($ob['Patent'])?Patent::fromArray($ob['Patent'], isset($ob['Contracts'])?Contracts::fromArray($ob['Contracts']):array(), $ob[$ob['Setting']['Language']]['SelectGenderBox'], $ob[$ob['Setting']['Language']]['SelectNationalityBox'], $ob[$ob['Setting']['Language']]['CheckBox']):array();
            $this->arr1 = isset($ob['Knows']) ? MyKnows::fromArray($ob['Knows']):array();
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['Receipt']['TitleDeleteReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelDeleteReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonDeleteReceipt'],
            route('deleteItem', 'Receipt'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Receipt']['PatientRegisteration'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeBranch($ob['Branch'], $ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Receipt']['TitleAddPatientServices'],
            $ob[$ob['Setting']['Language']]['Receipt']['TitleEditReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonPatientServices'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonAddPatientServices'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonEditReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['TableReceiptId'],
            $ob[$ob['Setting']['Language']]['Receipt']['TableReceiptPatientEdit'],
            $ob[$ob['Setting']['Language']]['Receipt']['PatentAvatar'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentName'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentName'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentEmail'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentEmail'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentPhone'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentPhone'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentAddress'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentAddress'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['CheckBox'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentOther'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentOther'],
            Receipt::fromArray2(array_reverse($ob['Receipt']), $this->myPatent, $this->arr1, $ob[$ob['Setting']['Language']]['SelectTestBox'], $ob[$ob['Setting']['Language']]['PaymentMethodBox']));
            $this->title5 = $ob[$this->language]['Receipt']['ReceiptPatient'];  
            $this->myCodePatient = $ob[$this->language]['Receipt']['PatientCode'];
            //init table
            $this->table13 = $ob[$this->language]['Receipt']['PatientRaysName'];
            $this->table14 = $ob[$this->language]['Receipt']['PatientRaysPrice'];
            $this->table15 = $ob[$this->language]['Receipt']['PatientRaysInOut'];
            $this->table16 = $ob[$this->language]['Receipt']['PatientRaysShortcut'];
            $this->table17 = $ob[$this->language]['Receipt']['PatientRaysDelete'];
            $this->table18 = $ob[$this->language]['Receipt']['PatientRaysSubtotal'];
            $this->table19 = $ob[$this->language]['Receipt']['PatientRaysDiscount'];
            $this->table20 = $ob[$this->language]['Receipt']['PatientRaysTotalDiscount'];
            $this->table21 = $ob[$this->language]['Receipt']['PatientRaysTotal'];
            $this->table22 = $ob[$this->language]['Receipt']['PatientRaysPaid'];
            $this->table23 = $ob[$this->language]['Receipt']['PatientRaysDue'];
            $this->table24 = $ob[$this->language]['Receipt']['PatientRaysDelayedMoney'];
            $this->table25 = $ob[$this->language]['Receipt']['PatientRaysDueUser'];
            $this->table26 = $ob[$this->language]['Receipt']['PatientRaysEGP'];
            $this->table27 = $ob[$this->language]['Receipt']['PatientRaysPercent'];
            $this->table29 = $ob[$this->language]['Receipt']['ReceiptPatientCode'];
            $this->table30 = $ob[$this->language]['Receipt']['ReceiptPatientName'];
            $this->table31 = $ob[$this->language]['Receipt']['ReceiptPatientAge'];
            $this->table32 = $ob[$this->language]['Receipt']['ReceiptPatientPhone'];
            $this->table33 = $ob[$this->language]['Receipt']['ReceiptPatientTest'];
            $this->table34 = $ob[$this->language]['Receipt']['ReceiptPatientSubtotal'];
            $this->table35 = $ob[$this->language]['Receipt']['ReceiptPatientDiscount'];
            $this->table36 = $ob[$this->language]['Receipt']['ReceiptPatientTotalDiscount'];
            $this->table37 = $ob[$this->language]['Receipt']['ReceiptPatientTotal'];
            $this->table38 = $ob[$this->language]['Receipt']['ReceiptPatientPaid'];
            $this->table39 = $ob[$this->language]['Receipt']['ReceiptPatientDue'];
            $this->table40 = $ob[$this->language]['Receipt']['ReceiptPatientDelayedMoney'];
            $this->table41 = $ob[$this->language]['Receipt']['ReceiptPatientDueUser'];
            $this->table42 = $ob[$this->language]['Receipt']['ReceiptPatientPaymentDate'];
            $this->table43 = $ob[$this->language]['Receipt']['ReceiptPatientAmountPaid'];
            $this->table44 = $ob[$this->language]['Receipt']['ReceiptPatientPaymentMethod'];
            $this->error1 = $ob[$this->language]['Receipt']['PatientRegisterationTestRequired'];
            $this->error8 = $ob[$this->language]['Receipt']['PatientRegisterationNameRequired'];
            $this->button5 = $ob[$this->language]['Receipt']['PatientAddTest'];
            $this->button4 = $ob[$this->language]['Receipt']['PatientDeleteTest'];
            //init label
            $this->label3 = $ob[$this->language]['Receipt']['PatentNationality'];
            $this->label9 = $ob[$this->language]['Receipt']['PatentGender'];
            $this->label13 = $ob[$this->language]['Receipt']['PatentContracting'];
            $this->PatientNameServices = $ob[$this->language]['Receipt']['PatientNameServices'];
            $this->label18 = $ob[$this->language]['Receipt']['PatientReceipt'];
            $this->label19 = $ob[$this->language]['Receipt']['PatientKnow'];
            $this->label20 = $ob[$this->language]['Receipt']['PatientNewItem'];
            $this->label21 = $ob[$this->language]['Receipt']['PatientRaysName'];
            $this->label22 = $ob[$this->language]['Receipt']['PatientRaysOption'];
            $this->label23 = $ob[$this->language]['Receipt']['PatientPaymentDetails'];
            $this->label24 = $ob[$this->language]['Receipt']['PatientPaymentDate'];
            $this->label25 = $ob[$this->language]['Receipt']['PatientAmountPaid'];
            $this->label26 = $ob[$this->language]['Receipt']['PatientPaymentMethod'];
            $this->label27 = $ob[$this->language]['Receipt']['PatientEndReceipt'];
            $this->label29 = $ob[$this->language]['Receipt']['ReceiptNumber'];
            $this->label30 = $ob[$this->language]['Receipt']['ReceiptDate'];
            $this->label31 = $ob[$this->language]['Receipt']['ReceiptPatentName'];
            $this->label32 = $ob[$this->language]['Receipt']['ReceiptPatentCode'];
            $this->label33 = $ob[$this->language]['Receipt']['ReceiptPatentTestName'];
            $this->label34 = $ob[$this->language]['Receipt']['ReceiptPatentTestPrice'];
            $this->label35 = $ob[$this->language]['Receipt']['ReceiptPatentSubtotal'];
            $this->label36 = $ob[$this->language]['Receipt']['ReceiptPatentTotalDiscount'];
            $this->label37 = $ob[$this->language]['Receipt']['ReceiptPatentTotal'];
            $this->label38 = $ob[$this->language]['Receipt']['ReceiptPatentPaymentDate'];
            $this->label39 = $ob[$this->language]['Receipt']['ReceiptPatentAmountPaid'];
            $this->label40 = $ob[$this->language]['Receipt']['ReceiptPatentPaymentMethod'];
            $this->label41 = $ob[$this->language]['Receipt']['ReceiptPatentDue'];
            $this->label42 = $ob[$this->language]['Receipt']['ReceiptPatentInfo'];
            $this->label43 = $ob[$this->language]['Receipt']['ReceiptPatientTitle'];
            $this->hint12 = $ob[$this->language]['Receipt']['HintPatientCode'];
            $this->hint13 = $ob[$this->language]['Receipt']['HintPatientNationality'];
            $this->hint14 = $ob[$this->language]['Receipt']['HintPatientGender'];
            $this->hint15 = $ob[$this->language]['Receipt']['HintPatientContracting'];
            $this->hint16 = $ob[$this->language]['Receipt']['HintpatientAmountPaid'];
            //init selectbox
            $this->selectBox1 = $ob[$this->language]['Receipt']['PatientPaymentMethod'];
            $this->selectBox2 = $ob[$this->language]['Receipt']['PatientNameServices'];
            $this->selectBox5 = $ob[$this->language]['Receipt']['Patientknow'];
            $this->selectBox6 = $ob[$this->language]['Receipt']['PatientTest'];
            $this->selectBox7 = $ob[$this->language]['Receipt']['ReceiptPatientPrint'];
            $this->payment = $ob[$this->language]['PaymentMethodBox'];
            $this->allTests = $ob[$this->language]['OptionTestBox'];
            $this->error2 = $ob[$this->language]['Receipt']['PatientRegisterationPaymentMethodRequired'];
            $this->error3 = $ob[$this->language]['Receipt']['PatientRegisterationPatentCodeRequired'];
            $this->error4 = $ob[$this->language]['Receipt']['PatientRegisterationKnowRequired'];
            $this->error5 = $ob[$this->language]['Receipt']['PatientRegisterationItemRequired'];
            $this->error6 = $ob[$this->language]['Receipt']['PatientRegisterationPaymentDateRequired'];
            $this->error7 = $ob[$this->language]['Receipt']['PatientRegisterationPaymentAmountRequired'];
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
            $this->successfully1 = $ob[$this->language]['Receipt']['LoadMessage'];
        }else if(request()->route('id') === 'Receipt' && $ob['Receipt'] && Rays::find(request()->session()->get('userLogout'))['Branch']){
            $this->myPatent = isset($ob['Patent'])?Patent::fromArray($ob['Patent'], isset($ob['Contracts'])?Contracts::fromArray($ob['Contracts']):array(), $ob[$ob['Setting']['Language']]['SelectGenderBox'], $ob[$ob['Setting']['Language']]['SelectNationalityBox'], $ob[$ob['Setting']['Language']]['CheckBox']):array();
            $this->arr1 = isset($ob['Knows']) ? MyKnows::fromArray($ob['Knows']):array();
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['Receipt']['TitleDeleteReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelDeleteReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonDeleteReceipt'],
            route('deleteItem', 'Receipt'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Receipt']['PatientRegisteration'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeBranch(Rays::find(request()->session()->get('userLogout'))['Branch'], $ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Receipt']['TitleAddPatientServices'],
            $ob[$ob['Setting']['Language']]['Receipt']['TitleEditReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonPatientServices'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonAddPatientServices'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonEditReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['TableReceiptId'],
            $ob[$ob['Setting']['Language']]['Receipt']['TableReceiptPatientEdit'],
            $ob[$ob['Setting']['Language']]['Receipt']['PatentAvatar'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentName'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentName'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentEmail'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentEmail'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentPhone'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentPhone'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentAddress'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentAddress'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['CheckBox'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentOther'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentOther'],
            Receipt::fromArray2(array_reverse($ob['Receipt']), $this->myPatent, $this->arr1, $ob[$ob['Setting']['Language']]['SelectTestBox'], $ob[$ob['Setting']['Language']]['PaymentMethodBox']));
            $this->title5 = $ob[$this->language]['Receipt']['ReceiptPatient'];  
            $this->myCodePatient = $ob[$this->language]['Receipt']['PatientCode'];
            //init table
            $this->table13 = $ob[$this->language]['Receipt']['PatientRaysName'];
            $this->table14 = $ob[$this->language]['Receipt']['PatientRaysPrice'];
            $this->table15 = $ob[$this->language]['Receipt']['PatientRaysInOut'];
            $this->table16 = $ob[$this->language]['Receipt']['PatientRaysShortcut'];
            $this->table17 = $ob[$this->language]['Receipt']['PatientRaysDelete'];
            $this->table18 = $ob[$this->language]['Receipt']['PatientRaysSubtotal'];
            $this->table19 = $ob[$this->language]['Receipt']['PatientRaysDiscount'];
            $this->table20 = $ob[$this->language]['Receipt']['PatientRaysTotalDiscount'];
            $this->table21 = $ob[$this->language]['Receipt']['PatientRaysTotal'];
            $this->table22 = $ob[$this->language]['Receipt']['PatientRaysPaid'];
            $this->table23 = $ob[$this->language]['Receipt']['PatientRaysDue'];
            $this->table24 = $ob[$this->language]['Receipt']['PatientRaysDelayedMoney'];
            $this->table25 = $ob[$this->language]['Receipt']['PatientRaysDueUser'];
            $this->table26 = $ob[$this->language]['Receipt']['PatientRaysEGP'];
            $this->table27 = $ob[$this->language]['Receipt']['PatientRaysPercent'];
            $this->table29 = $ob[$this->language]['Receipt']['ReceiptPatientCode'];
            $this->table30 = $ob[$this->language]['Receipt']['ReceiptPatientName'];
            $this->table31 = $ob[$this->language]['Receipt']['ReceiptPatientAge'];
            $this->table32 = $ob[$this->language]['Receipt']['ReceiptPatientPhone'];
            $this->table33 = $ob[$this->language]['Receipt']['ReceiptPatientTest'];
            $this->table34 = $ob[$this->language]['Receipt']['ReceiptPatientSubtotal'];
            $this->table35 = $ob[$this->language]['Receipt']['ReceiptPatientDiscount'];
            $this->table36 = $ob[$this->language]['Receipt']['ReceiptPatientTotalDiscount'];
            $this->table37 = $ob[$this->language]['Receipt']['ReceiptPatientTotal'];
            $this->table38 = $ob[$this->language]['Receipt']['ReceiptPatientPaid'];
            $this->table39 = $ob[$this->language]['Receipt']['ReceiptPatientDue'];
            $this->table40 = $ob[$this->language]['Receipt']['ReceiptPatientDelayedMoney'];
            $this->table41 = $ob[$this->language]['Receipt']['ReceiptPatientDueUser'];
            $this->table42 = $ob[$this->language]['Receipt']['ReceiptPatientPaymentDate'];
            $this->table43 = $ob[$this->language]['Receipt']['ReceiptPatientAmountPaid'];
            $this->table44 = $ob[$this->language]['Receipt']['ReceiptPatientPaymentMethod'];
            $this->error1 = $ob[$this->language]['Receipt']['PatientRegisterationTestRequired'];
            $this->error8 = $ob[$this->language]['Receipt']['PatientRegisterationNameRequired'];
            $this->button5 = $ob[$this->language]['Receipt']['PatientAddTest'];
            $this->button4 = $ob[$this->language]['Receipt']['PatientDeleteTest'];
            //init label
            $this->label3 = $ob[$this->language]['Receipt']['PatentNationality'];
            $this->label9 = $ob[$this->language]['Receipt']['PatentGender'];
            $this->label13 = $ob[$this->language]['Receipt']['PatentContracting'];
            $this->PatientNameServices = $ob[$this->language]['Receipt']['PatientNameServices'];
            $this->label18 = $ob[$this->language]['Receipt']['PatientReceipt'];
            $this->label19 = $ob[$this->language]['Receipt']['PatientKnow'];
            $this->label20 = $ob[$this->language]['Receipt']['PatientNewItem'];
            $this->label21 = $ob[$this->language]['Receipt']['PatientRaysName'];
            $this->label22 = $ob[$this->language]['Receipt']['PatientRaysOption'];
            $this->label23 = $ob[$this->language]['Receipt']['PatientPaymentDetails'];
            $this->label24 = $ob[$this->language]['Receipt']['PatientPaymentDate'];
            $this->label25 = $ob[$this->language]['Receipt']['PatientAmountPaid'];
            $this->label26 = $ob[$this->language]['Receipt']['PatientPaymentMethod'];
            $this->label27 = $ob[$this->language]['Receipt']['PatientEndReceipt'];
            $this->label29 = $ob[$this->language]['Receipt']['ReceiptNumber'];
            $this->label30 = $ob[$this->language]['Receipt']['ReceiptDate'];
            $this->label31 = $ob[$this->language]['Receipt']['ReceiptPatentName'];
            $this->label32 = $ob[$this->language]['Receipt']['ReceiptPatentCode'];
            $this->label33 = $ob[$this->language]['Receipt']['ReceiptPatentTestName'];
            $this->label34 = $ob[$this->language]['Receipt']['ReceiptPatentTestPrice'];
            $this->label35 = $ob[$this->language]['Receipt']['ReceiptPatentSubtotal'];
            $this->label36 = $ob[$this->language]['Receipt']['ReceiptPatentTotalDiscount'];
            $this->label37 = $ob[$this->language]['Receipt']['ReceiptPatentTotal'];
            $this->label38 = $ob[$this->language]['Receipt']['ReceiptPatentPaymentDate'];
            $this->label39 = $ob[$this->language]['Receipt']['ReceiptPatentAmountPaid'];
            $this->label40 = $ob[$this->language]['Receipt']['ReceiptPatentPaymentMethod'];
            $this->label41 = $ob[$this->language]['Receipt']['ReceiptPatentDue'];
            $this->label42 = $ob[$this->language]['Receipt']['ReceiptPatentInfo'];
            $this->label43 = $ob[$this->language]['Receipt']['ReceiptPatientTitle'];
            $this->hint12 = $ob[$this->language]['Receipt']['HintPatientCode'];
            $this->hint13 = $ob[$this->language]['Receipt']['HintPatientNationality'];
            $this->hint14 = $ob[$this->language]['Receipt']['HintPatientGender'];
            $this->hint15 = $ob[$this->language]['Receipt']['HintPatientContracting'];
            $this->hint16 = $ob[$this->language]['Receipt']['HintpatientAmountPaid'];
            //init selectbox
            $this->selectBox1 = $ob[$this->language]['Receipt']['PatientPaymentMethod'];
            $this->selectBox2 = $ob[$this->language]['Receipt']['PatientNameServices'];
            $this->selectBox5 = $ob[$this->language]['Receipt']['Patientknow'];
            $this->selectBox6 = $ob[$this->language]['Receipt']['PatientTest'];
            $this->selectBox7 = $ob[$this->language]['Receipt']['ReceiptPatientPrint'];
            $this->payment = $ob[$this->language]['PaymentMethodBox'];
            $this->allTests = $ob[$this->language]['OptionTestBox'];
            $this->error2 = $ob[$this->language]['Receipt']['PatientRegisterationPaymentMethodRequired'];
            $this->error3 = $ob[$this->language]['Receipt']['PatientRegisterationPatentCodeRequired'];
            $this->error4 = $ob[$this->language]['Receipt']['PatientRegisterationKnowRequired'];
            $this->error5 = $ob[$this->language]['Receipt']['PatientRegisterationItemRequired'];
            $this->error6 = $ob[$this->language]['Receipt']['PatientRegisterationPaymentDateRequired'];
            $this->error7 = $ob[$this->language]['Receipt']['PatientRegisterationPaymentAmountRequired'];
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
            $this->successfully1 = $ob[$this->language]['Receipt']['LoadMessage'];

        }else if(request()->route('id') === 'Receipt' && !$ob['Receipt'] && $ob['Branch']){
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['Receipt']['TitleDeleteReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelDeleteReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonDeleteReceipt'],
            route('deleteItem', 'Receipt'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Receipt']['PatientRegisteration'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeBranch($ob['Branch'], $ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Receipt']['TitleAddPatientServices'],
            $ob[$ob['Setting']['Language']]['Receipt']['TitleEditReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonPatientServices'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonAddPatientServices'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonEditReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['TableReceiptId'],
            $ob[$ob['Setting']['Language']]['Receipt']['TableReceiptPatientEdit'],
            $ob[$ob['Setting']['Language']]['Receipt']['PatentAvatar'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentName'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentName'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentEmail'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentEmail'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentPhone'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentPhone'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentAddress'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentAddress'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['CheckBox'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentOther'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentOther']);
            $this->title5 = $ob[$this->language]['Receipt']['ReceiptPatient'];  
            $this->myCodePatient = $ob[$this->language]['Receipt']['PatientCode'];
            //init table
            $this->table13 = $ob[$this->language]['Receipt']['PatientRaysName'];
            $this->table14 = $ob[$this->language]['Receipt']['PatientRaysPrice'];
            $this->table15 = $ob[$this->language]['Receipt']['PatientRaysInOut'];
            $this->table16 = $ob[$this->language]['Receipt']['PatientRaysShortcut'];
            $this->table17 = $ob[$this->language]['Receipt']['PatientRaysDelete'];
            $this->table18 = $ob[$this->language]['Receipt']['PatientRaysSubtotal'];
            $this->table19 = $ob[$this->language]['Receipt']['PatientRaysDiscount'];
            $this->table20 = $ob[$this->language]['Receipt']['PatientRaysTotalDiscount'];
            $this->table21 = $ob[$this->language]['Receipt']['PatientRaysTotal'];
            $this->table22 = $ob[$this->language]['Receipt']['PatientRaysPaid'];
            $this->table23 = $ob[$this->language]['Receipt']['PatientRaysDue'];
            $this->table24 = $ob[$this->language]['Receipt']['PatientRaysDelayedMoney'];
            $this->table25 = $ob[$this->language]['Receipt']['PatientRaysDueUser'];
            $this->table26 = $ob[$this->language]['Receipt']['PatientRaysEGP'];
            $this->table27 = $ob[$this->language]['Receipt']['PatientRaysPercent'];
            $this->table29 = $ob[$this->language]['Receipt']['ReceiptPatientCode'];
            $this->table30 = $ob[$this->language]['Receipt']['ReceiptPatientName'];
            $this->table31 = $ob[$this->language]['Receipt']['ReceiptPatientAge'];
            $this->table32 = $ob[$this->language]['Receipt']['ReceiptPatientPhone'];
            $this->table33 = $ob[$this->language]['Receipt']['ReceiptPatientTest'];
            $this->table34 = $ob[$this->language]['Receipt']['ReceiptPatientSubtotal'];
            $this->table35 = $ob[$this->language]['Receipt']['ReceiptPatientDiscount'];
            $this->table36 = $ob[$this->language]['Receipt']['ReceiptPatientTotalDiscount'];
            $this->table37 = $ob[$this->language]['Receipt']['ReceiptPatientTotal'];
            $this->table38 = $ob[$this->language]['Receipt']['ReceiptPatientPaid'];
            $this->table39 = $ob[$this->language]['Receipt']['ReceiptPatientDue'];
            $this->table40 = $ob[$this->language]['Receipt']['ReceiptPatientDelayedMoney'];
            $this->table41 = $ob[$this->language]['Receipt']['ReceiptPatientDueUser'];
            $this->table42 = $ob[$this->language]['Receipt']['ReceiptPatientPaymentDate'];
            $this->table43 = $ob[$this->language]['Receipt']['ReceiptPatientAmountPaid'];
            $this->table44 = $ob[$this->language]['Receipt']['ReceiptPatientPaymentMethod'];
            $this->error1 = $ob[$this->language]['Receipt']['PatientRegisterationTestRequired'];
            $this->error8 = $ob[$this->language]['Receipt']['PatientRegisterationNameRequired'];
            $this->button5 = $ob[$this->language]['Receipt']['PatientAddTest'];
            $this->button4 = $ob[$this->language]['Receipt']['PatientDeleteTest'];
            //init label
            $this->label3 = $ob[$this->language]['Receipt']['PatentNationality'];
            $this->label9 = $ob[$this->language]['Receipt']['PatentGender'];
            $this->label13 = $ob[$this->language]['Receipt']['PatentContracting'];
            $this->PatientNameServices = $ob[$this->language]['Receipt']['PatientNameServices'];
            $this->label18 = $ob[$this->language]['Receipt']['PatientReceipt'];
            $this->label19 = $ob[$this->language]['Receipt']['PatientKnow'];
            $this->label20 = $ob[$this->language]['Receipt']['PatientNewItem'];
            $this->label21 = $ob[$this->language]['Receipt']['PatientRaysName'];
            $this->label22 = $ob[$this->language]['Receipt']['PatientRaysOption'];
            $this->label23 = $ob[$this->language]['Receipt']['PatientPaymentDetails'];
            $this->label24 = $ob[$this->language]['Receipt']['PatientPaymentDate'];
            $this->label25 = $ob[$this->language]['Receipt']['PatientAmountPaid'];
            $this->label26 = $ob[$this->language]['Receipt']['PatientPaymentMethod'];
            $this->label27 = $ob[$this->language]['Receipt']['PatientEndReceipt'];
            $this->label29 = $ob[$this->language]['Receipt']['ReceiptNumber'];
            $this->label30 = $ob[$this->language]['Receipt']['ReceiptDate'];
            $this->label31 = $ob[$this->language]['Receipt']['ReceiptPatentName'];
            $this->label32 = $ob[$this->language]['Receipt']['ReceiptPatentCode'];
            $this->label33 = $ob[$this->language]['Receipt']['ReceiptPatentTestName'];
            $this->label34 = $ob[$this->language]['Receipt']['ReceiptPatentTestPrice'];
            $this->label35 = $ob[$this->language]['Receipt']['ReceiptPatentSubtotal'];
            $this->label36 = $ob[$this->language]['Receipt']['ReceiptPatentTotalDiscount'];
            $this->label37 = $ob[$this->language]['Receipt']['ReceiptPatentTotal'];
            $this->label38 = $ob[$this->language]['Receipt']['ReceiptPatentPaymentDate'];
            $this->label39 = $ob[$this->language]['Receipt']['ReceiptPatentAmountPaid'];
            $this->label40 = $ob[$this->language]['Receipt']['ReceiptPatentPaymentMethod'];
            $this->label41 = $ob[$this->language]['Receipt']['ReceiptPatentDue'];
            $this->label42 = $ob[$this->language]['Receipt']['ReceiptPatentInfo'];
            $this->label43 = $ob[$this->language]['Receipt']['ReceiptPatientTitle'];
            $this->hint12 = $ob[$this->language]['Receipt']['HintPatientCode'];
            $this->hint13 = $ob[$this->language]['Receipt']['HintPatientNationality'];
            $this->hint14 = $ob[$this->language]['Receipt']['HintPatientGender'];
            $this->hint15 = $ob[$this->language]['Receipt']['HintPatientContracting'];
            $this->hint16 = $ob[$this->language]['Receipt']['HintpatientAmountPaid'];
            //init selectbox
            $this->selectBox1 = $ob[$this->language]['Receipt']['PatientPaymentMethod'];
            $this->selectBox2 = $ob[$this->language]['Receipt']['PatientNameServices'];
            $this->selectBox5 = $ob[$this->language]['Receipt']['Patientknow'];
            $this->selectBox6 = $ob[$this->language]['Receipt']['PatientTest'];
            $this->selectBox7 = $ob[$this->language]['Receipt']['ReceiptPatientPrint'];
            $this->payment = $ob[$this->language]['PaymentMethodBox'];
            $this->allTests = $ob[$this->language]['OptionTestBox'];
            $this->error2 = $ob[$this->language]['Receipt']['PatientRegisterationPaymentMethodRequired'];
            $this->error3 = $ob[$this->language]['Receipt']['PatientRegisterationPatentCodeRequired'];
            $this->error4 = $ob[$this->language]['Receipt']['PatientRegisterationKnowRequired'];
            $this->error5 = $ob[$this->language]['Receipt']['PatientRegisterationItemRequired'];
            $this->error6 = $ob[$this->language]['Receipt']['PatientRegisterationPaymentDateRequired'];
            $this->error7 = $ob[$this->language]['Receipt']['PatientRegisterationPaymentAmountRequired'];
            //add test
            $this->arr2 = isset($ob['Test'])?(array)$ob['Test']:null;
            $this->arr3 = isset($ob['Cultures'])?(array)$ob['Cultures']:null;
            $this->arr4 = isset($ob['Packages'])?(array)$ob['Packages']:null;
            if($this->arr2)
                foreach ($this->arr2 as $key=>$test)
                    $this->arr2[$key]['InputOutputLab'] = $ob[$this->language]['SelectTestBox'][$test['InputOutputLab']];
            if($this->arr3)
                foreach ($this->arr3 as $key => $cultures)
                    $this->arr3[$key]['InputOutputLab'] = $ob[$this->language]['SelectTestBox'][$test['InputOutputLab']];
            //init Packages
            if($this->arr4)
                foreach ($this->arr4 as $key => $packages)
                    $this->arr4[$key]['InputOutputLab'] = $ob[$this->language]['SelectTestBox'][$test['InputOutputLab']];
            $this->myPatent = isset($ob['Patent'])?Patent::fromArray($ob['Patent'], isset($ob['Contracts'])?Contracts::fromArray($ob['Contracts']):array(), $ob[$this->language]['SelectGenderBox'], $ob[$this->language]['SelectNationalityBox'], $ob[$this->language]['CheckBox']):array();
            $this->arr1 = isset($ob['Knows']) ? MyKnows::fromArray($ob['Knows']):array();
            $this->successfully1 = $ob[$this->language]['Receipt']['LoadMessage'];

        }else if(request()->route('id') === 'Receipt' && !$ob['Receipt'] && Rays::find(request()->session()->get('userLogout'))['Branch'] ){
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['Receipt']['TitleDeleteReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelDeleteReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonDeleteReceipt'],
            route('deleteItem', 'Receipt'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Receipt']['PatientRegisteration'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeBranch(Rays::find(request()->session()->get('userLogout'))['Branch'], $ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Receipt']['TitleAddPatientServices'],
            $ob[$ob['Setting']['Language']]['Receipt']['TitleEditReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonPatientServices'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonAddPatientServices'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonEditReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['TableReceiptId'],
            $ob[$ob['Setting']['Language']]['Receipt']['TableReceiptPatientEdit'],
            $ob[$ob['Setting']['Language']]['Receipt']['PatentAvatar'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentName'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentName'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentEmail'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentEmail'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentPhone'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentPhone'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentAddress'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentAddress'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['CheckBox'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentOther'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentOther']);
            $this->title5 = $ob[$this->language]['Receipt']['ReceiptPatient'];  
            $this->myCodePatient = $ob[$this->language]['Receipt']['PatientCode'];
            //init table
            $this->table13 = $ob[$this->language]['Receipt']['PatientRaysName'];
            $this->table14 = $ob[$this->language]['Receipt']['PatientRaysPrice'];
            $this->table15 = $ob[$this->language]['Receipt']['PatientRaysInOut'];
            $this->table16 = $ob[$this->language]['Receipt']['PatientRaysShortcut'];
            $this->table17 = $ob[$this->language]['Receipt']['PatientRaysDelete'];
            $this->table18 = $ob[$this->language]['Receipt']['PatientRaysSubtotal'];
            $this->table19 = $ob[$this->language]['Receipt']['PatientRaysDiscount'];
            $this->table20 = $ob[$this->language]['Receipt']['PatientRaysTotalDiscount'];
            $this->table21 = $ob[$this->language]['Receipt']['PatientRaysTotal'];
            $this->table22 = $ob[$this->language]['Receipt']['PatientRaysPaid'];
            $this->table23 = $ob[$this->language]['Receipt']['PatientRaysDue'];
            $this->table24 = $ob[$this->language]['Receipt']['PatientRaysDelayedMoney'];
            $this->table25 = $ob[$this->language]['Receipt']['PatientRaysDueUser'];
            $this->table26 = $ob[$this->language]['Receipt']['PatientRaysEGP'];
            $this->table27 = $ob[$this->language]['Receipt']['PatientRaysPercent'];
            $this->table29 = $ob[$this->language]['Receipt']['ReceiptPatientCode'];
            $this->table30 = $ob[$this->language]['Receipt']['ReceiptPatientName'];
            $this->table31 = $ob[$this->language]['Receipt']['ReceiptPatientAge'];
            $this->table32 = $ob[$this->language]['Receipt']['ReceiptPatientPhone'];
            $this->table33 = $ob[$this->language]['Receipt']['ReceiptPatientTest'];
            $this->table34 = $ob[$this->language]['Receipt']['ReceiptPatientSubtotal'];
            $this->table35 = $ob[$this->language]['Receipt']['ReceiptPatientDiscount'];
            $this->table36 = $ob[$this->language]['Receipt']['ReceiptPatientTotalDiscount'];
            $this->table37 = $ob[$this->language]['Receipt']['ReceiptPatientTotal'];
            $this->table38 = $ob[$this->language]['Receipt']['ReceiptPatientPaid'];
            $this->table39 = $ob[$this->language]['Receipt']['ReceiptPatientDue'];
            $this->table40 = $ob[$this->language]['Receipt']['ReceiptPatientDelayedMoney'];
            $this->table41 = $ob[$this->language]['Receipt']['ReceiptPatientDueUser'];
            $this->table42 = $ob[$this->language]['Receipt']['ReceiptPatientPaymentDate'];
            $this->table43 = $ob[$this->language]['Receipt']['ReceiptPatientAmountPaid'];
            $this->table44 = $ob[$this->language]['Receipt']['ReceiptPatientPaymentMethod'];
            $this->error1 = $ob[$this->language]['Receipt']['PatientRegisterationTestRequired'];
            $this->error8 = $ob[$this->language]['Receipt']['PatientRegisterationNameRequired'];
            $this->button5 = $ob[$this->language]['Receipt']['PatientAddTest'];
            $this->button4 = $ob[$this->language]['Receipt']['PatientDeleteTest'];
            //init label
            $this->label3 = $ob[$this->language]['Receipt']['PatentNationality'];
            $this->label9 = $ob[$this->language]['Receipt']['PatentGender'];
            $this->label13 = $ob[$this->language]['Receipt']['PatentContracting'];
            $this->PatientNameServices = $ob[$this->language]['Receipt']['PatientNameServices'];
            $this->label18 = $ob[$this->language]['Receipt']['PatientReceipt'];
            $this->label19 = $ob[$this->language]['Receipt']['PatientKnow'];
            $this->label20 = $ob[$this->language]['Receipt']['PatientNewItem'];
            $this->label21 = $ob[$this->language]['Receipt']['PatientRaysName'];
            $this->label22 = $ob[$this->language]['Receipt']['PatientRaysOption'];
            $this->label23 = $ob[$this->language]['Receipt']['PatientPaymentDetails'];
            $this->label24 = $ob[$this->language]['Receipt']['PatientPaymentDate'];
            $this->label25 = $ob[$this->language]['Receipt']['PatientAmountPaid'];
            $this->label26 = $ob[$this->language]['Receipt']['PatientPaymentMethod'];
            $this->label27 = $ob[$this->language]['Receipt']['PatientEndReceipt'];
            $this->label29 = $ob[$this->language]['Receipt']['ReceiptNumber'];
            $this->label30 = $ob[$this->language]['Receipt']['ReceiptDate'];
            $this->label31 = $ob[$this->language]['Receipt']['ReceiptPatentName'];
            $this->label32 = $ob[$this->language]['Receipt']['ReceiptPatentCode'];
            $this->label33 = $ob[$this->language]['Receipt']['ReceiptPatentTestName'];
            $this->label34 = $ob[$this->language]['Receipt']['ReceiptPatentTestPrice'];
            $this->label35 = $ob[$this->language]['Receipt']['ReceiptPatentSubtotal'];
            $this->label36 = $ob[$this->language]['Receipt']['ReceiptPatentTotalDiscount'];
            $this->label37 = $ob[$this->language]['Receipt']['ReceiptPatentTotal'];
            $this->label38 = $ob[$this->language]['Receipt']['ReceiptPatentPaymentDate'];
            $this->label39 = $ob[$this->language]['Receipt']['ReceiptPatentAmountPaid'];
            $this->label40 = $ob[$this->language]['Receipt']['ReceiptPatentPaymentMethod'];
            $this->label41 = $ob[$this->language]['Receipt']['ReceiptPatentDue'];
            $this->label42 = $ob[$this->language]['Receipt']['ReceiptPatentInfo'];
            $this->label43 = $ob[$this->language]['Receipt']['ReceiptPatientTitle'];
            $this->hint12 = $ob[$this->language]['Receipt']['HintPatientCode'];
            $this->hint13 = $ob[$this->language]['Receipt']['HintPatientNationality'];
            $this->hint14 = $ob[$this->language]['Receipt']['HintPatientGender'];
            $this->hint15 = $ob[$this->language]['Receipt']['HintPatientContracting'];
            $this->hint16 = $ob[$this->language]['Receipt']['HintpatientAmountPaid'];
            //init selectbox
            $this->selectBox1 = $ob[$this->language]['Receipt']['PatientPaymentMethod'];
            $this->selectBox2 = $ob[$this->language]['Receipt']['PatientNameServices'];
            $this->selectBox5 = $ob[$this->language]['Receipt']['Patientknow'];
            $this->selectBox6 = $ob[$this->language]['Receipt']['PatientTest'];
            $this->selectBox7 = $ob[$this->language]['Receipt']['ReceiptPatientPrint'];
            $this->payment = $ob[$this->language]['PaymentMethodBox'];
            $this->allTests = $ob[$this->language]['OptionTestBox'];
            $this->error2 = $ob[$this->language]['Receipt']['PatientRegisterationPaymentMethodRequired'];
            $this->error3 = $ob[$this->language]['Receipt']['PatientRegisterationPatentCodeRequired'];
            $this->error4 = $ob[$this->language]['Receipt']['PatientRegisterationKnowRequired'];
            $this->error5 = $ob[$this->language]['Receipt']['PatientRegisterationItemRequired'];
            $this->error6 = $ob[$this->language]['Receipt']['PatientRegisterationPaymentDateRequired'];
            $this->error7 = $ob[$this->language]['Receipt']['PatientRegisterationPaymentAmountRequired'];
            //add test
            $this->arr2 = isset($ob['Test'])?(array)$ob['Test']:null;
            $this->arr3 = isset($ob['Cultures'])?(array)$ob['Cultures']:null;
            $this->arr4 = isset($ob['Packages'])?(array)$ob['Packages']:null;
            if($this->arr2)
                foreach ($this->arr2 as $key=>$test)
                    $this->arr2[$key]['InputOutputLab'] = $ob[$this->language]['SelectTestBox'][$test['InputOutputLab']];
            if($this->arr3)
                foreach ($this->arr3 as $key => $cultures)
                    $this->arr3[$key]['InputOutputLab'] = $ob[$this->language]['SelectTestBox'][$test['InputOutputLab']];
            //init Packages
            if($this->arr4)
                foreach ($this->arr4 as $key => $packages)
                    $this->arr4[$key]['InputOutputLab'] = $ob[$this->language]['SelectTestBox'][$test['InputOutputLab']];
            $this->myPatent = isset($ob['Patent'])?Patent::fromArray($ob['Patent'], isset($ob['Contracts'])?Contracts::fromArray($ob['Contracts']):array(), $ob[$this->language]['SelectGenderBox'], $ob[$this->language]['SelectNationalityBox'], $ob[$this->language]['CheckBox']):array();
            $this->arr1 = isset($ob['Knows']) ? MyKnows::fromArray($ob['Knows']):array();
            $this->successfully1 = $ob[$this->language]['Receipt']['LoadMessage'];
        }else if(request()->route('id') === 'Receipt' && $ob['Receipt']){
            $this->myPatent = isset($ob['Patent'])?Patent::fromArray($ob['Patent'], isset($ob['Contracts'])?Contracts::fromArray($ob['Contracts']):array(), $ob[$ob['Setting']['Language']]['SelectGenderBox'], $ob[$ob['Setting']['Language']]['SelectNationalityBox'], $ob[$ob['Setting']['Language']]['CheckBox']):array();
            $this->arr1 = isset($ob['Knows']) ? MyKnows::fromArray($ob['Knows']):array();
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['Receipt']['TitleDeleteReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelDeleteReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonDeleteReceipt'],
            route('deleteItem', 'Receipt'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Receipt']['PatientRegisteration'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeMainBranch($ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Receipt']['TitleAddPatientServices'],
            $ob[$ob['Setting']['Language']]['Receipt']['TitleEditReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonPatientServices'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonAddPatientServices'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonEditReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['TableReceiptId'],
            $ob[$ob['Setting']['Language']]['Receipt']['TableReceiptPatientEdit'],
            $ob[$ob['Setting']['Language']]['Receipt']['PatentAvatar'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentName'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentName'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentEmail'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentEmail'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentPhone'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentPhone'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentAddress'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentAddress'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['CheckBox'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentOther'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentOther'],
            Receipt::fromArray2(array_reverse($ob['Receipt']), $this->myPatent, $this->arr1, $ob[$ob['Setting']['Language']]['SelectTestBox'], $ob[$ob['Setting']['Language']]['PaymentMethodBox']));
            $this->title5 = $ob[$this->language]['Receipt']['ReceiptPatient'];  
            $this->myCodePatient = $ob[$this->language]['Receipt']['PatientCode'];
            //init table
            $this->table13 = $ob[$this->language]['Receipt']['PatientRaysName'];
            $this->table14 = $ob[$this->language]['Receipt']['PatientRaysPrice'];
            $this->table15 = $ob[$this->language]['Receipt']['PatientRaysInOut'];
            $this->table16 = $ob[$this->language]['Receipt']['PatientRaysShortcut'];
            $this->table17 = $ob[$this->language]['Receipt']['PatientRaysDelete'];
            $this->table18 = $ob[$this->language]['Receipt']['PatientRaysSubtotal'];
            $this->table19 = $ob[$this->language]['Receipt']['PatientRaysDiscount'];
            $this->table20 = $ob[$this->language]['Receipt']['PatientRaysTotalDiscount'];
            $this->table21 = $ob[$this->language]['Receipt']['PatientRaysTotal'];
            $this->table22 = $ob[$this->language]['Receipt']['PatientRaysPaid'];
            $this->table23 = $ob[$this->language]['Receipt']['PatientRaysDue'];
            $this->table24 = $ob[$this->language]['Receipt']['PatientRaysDelayedMoney'];
            $this->table25 = $ob[$this->language]['Receipt']['PatientRaysDueUser'];
            $this->table26 = $ob[$this->language]['Receipt']['PatientRaysEGP'];
            $this->table27 = $ob[$this->language]['Receipt']['PatientRaysPercent'];
            $this->table29 = $ob[$this->language]['Receipt']['ReceiptPatientCode'];
            $this->table30 = $ob[$this->language]['Receipt']['ReceiptPatientName'];
            $this->table31 = $ob[$this->language]['Receipt']['ReceiptPatientAge'];
            $this->table32 = $ob[$this->language]['Receipt']['ReceiptPatientPhone'];
            $this->table33 = $ob[$this->language]['Receipt']['ReceiptPatientTest'];
            $this->table34 = $ob[$this->language]['Receipt']['ReceiptPatientSubtotal'];
            $this->table35 = $ob[$this->language]['Receipt']['ReceiptPatientDiscount'];
            $this->table36 = $ob[$this->language]['Receipt']['ReceiptPatientTotalDiscount'];
            $this->table37 = $ob[$this->language]['Receipt']['ReceiptPatientTotal'];
            $this->table38 = $ob[$this->language]['Receipt']['ReceiptPatientPaid'];
            $this->table39 = $ob[$this->language]['Receipt']['ReceiptPatientDue'];
            $this->table40 = $ob[$this->language]['Receipt']['ReceiptPatientDelayedMoney'];
            $this->table41 = $ob[$this->language]['Receipt']['ReceiptPatientDueUser'];
            $this->table42 = $ob[$this->language]['Receipt']['ReceiptPatientPaymentDate'];
            $this->table43 = $ob[$this->language]['Receipt']['ReceiptPatientAmountPaid'];
            $this->table44 = $ob[$this->language]['Receipt']['ReceiptPatientPaymentMethod'];
            $this->error1 = $ob[$this->language]['Receipt']['PatientRegisterationTestRequired'];
            $this->error8 = $ob[$this->language]['Receipt']['PatientRegisterationNameRequired'];
            $this->button5 = $ob[$this->language]['Receipt']['PatientAddTest'];
            $this->button4 = $ob[$this->language]['Receipt']['PatientDeleteTest'];
            //init label
            $this->label3 = $ob[$this->language]['Receipt']['PatentNationality'];
            $this->label9 = $ob[$this->language]['Receipt']['PatentGender'];
            $this->label13 = $ob[$this->language]['Receipt']['PatentContracting'];
            $this->PatientNameServices = $ob[$this->language]['Receipt']['PatientNameServices'];
            $this->label18 = $ob[$this->language]['Receipt']['PatientReceipt'];
            $this->label19 = $ob[$this->language]['Receipt']['PatientKnow'];
            $this->label20 = $ob[$this->language]['Receipt']['PatientNewItem'];
            $this->label21 = $ob[$this->language]['Receipt']['PatientRaysName'];
            $this->label22 = $ob[$this->language]['Receipt']['PatientRaysOption'];
            $this->label23 = $ob[$this->language]['Receipt']['PatientPaymentDetails'];
            $this->label24 = $ob[$this->language]['Receipt']['PatientPaymentDate'];
            $this->label25 = $ob[$this->language]['Receipt']['PatientAmountPaid'];
            $this->label26 = $ob[$this->language]['Receipt']['PatientPaymentMethod'];
            $this->label27 = $ob[$this->language]['Receipt']['PatientEndReceipt'];
            $this->label29 = $ob[$this->language]['Receipt']['ReceiptNumber'];
            $this->label30 = $ob[$this->language]['Receipt']['ReceiptDate'];
            $this->label31 = $ob[$this->language]['Receipt']['ReceiptPatentName'];
            $this->label32 = $ob[$this->language]['Receipt']['ReceiptPatentCode'];
            $this->label33 = $ob[$this->language]['Receipt']['ReceiptPatentTestName'];
            $this->label34 = $ob[$this->language]['Receipt']['ReceiptPatentTestPrice'];
            $this->label35 = $ob[$this->language]['Receipt']['ReceiptPatentSubtotal'];
            $this->label36 = $ob[$this->language]['Receipt']['ReceiptPatentTotalDiscount'];
            $this->label37 = $ob[$this->language]['Receipt']['ReceiptPatentTotal'];
            $this->label38 = $ob[$this->language]['Receipt']['ReceiptPatentPaymentDate'];
            $this->label39 = $ob[$this->language]['Receipt']['ReceiptPatentAmountPaid'];
            $this->label40 = $ob[$this->language]['Receipt']['ReceiptPatentPaymentMethod'];
            $this->label41 = $ob[$this->language]['Receipt']['ReceiptPatentDue'];
            $this->label42 = $ob[$this->language]['Receipt']['ReceiptPatentInfo'];
            $this->label43 = $ob[$this->language]['Receipt']['ReceiptPatientTitle'];
            $this->hint12 = $ob[$this->language]['Receipt']['HintPatientCode'];
            $this->hint13 = $ob[$this->language]['Receipt']['HintPatientNationality'];
            $this->hint14 = $ob[$this->language]['Receipt']['HintPatientGender'];
            $this->hint15 = $ob[$this->language]['Receipt']['HintPatientContracting'];
            $this->hint16 = $ob[$this->language]['Receipt']['HintpatientAmountPaid'];
            //init selectbox
            $this->selectBox1 = $ob[$this->language]['Receipt']['PatientPaymentMethod'];
            $this->selectBox2 = $ob[$this->language]['Receipt']['PatientNameServices'];
            $this->selectBox5 = $ob[$this->language]['Receipt']['Patientknow'];
            $this->selectBox6 = $ob[$this->language]['Receipt']['PatientTest'];
            $this->selectBox7 = $ob[$this->language]['Receipt']['ReceiptPatientPrint'];
            $this->payment = $ob[$this->language]['PaymentMethodBox'];
            $this->allTests = $ob[$this->language]['OptionTestBox'];
            $this->error2 = $ob[$this->language]['Receipt']['PatientRegisterationPaymentMethodRequired'];
            $this->error3 = $ob[$this->language]['Receipt']['PatientRegisterationPatentCodeRequired'];
            $this->error4 = $ob[$this->language]['Receipt']['PatientRegisterationKnowRequired'];
            $this->error5 = $ob[$this->language]['Receipt']['PatientRegisterationItemRequired'];
            $this->error6 = $ob[$this->language]['Receipt']['PatientRegisterationPaymentDateRequired'];
            $this->error7 = $ob[$this->language]['Receipt']['PatientRegisterationPaymentAmountRequired'];
            //add test
            $this->arr2 = isset($ob['Test'])?(array)$ob['Test']:null;
            $this->arr3 = isset($ob['Cultures'])?(array)$ob['Cultures']:null;
            $this->arr4 = isset($ob['Packages'])?(array)$ob['Packages']:null;
            if($this->arr2)
                foreach ($this->arr2 as $key=>$test)
                    $this->arr2[$key]['InputOutputLab'] = $ob[$this->language]['SelectTestBox'][$test['InputOutputLab']];
            if($this->arr3)
                foreach ($this->arr3 as $key => $cultures)
                    $this->arr3[$key]['InputOutputLab'] = $ob[$this->language]['SelectTestBox'][$test['InputOutputLab']];
            //init Packages
            if($this->arr4)
                foreach ($this->arr4 as $key => $packages)
                    $this->arr4[$key]['InputOutputLab'] = $ob[$this->language]['SelectTestBox'][$test['InputOutputLab']];
            $this->successfully1 = $ob[$this->language]['Receipt']['LoadMessage'];
        }else if(request()->route('id') === 'Receipt'){
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['Receipt']['TitleDeleteReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelDeleteReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonDeleteReceipt'],
            route('deleteItem', 'Receipt'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Receipt']['PatientRegisteration'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeMainBranch($ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Receipt']['TitleAddPatientServices'],
            $ob[$ob['Setting']['Language']]['Receipt']['TitleEditReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonPatientServices'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonAddPatientServices'],
            $ob[$ob['Setting']['Language']]['Receipt']['ButtonEditReceipt'],
            $ob[$ob['Setting']['Language']]['Receipt']['TableReceiptId'],
            $ob[$ob['Setting']['Language']]['Receipt']['TableReceiptPatientEdit'],
            $ob[$ob['Setting']['Language']]['Receipt']['PatentAvatar'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentName'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentName'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentEmail'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentEmail'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentPhone'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentPhone'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentAddress'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentAddress'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['CheckBox'],
            $ob[$ob['Setting']['Language']]['Receipt']['LabelPatentOther'],
            $ob[$ob['Setting']['Language']]['Receipt']['HintPatentOther']);
            $this->title5 = $ob[$this->language]['Receipt']['ReceiptPatient'];  
            $this->myCodePatient = $ob[$this->language]['Receipt']['PatientCode'];
            //init table
            $this->table13 = $ob[$this->language]['Receipt']['PatientRaysName'];
            $this->table14 = $ob[$this->language]['Receipt']['PatientRaysPrice'];
            $this->table15 = $ob[$this->language]['Receipt']['PatientRaysInOut'];
            $this->table16 = $ob[$this->language]['Receipt']['PatientRaysShortcut'];
            $this->table17 = $ob[$this->language]['Receipt']['PatientRaysDelete'];
            $this->table18 = $ob[$this->language]['Receipt']['PatientRaysSubtotal'];
            $this->table19 = $ob[$this->language]['Receipt']['PatientRaysDiscount'];
            $this->table20 = $ob[$this->language]['Receipt']['PatientRaysTotalDiscount'];
            $this->table21 = $ob[$this->language]['Receipt']['PatientRaysTotal'];
            $this->table22 = $ob[$this->language]['Receipt']['PatientRaysPaid'];
            $this->table23 = $ob[$this->language]['Receipt']['PatientRaysDue'];
            $this->table24 = $ob[$this->language]['Receipt']['PatientRaysDelayedMoney'];
            $this->table25 = $ob[$this->language]['Receipt']['PatientRaysDueUser'];
            $this->table26 = $ob[$this->language]['Receipt']['PatientRaysEGP'];
            $this->table27 = $ob[$this->language]['Receipt']['PatientRaysPercent'];
            $this->table29 = $ob[$this->language]['Receipt']['ReceiptPatientCode'];
            $this->table30 = $ob[$this->language]['Receipt']['ReceiptPatientName'];
            $this->table31 = $ob[$this->language]['Receipt']['ReceiptPatientAge'];
            $this->table32 = $ob[$this->language]['Receipt']['ReceiptPatientPhone'];
            $this->table33 = $ob[$this->language]['Receipt']['ReceiptPatientTest'];
            $this->table34 = $ob[$this->language]['Receipt']['ReceiptPatientSubtotal'];
            $this->table35 = $ob[$this->language]['Receipt']['ReceiptPatientDiscount'];
            $this->table36 = $ob[$this->language]['Receipt']['ReceiptPatientTotalDiscount'];
            $this->table37 = $ob[$this->language]['Receipt']['ReceiptPatientTotal'];
            $this->table38 = $ob[$this->language]['Receipt']['ReceiptPatientPaid'];
            $this->table39 = $ob[$this->language]['Receipt']['ReceiptPatientDue'];
            $this->table40 = $ob[$this->language]['Receipt']['ReceiptPatientDelayedMoney'];
            $this->table41 = $ob[$this->language]['Receipt']['ReceiptPatientDueUser'];
            $this->table42 = $ob[$this->language]['Receipt']['ReceiptPatientPaymentDate'];
            $this->table43 = $ob[$this->language]['Receipt']['ReceiptPatientAmountPaid'];
            $this->table44 = $ob[$this->language]['Receipt']['ReceiptPatientPaymentMethod'];
            $this->error1 = $ob[$this->language]['Receipt']['PatientRegisterationTestRequired'];
            $this->error8 = $ob[$this->language]['Receipt']['PatientRegisterationNameRequired'];
            $this->button5 = $ob[$this->language]['Receipt']['PatientAddTest'];
            $this->button4 = $ob[$this->language]['Receipt']['PatientDeleteTest'];
            //init label
            $this->label3 = $ob[$this->language]['Receipt']['PatentNationality'];
            $this->label9 = $ob[$this->language]['Receipt']['PatentGender'];
            $this->label13 = $ob[$this->language]['Receipt']['PatentContracting'];
            $this->PatientNameServices = $ob[$this->language]['Receipt']['PatientNameServices'];
            $this->label18 = $ob[$this->language]['Receipt']['PatientReceipt'];
            $this->label19 = $ob[$this->language]['Receipt']['PatientKnow'];
            $this->label20 = $ob[$this->language]['Receipt']['PatientNewItem'];
            $this->label21 = $ob[$this->language]['Receipt']['PatientRaysName'];
            $this->label22 = $ob[$this->language]['Receipt']['PatientRaysOption'];
            $this->label23 = $ob[$this->language]['Receipt']['PatientPaymentDetails'];
            $this->label24 = $ob[$this->language]['Receipt']['PatientPaymentDate'];
            $this->label25 = $ob[$this->language]['Receipt']['PatientAmountPaid'];
            $this->label26 = $ob[$this->language]['Receipt']['PatientPaymentMethod'];
            $this->label27 = $ob[$this->language]['Receipt']['PatientEndReceipt'];
            $this->label29 = $ob[$this->language]['Receipt']['ReceiptNumber'];
            $this->label30 = $ob[$this->language]['Receipt']['ReceiptDate'];
            $this->label31 = $ob[$this->language]['Receipt']['ReceiptPatentName'];
            $this->label32 = $ob[$this->language]['Receipt']['ReceiptPatentCode'];
            $this->label33 = $ob[$this->language]['Receipt']['ReceiptPatentTestName'];
            $this->label34 = $ob[$this->language]['Receipt']['ReceiptPatentTestPrice'];
            $this->label35 = $ob[$this->language]['Receipt']['ReceiptPatentSubtotal'];
            $this->label36 = $ob[$this->language]['Receipt']['ReceiptPatentTotalDiscount'];
            $this->label37 = $ob[$this->language]['Receipt']['ReceiptPatentTotal'];
            $this->label38 = $ob[$this->language]['Receipt']['ReceiptPatentPaymentDate'];
            $this->label39 = $ob[$this->language]['Receipt']['ReceiptPatentAmountPaid'];
            $this->label40 = $ob[$this->language]['Receipt']['ReceiptPatentPaymentMethod'];
            $this->label41 = $ob[$this->language]['Receipt']['ReceiptPatentDue'];
            $this->label42 = $ob[$this->language]['Receipt']['ReceiptPatentInfo'];
            $this->label43 = $ob[$this->language]['Receipt']['ReceiptPatientTitle'];
            $this->hint12 = $ob[$this->language]['Receipt']['HintPatientCode'];
            $this->hint13 = $ob[$this->language]['Receipt']['HintPatientNationality'];
            $this->hint14 = $ob[$this->language]['Receipt']['HintPatientGender'];
            $this->hint15 = $ob[$this->language]['Receipt']['HintPatientContracting'];
            $this->hint16 = $ob[$this->language]['Receipt']['HintpatientAmountPaid'];
            //init selectbox
            $this->selectBox1 = $ob[$this->language]['Receipt']['PatientPaymentMethod'];
            $this->selectBox2 = $ob[$this->language]['Receipt']['PatientNameServices'];
            $this->selectBox5 = $ob[$this->language]['Receipt']['Patientknow'];
            $this->selectBox6 = $ob[$this->language]['Receipt']['PatientTest'];
            $this->selectBox7 = $ob[$this->language]['Receipt']['ReceiptPatientPrint'];
            $this->payment = $ob[$this->language]['PaymentMethodBox'];
            $this->allTests = $ob[$this->language]['OptionTestBox'];
            $this->error2 = $ob[$this->language]['Receipt']['PatientRegisterationPaymentMethodRequired'];
            $this->error3 = $ob[$this->language]['Receipt']['PatientRegisterationPatentCodeRequired'];
            $this->error4 = $ob[$this->language]['Receipt']['PatientRegisterationKnowRequired'];
            $this->error5 = $ob[$this->language]['Receipt']['PatientRegisterationItemRequired'];
            $this->error6 = $ob[$this->language]['Receipt']['PatientRegisterationPaymentDateRequired'];
            $this->error7 = $ob[$this->language]['Receipt']['PatientRegisterationPaymentAmountRequired'];
            //add test
            $this->arr2 = isset($ob['Test'])?(array)$ob['Test']:null;
            $this->arr3 = isset($ob['Cultures'])?(array)$ob['Cultures']:null;
            $this->arr4 = isset($ob['Packages'])?(array)$ob['Packages']:null;
            if($this->arr2)
                foreach ($this->arr2 as $key=>$test)
                    $this->arr2[$key]['InputOutputLab'] = $ob[$this->language]['SelectTestBox'][$test['InputOutputLab']];
            if($this->arr3)
                foreach ($this->arr3 as $key => $cultures)
                    $this->arr3[$key]['InputOutputLab'] = $ob[$this->language]['SelectTestBox'][$test['InputOutputLab']];
            //init Packages
            if($this->arr4)
                foreach ($this->arr4 as $key => $packages)
                    $this->arr4[$key]['InputOutputLab'] = $ob[$this->language]['SelectTestBox'][$test['InputOutputLab']];
            $this->myPatent = isset($ob['Patent'])?Patent::fromArray($ob['Patent'], isset($ob['Contracts'])?Contracts::fromArray($ob['Contracts']):array(), $ob[$this->language]['SelectGenderBox'], $ob[$this->language]['SelectNationalityBox'], $ob[$this->language]['CheckBox']):array();
            $this->arr1 = isset($ob['Knows']) ? MyKnows::fromArray($ob['Knows']):array();
            $this->successfully1 = $ob[$this->language]['Receipt']['LoadMessage'];
        }else if($ob['Patent'] && $ob['Branch']){
            $this->myContract = isset($ob['Contracts'])?Contracts::fromArray($ob['Contracts']):array();
            parent::__construct($ob['Setting']['Language'], 
            $ob[$ob['Setting']['Language']]['Patent']['TitlePatentDelete'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentDelete'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonPatentDelete'],
            route('deleteItem', 'Patent'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Patent']['Patients'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeBranch($ob['Branch'], $ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Patent']['TitleAddPatent'],
            $ob[$ob['Setting']['Language']]['Patent']['TitlePatentEdit'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonPatentAvatar'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonAddPatent'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonCreatePatent'],
            $ob[$ob['Setting']['Language']]['Patent']['TablePatentEdit'],
            $ob[$ob['Setting']['Language']]['Patent']['TablePatentId'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentAvatar'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentName'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentName'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentEmail'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentEmail'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentPhone'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentPhone'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentAddress'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentAddress'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['CheckBox'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentOther'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentOther'],
            Patent::fromArray(array_reverse($ob['Patent']), $this->myContract, $ob[$ob['Setting']['Language']]['SelectGenderBox'], $ob[$ob['Setting']['Language']]['SelectNationalityBox'], $ob[$ob['Setting']['Language']]['CheckBox']));
            $this->error1 = $ob[$this->language]['Patent']['PatentNameRequired'];
            $this->error2 = $ob[$this->language]['Patent']['PatentNameInvalid'];
            $this->error3 = $ob[$this->language]['Patent']['PatentNationalIdRequired'];
            $this->error4 = $ob[$this->language]['Patent']['PatentNationalIdInvalid'];
            $this->error5 = $ob[$this->language]['Patent']['PatentPassportNoRequired'];
            $this->error6 = $ob[$this->language]['Patent']['PatentPassportNoInvalid'];
            $this->error7 = $ob[$this->language]['Patent']['PatentEmailRequired'];
            $this->error8 = $ob[$this->language]['Patent']['PatentEmailInvalid'];
            $this->error9 = $ob[$this->language]['Patent']['PatentPhoneRequired'];
            $this->error10 = $ob[$this->language]['Patent']['PatentPhoneInvalid'];
            $this->error11 = $ob[$this->language]['Patent']['PatentPhone2Required'];
            $this->error12 = $ob[$this->language]['Patent']['PatentPhone2Invalid'];
            $this->error13 = $ob[$this->language]['Patent']['PatentAddressRequired'];
            $this->error14 = $ob[$this->language]['Patent']['PatentAddressInvalid'];
            $this->error15 = $ob[$this->language]['Patent']['PatentFastingHoursRequired'];
            $this->error16 = $ob[$this->language]['Patent']['PatentDiseaseRequired'];
            $this->error17 = $ob[$this->language]['Patent']['PatentNationalityRequired'];
            $this->error18 = $ob[$this->language]['Patent']['PatentGenderRequired'];
            $this->error19 = $ob[$this->language]['Patent']['PatentLastPeriodDateRequired'];
            $this->error20 = $ob[$this->language]['Patent']['PatentDateBirthRequired'];
            $this->error21 = $ob[$this->language]['Patent']['PatentContractingRequired'];
            $this->error22 = $ob[$this->language]['Patent']['PatentDiseasOtherInvalid'];
            $this->error23 = $ob[$this->language]['Patent']['PatentAvatarImage'];
            $this->error32 = $ob[$this->language]['Patent']['PatentAvatarMax'];
            $this->PatentAvatarDimensions = $ob[$this->language]['Patent']['PatentAvatarDimensions'];
            $this->title5 = $ob[$this->language]['Patent']['PatentIamge'];
            //init table
            $this->table24 = $ob[$this->language]['Patent']['TablePatentCode'];
            $this->table8 = $ob[$this->language]['Patent']['TablePatentAvatar'];
            $this->table9 = $ob[$this->language]['Patent']['TablePatentName'];
            $this->table10 = $ob[$this->language]['Patent']['TablePatentNationality'];
            $this->table22 = $ob[$this->language]['Patent']['TablePatentNationalId'];
            $this->table12 = $ob[$this->language]['Patent']['TablePatentPassportNo'];
            $this->table13 = $ob[$this->language]['Patent']['TablePatentEmail'];
            $this->table14 = $ob[$this->language]['Patent']['TablePatentPhone'];
            $this->table15 = $ob[$this->language]['Patent']['TablePatentPhone2'];
            $this->table16 = $ob[$this->language]['Patent']['TablePatentGender'];
            $this->table17 = $ob[$this->language]['Patent']['TablePatentLastPeriodDate'];
            $this->table18 = $ob[$this->language]['Patent']['TablePatentDateBirth'];
            $this->table19 = $ob[$this->language]['Patent']['TablePatentContracting'];
            $this->table20 = $ob[$this->language]['Patent']['TablePatentHours'];
            $this->table21 = $ob[$this->language]['Patent']['TablePatentDisease'];
            $this->table23 = $ob[$this->language]['Patent']['TablePatentAddress'];
            //init label
            $this->label4 = $ob[$this->language]['Patent']['LabelPatentNationality'];
            $this->label9 = $ob[$this->language]['Patent']['LabelPatentGender'];
            $this->label13 = $ob[$this->language]['Patent']['LabelPatentContracting'];
            $this->nationality = $ob[$this->language]['SelectNationalityBox'];
            $this->gender = $ob[$this->language]['SelectGenderBox'];
            $this->selectBox1 = $ob[$this->language]['Patent']['SelectBoxPatentNationality'];
            $this->selectBox2 = $ob[$this->language]['Patent']['SelectBoxPatentGender'];
            $this->selectBox5 = $ob[$this->language]['Patent']['SelectBoxPatentContracting'];
            //make button
            $this->button4 = $ob[$this->language]['Patent']['ButtonPatentEdit'];
            $this->successfully1 = $ob[$this->language]['Patent']['LoadMessage'];
        }else if($ob['Patent'] && Rays::find(request()->session()->get('userLogout'))['Branch']){

            $this->myContract = isset($ob['Contracts'])?Contracts::fromArray($ob['Contracts']):array();
            parent::__construct($ob['Setting']['Language'], 
            $ob[$ob['Setting']['Language']]['Patent']['TitlePatentDelete'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentDelete'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonPatentDelete'],
            route('deleteItem', 'Patent'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Patent']['Patients'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeBranch(Rays::find(request()->session()->get('userLogout'))['Branch'], $ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Patent']['TitleAddPatent'],
            $ob[$ob['Setting']['Language']]['Patent']['TitlePatentEdit'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonPatentAvatar'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonAddPatent'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonCreatePatent'],
            $ob[$ob['Setting']['Language']]['Patent']['TablePatentEdit'],
            $ob[$ob['Setting']['Language']]['Patent']['TablePatentId'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentAvatar'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentName'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentName'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentEmail'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentEmail'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentPhone'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentPhone'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentAddress'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentAddress'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['CheckBox'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentOther'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentOther'],
            Patent::fromArray(array_reverse($ob['Patent']), $this->myContract, $ob[$ob['Setting']['Language']]['SelectGenderBox'], $ob[$ob['Setting']['Language']]['SelectNationalityBox'], $ob[$ob['Setting']['Language']]['CheckBox']));
            $this->error1 = $ob[$this->language]['Patent']['PatentNameRequired'];
            $this->error2 = $ob[$this->language]['Patent']['PatentNameInvalid'];
            $this->error3 = $ob[$this->language]['Patent']['PatentNationalIdRequired'];
            $this->error4 = $ob[$this->language]['Patent']['PatentNationalIdInvalid'];
            $this->error5 = $ob[$this->language]['Patent']['PatentPassportNoRequired'];
            $this->error6 = $ob[$this->language]['Patent']['PatentPassportNoInvalid'];
            $this->error7 = $ob[$this->language]['Patent']['PatentEmailRequired'];
            $this->error8 = $ob[$this->language]['Patent']['PatentEmailInvalid'];
            $this->error9 = $ob[$this->language]['Patent']['PatentPhoneRequired'];
            $this->error10 = $ob[$this->language]['Patent']['PatentPhoneInvalid'];
            $this->error11 = $ob[$this->language]['Patent']['PatentPhone2Required'];
            $this->error12 = $ob[$this->language]['Patent']['PatentPhone2Invalid'];
            $this->error13 = $ob[$this->language]['Patent']['PatentAddressRequired'];
            $this->error14 = $ob[$this->language]['Patent']['PatentAddressInvalid'];
            $this->error15 = $ob[$this->language]['Patent']['PatentFastingHoursRequired'];
            $this->error16 = $ob[$this->language]['Patent']['PatentDiseaseRequired'];
            $this->error17 = $ob[$this->language]['Patent']['PatentNationalityRequired'];
            $this->error18 = $ob[$this->language]['Patent']['PatentGenderRequired'];
            $this->error19 = $ob[$this->language]['Patent']['PatentLastPeriodDateRequired'];
            $this->error20 = $ob[$this->language]['Patent']['PatentDateBirthRequired'];
            $this->error21 = $ob[$this->language]['Patent']['PatentContractingRequired'];
            $this->error22 = $ob[$this->language]['Patent']['PatentDiseasOtherInvalid'];
            $this->error23 = $ob[$this->language]['Patent']['PatentAvatarImage'];
            $this->error32 = $ob[$this->language]['Patent']['PatentAvatarMax'];
            $this->PatentAvatarDimensions = $ob[$this->language]['Patent']['PatentAvatarDimensions'];
            $this->title5 = $ob[$this->language]['Patent']['PatentIamge'];
            //init table
            $this->table24 = $ob[$this->language]['Patent']['TablePatentCode'];
            $this->table8 = $ob[$this->language]['Patent']['TablePatentAvatar'];
            $this->table9 = $ob[$this->language]['Patent']['TablePatentName'];
            $this->table10 = $ob[$this->language]['Patent']['TablePatentNationality'];
            $this->table22 = $ob[$this->language]['Patent']['TablePatentNationalId'];
            $this->table12 = $ob[$this->language]['Patent']['TablePatentPassportNo'];
            $this->table13 = $ob[$this->language]['Patent']['TablePatentEmail'];
            $this->table14 = $ob[$this->language]['Patent']['TablePatentPhone'];
            $this->table15 = $ob[$this->language]['Patent']['TablePatentPhone2'];
            $this->table16 = $ob[$this->language]['Patent']['TablePatentGender'];
            $this->table17 = $ob[$this->language]['Patent']['TablePatentLastPeriodDate'];
            $this->table18 = $ob[$this->language]['Patent']['TablePatentDateBirth'];
            $this->table19 = $ob[$this->language]['Patent']['TablePatentContracting'];
            $this->table20 = $ob[$this->language]['Patent']['TablePatentHours'];
            $this->table21 = $ob[$this->language]['Patent']['TablePatentDisease'];
            $this->table23 = $ob[$this->language]['Patent']['TablePatentAddress'];
            //init label
            $this->label4 = $ob[$this->language]['Patent']['LabelPatentNationality'];
            $this->label9 = $ob[$this->language]['Patent']['LabelPatentGender'];
            $this->label13 = $ob[$this->language]['Patent']['LabelPatentContracting'];
            $this->nationality = $ob[$this->language]['SelectNationalityBox'];
            $this->gender = $ob[$this->language]['SelectGenderBox'];
            $this->selectBox1 = $ob[$this->language]['Patent']['SelectBoxPatentNationality'];
            $this->selectBox2 = $ob[$this->language]['Patent']['SelectBoxPatentGender'];
            $this->selectBox5 = $ob[$this->language]['Patent']['SelectBoxPatentContracting'];
            //make button
            $this->button4 = $ob[$this->language]['Patent']['ButtonPatentEdit'];
            $this->myContract = isset($ob['Contracts'])?Contracts::fromArray($ob['Contracts']):array();
            $this->myPatent = isset($ob['Patent'])?Patent::fromArray($ob['Patent'], $this->myContract, $ob[$ob['Setting']['Language']]['SelectGenderBox'], $ob[$ob['Setting']['Language']]['SelectNationalityBox'], $ob[$ob['Setting']['Language']]['CheckBox']):array();
            $this->successfully1 = $ob[$this->language]['Patent']['LoadMessage'];
        }else if(!$ob['Patent'] && $ob['Branch']){
            parent::__construct($ob['Setting']['Language'], 
            $ob[$ob['Setting']['Language']]['Patent']['TitlePatentDelete'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentDelete'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonPatentDelete'],
            route('deleteItem', 'Patent'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Patent']['Patients'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeBranch($ob['Branch'], $ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Patent']['TitleAddPatent'],
            $ob[$ob['Setting']['Language']]['Patent']['TitlePatentEdit'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonPatentAvatar'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonAddPatent'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonCreatePatent'],
            $ob[$ob['Setting']['Language']]['Patent']['TablePatentEdit'],
            $ob[$ob['Setting']['Language']]['Patent']['TablePatentId'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentAvatar'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentName'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentName'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentEmail'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentEmail'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentPhone'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentPhone'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentAddress'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentAddress'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['CheckBox'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentOther'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentOther']);
            $this->error1 = $ob[$this->language]['Patent']['PatentNameRequired'];
            $this->error2 = $ob[$this->language]['Patent']['PatentNameInvalid'];
            $this->error3 = $ob[$this->language]['Patent']['PatentNationalIdRequired'];
            $this->error4 = $ob[$this->language]['Patent']['PatentNationalIdInvalid'];
            $this->error5 = $ob[$this->language]['Patent']['PatentPassportNoRequired'];
            $this->error6 = $ob[$this->language]['Patent']['PatentPassportNoInvalid'];
            $this->error7 = $ob[$this->language]['Patent']['PatentEmailRequired'];
            $this->error8 = $ob[$this->language]['Patent']['PatentEmailInvalid'];
            $this->error9 = $ob[$this->language]['Patent']['PatentPhoneRequired'];
            $this->error10 = $ob[$this->language]['Patent']['PatentPhoneInvalid'];
            $this->error11 = $ob[$this->language]['Patent']['PatentPhone2Required'];
            $this->error12 = $ob[$this->language]['Patent']['PatentPhone2Invalid'];
            $this->error13 = $ob[$this->language]['Patent']['PatentAddressRequired'];
            $this->error14 = $ob[$this->language]['Patent']['PatentAddressInvalid'];
            $this->error15 = $ob[$this->language]['Patent']['PatentFastingHoursRequired'];
            $this->error16 = $ob[$this->language]['Patent']['PatentDiseaseRequired'];
            $this->error17 = $ob[$this->language]['Patent']['PatentNationalityRequired'];
            $this->error18 = $ob[$this->language]['Patent']['PatentGenderRequired'];
            $this->error19 = $ob[$this->language]['Patent']['PatentLastPeriodDateRequired'];
            $this->error20 = $ob[$this->language]['Patent']['PatentDateBirthRequired'];
            $this->error21 = $ob[$this->language]['Patent']['PatentContractingRequired'];
            $this->error22 = $ob[$this->language]['Patent']['PatentDiseasOtherInvalid'];
            $this->error23 = $ob[$this->language]['Patent']['PatentAvatarImage'];
            $this->error32 = $ob[$this->language]['Patent']['PatentAvatarMax'];
            $this->PatentAvatarDimensions = $ob[$this->language]['Patent']['PatentAvatarDimensions'];
            $this->title5 = $ob[$this->language]['Patent']['PatentIamge'];
            //init table
            $this->table24 = $ob[$this->language]['Patent']['TablePatentCode'];
            $this->table8 = $ob[$this->language]['Patent']['TablePatentAvatar'];
            $this->table9 = $ob[$this->language]['Patent']['TablePatentName'];
            $this->table10 = $ob[$this->language]['Patent']['TablePatentNationality'];
            $this->table22 = $ob[$this->language]['Patent']['TablePatentNationalId'];
            $this->table12 = $ob[$this->language]['Patent']['TablePatentPassportNo'];
            $this->table13 = $ob[$this->language]['Patent']['TablePatentEmail'];
            $this->table14 = $ob[$this->language]['Patent']['TablePatentPhone'];
            $this->table15 = $ob[$this->language]['Patent']['TablePatentPhone2'];
            $this->table16 = $ob[$this->language]['Patent']['TablePatentGender'];
            $this->table17 = $ob[$this->language]['Patent']['TablePatentLastPeriodDate'];
            $this->table18 = $ob[$this->language]['Patent']['TablePatentDateBirth'];
            $this->table19 = $ob[$this->language]['Patent']['TablePatentContracting'];
            $this->table20 = $ob[$this->language]['Patent']['TablePatentHours'];
            $this->table21 = $ob[$this->language]['Patent']['TablePatentDisease'];
            $this->table23 = $ob[$this->language]['Patent']['TablePatentAddress'];
            //init label
            $this->label4 = $ob[$this->language]['Patent']['LabelPatentNationality'];
            $this->label9 = $ob[$this->language]['Patent']['LabelPatentGender'];
            $this->label13 = $ob[$this->language]['Patent']['LabelPatentContracting'];
            $this->nationality = $ob[$this->language]['SelectNationalityBox'];
            $this->gender = $ob[$this->language]['SelectGenderBox'];
            $this->selectBox1 = $ob[$this->language]['Patent']['SelectBoxPatentNationality'];
            $this->selectBox2 = $ob[$this->language]['Patent']['SelectBoxPatentGender'];
            $this->selectBox5 = $ob[$this->language]['Patent']['SelectBoxPatentContracting'];
            //make button
            $this->button4 = $ob[$this->language]['Patent']['ButtonPatentEdit'];
            $this->myContract = isset($ob['Contracts'])?Contracts::fromArray($ob['Contracts']):array();
            $this->successfully1 = $ob[$this->language]['Patent']['LoadMessage'];
        }else if(!$ob['Patent'] && Rays::find(request()->session()->get('userLogout'))['Branch']){
            parent::__construct($ob['Setting']['Language'], 
            $ob[$ob['Setting']['Language']]['Patent']['TitlePatentDelete'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentDelete'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonPatentDelete'],
            route('deleteItem', 'Patent'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Patent']['Patients'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeBranch(Rays::find(request()->session()->get('userLogout'))['Branch'], $ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Patent']['TitleAddPatent'],
            $ob[$ob['Setting']['Language']]['Patent']['TitlePatentEdit'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonPatentAvatar'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonAddPatent'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonCreatePatent'],
            $ob[$ob['Setting']['Language']]['Patent']['TablePatentEdit'],
            $ob[$ob['Setting']['Language']]['Patent']['TablePatentId'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentAvatar'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentName'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentName'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentEmail'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentEmail'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentPhone'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentPhone'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentAddress'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentAddress'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['CheckBox'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentOther'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentOther']);
            $this->error1 = $ob[$this->language]['Patent']['PatentNameRequired'];
            $this->error2 = $ob[$this->language]['Patent']['PatentNameInvalid'];
            $this->error3 = $ob[$this->language]['Patent']['PatentNationalIdRequired'];
            $this->error4 = $ob[$this->language]['Patent']['PatentNationalIdInvalid'];
            $this->error5 = $ob[$this->language]['Patent']['PatentPassportNoRequired'];
            $this->error6 = $ob[$this->language]['Patent']['PatentPassportNoInvalid'];
            $this->error7 = $ob[$this->language]['Patent']['PatentEmailRequired'];
            $this->error8 = $ob[$this->language]['Patent']['PatentEmailInvalid'];
            $this->error9 = $ob[$this->language]['Patent']['PatentPhoneRequired'];
            $this->error10 = $ob[$this->language]['Patent']['PatentPhoneInvalid'];
            $this->error11 = $ob[$this->language]['Patent']['PatentPhone2Required'];
            $this->error12 = $ob[$this->language]['Patent']['PatentPhone2Invalid'];
            $this->error13 = $ob[$this->language]['Patent']['PatentAddressRequired'];
            $this->error14 = $ob[$this->language]['Patent']['PatentAddressInvalid'];
            $this->error15 = $ob[$this->language]['Patent']['PatentFastingHoursRequired'];
            $this->error16 = $ob[$this->language]['Patent']['PatentDiseaseRequired'];
            $this->error17 = $ob[$this->language]['Patent']['PatentNationalityRequired'];
            $this->error18 = $ob[$this->language]['Patent']['PatentGenderRequired'];
            $this->error19 = $ob[$this->language]['Patent']['PatentLastPeriodDateRequired'];
            $this->error20 = $ob[$this->language]['Patent']['PatentDateBirthRequired'];
            $this->error21 = $ob[$this->language]['Patent']['PatentContractingRequired'];
            $this->error22 = $ob[$this->language]['Patent']['PatentDiseasOtherInvalid'];
            $this->error23 = $ob[$this->language]['Patent']['PatentAvatarImage'];
            $this->error32 = $ob[$this->language]['Patent']['PatentAvatarMax'];
            $this->PatentAvatarDimensions = $ob[$this->language]['Patent']['PatentAvatarDimensions'];
            $this->title5 = $ob[$this->language]['Patent']['PatentIamge'];
            //init table
            $this->table24 = $ob[$this->language]['Patent']['TablePatentCode'];
            $this->table8 = $ob[$this->language]['Patent']['TablePatentAvatar'];
            $this->table9 = $ob[$this->language]['Patent']['TablePatentName'];
            $this->table10 = $ob[$this->language]['Patent']['TablePatentNationality'];
            $this->table22 = $ob[$this->language]['Patent']['TablePatentNationalId'];
            $this->table12 = $ob[$this->language]['Patent']['TablePatentPassportNo'];
            $this->table13 = $ob[$this->language]['Patent']['TablePatentEmail'];
            $this->table14 = $ob[$this->language]['Patent']['TablePatentPhone'];
            $this->table15 = $ob[$this->language]['Patent']['TablePatentPhone2'];
            $this->table16 = $ob[$this->language]['Patent']['TablePatentGender'];
            $this->table17 = $ob[$this->language]['Patent']['TablePatentLastPeriodDate'];
            $this->table18 = $ob[$this->language]['Patent']['TablePatentDateBirth'];
            $this->table19 = $ob[$this->language]['Patent']['TablePatentContracting'];
            $this->table20 = $ob[$this->language]['Patent']['TablePatentHours'];
            $this->table21 = $ob[$this->language]['Patent']['TablePatentDisease'];
            $this->table23 = $ob[$this->language]['Patent']['TablePatentAddress'];
            //init label
            $this->label4 = $ob[$this->language]['Patent']['LabelPatentNationality'];
            $this->label9 = $ob[$this->language]['Patent']['LabelPatentGender'];
            $this->label13 = $ob[$this->language]['Patent']['LabelPatentContracting'];
            $this->nationality = $ob[$this->language]['SelectNationalityBox'];
            $this->gender = $ob[$this->language]['SelectGenderBox'];
            $this->selectBox1 = $ob[$this->language]['Patent']['SelectBoxPatentNationality'];
            $this->selectBox2 = $ob[$this->language]['Patent']['SelectBoxPatentGender'];
            $this->selectBox5 = $ob[$this->language]['Patent']['SelectBoxPatentContracting'];
            //make button
            $this->button4 = $ob[$this->language]['Patent']['ButtonPatentEdit'];
            $this->myContract = isset($ob['Contracts'])?Contracts::fromArray($ob['Contracts']):array();
            $this->successfully1 = $ob[$this->language]['Patent']['LoadMessage'];
        }else if($ob['Patent']){
            $this->myContract = isset($ob['Contracts'])?Contracts::fromArray($ob['Contracts']):array();            
            parent::__construct($ob['Setting']['Language'], 
            $ob[$ob['Setting']['Language']]['Patent']['TitlePatentDelete'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentDelete'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonPatentDelete'],
            route('deleteItem', 'Patent'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Patent']['Patients'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeMainBranch($ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Patent']['TitleAddPatent'],
            $ob[$ob['Setting']['Language']]['Patent']['TitlePatentEdit'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonPatentAvatar'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonAddPatent'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonCreatePatent'],
            $ob[$ob['Setting']['Language']]['Patent']['TablePatentEdit'],
            $ob[$ob['Setting']['Language']]['Patent']['TablePatentId'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentAvatar'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentName'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentName'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentEmail'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentEmail'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentPhone'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentPhone'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentAddress'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentAddress'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['CheckBox'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentOther'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentOther'],
            Patent::fromArray(array_reverse($ob['Patent']), $this->myContract, $ob[$ob['Setting']['Language']]['SelectGenderBox'], $ob[$ob['Setting']['Language']]['SelectNationalityBox'], $ob[$ob['Setting']['Language']]['CheckBox']));
            $this->error1 = $ob[$this->language]['Patent']['PatentNameRequired'];
            $this->error2 = $ob[$this->language]['Patent']['PatentNameInvalid'];
            $this->error3 = $ob[$this->language]['Patent']['PatentNationalIdRequired'];
            $this->error4 = $ob[$this->language]['Patent']['PatentNationalIdInvalid'];
            $this->error5 = $ob[$this->language]['Patent']['PatentPassportNoRequired'];
            $this->error6 = $ob[$this->language]['Patent']['PatentPassportNoInvalid'];
            $this->error7 = $ob[$this->language]['Patent']['PatentEmailRequired'];
            $this->error8 = $ob[$this->language]['Patent']['PatentEmailInvalid'];
            $this->error9 = $ob[$this->language]['Patent']['PatentPhoneRequired'];
            $this->error10 = $ob[$this->language]['Patent']['PatentPhoneInvalid'];
            $this->error11 = $ob[$this->language]['Patent']['PatentPhone2Required'];
            $this->error12 = $ob[$this->language]['Patent']['PatentPhone2Invalid'];
            $this->error13 = $ob[$this->language]['Patent']['PatentAddressRequired'];
            $this->error14 = $ob[$this->language]['Patent']['PatentAddressInvalid'];
            $this->error15 = $ob[$this->language]['Patent']['PatentFastingHoursRequired'];
            $this->error16 = $ob[$this->language]['Patent']['PatentDiseaseRequired'];
            $this->error17 = $ob[$this->language]['Patent']['PatentNationalityRequired'];
            $this->error18 = $ob[$this->language]['Patent']['PatentGenderRequired'];
            $this->error19 = $ob[$this->language]['Patent']['PatentLastPeriodDateRequired'];
            $this->error20 = $ob[$this->language]['Patent']['PatentDateBirthRequired'];
            $this->error21 = $ob[$this->language]['Patent']['PatentContractingRequired'];
            $this->error22 = $ob[$this->language]['Patent']['PatentDiseasOtherInvalid'];
            $this->error23 = $ob[$this->language]['Patent']['PatentAvatarImage'];
            $this->error32 = $ob[$this->language]['Patent']['PatentAvatarMax'];
            $this->PatentAvatarDimensions = $ob[$this->language]['Patent']['PatentAvatarDimensions'];
            $this->title5 = $ob[$this->language]['Patent']['PatentIamge'];
            //init table
            $this->table24 = $ob[$this->language]['Patent']['TablePatentCode'];
            $this->table8 = $ob[$this->language]['Patent']['TablePatentAvatar'];
            $this->table9 = $ob[$this->language]['Patent']['TablePatentName'];
            $this->table10 = $ob[$this->language]['Patent']['TablePatentNationality'];
            $this->table22 = $ob[$this->language]['Patent']['TablePatentNationalId'];
            $this->table12 = $ob[$this->language]['Patent']['TablePatentPassportNo'];
            $this->table13 = $ob[$this->language]['Patent']['TablePatentEmail'];
            $this->table14 = $ob[$this->language]['Patent']['TablePatentPhone'];
            $this->table15 = $ob[$this->language]['Patent']['TablePatentPhone2'];
            $this->table16 = $ob[$this->language]['Patent']['TablePatentGender'];
            $this->table17 = $ob[$this->language]['Patent']['TablePatentLastPeriodDate'];
            $this->table18 = $ob[$this->language]['Patent']['TablePatentDateBirth'];
            $this->table19 = $ob[$this->language]['Patent']['TablePatentContracting'];
            $this->table20 = $ob[$this->language]['Patent']['TablePatentHours'];
            $this->table21 = $ob[$this->language]['Patent']['TablePatentDisease'];
            $this->table23 = $ob[$this->language]['Patent']['TablePatentAddress'];
            //init label
            $this->label4 = $ob[$this->language]['Patent']['LabelPatentNationality'];
            $this->label9 = $ob[$this->language]['Patent']['LabelPatentGender'];
            $this->label13 = $ob[$this->language]['Patent']['LabelPatentContracting'];
            $this->nationality = $ob[$this->language]['SelectNationalityBox'];
            $this->gender = $ob[$this->language]['SelectGenderBox'];
            $this->selectBox1 = $ob[$this->language]['Patent']['SelectBoxPatentNationality'];
            $this->selectBox2 = $ob[$this->language]['Patent']['SelectBoxPatentGender'];
            $this->selectBox5 = $ob[$this->language]['Patent']['SelectBoxPatentContracting'];
            //make button
            $this->button4 = $ob[$this->language]['Patent']['ButtonPatentEdit'];
            $this->successfully1 = $ob[$this->language]['Patent']['LoadMessage'];
        }else //if(request()->route('id') === 'Patients')
        {
            parent::__construct($ob['Setting']['Language'], 
            $ob[$ob['Setting']['Language']]['Patent']['TitlePatentDelete'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentDelete'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonPatentDelete'],
            route('deleteItem', 'Patent'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Patent']['Patients'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeMainBranch($ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Patent']['TitleAddPatent'],
            $ob[$ob['Setting']['Language']]['Patent']['TitlePatentEdit'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonPatentAvatar'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonAddPatent'],
            $ob[$ob['Setting']['Language']]['Patent']['ButtonCreatePatent'],
            $ob[$ob['Setting']['Language']]['Patent']['TablePatentEdit'],
            $ob[$ob['Setting']['Language']]['Patent']['TablePatentId'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentAvatar'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentName'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentName'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentNationalId'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentPassportNo'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentEmail'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentEmail'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentPhone'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentPhone'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentPhone2'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentLastPeriodDate'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentDateBirth'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentAddress'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentAddress'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentFastingGours'],
            $ob[$ob['Setting']['Language']]['CheckBox'],
            $ob[$ob['Setting']['Language']]['Patent']['LabelPatentOther'],
            $ob[$ob['Setting']['Language']]['Patent']['HintPatentOther']);
            $this->error1 = $ob[$this->language]['Patent']['PatentNameRequired'];
            $this->error2 = $ob[$this->language]['Patent']['PatentNameInvalid'];
            $this->error3 = $ob[$this->language]['Patent']['PatentNationalIdRequired'];
            $this->error4 = $ob[$this->language]['Patent']['PatentNationalIdInvalid'];
            $this->error5 = $ob[$this->language]['Patent']['PatentPassportNoRequired'];
            $this->error6 = $ob[$this->language]['Patent']['PatentPassportNoInvalid'];
            $this->error7 = $ob[$this->language]['Patent']['PatentEmailRequired'];
            $this->error8 = $ob[$this->language]['Patent']['PatentEmailInvalid'];
            $this->error9 = $ob[$this->language]['Patent']['PatentPhoneRequired'];
            $this->error10 = $ob[$this->language]['Patent']['PatentPhoneInvalid'];
            $this->error11 = $ob[$this->language]['Patent']['PatentPhone2Required'];
            $this->error12 = $ob[$this->language]['Patent']['PatentPhone2Invalid'];
            $this->error13 = $ob[$this->language]['Patent']['PatentAddressRequired'];
            $this->error14 = $ob[$this->language]['Patent']['PatentAddressInvalid'];
            $this->error15 = $ob[$this->language]['Patent']['PatentFastingHoursRequired'];
            $this->error16 = $ob[$this->language]['Patent']['PatentDiseaseRequired'];
            $this->error17 = $ob[$this->language]['Patent']['PatentNationalityRequired'];
            $this->error18 = $ob[$this->language]['Patent']['PatentGenderRequired'];
            $this->error19 = $ob[$this->language]['Patent']['PatentLastPeriodDateRequired'];
            $this->error20 = $ob[$this->language]['Patent']['PatentDateBirthRequired'];
            $this->error21 = $ob[$this->language]['Patent']['PatentContractingRequired'];
            $this->error22 = $ob[$this->language]['Patent']['PatentDiseasOtherInvalid'];
            $this->error23 = $ob[$this->language]['Patent']['PatentAvatarImage'];
            $this->error32 = $ob[$this->language]['Patent']['PatentAvatarMax'];
            $this->PatentAvatarDimensions = $ob[$this->language]['Patent']['PatentAvatarDimensions'];
            $this->title5 = $ob[$this->language]['Patent']['PatentIamge'];
            //init table
            $this->table24 = $ob[$this->language]['Patent']['TablePatentCode'];
            $this->table8 = $ob[$this->language]['Patent']['TablePatentAvatar'];
            $this->table9 = $ob[$this->language]['Patent']['TablePatentName'];
            $this->table10 = $ob[$this->language]['Patent']['TablePatentNationality'];
            $this->table22 = $ob[$this->language]['Patent']['TablePatentNationalId'];
            $this->table12 = $ob[$this->language]['Patent']['TablePatentPassportNo'];
            $this->table13 = $ob[$this->language]['Patent']['TablePatentEmail'];
            $this->table14 = $ob[$this->language]['Patent']['TablePatentPhone'];
            $this->table15 = $ob[$this->language]['Patent']['TablePatentPhone2'];
            $this->table16 = $ob[$this->language]['Patent']['TablePatentGender'];
            $this->table17 = $ob[$this->language]['Patent']['TablePatentLastPeriodDate'];
            $this->table18 = $ob[$this->language]['Patent']['TablePatentDateBirth'];
            $this->table19 = $ob[$this->language]['Patent']['TablePatentContracting'];
            $this->table20 = $ob[$this->language]['Patent']['TablePatentHours'];
            $this->table21 = $ob[$this->language]['Patent']['TablePatentDisease'];
            $this->table23 = $ob[$this->language]['Patent']['TablePatentAddress'];
            //init label
            $this->label4 = $ob[$this->language]['Patent']['LabelPatentNationality'];
            $this->label9 = $ob[$this->language]['Patent']['LabelPatentGender'];
            $this->label13 = $ob[$this->language]['Patent']['LabelPatentContracting'];
            $this->nationality = $ob[$this->language]['SelectNationalityBox'];
            $this->gender = $ob[$this->language]['SelectGenderBox'];
            $this->selectBox1 = $ob[$this->language]['Patent']['SelectBoxPatentNationality'];
            $this->selectBox2 = $ob[$this->language]['Patent']['SelectBoxPatentGender'];
            $this->selectBox5 = $ob[$this->language]['Patent']['SelectBoxPatentContracting'];
            //make button
            $this->button4 = $ob[$this->language]['Patent']['ButtonPatentEdit'];
            $this->myContract = isset($ob['Contracts'])?Contracts::fromArray($ob['Contracts']):array();
            $this->successfully1 = $ob[$this->language]['Patent']['LoadMessage'];
        }


    }
    public function index($id){
        return view($id === 'Receipt'? 'admin.reception.patientRegisteration':'admin.reception.patients', [
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
