<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\interface\LangObject;
use App\language\share\Page;
use App\Http\interface\ActionInit;
use App\instance\admin\contracts\Contracts;
use App\Models\Rays;

class ContractsController extends Page implements LangObject, ActionInit
{
    public function initView(){
        $this->tableData = $this->ob['Contracts']?Contracts::fromArray(array_reverse($this->ob['Contracts'])):array();
        $this->table8 = $this->ob[$this->language]['Contracts']['TableContractName'];
        $this->table9 = $this->ob[$this->language]['Contracts']['TableContractGovernorate'];
        $this->table10 = $this->ob[$this->language]['Contracts']['TableContractArea'];
        $this->label3 = $this->ob[$this->language]['Contracts']['LabelContractName'];
        $this->label4 = $this->ob[$this->language]['Contracts']['LabelContractGovernorate'];
        $this->label5 = $this->ob[$this->language]['Contracts']['LabelContractArea'];
        $this->hint1 = $this->ob[$this->language]['Contracts']['HintContractName'];
        $this->hint2 = $this->ob[$this->language]['Contracts']['HintContractGovernorate'];
        $this->hint3 = $this->ob[$this->language]['Contracts']['HintContractArea'];
    }
    public function initValid(){
        $this->roll['name'] =['required', 'min:3'];
        $this->roll['governorate'] =['required', 'min:3'];
        $this->roll['area'] =['required', 'min:3'];
        $this->message['name.required'] = $this->error1;
        $this->message['name.min'] = $this->error1;
        $this->message['governorate.required'] = $this->error1;
        $this->message['governorate.min'] = $this->error1;
        $this->message['area.required'] = $this->error1;
        $this->message['area.min'] = $this->error1;
    }
    public function __construct(){
        $this->ob = Rays::find(request()->session()->get('userId'));
        $this->error1 = $this->ob[$this->ob['Setting']['Language']]['Contracts']['ContractNameRequired'];
        $this->error2 = $this->ob[$this->ob['Setting']['Language']]['Contracts']['ContractNameInvalid'];
        $this->error3 = $this->ob[$this->ob['Setting']['Language']]['Contracts']['ContractGovernorateRequired'];
        $this->error4 = $this->ob[$this->ob['Setting']['Language']]['Contracts']['ContractGovernorateInvalid'];
        $this->error5 = $this->ob[$this->ob['Setting']['Language']]['Contracts']['ContractAreaRequired'];
        $this->error6 = $this->ob[$this->ob['Setting']['Language']]['Contracts']['ContractAreaInvalid'];
        parent::__construct($this, 'Contracts', $this->ob);
    }
    public function index(){
        return view('admin.contracts.packages_contracts',[
            'lang'=> $this,
            'active'=>'Contracts',
        ]);
    }
    public function makeAddContracts(){
        $this->getCreateDataBase($this->ob, 'Contracts', $this->generateUniqueIdentifier(), $this);
        return back()->with('success', $this->successfulyMessage);
    }
    public function makeEditContracts(){
        $this->getEditDataBase($this->ob, 'Contracts', $this);
        return back()->with('success', $this->successfulyMessage);
    }
    public function getMyObject($id = null){
        request()->validate($this->roll, $this->message);
        return array('Name'=>request()->input('name'), 'Governorate'=>request()->input('governorate'), 'Area'=>request()->input('area'));
    }
}
