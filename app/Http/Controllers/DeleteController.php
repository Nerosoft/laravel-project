<?php
namespace App\Http\Controllers;
use App\Models\Rays;
use Illuminate\Validation\Rule;
class DeleteController extends Controller
{
    public function __construct(){
        if(request()->input('id') === request()->session()->get('userId') && request()->route('id') === 'Branch'){
            $ob = Rays::find(request()->session()->get('userLogout'));
            request()->validate(['id' => ['required', Rule::in(isset($ob[request()->route('id')]) ? array_keys($ob[request()->route('id')]) : array())],
            ], [
                'id.required'=>$ob[$ob['Setting']['Language']][request()->route('id')]['BranchRaysId'],
                'id.in'=>$ob[$ob['Setting']['Language']][request()->route('id')]['BranchRaysLenght'],
            ]);
            $this->getDeleteDatabade($ob, request()->route('id'));
            request()->session()->put('userId', request()->session()->get('userLogout'));
            Rays::find(request()->input('id'))->delete();
            $this->successfully1 = $ob[$ob['Setting']['Language']][request()->route('id')]['BranchesDelete'];
        }else if(request()->route('id') === 'Branch'){
            $ob = Rays::find(request()->session()->get('userLogout'));
            request()->validate(['id' => ['required', Rule::in(isset($ob[request()->route('id')]) ? array_keys($ob[request()->route('id')]) : array())],
            ], [
                'id.required'=>$ob[$ob['Setting']['Language']][request()->route('id')]['BranchRaysId'],
                'id.in'=>$ob[$ob['Setting']['Language']][request()->route('id')]['BranchRaysLenght'],
            ]);
            $this->getDeleteDatabade($ob, request()->route('id'));
            Rays::find(request()->input('id'))->delete();
            $this->successfully1 = $ob[$ob['Setting']['Language']][request()->route('id')]['BranchesDelete'];
        }else if(request()->route('id') === 'CurrentOffers'){
            $ob = Rays::find(request()->session()->get('userId'));
            request()->validate(['id' => ['required', Rule::in(isset($ob[request()->route('id')]) ? array_keys($ob[request()->route('id')]) : array())],
            ], [
                'id.required'=>$ob[$ob['Setting']['Language']][request()->route('id')]['CurrentOffersIdRequired'],
                'id.in'=>$ob[$ob['Setting']['Language']][request()->route('id')]['CurrentOffersIdInvalid'],
            ]);
            $this->getDeleteDatabade($ob, request()->route('id'));
            $this->successfully1 = $ob[$ob['Setting']['Language']][request()->route('id')]['CurrentOffersDelete'];
        }else if(request()->route('id') === 'Test'){
            $ob = Rays::find(request()->session()->get('userId'));
            request()->validate(['id' => ['required', Rule::in(isset($ob[request()->route('id')]) ? array_keys($ob[request()->route('id')]) : array())],
            ], [
                'id.required'=>$ob[$ob['Setting']['Language']][request()->route('id')]['TestIdRequired'],
                'id.in'=>$ob[$ob['Setting']['Language']][request()->route('id')]['TestIdInvalid'],
            ]);
            $this->getDeleteDatabade($ob, request()->route('id'));
            $this->successfully1 = $ob[$ob['Setting']['Language']][request()->route('id')]['TestDelete'];
        }else if(request()->route('id') === 'Packages'){
            $ob = Rays::find(request()->session()->get('userId'));
            request()->validate(['id' => ['required', Rule::in(isset($ob[request()->route('id')]) ? array_keys($ob[request()->route('id')]) : array())],
            ], [
                'id.required'=>$ob[$ob['Setting']['Language']][request()->route('id')]['PackagesIdRequired'],
                'id.in'=>$ob[$ob['Setting']['Language']][request()->route('id')]['PackagesIdInvalid'],
            ]);
            $this->getDeleteDatabade($ob, request()->route('id'));
            $this->successfully1 = $ob[$ob['Setting']['Language']][request()->route('id')]['PackagesDelete'];
        }else if(request()->route('id') === 'Cultures'){
            $ob = Rays::find(request()->session()->get('userId'));
            request()->validate(['id' => ['required', Rule::in(isset($ob[request()->route('id')]) ? array_keys($ob[request()->route('id')]) : array())],
            ], [
                'id.required'=>$ob[$ob['Setting']['Language']][request()->route('id')]['CulturesIdRequired'],
                'id.in'=>$ob[$ob['Setting']['Language']][request()->route('id')]['CulturesIdInvalid'],
            ]);
            $this->getDeleteDatabade($ob, request()->route('id'));
            $this->successfully1 = $ob[$ob['Setting']['Language']][request()->route('id')]['CulturesDelete'];
        }else if(request()->route('id') === 'Contracts'){
            $ob = Rays::find(request()->session()->get('userId'));
            request()->validate(['id' => ['required', Rule::in(isset($ob[request()->route('id')]) ? array_keys($ob[request()->route('id')]) : array())],
            ], [
                'id.required'=>$ob[$ob['Setting']['Language']][request()->route('id')]['ContractIdRequired'],
                'id.in'=>$ob[$ob['Setting']['Language']][request()->route('id')]['ContractIdInvalid'],
            ]);
            $this->getDeleteDatabade($ob, request()->route('id'));
            $this->successfully1 = $ob[$ob['Setting']['Language']][request()->route('id')]['ContractsDelete'];
        }else if(request()->route('id') === 'Knows'){
            $ob = Rays::find(request()->session()->get('userId'));
            request()->validate(['id' => ['required', Rule::in(isset($ob[request()->route('id')]) ? array_keys($ob[request()->route('id')]) : array())],
            ], [
                'id.required'=>$ob[$ob['Setting']['Language']][request()->route('id')]['KnowsIdRequired'],
                'id.in'=>$ob[$ob['Setting']['Language']][request()->route('id')]['KnowsIdInvalid'],
            ]);
            $this->getDeleteDatabade($ob, request()->route('id'));
            $this->successfully1 = $ob[$ob['Setting']['Language']][request()->route('id')]['KnowsDelete'];
        }else if(request()->route('id') === 'Patent'){
            $ob = Rays::find(request()->session()->get('userId'));
            request()->validate(['id' => ['required', Rule::in(isset($ob[request()->route('id')]) ? array_keys($ob[request()->route('id')]) : array())],
            ], [
                'id.required'=>$ob[$ob['Setting']['Language']][request()->route('id')]['PatentIdRequired'],
                'id.in'=>$ob[$ob['Setting']['Language']][request()->route('id')]['PatentIdInvalid'],
            ]);
            $this->getDeleteDatabade($ob, request()->route('id'));
            $this->successfully1 = $ob[$ob['Setting']['Language']][request()->route('id')]['PatientsDelete'];
        }else //if(request()->route('id') === 'Receipt')
        {
            $ob = Rays::find(request()->session()->get('userId'));
            request()->validate(['id' => ['required', Rule::in(isset($ob[request()->route('id')]) ? array_keys($ob[request()->route('id')]) : array())],
            ], [
                'id.required'=>$ob[$ob['Setting']['Language']][request()->route('id')]['PatientRegisterationIdRequired'],
                'id.in'=>$ob[$ob['Setting']['Language']][request()->route('id')]['PatientRegisterationIdInvalid'],
            ]);
            $this->getDeleteDatabade($ob, request()->route('id'));
            $this->successfully1 = $ob[$ob['Setting']['Language']][request()->route('id')]['PatientRegisterationDelete'];
        }
    }
    public function action($id){
        return back()->with('success', $this->successfully1);
    }
    private function getDeleteDatabade($model, $item){
        if(count($model[$item]) === 1)
            unset($model[$item]);
        else{
            $arr = $model[$item];
            unset($arr[request()->input('id')]);
            $model[$item] = $arr;
        }
        $model->save();
    }
}