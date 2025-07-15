<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rays;
use Illuminate\Validation\Rule;
use App\Http\interface\LangObject;
use App\language\share\Page;
use App\Menu;
use App\instance\admin\contracts\Contracts;
use Illuminate\Support\Facades\Route;
use App\instance\admin\reception\MyKnows;
use App\instance\admin\Branch;

class ContractsController extends Page implements LangObject
{
    public function __construct(){
        $this->ob = Rays::find(request()->session()->get('userId'));
        $this->error1 = $this->ob[$this->ob['Setting']['Language']]['Contracts']['ContractNameRequired'];
        $this->error2 = $this->ob[$this->ob['Setting']['Language']]['Contracts']['ContractNameInvalid'];
        $this->error3 = $this->ob[$this->ob['Setting']['Language']]['Contracts']['ContractGovernorateRequired'];
        $this->error4 = $this->ob[$this->ob['Setting']['Language']]['Contracts']['ContractGovernorateInvalid'];
        $this->error5 = $this->ob[$this->ob['Setting']['Language']]['Contracts']['ContractAreaRequired'];
        $this->error6 = $this->ob[$this->ob['Setting']['Language']]['Contracts']['ContractAreaInvalid'];
        if(Route::currentRouteName() === 'createContract' || Route::currentRouteName() === 'editContract'){
            $this->roll = [
                'name' => ['required', 'min:3'],
                'governorate' => ['required', 'min:3'],
                'area' => ['required', 'min:3'],
            ];
            $this->message = [
                'name.required' => $this->error1,
                'name.min' => $this->error2,
                'governorate.required' => $this->error3,
                'governorate.min' =>  $this->error4,
                'area.required' => $this->error5,
                'area.min' => $this->error6,
            ];
        }else{
            parent::__construct(route('deleteItem', 'Contracts'), 'Contracts', $this->ob, $this->ob['Contracts']?Contracts::fromArray(array_reverse($this->ob['Contracts'])):array());
            $this->table8 = $this->ob[$this->language]['Contracts']['TableContractName'];
            $this->table9 = $this->ob[$this->language]['Contracts']['TableContractGovernorate'];
            $this->table10 = $this->ob[$this->language]['Contracts']['TableContractArea'];
            $this->label3 = $this->ob[$this->language]['Contracts']['LabelContractName'];
            $this->label4 = $this->ob[$this->language]['Contracts']['LabelContractGovernorate'];
            $this->label5 = $this->ob[$this->language]['Contracts']['LabelContractArea'];
            $this->hint1 = $this->ob[$this->language]['Contracts']['HintContractName'];
            $this->hint2 = $this->ob[$this->language]['Contracts']['HintContractGovernorate'];
            $this->hint3 = $this->ob[$this->language]['Contracts']['HintContractArea'];
            $this->successfully1 = $this->ob[$this->language]['Contracts']['LoadMessage'];
        }
    }
    public function index(){
        return view('admin.contracts.packages_contracts',[
            'lang'=> $this,
            'active'=>'Contracts',
        ]);
    }
    public function makeAddContracts(){
        $this->getCreateDataBase($this->ob, 'Contracts', $this->generateUniqueIdentifier(), $this);
        return back()->with('success', $this->ob[$this->ob['Setting']['Language']]['Contracts']['ContractsAdd']);
    }
    public function makeEditContracts(){
        $this->roll['id'] = ['required', Rule::in($this->ob['Contracts']?array_keys($this->ob['Contracts']):null)];
        $this->message['id.required'] = $this->ob[$this->ob['Setting']['Language']]['Contracts']['IdIsReq'];
        $this->message['id.in'] = $this->ob[$this->ob['Setting']['Language']]['Contracts']['IdIsInv'];
        $this->getEditDataBase($this->ob, 'Contracts', $this);
        return back()->with('success', $this->ob[$this->ob['Setting']['Language']]['Contracts']['ContractsEdit']);
    }
    public function getMyObject(){
        request()->validate($this->roll, $this->message);
        return array('Name'=>request()->input('name'), 'Governorate'=>request()->input('governorate'), 'Area'=>request()->input('area'));
    }
}
