<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rays;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Http\interface\LangObject;
use Illuminate\Support\Facades\Route;
use App\language\share\Page;
use App\Menu;
use App\instance\admin\Branch;
use Illuminate\Support\Facades\Validator;

class BranchesController extends Page implements LangObject
{
    public function __construct(){
        $ob = Rays::find(request()->session()->get('userId'));
        $this->error1 = $ob[$ob['Setting']['Language']]['Error']['BranceRaysNameRequired'];
        $this->error2 = $ob[$ob['Setting']['Language']]['Error']['BranceRaysPhoneRequired'];
        $this->error3 = $ob[$ob['Setting']['Language']]['Error']['BranceRaysGovernmentsRequired'];
        $this->error4 = $ob[$ob['Setting']['Language']]['Error']['BranceRaysCityRequired'];
        $this->error5 = $ob[$ob['Setting']['Language']]['Error']['BranceRaysStreetRequired'];
        $this->error6 = $ob[$ob['Setting']['Language']]['Error']['BranceRaysBuildingRequired'];
        $this->error7 = $ob[$ob['Setting']['Language']]['Error']['BranceRaysAddressRequired'];
        $this->error8 = $ob[$ob['Setting']['Language']]['Error']['BranceRaysCountryRequired'];
        $this->error9 = $ob[$ob['Setting']['Language']]['Error']['BranceRaysFollowRequired'];
        $this->error10 = $ob[$ob['Setting']['Language']]['Error']['BranceRaysNameLength'];
        $this->error11 = $ob[$ob['Setting']['Language']]['Error']['BranceRaysPhoneLength'];
        $this->error12 = $ob[$ob['Setting']['Language']]['Error']['BranceRaysGovernmentsLength'];
        $this->error13 = $ob[$ob['Setting']['Language']]['Error']['BranceRaysCityLength'];
        $this->error14 = $ob[$ob['Setting']['Language']]['Error']['BranceRaysStreetLength'];
        $this->error15 = $ob[$ob['Setting']['Language']]['Error']['BranceRaysBuildingLength'];
        $this->error16 = $ob[$ob['Setting']['Language']]['Error']['BranceRaysAddressLength'];
        $this->error17 = $ob[$ob['Setting']['Language']]['Error']['BranceRaysCountryLength'];
        if(Route::currentRouteName() === 'addBranchRays'){
            $this->error18 = $ob[$ob['Setting']['Language']]['Error']['BranceRaysFollowLength'];
            $this->error19 = $ob[$ob['Setting']['Language']]['Error']['BranceRaysFollowValue'];
            request()->validate([
                'brance_rays_name' => ['required', 'min:3'],
                'brance_rays_phone' => ['required', 'regex:/^[0-9]{11}$/'],
                'brance_rays_governments' => ['required', 'min:3'],
                'brance_rays_city' => ['required', 'min:3'],
                'brance_rays_street' => ['required', 'min:3'],
                'brance_rays_building' => ['required', 'min:3'],
                'brance_rays_address' => ['required', 'min:3'],
                'brance_rays_country' => ['required', 'min:3'],
                'brance_rays_follow' => ['required', 'min:3', Rule::in(array_keys($ob[$ob['Setting']['Language']]['SelectBranchBox']))],
                ], [
                'brance_rays_name.min' => $this->error10,
                'brance_rays_name.required' => $this->error1,
                'brance_rays_phone.regex' => $this->error11,
                'brance_rays_phone.required' => $this->error2,
                'brance_rays_governments.min' => $this->error12,
                'brance_rays_governments.required' => $this->error3,
                'brance_rays_city.min' => $this->error13,
                'brance_rays_city.required' => $this->error4,
                'brance_rays_street.min' => $this->error14,
                'brance_rays_street.required' => $this->error5,
                'brance_rays_building.min' => $this->error15,
                'brance_rays_building.required' => $this->error6,
                'brance_rays_address.min' => $this->error16,
                'brance_rays_address.required' => $this->error7,
                'brance_rays_country.min' => $this->error17,
                'brance_rays_country.required' => $this->error8,
                'brance_rays_follow.min' => $this->error18,
                'brance_rays_follow.required' => $this->error9,
                'brance_rays_follow.in' => $this->error19
            ]);
            $myId = Str::uuid()->toString();
            $myDb = request()->session()->get('userId') !== request()->session()->get('userlogout')?Rays::find(request()->session()->get('userLogout')):$ob;
            $this->getCreateDataBase($myDb, 'Branch', $myId, $this);
            //conver model database to array        
            $myBranch = $myDb->toArray();
            //delete object user
            unset($myBranch['User']);
            unset($myBranch['Branch']);
            //save brance name in _id 
            $myBranch['_id'] = $myId;
            //insert the object in database
            Rays::insert($myBranch);
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Message']['BranchesAdd'];
        }else if(Route::currentRouteName() === 'editBranchRays'){
            $this->error18 = $ob[$ob['Setting']['Language']]['Error']['BranceRaysFollowLength'];
            $this->error19 = $ob[$ob['Setting']['Language']]['Error']['BranceRaysFollowValue'];
            $this->error20 = $ob[$ob['Setting']['Language']]['Error']['BranchRaysId'];
            $this->error21 = $ob[$ob['Setting']['Language']]['Error']['BranchRaysLenght'];
            $myDb = request()->session()->get('userId') !== request()->session()->get('userlogout')?Rays::find(request()->session()->get('userLogout')):$ob;
            request()->validate([
            'id' => ['required', Rule::in(isset($myDb['Branch'])?array_keys($myDb['Branch']):null)],
            'brance_rays_name' => ['required', 'min:3'],
            'brance_rays_phone' => ['required', 'regex:/^[0-9]{11}$/'],
            'brance_rays_governments' => ['required', 'min:3'],
            'brance_rays_city' => ['required', 'min:3'],
            'brance_rays_street' => ['required', 'min:3'],
            'brance_rays_building' => ['required', 'min:3'],
            'brance_rays_address' => ['required', 'min:3'],
            'brance_rays_country' => ['required', 'min:3'],
            'brance_rays_follow' => ['required', 'min:3', Rule::in(array_keys($myDb[$myDb['Setting']['Language']]['SelectBranchBox']))],
            ], [
                'id.required' => $this->error20,
                'id.in' => $this->error21,
                'brance_rays_name.min' => $this->error10,
                'brance_rays_name.required' => $this->error1,
                'brance_rays_phone.regex' => $this->error11,
                'brance_rays_phone.required' => $this->error2,
                'brance_rays_governments.min' => $this->error12,
                'brance_rays_governments.required' => $this->error3,
                'brance_rays_city.min' => $this->error13,
                'brance_rays_city.required' => $this->error4,
                'brance_rays_street.min' => $this->error14,
                'brance_rays_street.required' => $this->error5,
                'brance_rays_building.min' => $this->error15,
                'brance_rays_building.required' => $this->error6,
                'brance_rays_address.min' => $this->error16,
                'brance_rays_address.required' => $this->error7,
                'brance_rays_country.min' => $this->error17,
                'brance_rays_country.required' => $this->error8,
                'brance_rays_follow.min' => $this->error18,
                'brance_rays_follow.required' => $this->error9,
                'brance_rays_follow.in' => $this->error19
            ]);
            $this->getEditDataBase($myDb, 'Branch', $this); 
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Message']['BranchesEdit'];
        }else if(Route::currentRouteName() === 'branchMain'){
            $ob = Rays::find(request()->route('id'))? Rays::find(request()->route('id')):$ob;
            $myBranch = isset(Rays::find(request()->session()->get('userLogout'))['Branch'][request()->route('id')])?
            Rays::find(request()->session()->get('userLogout'))['Branch']:
            array(request()->session()->get('userLogout')=>['Name'=>$ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']]);
            Validator::make(['id'=>request()->route('id')], [
                'id'=>['required', Rule::in(array_keys($myBranch))]
            ], [
                'id.required'=>$ob[$ob['Setting']['Language']]['Error']['BranchRaysId'],
                'id.in'=>$ob[$ob['Setting']['Language']]['Error']['BranchRaysLenght'],
            ])->validate();
            request()->session()->put('userId', request()->route('id'));
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Message']['BranchesChange'].' '.$myBranch[request()->route('id')]['Name'];
        }else{
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['Title']['BranchRaysDelete'],
            $ob[$ob['Setting']['Language']]['Label']['BranchRaysDelete'],
            $ob[$ob['Setting']['Language']]['Button']['BranchRaysDelete'],
            route('deleteItem', 'Branch'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Title']['Branches'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            $ob['Branch']?$ob['Branch']:Rays::find(request()->session()->get('userLogout'))['Branch'],
            new Menu($ob[$ob['Setting']['Language']]['Menu'], 'Admin'),
            $ob[$ob['Setting']['Language']]['Title']['BranchRays'],
            $ob[$ob['Setting']['Language']]['Title']['BranchRaysEdit'],
            $ob[$ob['Setting']['Language']]['Button']['CreateBranche'],
            $ob[$ob['Setting']['Language']]['Button']['AddBranchRays'],
            $ob[$ob['Setting']['Language']]['Button']['EditBranchRays'],
            $ob[$ob['Setting']['Language']]['Table']['BranchRaysId'],
            $ob[$ob['Setting']['Language']]['Table']['LanguageEvent']);
            //init label
            $this->table8 = $ob[$this->language]['Table']['BranchStreet'];
            $this->table9 = $ob[$this->language]['Table']['BranchName'];
            $this->table10 = $ob[$this->language]['Table']['BranchPhone'];
            $this->table16 = $ob[$this->language]['Table']['BranchGovernments'];
            $this->table17 = $ob[$this->language]['Table']['BranchCity'];
            $this->table12 = $ob[$this->language]['Table']['BranchBuilding'];
            $this->table13 = $ob[$this->language]['Table']['BranchAddress'];
            $this->table14 = $ob[$this->language]['Table']['BranchCountry'];
            $this->table15 = $ob[$this->language]['Table']['BranchFollow'];
            //get all hint
            $this->hint1 = $ob[$this->language]['Hint']['BranchRaysName'];
            $this->hint2 = $ob[$this->language]['Hint']['BranchRaysPhone'];
            $this->hint3 = $ob[$this->language]['Hint']['BranchRaysCountry'];
            $this->hint4 = $ob[$this->language]['Hint']['BranchRaysGovernments'];
            $this->hint5 = $ob[$this->language]['Hint']['BranchRaysCity'];
            $this->hint6 = $ob[$this->language]['Hint']['BranchRaysStreet'];
            $this->hint7 = $ob[$this->language]['Hint']['BranchRaysBuilding'];
            $this->hint8 = $ob[$this->language]['Hint']['BranchRaysAddress'];
            $this->branchInputOutput = $ob[$this->language]['SelectBranchBox'];
            $this->selectBox1 = $ob[$this->language]['SelectBox']['WithRaysOut'];
            $ob = request()->session()->get('userLogout') !== request()->session()->get('userId')?Rays::find(request()->session()->get('userLogout')):$ob;
            $this->allBranch = isset($ob['Branch'])?Branch::fromArray($ob['Branch'], $this->branchInputOutput):array();
        }
    }
    public function action(){
        return back()->with('success', $this->successfully1);
    }
    public function index(){
        return view('admin.branches',[
            'lang'=> $this,
            'newBranchRays'=>route('addBranchRays'),
            'active'=>'Branches',
            'logOut'=>route('admin.logout')
        ]);
    }
    public function getMyObject(){
        return array('Name'=>request()->input('brance_rays_name'),
            'Phone'=>request()->input('brance_rays_phone'),
            'Governments'=>request()->input('brance_rays_governments'),
            'City'=>request()->input('brance_rays_city'),
            'Street'=>request()->input('brance_rays_street'),
            'Building'=>request()->input('brance_rays_building'),
            'Address'=>request()->input('brance_rays_address'),
            'Country'=>request()->input('brance_rays_country'),
            'Follow'=>request()->input('brance_rays_follow'));
    }
}
