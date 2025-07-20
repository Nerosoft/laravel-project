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
use App\instance\admin\Branch;
use Illuminate\Support\Facades\Validator;

use App\Http\interface\ActionInit;

class BranchesController extends Page implements LangObject, ActionInit
{
    public function initView(){
        $this->tableData = $this->ob['Branch'] || Rays::find(request()->session()->get('userLogout'))['Branch']?
        Branch::fromArray($this->ob['Branch']? $this->ob['Branch'] : Rays::find(request()->session()->get('userLogout'))['Branch'], $this->ob[$this->ob['Setting']['Language']]['SelectBranchBox']):array();
        $this->table8 = $this->ob[$this->language]['Branch']['BranchStreet'];
        $this->table9 = $this->ob[$this->language]['Branch']['BranchName'];
        $this->table10 = $this->ob[$this->language]['Branch']['BranchPhone'];
        $this->table16 = $this->ob[$this->language]['Branch']['BranchGovernments'];
        $this->table17 = $this->ob[$this->language]['Branch']['BranchCity'];
        $this->table12 = $this->ob[$this->language]['Branch']['BranchBuilding'];
        $this->table13 = $this->ob[$this->language]['Branch']['BranchAddress'];
        $this->table14 = $this->ob[$this->language]['Branch']['BranchCountry'];
        $this->table15 = $this->ob[$this->language]['Branch']['BranchFollow'];
        //get all hint
        $this->hint1 = $this->ob[$this->language]['Branch']['BranchRaysName'];
        $this->hint2 = $this->ob[$this->language]['Branch']['BranchRaysPhone'];
        $this->hint3 = $this->ob[$this->language]['Branch']['BranchRaysCountry'];
        $this->hint4 = $this->ob[$this->language]['Branch']['BranchRaysGovernments'];
        $this->hint5 = $this->ob[$this->language]['Branch']['BranchRaysCity'];
        $this->hint6 = $this->ob[$this->language]['Branch']['BranchRaysStreet'];
        $this->hint7 = $this->ob[$this->language]['Branch']['BranchRaysBuilding'];
        $this->hint8 = $this->ob[$this->language]['Branch']['BranchRaysAddress'];
        $this->branchInputOutput = $this->ob[$this->language]['SelectBranchBox'];
        $this->selectBox1 = $this->ob[$this->language]['Branch']['WithRaysOut'];
    }
    public function initValid(){
        $this->roll['brance_rays_name'] = ['required', 'min:3'];
        $this->roll['brance_rays_phone'] = ['required', 'regex:/^[0-9]{11}$/'];
        $this->roll['brance_rays_governments'] = ['required', 'min:3'];
        $this->roll['brance_rays_city'] = ['required', 'min:3'];
        $this->roll['brance_rays_street'] = ['required', 'min:3'];
        $this->roll['brance_rays_building'] = ['required', 'min:3'];
        $this->roll['brance_rays_address'] = ['required', 'min:3'];
        $this->roll['brance_rays_country'] = ['required', 'min:3'];
        $this->roll['brance_rays_follow'] = ['required', Rule::in(array_keys($this->ob[$this->ob['Setting']['Language']]['SelectBranchBox']))];
        $this->message['brance_rays_name.min'] = $this->error10;
        $this->message['brance_rays_name.required'] = $this->error1;
        $this->message['brance_rays_phone.regex'] = $this->error11;
        $this->message['brance_rays_phone.required'] = $this->error2;
        $this->message['brance_rays_governments.min'] = $this->error12;
        $this->message['brance_rays_governments.required'] = $this->error3;
        $this->message['brance_rays_city.min'] = $this->error13;
        $this->message['brance_rays_city.required'] = $this->error4;
        $this->message['brance_rays_street.min'] = $this->error14;
        $this->message['brance_rays_street.required'] = $this->error5;
        $this->message['brance_rays_building.min'] = $this->error15;
        $this->message['brance_rays_building.required'] = $this->error6;
        $this->message['brance_rays_address.min'] = $this->error16;
        $this->message['brance_rays_address.required'] = $this->error7;
        $this->message['brance_rays_country.min'] = $this->error17;
        $this->message['brance_rays_country.required'] = $this->error8;
        $this->message['brance_rays_follow.required'] = $this->error9;
        $this->message['brance_rays_follow.in'] = $this->ob[$this->ob['Setting']['Language']]['Branch']['BranceRaysFollowValue'];
    }
    public function __construct(){

        $this->ob = Rays::find(request()->session()->get('userId'));
        $this->error1 = $this->ob[$this->ob['Setting']['Language']]['Branch']['BranceRaysNameRequired'];
        $this->error2 = $this->ob[$this->ob['Setting']['Language']]['Branch']['BranceRaysPhoneRequired'];
        $this->error3 = $this->ob[$this->ob['Setting']['Language']]['Branch']['BranceRaysGovernmentsRequired'];
        $this->error4 = $this->ob[$this->ob['Setting']['Language']]['Branch']['BranceRaysCityRequired'];
        $this->error5 = $this->ob[$this->ob['Setting']['Language']]['Branch']['BranceRaysStreetRequired'];
        $this->error6 = $this->ob[$this->ob['Setting']['Language']]['Branch']['BranceRaysBuildingRequired'];
        $this->error7 = $this->ob[$this->ob['Setting']['Language']]['Branch']['BranceRaysAddressRequired'];
        $this->error8 = $this->ob[$this->ob['Setting']['Language']]['Branch']['BranceRaysCountryRequired'];
        $this->error9 = $this->ob[$this->ob['Setting']['Language']]['Branch']['BranceRaysFollowRequired'];
        $this->error10 = $this->ob[$this->ob['Setting']['Language']]['Branch']['BranceRaysNameLength'];
        $this->error11 = $this->ob[$this->ob['Setting']['Language']]['Branch']['BranceRaysPhoneLength'];
        $this->error12 = $this->ob[$this->ob['Setting']['Language']]['Branch']['BranceRaysGovernmentsLength'];
        $this->error13 = $this->ob[$this->ob['Setting']['Language']]['Branch']['BranceRaysCityLength'];
        $this->error14 = $this->ob[$this->ob['Setting']['Language']]['Branch']['BranceRaysStreetLength'];
        $this->error15 = $this->ob[$this->ob['Setting']['Language']]['Branch']['BranceRaysBuildingLength'];
        $this->error16 = $this->ob[$this->ob['Setting']['Language']]['Branch']['BranceRaysAddressLength'];
        $this->error17 = $this->ob[$this->ob['Setting']['Language']]['Branch']['BranceRaysCountryLength'];
        parent::__construct($this, 'Branch', $this->ob);
    }
    public function makeAddBranch(){
        $myId = Str::uuid()->toString();
        $this->getCreateDataBase($this->ob['Branch']?$this->ob:Rays::find(request()->session()->get('userLogout')), 'Branch', $myId, $this);
        //conver model database to array        
        $myBranch = $this->ob->toArray();
        //delete object user
        unset($myBranch['User']);
        unset($myBranch['Branch']);
        //save brance name in _id 
        $myBranch['_id'] = $myId;
        //insert the object in database
        Rays::insert($myBranch);
        return back()->with('success', $this->successfulyMessage);
    }
    public function makeEditBranch(){
        $this->getEditDataBase($this->ob['Branch']?$this->ob:Rays::find(request()->session()->get('userLogout')), 'Branch', $this); 
        return back()->with('success', $this->successfulyMessage);
    }
    public function index(){
        return view('admin.branches',[
            'lang'=> $this,
            'newBranchRays'=>route('addBranchRays'),
            'active'=>'Branches',
        ]);
    }
    public function getMyObject($id = null){
        request()->validate($this->roll, $this->message);
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
