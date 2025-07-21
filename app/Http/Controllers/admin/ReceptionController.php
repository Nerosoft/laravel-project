<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rays;
use Illuminate\Validation\Rule;
use App\instance\admin\reception\Receipt;
use App\Http\interface\LangObject;
use App\language\share\PatientInfo;
use App\instance\admin\test_cultures\Test;
use App\instance\admin\test_cultures\Packages;
use App\instance\admin\test_cultures\Cultures;
use App\Http\interface\ActionInit;
use App\instance\admin\reception\Patent;
use App\instance\admin\reception\MyKnows;
use App\instance\admin\contracts\Contracts;


class ReceptionController extends PatientInfo implements LangObject, ActionInit
{
    public function initView(){
        $this->myPatent = isset($this->ob['Patent'])?Patent::fromArray($this->ob['Patent'], isset($this->ob['Contracts'])?Contracts::fromArray($this->ob['Contracts']):array(), $this->ob[$this->ob['Setting']['Language']]['SelectGenderBox'], $this->ob[$this->ob['Setting']['Language']]['SelectNationalityBox'], $this->ob[$this->ob['Setting']['Language']]['CheckBox']):array();
        $this->arr1 = isset($this->ob['Knows']) ? MyKnows::fromArray($this->ob['Knows']):array();
        $this->tableData = $this->ob['Receipt']?Receipt::fromArray2(array_reverse($this->ob['Receipt']),$this->myPatent, $this->arr1, $this->ob[$this->ob['Setting']['Language']]['SelectTestBox'],$this->ob[$this->ob['Setting']['Language']]['PaymentMethodBox']):array();
        $this->title5 = $this->ob[$this->language]['Receipt']['ReceiptPatient'];  
        $this->myCodePatient = $this->ob[$this->language]['Receipt']['PatientCode'];
        //init table
        $this->table13 = $this->ob[$this->language]['Receipt']['PatientRaysName'];
        $this->table14 = $this->ob[$this->language]['Receipt']['PatientRaysPrice'];
        $this->table15 = $this->ob[$this->language]['Receipt']['PatientRaysInOut'];
        $this->table16 = $this->ob[$this->language]['Receipt']['PatientRaysShortcut'];
        $this->table17 = $this->ob[$this->language]['Receipt']['PatientRaysDelete'];
        $this->table18 = $this->ob[$this->language]['Receipt']['PatientRaysSubtotal'];
        $this->table19 = $this->ob[$this->language]['Receipt']['PatientRaysDiscount'];
        $this->table20 = $this->ob[$this->language]['Receipt']['PatientRaysTotalDiscount'];
        $this->table21 = $this->ob[$this->language]['Receipt']['PatientRaysTotal'];
        $this->table22 = $this->ob[$this->language]['Receipt']['PatientRaysPaid'];
        $this->table23 = $this->ob[$this->language]['Receipt']['PatientRaysDue'];
        $this->table24 = $this->ob[$this->language]['Receipt']['PatientRaysDelayedMoney'];
        $this->table25 = $this->ob[$this->language]['Receipt']['PatientRaysDueUser'];
        $this->table26 = $this->ob[$this->language]['Receipt']['PatientRaysEGP'];
        $this->table27 = $this->ob[$this->language]['Receipt']['PatientRaysPercent'];
        $this->table29 = $this->ob[$this->language]['Receipt']['ReceiptPatientCode'];
        $this->table30 = $this->ob[$this->language]['Receipt']['ReceiptPatientName'];
        $this->table31 = $this->ob[$this->language]['Receipt']['ReceiptPatientAge'];
        $this->table32 = $this->ob[$this->language]['Receipt']['ReceiptPatientPhone'];
        $this->table33 = $this->ob[$this->language]['Receipt']['ReceiptPatientTest'];
        $this->table34 = $this->ob[$this->language]['Receipt']['ReceiptPatientSubtotal'];
        $this->table35 = $this->ob[$this->language]['Receipt']['ReceiptPatientDiscount'];
        $this->table36 = $this->ob[$this->language]['Receipt']['ReceiptPatientTotalDiscount'];
        $this->table37 = $this->ob[$this->language]['Receipt']['ReceiptPatientTotal'];
        $this->table38 = $this->ob[$this->language]['Receipt']['ReceiptPatientPaid'];
        $this->table39 = $this->ob[$this->language]['Receipt']['ReceiptPatientDue'];
        $this->table40 = $this->ob[$this->language]['Receipt']['ReceiptPatientDelayedMoney'];
        $this->table41 = $this->ob[$this->language]['Receipt']['ReceiptPatientDueUser'];
        $this->table42 = $this->ob[$this->language]['Receipt']['ReceiptPatientPaymentDate'];
        $this->table43 = $this->ob[$this->language]['Receipt']['ReceiptPatientAmountPaid'];
        $this->table44 = $this->ob[$this->language]['Receipt']['ReceiptPatientPaymentMethod'];
        $this->error1 = $this->ob[$this->language]['Receipt']['PatientRegisterationTestRequired'];
        $this->error8 = $this->ob[$this->language]['Receipt']['PatientRegisterationNameRequired'];
        $this->button5 = $this->ob[$this->language]['Receipt']['PatientAddTest'];
        $this->button4 = $this->ob[$this->language]['Receipt']['PatientDeleteTest'];
        //init label
        $this->label3 = $this->ob[$this->language]['Receipt']['PatentNationality'];
        $this->label9 = $this->ob[$this->language]['Receipt']['PatentGender'];
        $this->label13 = $this->ob[$this->language]['Receipt']['PatentContracting'];
        $this->PatientNameServices = $this->ob[$this->language]['Receipt']['PatientNameServices'];
        $this->label18 = $this->ob[$this->language]['Receipt']['PatientReceipt'];
        $this->label19 = $this->ob[$this->language]['Receipt']['PatientKnow'];
        $this->label20 = $this->ob[$this->language]['Receipt']['PatientNewItem'];
        $this->label21 = $this->ob[$this->language]['Receipt']['PatientRaysName'];
        $this->label22 = $this->ob[$this->language]['Receipt']['PatientRaysOption'];
        $this->label23 = $this->ob[$this->language]['Receipt']['PatientPaymentDetails'];
        $this->label24 = $this->ob[$this->language]['Receipt']['PatientPaymentDate'];
        $this->label25 = $this->ob[$this->language]['Receipt']['PatientAmountPaid'];
        $this->label26 = $this->ob[$this->language]['Receipt']['PatientPaymentMethod'];
        $this->label27 = $this->ob[$this->language]['Receipt']['PatientEndReceipt'];
        $this->label29 = $this->ob[$this->language]['Receipt']['ReceiptNumber'];
        $this->label30 = $this->ob[$this->language]['Receipt']['ReceiptDate'];
        $this->label31 = $this->ob[$this->language]['Receipt']['ReceiptPatentName'];
        $this->label32 = $this->ob[$this->language]['Receipt']['ReceiptPatentCode'];
        $this->label33 = $this->ob[$this->language]['Receipt']['ReceiptPatentTestName'];
        $this->label34 = $this->ob[$this->language]['Receipt']['ReceiptPatentTestPrice'];
        $this->label35 = $this->ob[$this->language]['Receipt']['ReceiptPatentSubtotal'];
        $this->label36 = $this->ob[$this->language]['Receipt']['ReceiptPatentTotalDiscount'];
        $this->label37 = $this->ob[$this->language]['Receipt']['ReceiptPatentTotal'];
        $this->label38 = $this->ob[$this->language]['Receipt']['ReceiptPatentPaymentDate'];
        $this->label39 = $this->ob[$this->language]['Receipt']['ReceiptPatentAmountPaid'];
        $this->label40 = $this->ob[$this->language]['Receipt']['ReceiptPatentPaymentMethod'];
        $this->label41 = $this->ob[$this->language]['Receipt']['ReceiptPatentDue'];
        $this->label42 = $this->ob[$this->language]['Receipt']['ReceiptPatentInfo'];
        $this->label43 = $this->ob[$this->language]['Receipt']['ReceiptPatientTitle'];
        $this->hint12 = $this->ob[$this->language]['Receipt']['HintPatientCode'];
        $this->hint13 = $this->ob[$this->language]['Receipt']['HintPatientNationality'];
        $this->hint14 = $this->ob[$this->language]['Receipt']['HintPatientGender'];
        $this->hint15 = $this->ob[$this->language]['Receipt']['HintPatientContracting'];
        $this->hint16 = $this->ob[$this->language]['Receipt']['HintpatientAmountPaid'];
        //init selectbox
        $this->selectBox1 = $this->ob[$this->language]['Receipt']['PatientPaymentMethod'];
        $this->selectBox2 = $this->ob[$this->language]['Receipt']['PatientNameServices'];
        $this->selectBox5 = $this->ob[$this->language]['Receipt']['Patientknow'];
        $this->selectBox6 = $this->ob[$this->language]['Receipt']['PatientTest'];
        $this->selectBox7 = $this->ob[$this->language]['Receipt']['ReceiptPatientPrint'];
        $this->payment = $this->ob[$this->language]['PaymentMethodBox'];
        $this->allTests = $this->ob[$this->language]['OptionTestBox'];
        //add test
        $this->arr2 = isset($this->ob['Test'])?(array)$this->ob['Test']:null;
        $this->arr3 = isset($this->ob['Cultures'])?(array)$this->ob['Cultures']:null;
        $this->arr4 = isset($this->ob['Packages'])?(array)$this->ob['Packages']:null;
        if($this->arr2)
            foreach ($this->arr2 as $key=>$test)
                $this->arr2[$key]['InputOutputLab'] = $this->ob[$this->language]['SelectTestBox'][$test['InputOutputLab']];
        if($this->arr3)
            foreach ($this->arr3 as $key => $cultures)
                $this->arr3[$key]['InputOutputLab'] = $this->ob[$this->language]['SelectTestBox'][$test['InputOutputLab']];
        //init Packages
        if($this->arr4)
            foreach ($this->arr4 as $key => $packages)
                $this->arr4[$key]['InputOutputLab'] = $this->ob[$this->language]['SelectTestBox'][$test['InputOutputLab']];
    }
    public function initValid(){
        $this->roll['item'] = ['required', 'array'];
        $this->roll['item.*'] = ['required',
            function ($attribute, $value, $fail) {// use for loop
                if (isset($this->ob['Test'][$value]))
                    array_push($this->testArr, new Test($this->ob['Test'][$value]['Name'], $this->ob['Test'][$value]['Shortcut'], $this->ob['Test'][$value]['Price'], $this->ob['Test'][$value]['InputOutputLab'], $this->ob['Test'][$value]['Id']));
                else if(isset($this->ob['Packages'][$value]))
                    array_push($this->testArr, new Test($this->ob['Packages'][$value]['Name'], $this->ob['Packages'][$value]['Shortcut'], $this->ob['Packages'][$value]['Price'], $this->ob['Packages'][$value]['InputOutputLab'], $this->ob['Packages'][$value]['Id']));
                else if(isset($this->ob['Cultures'][$value]))
                    array_push($this->testArr, new Test($this->ob['Cultures'][$value]['Name'], $this->ob['Cultures'][$value]['Shortcut'], $this->ob['Cultures'][$value]['Price'], $this->ob['Cultures'][$value]['InputOutputLab'], $this->ob['Cultures'][$value]['Id']));
                else
                    $fail($this->ob[$this->ob['Setting']['Language']]['Receipt']['PatientRegisterationItemInvalid']);
            },];
        $this->roll['patentCode'] = ['required', Rule::in(isset($this->ob['Patent'])?array_keys($this->ob['Patent']):null)];
        $this->roll['know'] = ['required', Rule::in(isset($this->ob['Knows'])?array_keys($this->ob['Knows']):null)];
        $this->roll['discount'] = ['required', 'numeric', 'min:0'];
        $this->roll['delayedMoney'] = ['required', 'numeric', 'min:0'];
        $this->roll['paymentDate'] = ['required', 'date'];
        $this->roll['paymentAmount'] = ['required', 'numeric', 'min:0'];
        $this->roll['paymentMethod'] = ['required', Rule::in(array_keys($this->ob[$this->ob['Setting']['Language']]['PaymentMethodBox']))];
        $this->message['item.required'] = $this->error5;
        $this->message['item.array'] = $this->ob[$this->ob['Setting']['Language']]['Receipt']['PatientRegisterationItemInvalid'];
        $this->message['patentCode.required'] = $this->error3;
        $this->message['patentCode.in'] = $this->ob[$this->ob['Setting']['Language']]['Receipt']['PatientRegisterationPatentCodeInvalid'];
        $this->message['know.required'] = $this->error4;
        $this->message['know.in'] = $this->ob[$this->ob['Setting']['Language']]['Receipt']['PatientRegisterationKnowInvalid'];
        $this->message['discount.required'] = $this->ob[$this->ob['Setting']['Language']]['Receipt']['PatientRegisterationDiscountRequired'];
        $this->message['discount.numeric'] = $this->ob[$this->ob['Setting']['Language']]['Receipt']['PatientRegisterationDiscountInvalid'];
        $this->message['discount.min'] = $this->ob[$this->ob['Setting']['Language']]['Receipt']['PatientRegisterationDiscountInvalid'];
        $this->message['delayedMoney.required'] = $this->ob[$this->ob['Setting']['Language']]['Receipt']['PatientRegisterationDelayedMoneyRequired'];
        $this->message['delayedMoney.numeric'] = $this->ob[$this->ob['Setting']['Language']]['Receipt']['PatientRegisterationDelayedMoneyInvalid'];
        $this->message['delayedMoney.min'] = $this->ob[$this->ob['Setting']['Language']]['Receipt']['PatientRegisterationDelayedMoneyInvalid'];
        $this->message['paymentDate.required'] = $this->error6;
        $this->message['paymentDate.date'] = $this->ob[$this->ob['Setting']['Language']]['Receipt']['PatientRegisterationPaymentDateInvalid'];
        $this->message['paymentAmount.required'] = $this->error7;
        $this->message['paymentAmount.numeric'] = $this->ob[$this->ob['Setting']['Language']]['Receipt']['PatientRegisterationPaymentAmountInvalid'];
        $this->message['paymentAmount.min'] = $this->ob[$this->ob['Setting']['Language']]['Receipt']['PatientRegisterationPaymentAmountInvalid'];
        $this->message['paymentMethod.required'] = $this->error2;
        $this->message['paymentMethod.in'] = $this->ob[$this->ob['Setting']['Language']]['Receipt']['PatientRegisterationPaymentMethodInvalid'];
        $this->message['item.*.required'] = $this->ob[$this->ob['Setting']['Language']]['Receipt']['PatientRegisterationItemInvalid'];
        $this->testArr = array();
    }
    public function __construct(){
        $this->ob = Rays::find(request()->session()->get('userId'));
        $this->error2 = $this->ob[$this->ob['Setting']['Language']]['Receipt']['PatientRegisterationPaymentMethodRequired'];
        $this->error3 = $this->ob[$this->ob['Setting']['Language']]['Receipt']['PatientRegisterationPatentCodeRequired'];
        $this->error4 = $this->ob[$this->ob['Setting']['Language']]['Receipt']['PatientRegisterationKnowRequired'];
        $this->error5 = $this->ob[$this->ob['Setting']['Language']]['Receipt']['PatientRegisterationItemRequired'];
        $this->error6 = $this->ob[$this->ob['Setting']['Language']]['Receipt']['PatientRegisterationPaymentDateRequired'];
        $this->error7 = $this->ob[$this->ob['Setting']['Language']]['Receipt']['PatientRegisterationPaymentAmountRequired'];
        parent::__construct($this, 'Receipt', $this->ob);
    }
    public function index(){
        return view('admin.reception.patientRegisteration', [
            'lang'=> $this,
            'active'=>'Receipt',
        ]);
    }  
    public function makeAddReceipt(){
        $this->getCreateDataBase($this->ob, 'Receipt', $this->generateUniqueIdentifier(), $this);
        return response()->json([
            'success' => true,
            'message'=>$this->successfulyMessage
        ]);
    }
    public function makeEditReceipt(){
        $this->getEditDataBase($this->ob, 'Receipt', $this);
        return response()->json([
            'success' => true,
            'message'=>$this->ob[$this->ob['Setting']['Language']]['Receipt']['MessageModelEdit']
        ]);
    }
    public function getMyObject($id = null){
        request()->validate($this->roll, $this->message);
        return (new Receipt(request()->input('know'), $this->testArr, (int)request()->input('discount'), (int)request()->input('delayedMoney'), request()->input('paymentDate'), (int)request()->input('paymentAmount'), request()->input('paymentMethod'), request()->input('patentCode')))->getObject();
    }
}
