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
        $this->error1 = $ob[$ob['Setting']['Language']]['Branch']['BranceRaysNameRequired'];
        $this->error2 = $ob[$ob['Setting']['Language']]['Branch']['BranceRaysPhoneRequired'];
        $this->error3 = $ob[$ob['Setting']['Language']]['Branch']['BranceRaysGovernmentsRequired'];
        $this->error4 = $ob[$ob['Setting']['Language']]['Branch']['BranceRaysCityRequired'];
        $this->error5 = $ob[$ob['Setting']['Language']]['Branch']['BranceRaysStreetRequired'];
        $this->error6 = $ob[$ob['Setting']['Language']]['Branch']['BranceRaysBuildingRequired'];
        $this->error7 = $ob[$ob['Setting']['Language']]['Branch']['BranceRaysAddressRequired'];
        $this->error8 = $ob[$ob['Setting']['Language']]['Branch']['BranceRaysCountryRequired'];
        $this->error9 = $ob[$ob['Setting']['Language']]['Branch']['BranceRaysFollowRequired'];
        $this->error10 = $ob[$ob['Setting']['Language']]['Branch']['BranceRaysNameLength'];
        $this->error11 = $ob[$ob['Setting']['Language']]['Branch']['BranceRaysPhoneLength'];
        $this->error12 = $ob[$ob['Setting']['Language']]['Branch']['BranceRaysGovernmentsLength'];
        $this->error13 = $ob[$ob['Setting']['Language']]['Branch']['BranceRaysCityLength'];
        $this->error14 = $ob[$ob['Setting']['Language']]['Branch']['BranceRaysStreetLength'];
        $this->error15 = $ob[$ob['Setting']['Language']]['Branch']['BranceRaysBuildingLength'];
        $this->error16 = $ob[$ob['Setting']['Language']]['Branch']['BranceRaysAddressLength'];
        $this->error17 = $ob[$ob['Setting']['Language']]['Branch']['BranceRaysCountryLength'];
        if(Route::currentRouteName() === 'addBranchRays'){
            $this->error19 = $ob[$ob['Setting']['Language']]['Branch']['BranceRaysFollowValue'];
            request()->validate([
                'brance_rays_name' => ['required', 'min:3'],
                'brance_rays_phone' => ['required', 'regex:/^[0-9]{11}$/'],
                'brance_rays_governments' => ['required', 'min:3'],
                'brance_rays_city' => ['required', 'min:3'],
                'brance_rays_street' => ['required', 'min:3'],
                'brance_rays_building' => ['required', 'min:3'],
                'brance_rays_address' => ['required', 'min:3'],
                'brance_rays_country' => ['required', 'min:3'],
                'brance_rays_follow' => ['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['SelectBranchBox']))],
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
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Branch']['BranchesAdd'];
        }else if(Route::currentRouteName() === 'editBranchRays'){
            $this->error19 = $ob[$ob['Setting']['Language']]['Branch']['BranceRaysFollowValue'];
            $this->error20 = $ob[$ob['Setting']['Language']]['Branch']['BranchRaysId'];
            $this->error21 = $ob[$ob['Setting']['Language']]['Branch']['BranchRaysLenght'];
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
            'brance_rays_follow' => ['required', Rule::in(array_keys($myDb[$myDb['Setting']['Language']]['SelectBranchBox']))],
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
                'brance_rays_follow.required' => $this->error9,
                'brance_rays_follow.in' => $this->error19
            ]);
            $this->getEditDataBase($myDb, 'Branch', $this); 
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Branch']['BranchesEdit'];
        }else if(Route::currentRouteName() === 'branchMain'){
            $ob = Rays::find(request()->route('id'))? Rays::find(request()->route('id')):$ob;
            $myBranch = isset(Rays::find(request()->session()->get('userLogout'))['Branch'][request()->route('id')])?Rays::find(request()->session()->get('userLogout'))['Branch']:array(request()->session()->get('userLogout')=>['Name'=>$ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']]);
            Validator::make(['id'=>request()->route('id')], [
                'id'=>['required', Rule::in(array_keys($myBranch))]
            ], [
                'id.required'=>$ob[$ob['Setting']['Language']]['Branch']['BranchRaysId'],
                'id.in'=>$ob[$ob['Setting']['Language']]['Branch']['BranchRaysLenght'],
            ])->validate();
            request()->session()->put('userId', request()->route('id'));
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Branch']['BranchesChange'].' '.$myBranch[request()->route('id')]['Name'];
        }else{
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['Branch']['BranchRaysDelete1'],
            $ob[$ob['Setting']['Language']]['Branch']['BranchRaysDelete2'],
            $ob[$ob['Setting']['Language']]['Branch']['BranchRaysDelete3'],
            route('deleteItem', 'Branch'),
            $ob[$ob['Setting']['Language']]['TableInfo'],
            $ob[$ob['Setting']['Language']]['Branch']['Branches'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            $ob['Branch']?$ob['Branch']:Rays::find(request()->session()->get('userLogout'))['Branch'],
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Branch']['BranchRays'],
            $ob[$ob['Setting']['Language']]['Branch']['BranchRaysEdit'],
            $ob[$ob['Setting']['Language']]['Branch']['CreateBranche'],
            $ob[$ob['Setting']['Language']]['Branch']['AddBranchRays'],
            $ob[$ob['Setting']['Language']]['Branch']['EditBranchRays'],
            $ob[$ob['Setting']['Language']]['Branch']['TableBranchRaysId'],
            $ob[$ob['Setting']['Language']]['Branch']['LanguageEvent']);
            //init label
            $this->table8 = $ob[$this->language]['Branch']['BranchStreet'];
            $this->table9 = $ob[$this->language]['Branch']['BranchName'];
            $this->table10 = $ob[$this->language]['Branch']['BranchPhone'];
            $this->table16 = $ob[$this->language]['Branch']['BranchGovernments'];
            $this->table17 = $ob[$this->language]['Branch']['BranchCity'];
            $this->table12 = $ob[$this->language]['Branch']['BranchBuilding'];
            $this->table13 = $ob[$this->language]['Branch']['BranchAddress'];
            $this->table14 = $ob[$this->language]['Branch']['BranchCountry'];
            $this->table15 = $ob[$this->language]['Branch']['BranchFollow'];
            //get all hint
            $this->hint1 = $ob[$this->language]['Branch']['BranchRaysName'];
            $this->hint2 = $ob[$this->language]['Branch']['BranchRaysPhone'];
            $this->hint3 = $ob[$this->language]['Branch']['BranchRaysCountry'];
            $this->hint4 = $ob[$this->language]['Branch']['BranchRaysGovernments'];
            $this->hint5 = $ob[$this->language]['Branch']['BranchRaysCity'];
            $this->hint6 = $ob[$this->language]['Branch']['BranchRaysStreet'];
            $this->hint7 = $ob[$this->language]['Branch']['BranchRaysBuilding'];
            $this->hint8 = $ob[$this->language]['Branch']['BranchRaysAddress'];
            $this->branchInputOutput = $ob[$this->language]['SelectBranchBox'];
            $this->selectBox1 = $ob[$this->language]['Branch']['WithRaysOut'];
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
