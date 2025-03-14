<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Rays;
use Illuminate\Validation\Rule;
use App\language\admin\contracts\PackagesContracts;
use App\language\admin\action\AppModel;
use App\language\admin\contracts\Governments;
use App\language\admin\contracts\TheContracts;
use App\language\admin\contracts\PricesListContracts;
use App\language\admin\contracts\Labs;
use App\language\admin\contracts\LabsOut;
use App\language\admin\contracts\Doctors;
class ContractsController extends Controller
{
    public function index($id){
        $lang = $this->initLanguage($id);
        if($id === 'Governments'){
            $view = view('admin.contracts.governments',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'TheContracts'){
            $view = view('admin.contracts.the_contracts',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'PackagesContracts'){
            $view = view('admin.contracts.packages_contracts',[
                'lang'=> $lang, 
            ]);
        }
        else if($id === 'PricesListContracts'){
            $view = view('admin.contracts.prices_list_contracts',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'Labs'){
            $view = view('admin.contracts.labs',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'LabsOut'){
            $view = view('admin.contracts.labs_out',[
                'lang'=> $lang, 
            ]);
        }
        else if($id === 'Doctors'){
            $view = view('admin.contracts.doctors',[
                'lang'=> $lang,
            ]);
        }else
            abort(404);
        $lang->myMenuApp['Contracts']['active'] = 'my_active';
        $lang->myMenuApp['Contracts']['items'][$id]['active'] = 'my_active';
        return $view;
    }
    private function initLanguage($id, $ob = null){
        switch ($id) {
            case 'PackagesContracts':
                return new PackagesContracts($id);
            case 'Create-Nero-Soft-Contracts':
                return new AppModel('option3', $ob[$ob['Setting']['Language']]['Error'], 'PackagesContracts', $ob[$ob['Setting']['Language']]['Message']['ContractsAdd']);
            case 'Edit-Nero-Soft-Contracts':
                return new AppModel('option1', $ob[$ob['Setting']['Language']]['Error'], 'PackagesContracts', $ob[$ob['Setting']['Language']]['Message']['ContractsEdit'], isset($ob['Contracts']) ? array_keys($ob['Contracts']) : array());
            case 'Delete-Nero-Soft-Contracts':
                return new AppModel('delete', $ob[$ob['Setting']['Language']]['Error'], 'PackagesContracts', $ob[$ob['Setting']['Language']]['Message']['ContractsDelete'], isset($ob['Contracts']) ? array_keys($ob['Contracts']) : array());

            case 'Governments':
                return new Governments();
            case 'TheContracts':
                return new TheContracts();
            case 'PricesListContracts':
                return new PricesListContracts();
            case 'Labs':
                return new Labs();
            case 'LabsOut':
                return new LabsOut();
            case 'Doctors':
                return new Doctors();
            default:
                return null;
        }
    }
    public function createContract(){
        $lang = $this->initLanguage('Create-Nero-Soft-Contracts', Rays::find(request()->session()->get('userId')));
        request()->validate([
            'name' => ['required', 'min:3'],
            'governorate' => ['required', 'min:3'],
            'area' => ['required', 'min:3'],
        ], [
            'name.required' => $lang->error1,
            'name.min' => $lang->error2,
            'governorate.required' => $lang->error3,
            'governorate.min' => $lang->error4,
            'area.required' => $lang->error5,
            'area.min' => $lang->error6,
        ]);
        $this->getCreateDataBase('Contracts', [
        'Name'=>request()->input('name'),
        'Governorate'=>request()->input('governorate'), 
        'Area'=>request()->input('area')]);
        return back()->with('success', $lang->successfully1);
    }
    public function editContract(){
        $lang = $this->initLanguage('Edit-Nero-Soft-Contracts', Rays::find(request()->session()->get('userId')));
        $validator = Validator::make(request()->all(),[
            'id' => ['required', Rule::in($lang->size1)],
            'name' => ['required', 'min:3'],
            'governorate' => ['required', 'min:3'],
            'area' => ['required', 'min:3'],
        ], [
            'id.required'=>$lang->error7,
            'id.in'=>$lang->error8,
            'name.required' => $lang->error1,
            'name.min' => $lang->error2,
            'governorate.required' => $lang->error3,
            'governorate.min' => $lang->error4,
            'area.required' => $lang->error5,
            'area.min' => $lang->error6,
        ]);
        if ($validator->fails())
            return back()->withErrors($validator);
        else{
            $this->getEditDataBase('Contracts', [
            'Name'=>request()->input('name'), 
            'Governorate'=>request()->input('governorate'), 
            'Area'=>request()->input('area')]);
            return back()->with('success', $lang->successfully1);
        }
    }
    public function deleteContract(){
        $lang = $this->initLanguage('Delete-Nero-Soft-Contracts', Rays::find(request()->session()->get('userId')));
        request()->validate([
            'id' => ['required', Rule::in($lang->size1)]
        ], [
            'id.required'=>$lang->error7,
            'id.in'=>$lang->error8,
        ]);
        $this->getDeleteDatabade('Contracts');
        return back()->with('success', $lang->successfully1);
    }
}
