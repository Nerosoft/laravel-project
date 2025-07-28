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
use App\instance\admin\reception\Patent;
use App\instance\admin\reception\MyKnows;
use App\instance\admin\contracts\Contracts;
use Illuminate\Support\Facades\Route;
use App\Http\interface\ValidRule;
use App\Http\interface\PageTable;


class ReceptionController extends PatientInfo implements LangObject, ValidRule, PageTable
{
    public function getDataBase(){
        return $this->ob;
    }
    public function getTableData(){
        $this->myPatent = isset($this->myPat)?Patent::fromArray($this->myPat, isset($this->getDataBase()['Contracts'])?Contracts::fromArray($this->getDataBase()['Contracts']):array(), $this->getDataBase()[$this->language]['SelectGenderBox'], $this->getDataBase()[$this->language]['SelectNationalityBox'], $this->getDataBase()[$this->language]['CheckBox']):array();
        $this->arr1 = isset($this->getDataBase()['Knows']) ? MyKnows::fromArray($this->getDataBase()['Knows']):array();        
        return $this->getDataBase()['Receipt']?Receipt::fromArray2(array_reverse($this->getDataBase()['Receipt']),$this->myPatent, $this->arr1, $this->getDataBase()[$this->language]['SelectTestBox'],$this->payment):array();
    }
    public function getRouteDelete(){
        return route('deleteItem', 'Receipt');
    }
     public function getValidRule(){
        array_push($this->roll['id'], Rule::in(array_keys((array)$this->getDataBase()['Receipt'])));
        $this->initValid();
    }
    public function initView(){
        $this->callConst('Receipt');
        $this->title5 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatient'];  
        $this->myCodePatient = $this->getDataBase()[$this->language]['Receipt']['PatientCode'];
        //init table
        $this->table13 = $this->getDataBase()[$this->language]['Receipt']['PatientRaysName'];
        $this->table14 = $this->getDataBase()[$this->language]['Receipt']['PatientRaysPrice'];
        $this->table15 = $this->getDataBase()[$this->language]['Receipt']['PatientRaysInOut'];
        $this->table16 = $this->getDataBase()[$this->language]['Receipt']['PatientRaysShortcut'];
        $this->table17 = $this->getDataBase()[$this->language]['Receipt']['PatientRaysDelete'];
        $this->table18 = $this->getDataBase()[$this->language]['Receipt']['PatientRaysSubtotal'];
        $this->table19 = $this->getDataBase()[$this->language]['Receipt']['PatientRaysDiscount'];
        $this->table20 = $this->getDataBase()[$this->language]['Receipt']['PatientRaysTotalDiscount'];
        $this->table21 = $this->getDataBase()[$this->language]['Receipt']['PatientRaysTotal'];
        $this->table22 = $this->getDataBase()[$this->language]['Receipt']['PatientRaysPaid'];
        $this->table23 = $this->getDataBase()[$this->language]['Receipt']['PatientRaysDue'];
        $this->table24 = $this->getDataBase()[$this->language]['Receipt']['PatientRaysDelayedMoney'];
        $this->table25 = $this->getDataBase()[$this->language]['Receipt']['PatientRaysDueUser'];
        $this->table26 = $this->getDataBase()[$this->language]['Receipt']['PatientRaysEGP'];
        $this->table27 = $this->getDataBase()[$this->language]['Receipt']['PatientRaysPercent'];
        $this->table29 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatientCode'];
        $this->table30 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatientName'];
        $this->table31 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatientAge'];
        $this->table32 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatientPhone'];
        $this->table33 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatientTest'];
        $this->table34 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatientSubtotal'];
        $this->table35 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatientDiscount'];
        $this->table36 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatientTotalDiscount'];
        $this->table37 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatientTotal'];
        $this->table38 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatientPaid'];
        $this->table39 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatientDue'];
        $this->table40 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatientDelayedMoney'];
        $this->table41 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatientDueUser'];
        $this->table42 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatientPaymentDate'];
        $this->table43 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatientAmountPaid'];
        $this->table44 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatientPaymentMethod'];
        $this->error1 = $this->getDataBase()[$this->language]['Receipt']['PatientRegisterationTestRequired'];
        $this->error8 = $this->getDataBase()[$this->language]['Receipt']['PatientRegisterationNameRequired'];
        $this->button5 = $this->getDataBase()[$this->language]['Receipt']['PatientAddTest'];
        $this->button4 = $this->getDataBase()[$this->language]['Receipt']['PatientDeleteTest'];
        //init label
        $this->label3 = $this->getDataBase()[$this->language]['Receipt']['PatentNationality'];
        $this->label9 = $this->getDataBase()[$this->language]['Receipt']['PatentGender'];
        $this->label13 = $this->getDataBase()[$this->language]['Receipt']['PatentContracting'];
        $this->PatientNameServices = $this->getDataBase()[$this->language]['Receipt']['PatientNameServices'];
        $this->label18 = $this->getDataBase()[$this->language]['Receipt']['PatientReceipt'];
        $this->label19 = $this->getDataBase()[$this->language]['Receipt']['PatientKnow'];
        $this->label20 = $this->getDataBase()[$this->language]['Receipt']['PatientNewItem'];
        $this->label21 = $this->getDataBase()[$this->language]['Receipt']['PatientRaysName'];
        $this->label22 = $this->getDataBase()[$this->language]['Receipt']['PatientRaysOption'];
        $this->label23 = $this->getDataBase()[$this->language]['Receipt']['PatientPaymentDetails'];
        $this->label24 = $this->getDataBase()[$this->language]['Receipt']['PatientPaymentDate'];
        $this->label25 = $this->getDataBase()[$this->language]['Receipt']['PatientAmountPaid'];
        $this->label26 = $this->getDataBase()[$this->language]['Receipt']['PatientPaymentMethod'];
        $this->label27 = $this->getDataBase()[$this->language]['Receipt']['PatientEndReceipt'];
        $this->label29 = $this->getDataBase()[$this->language]['Receipt']['ReceiptNumber'];
        $this->label30 = $this->getDataBase()[$this->language]['Receipt']['ReceiptDate'];
        $this->label31 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatentName'];
        $this->label32 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatentCode'];
        $this->label33 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatentTestName'];
        $this->label34 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatentTestPrice'];
        $this->label35 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatentSubtotal'];
        $this->label36 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatentTotalDiscount'];
        $this->label37 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatentTotal'];
        $this->label38 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatentPaymentDate'];
        $this->label39 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatentAmountPaid'];
        $this->label40 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatentPaymentMethod'];
        $this->label41 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatentDue'];
        $this->label42 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatentInfo'];
        $this->label43 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatientTitle'];
        $this->hint12 = $this->getDataBase()[$this->language]['Receipt']['HintPatientCode'];
        $this->hint13 = $this->getDataBase()[$this->language]['Receipt']['HintPatientNationality'];
        $this->hint14 = $this->getDataBase()[$this->language]['Receipt']['HintPatientGender'];
        $this->hint15 = $this->getDataBase()[$this->language]['Receipt']['HintPatientContracting'];
        $this->hint16 = $this->getDataBase()[$this->language]['Receipt']['HintpatientAmountPaid'];
        //init selectbox
        $this->selectBox1 = $this->getDataBase()[$this->language]['Receipt']['PatientPaymentMethod'];
        $this->selectBox2 = $this->getDataBase()[$this->language]['Receipt']['PatientNameServices'];
        $this->selectBox5 = $this->getDataBase()[$this->language]['Receipt']['Patientknow'];
        $this->selectBox6 = $this->getDataBase()[$this->language]['Receipt']['PatientTest'];
        $this->selectBox7 = $this->getDataBase()[$this->language]['Receipt']['ReceiptPatientPrint'];
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
    }
    public function initValid(){
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
    }
    public function __construct(){
        $this->ob = Rays::find(request()->session()->get('userId'));
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
        parent::__construct($this, 'Receipt');
    }
    public function index(){
        return view('admin.reception.patientRegisteration', [
            'lang'=> $this,
            'active'=>'Receipt',
        ]);
    }  
    public function makeAddReceipt(){
        $this->getCreateDataBase($this->getDataBase(), 'Receipt', $this->generateUniqueIdentifier(), $this);
        return response()->json([
            'success' => true,
            'message'=>$this->successfulyMessage
        ]);
    }
    public function makeEditReceipt(){
        $this->getEditDataBase($this->getDataBase(), 'Receipt', $this);
        return response()->json([
            'success' => true,
            'message'=>$this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Receipt']['MessageModelEdit']
        ]);
    }
    public function getMyObject($id = null){
        request()->validate($this->roll, $this->message);
        return (new Receipt(request()->input('know'), $this->testArr, (int)request()->input('discount'), (int)request()->input('delayedMoney'), request()->input('paymentDate'), (int)request()->input('paymentAmount'), request()->input('paymentMethod'), request()->input('patentCode')))->getObject();
    }
}
