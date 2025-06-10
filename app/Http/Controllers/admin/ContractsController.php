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

class ContractsController extends Page implements LangObject
{
    public function __construct(){
        $ob = Rays::find(request()->session()->get('userId'));
        if(Route::currentRouteName() === 'createContract'){
            request()->validate([
                'name' => ['required', 'min:3'],
                'governorate' => ['required', 'min:3'],
                'area' => ['required', 'min:3'],
            ], [
                'name.required' => $ob[$ob['Setting']['Language']]['Error']['ContractNameRequired'],
                'name.min' => $ob[$ob['Setting']['Language']]['Error']['ContractNameInvalid'],
                'governorate.required' => $ob[$ob['Setting']['Language']]['Error']['ContractGovernorateRequired'],
                'governorate.min' => $ob[$ob['Setting']['Language']]['Error']['ContractGovernorateInvalid'],
                'area.required' => $ob[$ob['Setting']['Language']]['Error']['ContractAreaRequired'],
                'area.min' => $ob[$ob['Setting']['Language']]['Error']['ContractAreaInvalid'],
            ]);
            $this->getCreateDataBase($ob, 'Contracts', $this->generateUniqueIdentifier(), $this);
            $this->successfully1=$ob[$ob['Setting']['Language']]['Message']['ContractsAdd'];
        }else if(Route::currentRouteName() === 'editContract'){
            request()->validate([
                'id' => ['required', Rule::in(isset($ob['Contracts'])?array_keys($ob['Contracts']):null)],
                'name' => ['required', 'min:3'],
                'governorate' => ['required', 'min:3'],
                'area' => ['required', 'min:3'],
            ], [
                'id.required'=>$ob[$ob['Setting']['Language']]['Error']['ContractIdRequired'],
                'id.in'=>$ob[$ob['Setting']['Language']]['Error']['ContractIdInvalid'],
                'name.required' => $ob[$ob['Setting']['Language']]['Error']['ContractNameRequired'],
                'name.min' => $ob[$ob['Setting']['Language']]['Error']['ContractNameInvalid'],
                'governorate.required' => $ob[$ob['Setting']['Language']]['Error']['ContractGovernorateRequired'],
                'governorate.min' => $ob[$ob['Setting']['Language']]['Error']['ContractGovernorateInvalid'],
                'area.required' => $ob[$ob['Setting']['Language']]['Error']['ContractAreaRequired'],
                'area.min' => $ob[$ob['Setting']['Language']]['Error']['ContractAreaInvalid'],
            ]);
            $this->getEditDataBase($ob, 'Contracts', $this);
            $this->successfully1=$ob[$ob['Setting']['Language']]['Message']['ContractsEdit'];
        }else if(Route::currentRouteName() === 'createKnows'){
            request()->validate([
                'name' => ['required', 'min:3'],
            ], [
                'name.required' => $ob[$ob['Setting']['Language']]['Error']['KnowsNameRequired'],
                'name.min' => $ob[$ob['Setting']['Language']]['Error']['KnowsNameInvalid'],
            ]);
            $this->getCreateDataBase($ob, 'Knows', $this->generateUniqueIdentifier(), $this);
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Message']['KnowsAdd'];
        }else if(Route::currentRouteName() === 'editKnows'){
            request()->validate([
                'id' => ['required', Rule::in(isset($ob['Knows'])?array_keys($ob['Knows']):null)],
                'name' => ['required', 'min:3'],
            ], [
                'id.required' => $ob[$ob['Setting']['Language']]['Error']['KnowsIdRequired'],
                'id.in' => $ob[$ob['Setting']['Language']]['Error']['KnowsIdInvalid'],
                'name.required' => $ob[$ob['Setting']['Language']]['Error']['KnowsNameRequired'],
                'name.min' => $ob[$ob['Setting']['Language']]['Error']['KnowsNameInvalid'],
            ]);
            $this->getEditDataBase($ob, 'Knows', $this);
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Message']['KnowsEdit'];
        }else if(Route::currentRouteName() === 'Contracts' && request()->route('id') === 'Knows'){
            $this->error1 = $ob[$ob['Setting']['Language']]['Error']['KnowsNameRequired'];
            $this->error2 = $ob[$ob['Setting']['Language']]['Error']['KnowsNameInvalid'];
            parent::__construct($ob['Setting']['Language'], 
            $ob[$ob['Setting']['Language']]['Title']['KnowsDelete'],
            $ob[$ob['Setting']['Language']]['Label']['KnowsDelete'],
            $ob[$ob['Setting']['Language']]['Button']['KnowsDelete'],
            route('deleteItem', 'Knows'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Title']['Knows'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            $ob['Branch']?$ob['Branch']:Rays::find(request()->session()->get('userLogout'))['Branch'],
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Title']['KnowsCreate'],
            $ob[$ob['Setting']['Language']]['Title']['KnowsEdit'],
            $ob[$ob['Setting']['Language']]['Button']['KnowsCreate'],
            $ob[$ob['Setting']['Language']]['Button']['KnowsAdd'],
            $ob[$ob['Setting']['Language']]['Button']['KnowsEdit'],
            $ob[$ob['Setting']['Language']]['Table']['KnowsId'],
            $ob[$ob['Setting']['Language']]['Table']['KnowsEdit']);
            //init table
            $this->table8 = $ob[$this->language]['Table']['KnowsName'];
            //init label
            $this->label3 = $ob[$this->language]['Label']['KnowsName'];
            //init hint
            $this->hint1 = $ob[$this->language]['Hint']['KnowsName'];
            //---------------
            $this->knows = isset($ob['Knows']) ? MyKnows::fromArray($ob['Knows']):array();
        }else{
            parent::__construct($ob['Setting']['Language'], 
            $ob[$ob['Setting']['Language']]['Title']['DeleteContract'],
            $ob[$ob['Setting']['Language']]['Label']['DeleteContract'],
            $ob[$ob['Setting']['Language']]['Button']['DeleteContract'],
            route('deleteItem', 'Contracts'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Title']['PackagesContracts'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            $ob['Branch']?$ob['Branch']:Rays::find(request()->session()->get('userLogout'))['Branch'],
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Title']['CreateContract'],
            $ob[$ob['Setting']['Language']]['Title']['EditContract'],
            $ob[$ob['Setting']['Language']]['Button']['CreateContract'],
            $ob[$ob['Setting']['Language']]['Button']['AddContract'],
            $ob[$ob['Setting']['Language']]['Button']['EditContract'],
            $ob[$ob['Setting']['Language']]['Table']['ContractId'],
            $ob[$ob['Setting']['Language']]['Table']['ContractEdit']);
            $this->error1 = $ob[$this->language]['Error']['ContractNameRequired'];
            $this->error2 = $ob[$this->language]['Error']['ContractNameInvalid'];
            $this->error3 = $ob[$this->language]['Error']['ContractGovernorateRequired'];
            $this->error4 = $ob[$this->language]['Error']['ContractGovernorateInvalid'];
            $this->error5 = $ob[$this->language]['Error']['ContractAreaRequired'];
            $this->error6 = $ob[$this->language]['Error']['ContractAreaInvalid'];
            //init table
            $this->table8 = $ob[$this->language]['Table']['ContractName'];
            $this->table9 = $ob[$this->language]['Table']['ContractGovernorate'];
            $this->table10 = $ob[$this->language]['Table']['ContractArea'];
            //init label
            $this->label3 = $ob[$this->language]['Label']['ContractName'];
            $this->label4 = $ob[$this->language]['Label']['ContractGovernorate'];
            $this->label5 = $ob[$this->language]['Label']['ContractArea'];
            //init hint
            $this->hint1 = $ob[$this->language]['Hint']['ContractName'];
            $this->hint2 = $ob[$this->language]['Hint']['ContractGovernorate'];
            $this->hint3 = $ob[$this->language]['Hint']['ContractArea'];
            $this->myContract = isset($ob['Contracts'])?Contracts::fromArray($ob['Contracts']):array();    
        }
    }
    public function index($id){
        return view($id!=='Knows'?'admin.contracts.packages_contracts':'admin.contracts.knows',[
            'lang'=> $this,
            'active'=>'Contracts',
            'activeItem'=>$id
        ]);
    }
    public function action(){
        return back()->with('success', $this->successfully1);
    }
    public function getMyObject(){
        if(Route::currentRouteName() === 'createKnows' || Route::currentRouteName() === 'editKnows')
            return array('Name'=>request()->input('name'));
        else
            return array('Name'=>request()->input('name'), 'Governorate'=>request()->input('governorate'), 'Area'=>request()->input('area'));
    }
}
