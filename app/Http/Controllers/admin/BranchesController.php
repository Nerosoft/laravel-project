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

class BranchesController extends Controller
{
    public function setupLanguage($init, $ob = null){
        switch ($init) {
            case 'Branch':
                return new Branches($init);
            case 'branch_create':
                return new AppModel('option6', $ob[$ob['Setting']['Language']]['Error'], 'Branch', $ob[$ob['Setting']['Language']]['Message']['BranchesAdd'], array_keys($ob[$ob['Setting']['Language']]['SelectBranchBox']), $ob['AppId']);    
            case 'branch_edit':
                return new AppModel('option2', $ob[$ob['Setting']['Language']]['Error'], 'Branch', $ob[$ob['Setting']['Language']]['Message']['BranchesEdit'], array_keys($ob[$ob['Setting']['Language']]['SelectBranchBox']), isset($ob['Branch']) ? array_keys($ob['Branch']) : array());    
            case 'branch_delete':{
                $arr1 = array();
                if(isset($ob['Branch']))
                    foreach ($ob['Branch'] as $key => $branch)
                        array_push($arr1, $branch['id']);
                return new AppModel('delete', $ob[$ob['Setting']['Language']]['Error'], 'Branch', $ob[$ob['Setting']['Language']]['Message']['BranchesDelete'], $arr1);    
            }
        }
    }
    public function index(){
        $lang = $this->setupLanguage('Branch');
        return view('admin.branches',[
            'lang'=> $lang,
            'newBranchRays'=>route('addBranchRays'),
            'active'=>'Branches'
        ]);
    }
    private function saveBranch($model, $id){
        $arr = $model->Branch;
        $arr[$this->generateUniqueIdentifier()] = [
        'Name'=>request()->input('brance_rays_name'),
        'Phone'=>request()->input('brance_rays_phone'),
        'Governments'=>request()->input('brance_rays_governments'),
        'City'=>request()->input('brance_rays_city'),
        'Street'=>request()->input('brance_rays_street'),
        'Building'=>request()->input('brance_rays_building'),
        'Address'=>request()->input('brance_rays_address'),
        'Country'=>request()->input('brance_rays_country'),
        'Follow'=>request()->input('brance_rays_follow'),
        'id'=>$id];
        $model->Branch = $arr;
        $model->save();
    }
    public function newBranchRays(Request $request){
        $lang = $this->setupLanguage('branch_create', Rays::find(request()->session()->get('userId')));
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
        //find model in database and save that model in my variable
        $myDb = Rays::find($lang->id1);
        $myId = Str::uuid()->toString();
        //if branch exist in my database push it branch in my brancy in database and save all branch
        if(isset($myDb->Branch)){
            foreach ($myDb->Branch as $key => $value){
                $model = Rays::find($value['id']);
                $this->saveBranch($model, $myId);
            }   
            $this->saveBranch($myDb, $myId);
        }
        //if no exist brance in my database make branch and save it branch in database
        else{
            $myDb->Branch = array($this->generateUniqueIdentifier()=>[
            'Name'=>$request->input('brance_rays_name'),
            'Phone'=>$request->input('brance_rays_phone'),
            'Governments'=>$request->input('brance_rays_governments'),
            'City'=>$request->input('brance_rays_city'),
            'Street'=>$request->input('brance_rays_street'),
            'Building'=>$request->input('brance_rays_building'),
            'Address'=>$request->input('brance_rays_address'),
            'Country'=>$request->input('brance_rays_country'),
            'Follow'=>$request->input('brance_rays_follow'),
            'id'=>$myId]);
            $myDb->save();
        }
        //conver model database to array        
        $myBranch = $myDb->toArray();
        //delete object user
        unset($myBranch['User']);
        //save brance name in _id 
        $myBranch['_id'] = $myId;
        //save father id
        $myBranch['AppId'] = $lang->id1;
        //insert the object in database
        Rays::insert($myBranch);
        return back()->with('success', $lang->successfully1);
    }
    public function editBranchRays(){
        $lang = $this->setupLanguage('branch_edit', Rays::find(request()->session()->get('userId')));
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
        ]);
        if ($validator->fails())
            return back()->withErrors($validator);
        else{
            foreach (Rays::all() as $index => $ob){
                $model = $ob->get()[$index];
                if($model->AppId === request()->session()->get('userLogout') || $model->_id === request()->session()->get('userLogout'))
                    foreach ($model->Branch as $key => $branch)
                        if($key == request()->input('id')){
                            $arr = $model->Branch;
                            $arr[request()->input('id')] = [
                            'Name'=>request()->input('brance_rays_name'),
                            'Phone'=>request()->input('brance_rays_phone'),
                            'Governments'=>request()->input('brance_rays_governments'), 
                            'City'=>request()->input('brance_rays_city'),
                            'Street'=>request()->input('brance_rays_street'), 
                            'Building'=>request()->input('brance_rays_building'),
                            'Address'=>request()->input('brance_rays_address'), 
                            'Country'=>request()->input('brance_rays_country'),
                            'Follow'=>request()->input('brance_rays_follow'), 
                            'id'=>$arr[request()->input('id')]['id']];
                            $model->Branch = $arr;
                            $model->save();
                            break;
                        }    
            }             
            return back()->with('success', $lang->successfully1);
        }
    }
    public function deleteBranchRays(){
        $lang = $this->setupLanguage('branch_delete', Rays::find(request()->session()->get('userId')));
        request()->validate([
            'id' => ['required', Rule::in($lang->size1), Rule::notIn(request()->session()->get('userId'))],
            ], [
                'id.required' => $lang->error20,
                'id.in' => $lang->error21,
                'id.not_in' => $lang->error21,
            ]);
        Rays::find(request()->input('id'))->delete();
        $model = Rays::find(request()->session()->get('userLogout'));
            foreach ($model->Branch as $key => $branch) {
                if($branch['id'] === request()->input('id')){
                    $arr = $model->Branch;
                    unset($arr[$key]);
                    if(count($arr) === 0)
                        unset($model['Branch']);
                    else
                        $model->Branch = $arr;
                    $model->save();
                }else{
                    $model2 = Rays::find($branch['id']);
                    foreach ($model2->Branch as $key => $branch) {
                        if($branch['id'] === request()->input('id')){
                            $arr = $model2->Branch;
                            unset($arr[$key]);
                            $model2->Branch = $arr;
                            $model2->save();
                            break;
                        }
                    }
                }
            }
            return back()->with('success', $lang->successfully1);  
    }
}
