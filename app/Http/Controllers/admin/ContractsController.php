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
        $ob = Rays::find(request()->session()->get('userId'));
        if(Route::currentRouteName() === 'createContract'){
            request()->validate([
                'name' => ['required', 'min:3'],
                'governorate' => ['required', 'min:3'],
                'area' => ['required', 'min:3'],
            ], [
                'name.required' => $ob[$ob['Setting']['Language']]['Contracts']['ContractNameRequired'],
                'name.min' => $ob[$ob['Setting']['Language']]['Contracts']['ContractNameInvalid'],
                'governorate.required' => $ob[$ob['Setting']['Language']]['Contracts']['ContractGovernorateRequired'],
                'governorate.min' => $ob[$ob['Setting']['Language']]['Contracts']['ContractGovernorateInvalid'],
                'area.required' => $ob[$ob['Setting']['Language']]['Contracts']['ContractAreaRequired'],
                'area.min' => $ob[$ob['Setting']['Language']]['Contracts']['ContractAreaInvalid'],
            ]);
            $this->getCreateDataBase($ob, 'Contracts', $this->generateUniqueIdentifier(), $this);
            $this->successfully1=$ob[$ob['Setting']['Language']]['Contracts']['ContractsAdd'];
        }else if(Route::currentRouteName() === 'editContract' && isset($ob['Contracts'])){
            request()->validate([
                'id' => ['required', Rule::in(array_keys($ob['Contracts']))],
                'name' => ['required', 'min:3'],
                'governorate' => ['required', 'min:3'],
                'area' => ['required', 'min:3'],
            ], [
                'id.required'=>$ob[$ob['Setting']['Language']]['Contracts']['IdIsReq'],
                'id.in'=>$ob[$ob['Setting']['Language']]['Contracts']['IdIsInv'],
                'name.required' => $ob[$ob['Setting']['Language']]['Contracts']['ContractNameRequired'],
                'name.min' => $ob[$ob['Setting']['Language']]['Contracts']['ContractNameInvalid'],
                'governorate.required' => $ob[$ob['Setting']['Language']]['Contracts']['ContractGovernorateRequired'],
                'governorate.min' => $ob[$ob['Setting']['Language']]['Contracts']['ContractGovernorateInvalid'],
                'area.required' => $ob[$ob['Setting']['Language']]['Contracts']['ContractAreaRequired'],
                'area.min' => $ob[$ob['Setting']['Language']]['Contracts']['ContractAreaInvalid'],
            ]);
            $this->getEditDataBase($ob, 'Contracts', $this);
            $this->successfully1=$ob[$ob['Setting']['Language']]['Contracts']['ContractsEdit'];
        }else if(Route::currentRouteName() === 'createKnows'){
            request()->validate([
                'name' => ['required', 'min:3'],
            ], [
                'name.required' => $ob[$ob['Setting']['Language']]['Knows']['KnowsNameRequired'],
                'name.min' => $ob[$ob['Setting']['Language']]['Knows']['KnowsNameInvalid'],
            ]);
            $this->getCreateDataBase($ob, 'Knows', $this->generateUniqueIdentifier(), $this);
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Knows']['KnowsAdd'];
        }else if(Route::currentRouteName() === 'editKnows' && isset($ob['Knows'])){
            request()->validate([
                'id' => ['required', Rule::in(array_keys($ob['Knows']))],
                'name' => ['required', 'min:3'],
            ], [
                'id.required' => $ob[$ob['Setting']['Language']]['Knows']['IdIsReq'],
                'id.in' => $ob[$ob['Setting']['Language']]['Knows']['IdIsInv'],
                'name.required' => $ob[$ob['Setting']['Language']]['Knows']['KnowsNameRequired'],
                'name.min' => $ob[$ob['Setting']['Language']]['Knows']['KnowsNameInvalid'],
            ]);
            $this->getEditDataBase($ob, 'Knows', $this);
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Knows']['KnowsEdit'];
        }else if(request()->route('id') === 'Knows' && $ob['Knows'] && $ob['Branch']){
            $this->error1 = $ob[$ob['Setting']['Language']]['Knows']['KnowsNameRequired'];
            $this->error2 = $ob[$ob['Setting']['Language']]['Knows']['KnowsNameInvalid'];
            parent::__construct($ob['Setting']['Language'], 
            $ob[$ob['Setting']['Language']]['Knows']['TitleKnowsDelete'],
            $ob[$ob['Setting']['Language']]['Knows']['LabelKnowsDelete'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsDelete'],
            route('deleteItem', request()->route('id')),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Knows']['Knows'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeBranch($ob['Branch'], $ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Knows']['TitleKnowsCreate'],
            $ob[$ob['Setting']['Language']]['Knows']['TitleKnowsEdit'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsCreate'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsAdd'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsEdit'],
            $ob[$ob['Setting']['Language']]['Knows']['TableKnowsId'],
            $ob[$ob['Setting']['Language']]['Knows']['TableKnowsEdit'],
            MyKnows::fromArray(array_reverse($ob['Knows'])));
            //init table
            $this->table8 = $ob[$this->language]['Knows']['TableKnowsName'];
            //init label
            $this->label3 = $ob[$this->language]['Knows']['LabelKnowsName'];
            //init hint
            $this->hint1 = $ob[$this->language]['Knows']['HintKnowsName'];
            $this->successfully1 = $ob[$this->language]['Knows']['LoadMessage'];
        }else if(request()->route('id') === 'Knows' && $ob['Knows'] && Rays::find(request()->session()->get('userLogout'))['Branch']){
            $this->error1 = $ob[$ob['Setting']['Language']]['Knows']['KnowsNameRequired'];
            $this->error2 = $ob[$ob['Setting']['Language']]['Knows']['KnowsNameInvalid'];
            parent::__construct($ob['Setting']['Language'], 
            $ob[$ob['Setting']['Language']]['Knows']['TitleKnowsDelete'],
            $ob[$ob['Setting']['Language']]['Knows']['LabelKnowsDelete'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsDelete'],
            route('deleteItem', request()->route('id')),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Knows']['Knows'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeBranch(Rays::find(request()->session()->get('userLogout'))['Branch'], $ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Knows']['TitleKnowsCreate'],
            $ob[$ob['Setting']['Language']]['Knows']['TitleKnowsEdit'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsCreate'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsAdd'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsEdit'],
            $ob[$ob['Setting']['Language']]['Knows']['TableKnowsId'],
            $ob[$ob['Setting']['Language']]['Knows']['TableKnowsEdit'],
            MyKnows::fromArray(array_reverse($ob['Knows'])));
            //init table
            $this->table8 = $ob[$this->language]['Knows']['TableKnowsName'];
            //init label
            $this->label3 = $ob[$this->language]['Knows']['LabelKnowsName'];
            //init hint
            $this->hint1 = $ob[$this->language]['Knows']['HintKnowsName'];
            $this->successfully1 = $ob[$this->language]['Knows']['LoadMessage'];
        }else if(request()->route('id') === 'Knows' && !$ob['Knows'] && $ob['Branch']){
            $this->error1 = $ob[$ob['Setting']['Language']]['Knows']['KnowsNameRequired'];
            $this->error2 = $ob[$ob['Setting']['Language']]['Knows']['KnowsNameInvalid'];
            parent::__construct($ob['Setting']['Language'], 
            $ob[$ob['Setting']['Language']]['Knows']['TitleKnowsDelete'],
            $ob[$ob['Setting']['Language']]['Knows']['LabelKnowsDelete'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsDelete'],
            route('deleteItem', request()->route('id')),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Knows']['Knows'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeBranch($ob['Branch'], $ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Knows']['TitleKnowsCreate'],
            $ob[$ob['Setting']['Language']]['Knows']['TitleKnowsEdit'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsCreate'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsAdd'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsEdit'],
            $ob[$ob['Setting']['Language']]['Knows']['TableKnowsId'],
            $ob[$ob['Setting']['Language']]['Knows']['TableKnowsEdit']);
            //init table
            $this->table8 = $ob[$this->language]['Knows']['TableKnowsName'];
            //init label
            $this->label3 = $ob[$this->language]['Knows']['LabelKnowsName'];
            //init hint
            $this->hint1 = $ob[$this->language]['Knows']['HintKnowsName'];
            $this->successfully1 = $ob[$this->language]['Knows']['LoadMessage'];
        }else if(request()->route('id') === 'Knows' && !$ob['Knows'] && Rays::find(request()->session()->get('userLogout'))['Branch']){
            $this->error1 = $ob[$ob['Setting']['Language']]['Knows']['KnowsNameRequired'];
            $this->error2 = $ob[$ob['Setting']['Language']]['Knows']['KnowsNameInvalid'];
            parent::__construct($ob['Setting']['Language'], 
            $ob[$ob['Setting']['Language']]['Knows']['TitleKnowsDelete'],
            $ob[$ob['Setting']['Language']]['Knows']['LabelKnowsDelete'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsDelete'],
            route('deleteItem', request()->route('id')),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Knows']['Knows'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeBranch(Rays::find(request()->session()->get('userLogout'))['Branch'], $ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']),
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Knows']['TitleKnowsCreate'],
            $ob[$ob['Setting']['Language']]['Knows']['TitleKnowsEdit'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsCreate'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsAdd'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsEdit'],
            $ob[$ob['Setting']['Language']]['Knows']['TableKnowsId'],
            $ob[$ob['Setting']['Language']]['Knows']['TableKnowsEdit']);
            //init table
            $this->table8 = $ob[$this->language]['Knows']['TableKnowsName'];
            //init label
            $this->label3 = $ob[$this->language]['Knows']['LabelKnowsName'];
            //init hint
            $this->hint1 = $ob[$this->language]['Knows']['HintKnowsName'];
            $this->successfully1 = $ob[$this->language]['Knows']['LoadMessage'];
        }else if(request()->route('id') === 'Knows' && $ob['Knows']){
            $this->error1 = $ob[$ob['Setting']['Language']]['Knows']['KnowsNameRequired'];
            $this->error2 = $ob[$ob['Setting']['Language']]['Knows']['KnowsNameInvalid'];
            parent::__construct($ob['Setting']['Language'], 
            $ob[$ob['Setting']['Language']]['Knows']['TitleKnowsDelete'],
            $ob[$ob['Setting']['Language']]['Knows']['LabelKnowsDelete'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsDelete'],
            route('deleteItem', request()->route('id')),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Knows']['Knows'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeMainBranch($ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']),
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Knows']['TitleKnowsCreate'],
            $ob[$ob['Setting']['Language']]['Knows']['TitleKnowsEdit'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsCreate'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsAdd'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsEdit'],
            $ob[$ob['Setting']['Language']]['Knows']['TableKnowsId'],
            $ob[$ob['Setting']['Language']]['Knows']['TableKnowsEdit'],
            MyKnows::fromArray(array_reverse($ob['Knows'])));
            //init table
            $this->table8 = $ob[$this->language]['Knows']['TableKnowsName'];
            //init label
            $this->label3 = $ob[$this->language]['Knows']['LabelKnowsName'];
            //init hint
            $this->hint1 = $ob[$this->language]['Knows']['HintKnowsName'];
            $this->successfully1 = $ob[$this->language]['Knows']['LoadMessage'];
        }else if(request()->route('id') === 'Knows'){
            $this->error1 = $ob[$ob['Setting']['Language']]['Knows']['KnowsNameRequired'];
            $this->error2 = $ob[$ob['Setting']['Language']]['Knows']['KnowsNameInvalid'];
            parent::__construct($ob['Setting']['Language'], 
            $ob[$ob['Setting']['Language']]['Knows']['TitleKnowsDelete'],
            $ob[$ob['Setting']['Language']]['Knows']['LabelKnowsDelete'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsDelete'],
            route('deleteItem', request()->route('id')),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Knows']['Knows'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeMainBranch($ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']),
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Knows']['TitleKnowsCreate'],
            $ob[$ob['Setting']['Language']]['Knows']['TitleKnowsEdit'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsCreate'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsAdd'],
            $ob[$ob['Setting']['Language']]['Knows']['ButtonKnowsEdit'],
            $ob[$ob['Setting']['Language']]['Knows']['TableKnowsId'],
            $ob[$ob['Setting']['Language']]['Knows']['TableKnowsEdit']);
            //init table
            $this->table8 = $ob[$this->language]['Knows']['TableKnowsName'];
            //init label
            $this->label3 = $ob[$this->language]['Knows']['LabelKnowsName'];
            //init hint
            $this->hint1 = $ob[$this->language]['Knows']['HintKnowsName'];
            $this->successfully1 = $ob[$this->language]['Knows']['LoadMessage'];
        }else if($ob['Contracts'] && $ob['Branch']){
            parent::__construct($ob['Setting']['Language'], 
            $ob[$ob['Setting']['Language']]['Contracts']['TitleDeleteContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['LabelDeleteContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonDeleteContract'],
            route('deleteItem', 'Contracts'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Contracts']['PackagesContracts'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeBranch($ob['Branch'], $ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Contracts']['TitleCreateContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['TitleEditContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonCreateContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonAddContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonEditContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['TableContractId'],
            $ob[$ob['Setting']['Language']]['Contracts']['TableContractEdit'],
            Contracts::fromArray(array_reverse($ob['Contracts'])));
            $this->error1 = $ob[$this->language]['Contracts']['ContractNameRequired'];
            $this->error2 = $ob[$this->language]['Contracts']['ContractNameInvalid'];
            $this->error3 = $ob[$this->language]['Contracts']['ContractGovernorateRequired'];
            $this->error4 = $ob[$this->language]['Contracts']['ContractGovernorateInvalid'];
            $this->error5 = $ob[$this->language]['Contracts']['ContractAreaRequired'];
            $this->error6 = $ob[$this->language]['Contracts']['ContractAreaInvalid'];
            //init table
            $this->table8 = $ob[$this->language]['Contracts']['TableContractName'];
            $this->table9 = $ob[$this->language]['Contracts']['TableContractGovernorate'];
            $this->table10 = $ob[$this->language]['Contracts']['TableContractArea'];
            //init label
            $this->label3 = $ob[$this->language]['Contracts']['LabelContractName'];
            $this->label4 = $ob[$this->language]['Contracts']['LabelContractGovernorate'];
            $this->label5 = $ob[$this->language]['Contracts']['LabelContractArea'];
            //init hint
            $this->hint1 = $ob[$this->language]['Contracts']['HintContractName'];
            $this->hint2 = $ob[$this->language]['Contracts']['HintContractGovernorate'];
            $this->hint3 = $ob[$this->language]['Contracts']['HintContractArea'];
            $this->successfully1 = $ob[$this->language]['Contracts']['LoadMessage'];
        }else if($ob['Contracts'] && Rays::find(request()->session()->get('userLogout'))['Branch']){
            parent::__construct($ob['Setting']['Language'], 
            $ob[$ob['Setting']['Language']]['Contracts']['TitleDeleteContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['LabelDeleteContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonDeleteContract'],
            route('deleteItem', 'Contracts'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Contracts']['PackagesContracts'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeBranch(Rays::find(request()->session()->get('userLogout'))['Branch'], $ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Contracts']['TitleCreateContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['TitleEditContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonCreateContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonAddContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonEditContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['TableContractId'],
            $ob[$ob['Setting']['Language']]['Contracts']['TableContractEdit'],
            Contracts::fromArray(array_reverse($ob['Contracts'])));
            $this->error1 = $ob[$this->language]['Contracts']['ContractNameRequired'];
            $this->error2 = $ob[$this->language]['Contracts']['ContractNameInvalid'];
            $this->error3 = $ob[$this->language]['Contracts']['ContractGovernorateRequired'];
            $this->error4 = $ob[$this->language]['Contracts']['ContractGovernorateInvalid'];
            $this->error5 = $ob[$this->language]['Contracts']['ContractAreaRequired'];
            $this->error6 = $ob[$this->language]['Contracts']['ContractAreaInvalid'];
            //init table
            $this->table8 = $ob[$this->language]['Contracts']['TableContractName'];
            $this->table9 = $ob[$this->language]['Contracts']['TableContractGovernorate'];
            $this->table10 = $ob[$this->language]['Contracts']['TableContractArea'];
            //init label
            $this->label3 = $ob[$this->language]['Contracts']['LabelContractName'];
            $this->label4 = $ob[$this->language]['Contracts']['LabelContractGovernorate'];
            $this->label5 = $ob[$this->language]['Contracts']['LabelContractArea'];
            //init hint
            $this->hint1 = $ob[$this->language]['Contracts']['HintContractName'];
            $this->hint2 = $ob[$this->language]['Contracts']['HintContractGovernorate'];
            $this->hint3 = $ob[$this->language]['Contracts']['HintContractArea'];
            $this->successfully1 = $ob[$this->language]['Contracts']['LoadMessage'];
        }else if(!$ob['Contracts'] && $ob['Branch']){
            parent::__construct($ob['Setting']['Language'], 
            $ob[$ob['Setting']['Language']]['Contracts']['TitleDeleteContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['LabelDeleteContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonDeleteContract'],
            route('deleteItem', 'Contracts'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Contracts']['PackagesContracts'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeBranch($ob['Branch'], $ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Contracts']['TitleCreateContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['TitleEditContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonCreateContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonAddContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonEditContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['TableContractId'],
            $ob[$ob['Setting']['Language']]['Contracts']['TableContractEdit']);
            $this->error1 = $ob[$this->language]['Contracts']['ContractNameRequired'];
            $this->error2 = $ob[$this->language]['Contracts']['ContractNameInvalid'];
            $this->error3 = $ob[$this->language]['Contracts']['ContractGovernorateRequired'];
            $this->error4 = $ob[$this->language]['Contracts']['ContractGovernorateInvalid'];
            $this->error5 = $ob[$this->language]['Contracts']['ContractAreaRequired'];
            $this->error6 = $ob[$this->language]['Contracts']['ContractAreaInvalid'];
            //init table
            $this->table8 = $ob[$this->language]['Contracts']['TableContractName'];
            $this->table9 = $ob[$this->language]['Contracts']['TableContractGovernorate'];
            $this->table10 = $ob[$this->language]['Contracts']['TableContractArea'];
            //init label
            $this->label3 = $ob[$this->language]['Contracts']['LabelContractName'];
            $this->label4 = $ob[$this->language]['Contracts']['LabelContractGovernorate'];
            $this->label5 = $ob[$this->language]['Contracts']['LabelContractArea'];
            //init hint
            $this->hint1 = $ob[$this->language]['Contracts']['HintContractName'];
            $this->hint2 = $ob[$this->language]['Contracts']['HintContractGovernorate'];
            $this->hint3 = $ob[$this->language]['Contracts']['HintContractArea'];
            $this->successfully1 = $ob[$this->language]['Contracts']['LoadMessage'];
        }else if(!$ob['Contracts'] && Rays::find(request()->session()->get('userLogout'))['Branch']){
            parent::__construct($ob['Setting']['Language'], 
            $ob[$ob['Setting']['Language']]['Contracts']['TitleDeleteContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['LabelDeleteContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonDeleteContract'],
            route('deleteItem', 'Contracts'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Contracts']['PackagesContracts'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeBranch(Rays::find(request()->session()->get('userLogout'))['Branch'], $ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Contracts']['TitleCreateContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['TitleEditContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonCreateContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonAddContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonEditContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['TableContractId'],
            $ob[$ob['Setting']['Language']]['Contracts']['TableContractEdit']);
            $this->error1 = $ob[$this->language]['Contracts']['ContractNameRequired'];
            $this->error2 = $ob[$this->language]['Contracts']['ContractNameInvalid'];
            $this->error3 = $ob[$this->language]['Contracts']['ContractGovernorateRequired'];
            $this->error4 = $ob[$this->language]['Contracts']['ContractGovernorateInvalid'];
            $this->error5 = $ob[$this->language]['Contracts']['ContractAreaRequired'];
            $this->error6 = $ob[$this->language]['Contracts']['ContractAreaInvalid'];
            //init table
            $this->table8 = $ob[$this->language]['Contracts']['TableContractName'];
            $this->table9 = $ob[$this->language]['Contracts']['TableContractGovernorate'];
            $this->table10 = $ob[$this->language]['Contracts']['TableContractArea'];
            //init label
            $this->label3 = $ob[$this->language]['Contracts']['LabelContractName'];
            $this->label4 = $ob[$this->language]['Contracts']['LabelContractGovernorate'];
            $this->label5 = $ob[$this->language]['Contracts']['LabelContractArea'];
            //init hint
            $this->hint1 = $ob[$this->language]['Contracts']['HintContractName'];
            $this->hint2 = $ob[$this->language]['Contracts']['HintContractGovernorate'];
            $this->hint3 = $ob[$this->language]['Contracts']['HintContractArea'];
            $this->successfully1 = $ob[$this->language]['Contracts']['LoadMessage'];
        }else if($ob['Contracts']){  
            parent::__construct($ob['Setting']['Language'], 
            $ob[$ob['Setting']['Language']]['Contracts']['TitleDeleteContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['LabelDeleteContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonDeleteContract'],
            route('deleteItem', 'Contracts'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Contracts']['PackagesContracts'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeMainBranch($ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Contracts']['TitleCreateContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['TitleEditContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonCreateContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonAddContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonEditContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['TableContractId'],
            $ob[$ob['Setting']['Language']]['Contracts']['TableContractEdit'],
            Contracts::fromArray(array_reverse($ob['Contracts'])));
            $this->error1 = $ob[$this->language]['Contracts']['ContractNameRequired'];
            $this->error2 = $ob[$this->language]['Contracts']['ContractNameInvalid'];
            $this->error3 = $ob[$this->language]['Contracts']['ContractGovernorateRequired'];
            $this->error4 = $ob[$this->language]['Contracts']['ContractGovernorateInvalid'];
            $this->error5 = $ob[$this->language]['Contracts']['ContractAreaRequired'];
            $this->error6 = $ob[$this->language]['Contracts']['ContractAreaInvalid'];
            //init table
            $this->table8 = $ob[$this->language]['Contracts']['TableContractName'];
            $this->table9 = $ob[$this->language]['Contracts']['TableContractGovernorate'];
            $this->table10 = $ob[$this->language]['Contracts']['TableContractArea'];
            //init label
            $this->label3 = $ob[$this->language]['Contracts']['LabelContractName'];
            $this->label4 = $ob[$this->language]['Contracts']['LabelContractGovernorate'];
            $this->label5 = $ob[$this->language]['Contracts']['LabelContractArea'];
            //init hint
            $this->hint1 = $ob[$this->language]['Contracts']['HintContractName'];
            $this->hint2 = $ob[$this->language]['Contracts']['HintContractGovernorate'];
            $this->hint3 = $ob[$this->language]['Contracts']['HintContractArea'];
            $this->successfully1 = $ob[$this->language]['Contracts']['LoadMessage'];
        }else{//request()->route('id') === 'PackagesContracts'
            parent::__construct($ob['Setting']['Language'], 
            $ob[$ob['Setting']['Language']]['Contracts']['TitleDeleteContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['LabelDeleteContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonDeleteContract'],
            route('deleteItem', 'Contracts'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Contracts']['PackagesContracts'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeMainBranch($ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']),
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Contracts']['TitleCreateContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['TitleEditContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonCreateContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonAddContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['ButtonEditContract'],
            $ob[$ob['Setting']['Language']]['Contracts']['TableContractId'],
            $ob[$ob['Setting']['Language']]['Contracts']['TableContractEdit']);
            $this->error1 = $ob[$this->language]['Contracts']['ContractNameRequired'];
            $this->error2 = $ob[$this->language]['Contracts']['ContractNameInvalid'];
            $this->error3 = $ob[$this->language]['Contracts']['ContractGovernorateRequired'];
            $this->error4 = $ob[$this->language]['Contracts']['ContractGovernorateInvalid'];
            $this->error5 = $ob[$this->language]['Contracts']['ContractAreaRequired'];
            $this->error6 = $ob[$this->language]['Contracts']['ContractAreaInvalid'];
            //init table
            $this->table8 = $ob[$this->language]['Contracts']['TableContractName'];
            $this->table9 = $ob[$this->language]['Contracts']['TableContractGovernorate'];
            $this->table10 = $ob[$this->language]['Contracts']['TableContractArea'];
            //init label
            $this->label3 = $ob[$this->language]['Contracts']['LabelContractName'];
            $this->label4 = $ob[$this->language]['Contracts']['LabelContractGovernorate'];
            $this->label5 = $ob[$this->language]['Contracts']['LabelContractArea'];
            //init hint
            $this->hint1 = $ob[$this->language]['Contracts']['HintContractName'];
            $this->hint2 = $ob[$this->language]['Contracts']['HintContractGovernorate'];
            $this->hint3 = $ob[$this->language]['Contracts']['HintContractArea'];
            $this->successfully1 = $ob[$this->language]['Contracts']['LoadMessage'];
        }
    }
    public function index($id){
        return view($id ==='Knows'?'admin.contracts.knows':'admin.contracts.packages_contracts',[
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
