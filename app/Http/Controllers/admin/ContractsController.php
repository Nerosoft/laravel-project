<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\interface\LangObject;
use App\language\share\Page;
use App\instance\admin\contracts\Contracts;
use App\Models\Rays;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

use App\Http\interface\ValidRule;
use App\Http\interface\PageTable;


class ContractsController extends Page implements LangObject, ValidRule, PageTable
{
    public function getDataBase(){
        return $this->ob;
    }
    public function getTableData(){
        return $this->getDataBase()['Contracts']?Contracts::fromArray(array_reverse($this->getDataBase()['Contracts'])):array();
    }
    public function getRouteDelete(){
        return route('deleteItem', 'Contracts');
    }
     public function getValidRule(){
        array_push($this->roll['id'], Rule::in(array_keys((array)$this->getDataBase()['Contracts'])));
        $this->initValid();
    }
    public function initView(){
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
    public function initValid(){
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
    public function __construct(){
        $this->ob = Rays::find(request()->session()->get('userId'));
        $this->error1 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Contracts']['ContractNameRequired'];
        $this->error2 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Contracts']['ContractNameInvalid'];
        $this->error3 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Contracts']['ContractGovernorateRequired'];
        $this->error4 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Contracts']['ContractGovernorateInvalid'];
        $this->error5 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Contracts']['ContractAreaRequired'];
        $this->error6 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Contracts']['ContractAreaInvalid'];
        parent::__construct($this, 'Contracts');
    }
    public function index(){
        return view('admin.contracts.packages_contracts',[
            'lang'=> $this,
            'active'=>'Contracts',
        ]);
    }
    public function makeAddContracts(){
        $this->getCreateDataBase($this->getDataBase(), 'Contracts', $this->generateUniqueIdentifier(), $this);
        return back()->with('success', $this->successfulyMessage);
    }
    public function makeEditContracts(){
        $this->getEditDataBase($this->getDataBase(), 'Contracts', $this);
        return back()->with('success', $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Contracts']['MessageModelEdit']);
    }
    public function getMyObject($id = null){
        request()->validate($this->roll, $this->message);
        return array('Name'=>request()->input('name'), 'Governorate'=>request()->input('governorate'), 'Area'=>request()->input('area'));
    }
}
