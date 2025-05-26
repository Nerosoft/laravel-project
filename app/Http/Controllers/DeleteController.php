<?php
namespace App\Http\Controllers;
use App\Models\Rays;
use Illuminate\Validation\Rule;
class DeleteController extends Controller
{
    public function __construct(){
        $ob = Rays::find(request()->session()->get('userId'));
        request()->validate([
        'id' => ['required', Rule::in( request()->route('id') === 'Branch'&&isset(Rays::find(request()->session()->get('userLogout'))['Branch'])? array_keys(Rays::find(request()->session()->get('userLogout'))['Branch']) :(isset($ob[request()->route('id')])?array_keys($ob[request()->route('id')]):array()))],
        ], [
            'id.required'=>$ob[$ob['Setting']['Language']]['Error'][
                request()->route('id') === 'CurrentOffers'?'CurrentOffersIdRequired':(request()->route('id') === 'Test'?'TestIdRequired':(request()->route('id') === 'Packages'?'PackagesIdRequired':(request()->route('id') === 'Cultures'?'CulturesIdRequired':(request()->route('id') === 'Contracts'?'ContractIdRequired':(request()->route('id') === 'Knows'?'KnowsIdRequired':(request()->route('id') === 'Patent'?'PatentIdRequired':(request()->route('id') === 'Receipt'?'PatientRegisterationIdRequired':(request()->route('id') === 'Branch'?'BranchRaysId':''))))))))],
            'id.in'=>$ob[$ob['Setting']['Language']]['Error'][
                request()->route('id') === 'CurrentOffers'?'CurrentOffersIdInvalid':(request()->route('id') === 'Test'?'TestIdInvalid':(request()->route('id') === 'Packages'?'PackagesIdInvalid':(request()->route('id') === 'Cultures'?'CulturesIdInvalid':(request()->route('id') === 'Contracts'?'ContractIdInvalid':(request()->route('id') === 'Knows'?'KnowsIdInvalid':(request()->route('id') === 'Patent'?'PatentIdInvalid':(request()->route('id') === 'Receipt'?'PatientRegisterationIdInvalid':(request()->route('id') === 'Branch'?'BranchRaysLenght':''))))))))],
        ]);
        if(request()->input('id') === request()->session()->get('userId')&& request()->route('id') === 'Branch'){
            $ob = Rays::find(request()->session()->get('userLogout'));
            $this->getDeleteDatabade($ob, request()->route('id'));
            request()->session()->put('userId', request()->session()->get('userLogout'));
            Rays::find(request()->input('id'))->delete();
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Message']['BranchesDelete'];
        }
        else if(request()->route('id') === 'Branch'){
            $this->getDeleteDatabade(Rays::find(request()->session()->get('userLogout')), request()->route('id'));
            Rays::find(request()->input('id'))->delete();
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Message']['BranchesDelete'];
        }
        else{
            $this->getDeleteDatabade($ob, request()->route('id'));
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Message'][
            request()->route('id') === 'CurrentOffers'?'CurrentOffersDelete':(request()->route('id') === 'Test'?'TestDelete':(request()->route('id') === 'Packages'?'PackagesDelete':(request()->route('id') === 'Cultures'?'CulturesDelete':(request()->route('id') === 'Contracts'?'ContractsDelete':(request()->route('id') === 'Knows'?'KnowsDelete':(request()->route('id') === 'Patent'?'PatientsDelete':(request()->route('id') === 'Receipt'?'PatientRegisterationDelete':'')))))))];
        }
    }
    public function action($id){
        return back()->with('success', $this->successfully1);
    }
}