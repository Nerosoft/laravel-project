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
            $view = view('admin.test_cultures.categories',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'AllTestCultures'){
            $view = view('admin.test_cultures.all_test_cultures',[
                'lang'=> $lang,             
            ]);
        }
        else if($id === 'SampleTypes'){
            $view = view('admin.test_cultures.sample_types',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'TheCultures'){
            $view = view('admin.test_cultures.the_cultures',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'CultureOptions'){
            $view = view('admin.test_cultures.culture_options',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'Antibiotics'){
            $view = view('admin.test_cultures.antibiotics',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'PackagesCultures'){
            $view = view('admin.test_cultures.packages_cultures',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'ExtraService'){
            $view = view('admin.test_cultures.extra_service',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'CurrentOffers'){
            $view = view('admin.test_cultures.current_offers',[
                'lang'=> $lang,
            ]);
        }else
            abort(404);
        $lang->myMenuApp['TestCultures']['active'] = 'my_active';
        $lang->myMenuApp['TestCultures']['items'][$id]['active'] = 'my_active';
        return $view;
    }
    public function createTest(){
        $lang = $this->initLanguage('Create-Test', Rays::find(request()->session()->get('userId')));
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
        $this->getCreateDataBase('Test',['Name'=>request()->input('name'),
        'Shortcut'=>request()->input('shortcut'), 'Price'=>request()->input('price'),
        'InputOutputLab'=>request()->input('input-output-lab'), 'Id'=>$Id], $Id);
        return back()->with('success', $lang->successfully1);
    }
    public function editTest(){
        $lang = $this->initLanguage('Edit-Test', Rays::find(request()->session()->get('userId')));
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
        if ($validator->fails())
            return back()->withErrors($validator);
        else{
            $this->getEditDataBase('Test', 
            ['Name'=>request()->input('name'), 'Shortcut'=>request()->input('shortcut'),
            'Price'=>request()->input('price'), 'InputOutputLab'=>request()->input('input-output-lab'),
            'Id'=>request()->input('id')]);
            return back()->with('success', $lang->successfully1);
        }
    }
    public function deleteTest(){
        $lang = $this->initLanguage('Delete-Test', Rays::find(request()->session()->get('userId')));        
        // $lang = new TestDelete('Test');
        request()->validate([
            'id' => ['required', Rule::in($lang->size1)],
        ], [
            'id.required'=>$lang->error7,
            'id.in'=>$lang->error8,
        ]);
        $this->getDeleteDatabade('Test');
        return back()->with('success', $lang->successfully1);
    }
    
    public function createCultures(){
        $lang = $this->initLanguage('Create-Cultures', Rays::find(request()->session()->get('userId')));
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
        $this->getCreateDataBase('Cultures', [
        'Name'=>request()->input('name'),
        'Shortcut'=>request()->input('shortcut'),
        'Price'=>request()->input('price'),
        'InputOutputLab'=>request()->input('input-output-lab'),
        'Id'=>$Id], $Id);
        return back()->with('success', $lang->successfully1);
    }
    public function editCultures(){
        $lang = $this->initLanguage('Edit-Cultures', Rays::find(request()->session()->get('userId')));
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
        if ($validator->fails())
            return back()->withErrors($validator);
        else{
            $this->getEditDataBase('Cultures', [
            'Name'=>request()->input('name'),
            'Shortcut'=>request()->input('shortcut'),
            'Price'=>request()->input('price'),
            'InputOutputLab'=>request()->input('input-output-lab'),
            'Id'=>request()->input('id')]);
            return back()->with('success', $lang->successfully1);
        }
    }
    public function deleteCultures(){
        $lang = $this->initLanguage('Delete-Cultures', Rays::find(request()->session()->get('userId')));
        request()->validate([
            'id' => ['required', Rule::in($lang->size1)],
        ], [
            'id.required'=>$lang->error7,
            'id.in'=>$lang->error8,
        ]);
        $this->getDeleteDatabade('Cultures');
        return back()->with('success', $lang->successfully1);
    }
    
    public function createPackages(){
        $lang = $this->initLanguage('Create-Packages', Rays::find(request()->session()->get('userId')));
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
        $this->getCreateDataBase('Packages', [
        'Name'=>request()->input('name'),
        'Shortcut'=>request()->input('shortcut'),
        'Price'=>request()->input('price'),
        'InputOutputLab'=>request()->input('input-output-lab'),
        'Id'=>$Id], $Id);
        return back()->with('success', $lang->successfully1);
    }
    public function editPackages(){
        $lang = $this->initLanguage('Edit-Packages', Rays::find(request()->session()->get('userId')));
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
        if ($validator->fails())
            return back()->withErrors($validator);
        else{
            $this->getEditDataBase('Packages', [
            'Name'=>request()->input('name'),
            'Shortcut'=>request()->input('shortcut'),
            'Price'=>request()->input('price'),
            'InputOutputLab'=>request()->input('input-output-lab'),
            'Id'=>request()->input('id')]);
            return back()->with('success', $lang->successfully1);
        }
    }
    public function deletePackages(){
        $lang = $this->initLanguage('Delete-Packages', Rays::find(request()->session()->get('userId')));
        request()->validate([
            'id' => ['required', Rule::in($lang->size1)],
        ], [
            'id.required'=>$lang->error7,
            'id.in'=>$lang->error8,
        ]);
        $this->getDeleteDatabade('Packages');
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
    private function initLanguage($id, $ob = null){
        switch ($id) {
            case 'CurrentOffers':
            case 'TheCultures':
            case 'PackagesCultures':
            case 'AllTestCultures':
                return $id !== 'CurrentOffers' ? new TestView($id) : new OfferView($id);

            case 'Create-Test':
                return new AppModel('option1', $ob[$ob['Setting']['Language']]['Error'], 'AllTestCultures', $ob[$ob['Setting']['Language']]['Message']['TestAdd'], array_keys($ob[$ob['Setting']['Language']]['SelectTestBox']));
            case 'Edit-Test':
                return new AppModel('option2', $ob[$ob['Setting']['Language']]['Error'], 'AllTestCultures', $ob[$ob['Setting']['Language']]['Message']['TestEdit'], array_keys($ob[$ob['Setting']['Language']]['SelectTestBox']), isset($ob['Test']) ? array_keys($ob['Test']) : array());    
            case 'Delete-Test':
                return new AppModel('delete', $ob[$ob['Setting']['Language']]['Error'], 'AllTestCultures', $ob[$ob['Setting']['Language']]['Message']['TestDelete'], isset($ob['Test']) ? array_keys($ob['Test']) : array());

            case 'Create-Packages':
                return new AppModel('option1', $ob[$ob['Setting']['Language']]['Error'], 'PackagesCultures', $ob[$ob['Setting']['Language']]['Message']['PackagesAdd'], array_keys($ob[$ob['Setting']['Language']]['SelectTestBox']));
            case 'Edit-Packages':
                return new AppModel('option2', $ob[$ob['Setting']['Language']]['Error'], 'PackagesCultures', $ob[$ob['Setting']['Language']]['Message']['PackagesEdit'], array_keys($ob[$ob['Setting']['Language']]['SelectTestBox']), isset($ob['Packages']) ? array_keys($ob['Packages']) : array());    
            case 'Delete-Packages':
                return new AppModel('delete', $ob[$ob['Setting']['Language']]['Error'], 'PackagesCultures', $ob[$ob['Setting']['Language']]['Message']['PackagesDelete'], isset($ob['Packages']) ? array_keys($ob['Packages']) : array());
            
            case 'Create-Cultures':
                return new AppModel('option1', $ob[$ob['Setting']['Language']]['Error'], 'TheCultures', $ob[$ob['Setting']['Language']]['Message']['CulturesAdd'], array_keys($ob[$ob['Setting']['Language']]['SelectTestBox']));
            case 'Edit-Cultures':
                return new AppModel('option2', $ob[$ob['Setting']['Language']]['Error'], 'TheCultures', $ob[$ob['Setting']['Language']]['Message']['CulturesEdit'], array_keys($ob[$ob['Setting']['Language']]['SelectTestBox']), isset($ob['Cultures']) ? array_keys($ob['Cultures']) : array());    
            case 'Delete-Cultures':
                return new AppModel('delete', $ob[$ob['Setting']['Language']]['Error'], 'TheCultures', $ob[$ob['Setting']['Language']]['Message']['CulturesDelete'], isset($ob['Cultures']) ? array_keys($ob['Cultures']) : array());        

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
