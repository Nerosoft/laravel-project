<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rays;
use App\language\admin\Branches;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\language\admin\action\AppModel;
use App\Http\interface\LangObject;

class BranchesController extends Controller implements LangObject
{
    public function setupLanguage($init, $myDb = null){
        switch ($init) {
            case 'Branch':
                return new Branches($init);
            case 'branch_create':
                return new AppModel('option1', (request()->session()->get('userLogout') === request()->session()->get('userId')?$myDb:Rays::find(request()->session()->get('userId')))[(request()->session()->get('userLogout') === request()->session()->get('userId')?$myDb:Rays::find(request()->session()->get('userId')))['Setting']['Language']]['Error'], 'Branch', (request()->session()->get('userLogout') === request()->session()->get('userId')?$myDb:Rays::find(request()->session()->get('userId')))[(request()->session()->get('userLogout') === request()->session()->get('userId')?$myDb:Rays::find(request()->session()->get('userId')))['Setting']['Language']]['Message']['BranchesAdd'], array_keys($myDb[$myDb['Setting']['Language']]['SelectBranchBox']));    
            case 'branch_edit':
                return new AppModel('option2', (request()->session()->get('userLogout') === request()->session()->get('userId')?$myDb:Rays::find(request()->session()->get('userId')))[(request()->session()->get('userLogout') === request()->session()->get('userId')?$myDb:Rays::find(request()->session()->get('userId')))['Setting']['Language']]['Error'], 'Branch', (request()->session()->get('userLogout') === request()->session()->get('userId')?$myDb:Rays::find(request()->session()->get('userId')))[(request()->session()->get('userLogout') === request()->session()->get('userId')?$myDb:Rays::find(request()->session()->get('userId')))['Setting']['Language']]['Message']['BranchesEdit'], isset($myDb['Branch'])?array_keys($myDb['Branch']):array(), array_keys($myDb[$myDb['Setting']['Language']]['SelectBranchBox']));    
            case 'branch_delete':
                return new AppModel('delete', (request()->session()->get('userLogout') === request()->session()->get('userId')?$myDb:Rays::find(request()->session()->get('userId')))[(request()->session()->get('userLogout') === request()->session()->get('userId')?$myDb:Rays::find(request()->session()->get('userId')))['Setting']['Language']]['Error'], 'Branch', (request()->session()->get('userLogout') === request()->session()->get('userId')||request()->input('id')===request()->session()->get('userId')?$myDb:Rays::find(request()->session()->get('userId')))[(request()->session()->get('userLogout') === request()->session()->get('userId')||request()->input('id')===request()->session()->get('userId')?$myDb:Rays::find(request()->session()->get('userId')))['Setting']['Language']]['Message']['BranchesDelete'], isset($myDb['Branch'])?array_keys($myDb['Branch']):array());
            case'change':
                return new AppModel('delete', $myDb[$myDb['Setting']['Language']]['Error'], 'Branch', $myDb[$myDb['Setting']['Language']]['Message']['BranchesChange'], isset($myDb['Branch'])||!isset(Rays::find(request()->session()->get('userLogout'))['Branch'])?array(request()->session()->get('userLogout')=>['Name'=>$myDb[$myDb['Setting']['Language']]['AppSettingAdmin']['BranchMain']]):Rays::find(request()->session()->get('userLogout'))['Branch']);
        }
    }
    public function index(){
        $lang = $this->setupLanguage('Branch');
        return view('admin.branches',[
            'lang'=> $lang,
            'newBranchRays'=>route('addBranchRays'),
            'active'=>'Branches',
            'logOut'=>route('admin.logout')
        ]);
    }
    public function changeBranch($id = null){
        $lang = $this->setupLanguage('change', Rays::find($id)?Rays::find($id):Rays::find(request()->session()->get('userId')));
        $validator = Validator::make(['id'=>$id], [
            'id'=>['required', Rule::in(array_keys($lang->size1))]
        ], [
            'id.required'=>$lang->error20,
            'id.in'=>$lang->error21,
        ])->validate();
        request()->session()->put('userId', $id);
        return back()->with('success', $lang->successfully1.' '.$lang->size1[$id]['Name']);
    }
    public function newBranchRays(Request $request){
        $myDb = Rays::find(request()->session()->get('userLogout'));
        $lang = $this->setupLanguage('branch_create', $myDb);
        $request->validate([
            'brance_rays_name' => ['required', 'min:3'],
            'brance_rays_phone' => ['required', 'regex:/^[0-9]{11}$/'],
            'brance_rays_governments' => ['required', 'min:3'],
            'brance_rays_city' => ['required', 'min:3'],
            'brance_rays_street' => ['required', 'min:3'],
            'brance_rays_building' => ['required', 'min:3'],
            'brance_rays_address' => ['required', 'min:3'],
            'brance_rays_country' => ['required', 'min:3'],
            'brance_rays_follow' => ['required', 'min:3', Rule::in($lang->branchInputOutputKeys)],
        ], [
            'brance_rays_name.min' => $lang->error10,
            'brance_rays_name.required' => $lang->error1,
            'brance_rays_phone.regex' => $lang->error11,
            'brance_rays_phone.required' => $lang->error2,
            'brance_rays_governments.min' => $lang->error12,
            'brance_rays_governments.required' => $lang->error3,
            'brance_rays_city.min' => $lang->error13,
            'brance_rays_city.required' => $lang->error4,
            'brance_rays_street.min' => $lang->error14,
            'brance_rays_street.required' => $lang->error5,
            'brance_rays_building.min' => $lang->error15,
            'brance_rays_building.required' => $lang->error6,
            'brance_rays_address.min' => $lang->error16,
            'brance_rays_address.required' => $lang->error7,
            'brance_rays_country.min' => $lang->error17,
            'brance_rays_country.required' => $lang->error8,
            'brance_rays_follow.min' => $lang->error18,
            'brance_rays_follow.required' => $lang->error9,
            'brance_rays_follow.in' => $lang->error19
        ]);
        $myId = Str::uuid()->toString();
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
        return back()->with('success', $lang->successfully1);
    }
    public function editBranchRays(){
        $myDb = Rays::find(request()->session()->get('userLogout'));        
        $lang = $this->setupLanguage('branch_edit', $myDb);
        $validator = Validator::make(request()->all(), [
            'id' => ['required', Rule::in($lang->size1)],
            'brance_rays_name' => ['required', 'min:3'],
            'brance_rays_phone' => ['required', 'regex:/^[0-9]{11}$/'],
            'brance_rays_governments' => ['required', 'min:3'],
            'brance_rays_city' => ['required', 'min:3'],
            'brance_rays_street' => ['required', 'min:3'],
            'brance_rays_building' => ['required', 'min:3'],
            'brance_rays_address' => ['required', 'min:3'],
            'brance_rays_country' => ['required', 'min:3'],
            'brance_rays_follow' => ['required', 'min:3', Rule::in($lang->branchInputOutputKeys)],
        ], [
            'id.required' => $lang->error20,
            'id.in' => $lang->error21,
            // 'id.integer' => $lang->error23,
            'brance_rays_name.min' => $lang->error10,
            'brance_rays_name.required' => $lang->error1,
            'brance_rays_phone.regex' => $lang->error11,
            'brance_rays_phone.required' => $lang->error2,
            'brance_rays_governments.min' => $lang->error12,
            'brance_rays_governments.required' => $lang->error3,
            'brance_rays_city.min' => $lang->error13,
            'brance_rays_city.required' => $lang->error4,
            'brance_rays_street.min' => $lang->error14,
            'brance_rays_street.required' => $lang->error5,
            'brance_rays_building.min' => $lang->error15,
            'brance_rays_building.required' => $lang->error6,
            'brance_rays_address.min' => $lang->error16,
            'brance_rays_address.required' => $lang->error7,
            'brance_rays_country.min' => $lang->error17,
            'brance_rays_country.required' => $lang->error8,
            'brance_rays_follow.min' => $lang->error18,
            'brance_rays_follow.required' => $lang->error9,
            'brance_rays_follow.in' => $lang->error19
        ])->validate();
        $this->getEditDataBase($myDb, 'Branch', $this);     
        return back()->with('success', $lang->successfully1);
    }
    public function deleteBranchRays(){
        $lang = $this->setupLanguage('branch_delete', Rays::find(request()->session()->get('userLogout')));
        request()->validate([
            'id' => ['required', Rule::in($lang->size1)],
            ], [
                'id.required' => $lang->error20,
                'id.in' => $lang->error21,
            ]);
        Rays::find(request()->input('id'))->delete();
        $this->getDeleteDatabade('Branch', 'userLogout');
        if(request()->input('id') === request()->session()->get('userId'))
            request()->session()->put('userId', request()->session()->get('userLogout'));
        return back()->with('success', $lang->successfully1);
    }
    public function getMyObject($name, $image, $id = null){
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
