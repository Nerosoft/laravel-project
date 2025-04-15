<?php
namespace App\language\admin\reception;
use App\instance\admin\test_cultures\Test;
use App\instance\admin\test_cultures\MyCurrentOffers;
use App\instance\admin\reception\Receipt;
use App\instance\admin\reception\MyKnows;
use App\instance\admin\reception\Patent;
use App\language\share\Page;
use App\Models\Rays;
use App\Menu;
class PatientRegisteration extends Page
{
    /**
     * Create a new class instance.
     */
    public $myPatent = array();
    public $arr1 = array();
    public $arr6 = array();
    public $name1 = 'CurrentOffers';
    public function __construct($state)
    {
        $ob = Rays::find(request()->session()->get('userId'));
        parent::__construct($ob[$ob['Setting']['Language']]['Error'], 
            $state, 
            $ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['Title']['DeleteReceipt'],
            $ob[$ob['Setting']['Language']]['Label']['DeleteReceipt'],
            $ob[$ob['Setting']['Language']]['Button']['DeleteReceipt'],
            route('deletePatientServices'),
            $ob[$ob['Setting']['Language']]['TableInfo'],

            $ob[$ob['Setting']['Language']]['Title']['PatientRegisteration'],

            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            
            $ob['Branch'],
            
            new Menu($ob[$ob['Setting']['Language']]['Menu'], 'Admin'),
            $ob[$ob['Setting']['Language']]['Title']['AddPatientServices'],
            $ob[$ob['Setting']['Language']]['Title']['EditReceipt'],
            $ob[$ob['Setting']['Language']]['Button']['PatientServices'],
            $ob[$ob['Setting']['Language']]['Button']['AddPatientServices'],
            $ob[$ob['Setting']['Language']]['Button']['EditReceipt'],
            $ob[$ob['Setting']['Language']]['Table']['ReceiptId'],
            $ob[$ob['Setting']['Language']]['Table']['ReceiptPatientEdit'],
            $ob['Test'],
            $ob['Cultures'],
            $ob['Packages'],
            $ob['CurrentOffers'],
            true,
            $ob[$ob['Setting']['Language']]['SelectTestBox'],
            $ob[$ob['Setting']['Language']]['SelectOfferBox']);
      
            $this->title5 = $ob[$this->language]['Title']['ReceiptPatient'];
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
            // $this->initError($ob[$this->language]['Error']);
            $this->error8 = $ob[$this->language]['Error']['PatientRegisterationNameRequired'];



            //init table
          

            $this->button5 = $ob[$this->language]['Button']['PatientAddTest'];
            

            $this->button4 = $ob[$this->language]['Button']['PatientDeleteTest'];
            //init label
            $this->label3 = $ob[$this->language]['Label']['PatentNationality'];
            $this->label4 = $ob[$this->language]['Label']['PatentNationalId'];
            $this->label5 = $ob[$this->language]['Label']['PatentPassportNo'];
            $this->label6 = $ob[$this->language]['Label']['PatentEmail'];
            $this->label7 = $ob[$this->language]['Label']['PatentPhone'];
            $this->label8 = $ob[$this->language]['Label']['PatentPhone2'];
            $this->label9 = $ob[$this->language]['Label']['PatentGender'];
            $this->label10 = $ob[$this->language]['Label']['PatentLastPeriodDate'];
            $this->label11 = $ob[$this->language]['Label']['PatentDateBirth'];
            $this->label12 = $ob[$this->language]['Label']['PatentAddress'];
            $this->label13 = $ob[$this->language]['Label']['PatentContracting'];
            $this->label14 = $ob[$this->language]['Label']['PatentFastingGours'];
            $this->label15 = $ob[$this->language]['Label']['PatentOther'];
            $this->label16 = $ob[$this->language]['Label']['PatientCode'];
            $this->label17 = $ob[$this->language]['Label']['PatientNameServices'];
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
            $this->label44 = $ob[$this->language]['Label']['PatentName'];
            $this->label45 = $ob[$this->language]['Label']['PatentAvatar'];
            //make hint
            $this->hint1 = $ob[$this->language]['Hint']['PatentName'];
            $this->hint2 = $ob[$this->language]['Hint']['PatentNationalId'];
            $this->hint3 = $ob[$this->language]['Hint']['PatentPassportNo'];
            $this->hint4 = $ob[$this->language]['Hint']['PatentEmail'];
            $this->hint5 = $ob[$this->language]['Hint']['PatentPhone'];
            $this->hint6 = $ob[$this->language]['Hint']['PatentPhone2'];
            $this->hint7 = $ob[$this->language]['Hint']['PatentLastPeriodDate'];
            $this->hint8 = $ob[$this->language]['Hint']['PatentDateBirth'];
            $this->hint9 = $ob[$this->language]['Hint']['PatentAddress'];
            $this->hint10 = $ob[$this->language]['Hint']['PatentFastingGours'];
            $this->hint11 = $ob[$this->language]['Hint']['PatentOther'];
            $this->hint12 = $ob[$this->language]['Hint']['PatientCode'];
            $this->hint13 = $ob[$this->language]['Hint']['PatientNationality'];
            $this->hint14 = $ob[$this->language]['Hint']['PatientGender'];
            $this->hint15 = $ob[$this->language]['Hint']['PatientContracting'];
            $this->hint16 = $ob[$this->language]['Hint']['patientAmountPaid'];
            //init selectbox
            // $this->selectBox6 = $ob[$this->language]['SelectBox']['PatientTestName'];
            $this->selectBox1 = $ob[$this->language]['SelectBox']['PatientPaymentMethod'];
            $this->selectBox2 = $ob[$this->language]['SelectBox']['PatientNameServices'];
            $this->selectBox5 = $ob[$this->language]['SelectBox']['Patientknow'];
            $this->selectBox6 = $ob[$this->language]['SelectBox']['PatientTest'];
            $this->selectBox7 = $ob[$this->language]['SelectBox']['ReceiptPatientPrint'];

            $this->payment = $ob[$this->language]['PaymentMethodBox'];

            $this->allTests = $ob[$this->language]['OptionTestBox'];

            
            $this->dis = $ob[$this->language]['CheckBox'];
            //---------------------------
            if(isset($ob['Patent']))
                foreach ($ob['Patent'] as $key => $patent)
                    $this->myPatent[$key] = new Patent($patent['PatentCode'], $patent['Avatar'], $patent['Name'], $patent['Nationality'], $patent['NationalId'], $patent['PassportNo'], $patent['Email'], $patent['Phone'], $patent['Phone2'], $patent['Gender'], $patent['LastPeriodDate'], $patent['DateBirth'], $patent['Address'], $patent['Contracting'], $patent['Hours'], $patent['Disease']);
            if(isset($ob['Receipt']))//check if patient exsit
                foreach ($ob['Receipt'] as $key => $receipt)
                    $this->arr6[$key] = (new Receipt($receipt['PatientCode'], $receipt['Know'],  $receipt['CurrentOffers'] != null ? array_reduce($receipt['CurrentOffers'], function ($acc, $item) {return is_array($acc) ? [...$acc, new MyCurrentOffers($item['Name'], $item['Shortcut'], $item['Price'], $item['DisplayPrice'], $item['State'], $item['Id'])] : array(new MyCurrentOffers($item['Name'], $item['Shortcut'], $item['Price'], $item['DisplayPrice'], $item['State'], $item['Id']));}, 0) : null, array_reduce($receipt['Test'], function ($acc, $item){return is_array($acc) ? [...$acc, new Test($item['Name'], $item['Shortcut'], $item['Price'], $item['InputOutputLab'], $item['Id'])] : array( new Test($item['Name'], $item['Shortcut'], $item['Price'], $item['InputOutputLab'], $item['Id']));}, 0), $receipt['Discount'], $receipt['DelayedMoney'], $receipt['PaymentDate'], $receipt['AmountPaid'], $receipt['PaymentMethod']))->setPatient($this->myPatent);
            if(isset($ob['Knows']))
                foreach ($ob['Knows'] as $key => $value)
                    $this->arr1[$key] = new MyKnows($value['Name']);
    }
}