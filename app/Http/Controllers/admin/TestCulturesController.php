<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rays;
use Illuminate\Validation\Rule;
use App\language\admin\test_cultures\OfferView;
use App\language\admin\test_cultures\TestView;
use App\language\admin\test_cultures\Categories;
use App\language\admin\test_cultures\Antibiotics;
use App\language\admin\test_cultures\CultureOptions;
use App\language\admin\test_cultures\ExtraService;
use App\language\admin\test_cultures\SampleTypes;
use App\language\admin\action\AppModel;
class TestCulturesController extends Controller
{
    public function index($id){
        $lang = $this->initLanguage($id);
        if($id === 'Categories'){
            return view('admin.test_cultures.categories',[
                'lang'=> $lang,
                'active'=>'TestCultures',
                'activeItem'=>'Categories'
            ]);
        }
        else if($id === 'AllTestCultures' || $id === 'TheCultures' || $id === 'PackagesCultures'){
            return view('admin.test_cultures.all_test_cultures',[
                'lang'=> $lang,
                'active'=>'TestCultures',
                'activeItem'=>$id !== 'AllTestCultures' ? ($id !== 'TheCultures' ? 'PackagesCultures' : 'TheCultures') : 'AllTestCultures',        
            ]);
        }
        else if($id === 'SampleTypes'){
            return view('admin.test_cultures.sample_types',[
                'lang'=> $lang,
                'active'=>'TestCultures',
                'activeItem'=>'SampleTypes'
            ]);
        }
        else if($id === 'CultureOptions'){
            return view('admin.test_cultures.culture_options',[
                'lang'=> $lang,
                'active'=>'TestCultures',
                'activeItem'=>'CultureOptions'
            ]);
        }
        else if($id === 'Antibiotics'){
            return view('admin.test_cultures.antibiotics',[
                'lang'=> $lang,
                'active'=>'TestCultures',
                'activeItem'=>'Antibiotics'
            ]);
        }
        else if($id === 'ExtraService'){
            return view('admin.test_cultures.extra_service',[
                'lang'=> $lang,
                'active'=>'TestCultures',
                'activeItem'=>'ExtraService'
            ]);
        }
        else if($id === 'CurrentOffers'){
            return view('admin.test_cultures.current_offers',[
                'lang'=> $lang,
                'active'=>'TestCultures',
                'activeItem'=>'CurrentOffers'
            ]);
        }else
            abort(404);
    }
    public function createTest($myId){
        if($myId !== 'AllTestCultures' && $myId !== 'TheCultures' && $myId !== 'PackagesCultures')
            return back();
        $lang = $this->initLanguage('Create-Test', Rays::find(request()->session()->get('userId')), $myId);
        request()->validate([
            'name' => ['required', 'min:3'],
            'shortcut' => ['required', 'min:3'],
            'price' => ['required', 'integer'],
            'input-output-lab' => ['required', Rule::in($lang->inputOutPutKeys)],
        ], [
            'name.required' => $lang->error1,
            'name.min' => $lang->error2,
            'shortcut.required' => $lang->error9,
            'shortcut.min' => $lang->error10,
            'price.required' => $lang->error3,
            'price.integer' => $lang->error5,
            'input-output-lab.required' => $lang->error4,
            'input-output-lab.in' => $lang->error6,
        ]);
        $Id = $this->generateUniqueIdentifier();
        $this->getCreateDataBase($myId !== 'AllTestCultures' ? ($myId !== 'TheCultures' ? 'Packages' : 'Cultures') : 'Test',['Name'=>request()->input('name'),
        'Shortcut'=>request()->input('shortcut'), 'Price'=>request()->input('price'),
        'InputOutputLab'=>request()->input('input-output-lab'), 'Id'=>$Id], $Id);
        return back()->with('success', $lang->successfully1);
    }
    public function editTest($myId){
        if($myId !== 'AllTestCultures' && $myId !== 'TheCultures' && $myId !== 'PackagesCultures')
            return back();
        $lang = $this->initLanguage('Edit-Test', Rays::find(request()->session()->get('userId')), $myId);
        $validator = Validator::make(request()->all(),[
            'id' => ['required', Rule::in($lang->size1)],
            'name' => ['required', 'min:3'],
            'shortcut' => ['required', 'min:3'],
            'price' => ['required', 'integer'],
            'input-output-lab' => ['required', Rule::in($lang->inputOutPutKeys)],
        ], [
            'name.required' => $lang->error1,
            'name.min' => $lang->error2,
            'shortcut.required' => $lang->error9,
            'shortcut.min' => $lang->error10,
            'price.required' => $lang->error3,
            'price.integer' => $lang->error5,
            'input-output-lab.required' => $lang->error4,
            'input-output-lab.in' => $lang->error6,
            'id.required'=>$lang->error7,
            'id.in'=>$lang->error8,
        ]);
        if($validator->fails())
            return back()->withErrors($validator);
        else{
            $this->getEditDataBase($myId !== 'AllTestCultures' ? ($myId !== 'TheCultures' ? 'Packages' : 'Cultures') : 'Test', 
            ['Name'=>request()->input('name'), 'Shortcut'=>request()->input('shortcut'),
            'Price'=>request()->input('price'), 'InputOutputLab'=>request()->input('input-output-lab'),
            'Id'=>request()->input('id')]);
            return back()->with('success', $lang->successfully1);
        }
    }
    public function deleteTest($myId){
        if($myId !== 'AllTestCultures' && $myId !== 'TheCultures' && $myId !== 'PackagesCultures')
            return back();
        $lang = $this->initLanguage('Delete-Test', Rays::find(request()->session()->get('userId')), $myId);        
        request()->validate([
            'id' => ['required', Rule::in($lang->size1)],
        ], [
            'id.required'=>$lang->error7,
            'id.in'=>$lang->error8,
        ]);
        $this->getDeleteDatabade($myId !== 'AllTestCultures' ? ($myId !== 'TheCultures' ? 'Packages' : 'Cultures') : 'Test');
        return back()->with('success', $lang->successfully1);
    }
    
    
    public function createCurrentOffers(){
        $lang = $this->initLanguage('Create-Offers', Rays::find(request()->session()->get('userId')));
        request()->validate([
            'name' => ['required', 'min:3'],
            'shortcut' => ['required', 'min:3'],
            'price' => ['required', 'integer'],
            'display-price' => ['required', 'integer'],
            'state' => ['required', Rule::in($lang->inputOutPutKeys)],
        ], [
            'name.required' => $lang->error1,
            'name.min' => $lang->error2,
            'shortcut.required' => $lang->error3,
            'shortcut.min' => $lang->error4,
            'price.required' => $lang->error5,
            'price.integer' => $lang->error8,
            'display-price.required' => $lang->error6,
            'display-price.integer' => $lang->error9,
            'state.required' => $lang->error7,
            'state.in' => $lang->error10,
        ]);
        $Id = $this->generateUniqueIdentifier();
        $this->getCreateDataBase('CurrentOffers', [
        'Name'=>request()->input('name'),
        'Shortcut'=>request()->input('shortcut'),
        'Price'=>request()->input('price'),
        'DisplayPrice'=>request()->input('display-price'),
        'State'=>request()->input('state'),
        'Id'=>$Id], $Id);
        return back()->with('success', $lang->successfully1);
    }
    public function editCurrentOffers(){
        $lang = $this->initLanguage('Edit-Offers', Rays::find(request()->session()->get('userId')));
        $validator = Validator::make(request()->all(),[
            'id' => ['required', Rule::in($lang->size1)],
            'name' => ['required', 'min:3'],
            'shortcut' => ['required', 'min:3'],
            'price' => ['required', 'integer'],
            'display-price' => ['required', 'integer'],
            'state' => ['required', Rule::in($lang->inputOutPutKeys)],
        ], [
            'name.required' => $lang->error1,
            'name.min' => $lang->error2,
            'shortcut.required' => $lang->error3,
            'shortcut.min' => $lang->error4,
            'price.required' => $lang->error5,
            'price.integer' => $lang->error8,
            'display-price.required' => $lang->error6,
            'display-price.integer' => $lang->error9,
            'state.required' => $lang->error7,
            'state.in' => $lang->error10,
            'id.required'=>$lang->error11,
            'id.in'=>$lang->error12,
        ]);
        if ($validator->fails())
            return back()->withErrors($validator);
        else{
            $this->getEditDataBase('CurrentOffers', [
            'Name'=>request()->input('name'),
            'Shortcut'=>request()->input('shortcut'),
            'Price'=>request()->input('price'),
            'DisplayPrice'=>request()->input('display-price'),
            'State'=>request()->input('state'),
            'Id'=>request()->input('id')]);
            return back()->with('success', $lang->successfully1);
        }
    }
    public function deleteCurrentOffers(){
        $lang = $this->initLanguage('Delete-Offers', Rays::find(request()->session()->get('userId')));
        request()->validate([
            'id' => ['required', Rule::in($lang->size1)],
        ], [
            'id.required'=>$lang->error11,
            'id.in'=>$lang->error12,
        ]);
        $this->getDeleteDatabade('CurrentOffers');
        return back()->with('success', $lang->successfully1);
    }
    private function initLanguage($id, $ob = null, $option = null){
        switch ($id) {
            case 'TheCultures':
            case 'PackagesCultures':
            case 'AllTestCultures':
                return new TestView($id);
            case 'CurrentOffers':
                return new OfferView($id);

            case 'Create-Test':
                return new AppModel('option1', $ob[$ob['Setting']['Language']]['Error'], $option, $ob[$ob['Setting']['Language']]['Message'][$option !== 'AllTestCultures' ? ($option !== 'TheCultures' ? 'PackagesAdd' : 'CulturesAdd') : 'TestAdd'], array_keys($ob[$ob['Setting']['Language']]['SelectTestBox']));
            case 'Edit-Test':
                return new AppModel('option2', $ob[$ob['Setting']['Language']]['Error'], $option, $ob[$ob['Setting']['Language']]['Message'][$option !== 'AllTestCultures' ? ($option !== 'TheCultures' ? 'PackagesEdit' : 'CulturesEdit') : 'TestEdit'], array_keys($ob[$ob['Setting']['Language']]['SelectTestBox']), isset($ob[$option !== 'AllTestCultures' ? ($option !== 'TheCultures' ? 'Packages' : 'Cultures') : 'Test']) ? array_keys($ob[$option !== 'AllTestCultures' ? ($option !== 'TheCultures' ? 'Packages' : 'Cultures') : 'Test']) : array());    
            case 'Delete-Test':
                return new AppModel('delete', $ob[$ob['Setting']['Language']]['Error'], $option, $ob[$ob['Setting']['Language']]['Message'][$option !== 'AllTestCultures' ? ($option !== 'TheCultures' ? 'PackagesDelete' : 'CulturesDelete') : 'TestDelete'], isset($ob[$option !== 'AllTestCultures' ? ($option !== 'TheCultures' ? 'Packages' : 'Cultures') : 'Test']) ? array_keys($ob[$option !== 'AllTestCultures' ? ($option !== 'TheCultures' ? 'Packages' : 'Cultures') : 'Test']) : array());

            case 'Create-Offers':
                return new AppModel('option1', $ob[$ob['Setting']['Language']]['Error'], 'CurrentOffers', $ob[$ob['Setting']['Language']]['Message']['CurrentOffersAdd'], array_keys($ob[$ob['Setting']['Language']]['SelectOfferBox']));
            case 'Edit-Offers':
                return new AppModel('option2', $ob[$ob['Setting']['Language']]['Error'], 'CurrentOffers', $ob[$ob['Setting']['Language']]['Message']['CurrentOffersEdit'], array_keys($ob[$ob['Setting']['Language']]['SelectOfferBox']), isset($ob['CurrentOffers']) ? array_keys($ob['CurrentOffers']) : array());    
            case 'Delete-Offers':
                return new AppModel('delete', $ob[$ob['Setting']['Language']]['Error'], 'CurrentOffers', $ob[$ob['Setting']['Language']]['Message']['CurrentOffersDelete'], isset($ob['CurrentOffers']) ? array_keys($ob['CurrentOffers']) : array());        

            case 'Categories':
                return new Categories();
            case 'Antibiotics':
                return new Antibiotics();
            case 'CultureOptions':
                return new CultureOptions();
            case 'ExtraService':
                return new ExtraService();
            case 'SampleTypes':
                return new SampleTypes();
            default :
                return null;
        }
    }
    
}
