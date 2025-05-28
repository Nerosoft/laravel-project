<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rays;
use Illuminate\Validation\Rule;
use App\language\admin\action\AppModel;
use App\Http\interface\LangObject;
use App\language\share\Page;
use Illuminate\Support\Facades\Route;
use App\Menu;
use App\instance\admin\test_cultures\Test;
use App\instance\admin\test_cultures\Packages;
use App\instance\admin\test_cultures\Cultures;
class TestCulturesController extends Page implements LangObject
{
    public function __construct(){
        $ob = Rays::find(request()->session()->get('userId'));
        $this->error1 = $ob[$ob['Setting']['Language']]['Error'][request()->route('id') === 'AllTestCultures'?'TestNameRequired':(request()->route('id') === 'PackagesCultures'?'PackagesNameRequired':'CulturesNameRequired')];
        $this->error2 = $ob[$ob['Setting']['Language']]['Error'][request()->route('id') === 'AllTestCultures'?'TestNameInvalid':(request()->route('id') === 'PackagesCultures'?'PackagesNameInvalid':'CulturesNameInvalid')];
        $this->error9 = $ob[$ob['Setting']['Language']]['Error'][request()->route('id') === 'AllTestCultures'?'TestShortcutRequired':(request()->route('id') === 'PackagesCultures'?'PackagesShortcutRequired':'CulturesShortcutRequired')];
        $this->error10 = $ob[$ob['Setting']['Language']]['Error'][request()->route('id') === 'AllTestCultures'?'TestShortcutInvalid':(request()->route('id') === 'PackagesCultures'?'PackagesShortcutInvalid':'CulturesShortcutInvalid')];
        $this->error3 = $ob[$ob['Setting']['Language']]['Error'][request()->route('id') === 'AllTestCultures'?'TestPriceRequired':(request()->route('id') === 'PackagesCultures'?'PackagesPriceRequired':'CulturesPriceRequired')];
        $this->error4 = $ob[$ob['Setting']['Language']]['Error'][request()->route('id') === 'AllTestCultures'?'TestInputOutputLabRequired':(request()->route('id') === 'PackagesCultures'?'PackagesInputOutputLabRequired':'CulturesInputOutputLabRequired')];
        if(Route::currentRouteName() === 'createTest' && request()->route('id') === 'AllTestCultures'){
            request()->validate([
            'name' => ['required', 'min:3'],
            'shortcut' => ['required', 'min:3'],
            'price' => ['required', 'integer'],
            'input-output-lab' => ['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['SelectTestBox']))],
            ], [
                'name.required' => $this->error1,
                'name.min' => $this->error2,
                'shortcut.required' =>$this->error9,
                'shortcut.min' => $this->error10,
                'price.required' => $this->error3,
                'price.integer' => $ob[$ob['Setting']['Language']]['Error']['TestPriceInvalid'],
                'input-output-lab.required' => $this->error4,
                'input-output-lab.in' => $ob[$ob['Setting']['Language']]['Error']['TestInputOutputLabInvalid'],
            ]);
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Message']['TestAdd'];
            $this->myDbId = $this->generateUniqueIdentifier();
            $this->getCreateDataBase($ob, 'Test', $this->myDbId, $this);
        }else if(Route::currentRouteName() === 'editTest' && request()->route('id') === 'AllTestCultures'){
            request()->validate([
            'id' => ['required', Rule::in(isset($ob['Test'])?array_keys($ob['Test']):null)],
            'name' => ['required', 'min:3'],
            'shortcut' => ['required', 'min:3'],
            'price' => ['required', 'integer'],
            'input-output-lab' => ['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['SelectTestBox']))],
            ], [
                'name.required' => $this->error1,
                'name.min' => $this->error2,
                'shortcut.required' =>$this->error9,
                'shortcut.min' => $this->error10,
                'price.required' => $this->error3,
                'price.integer' => $ob[$ob['Setting']['Language']]['Error']['TestPriceInvalid'],
                'input-output-lab.required' => $this->error4,
                'input-output-lab.in' => $ob[$ob['Setting']['Language']]['Error']['TestInputOutputLabInvalid'],
                'id.required'=> $ob[$ob['Setting']['Language']]['Error']['TestIdRequired'],
                'id.in'=> $ob[$ob['Setting']['Language']]['Error']['TestIdInvalid'],
            ]);
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Message']['TestEdit'];
            $this->getEditDataBase($ob, 'Test', $this);
        }else if(Route::currentRouteName() === 'createTest' && request()->route('id') === 'PackagesCultures'){
            request()->validate([
            'name' => ['required', 'min:3'],
            'shortcut' => ['required', 'min:3'],
            'price' => ['required', 'integer'],
            'input-output-lab' => ['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['SelectTestBox']))],
            ], [
                'name.required' => $this->error1,
                'name.min' => $this->error2,
                'shortcut.required' =>$this->error9,
                'shortcut.min' => $this->error10,
                'price.required' => $this->error3,
                'price.integer' => $ob[$ob['Setting']['Language']]['Error']['PackagesPriceInvalid'],
                'input-output-lab.required' => $this->error4,
                'input-output-lab.in' => $ob[$ob['Setting']['Language']]['Error']['PackagesInputOutputLabInvalid'],
            ]);
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Message']['PackagesAdd'];
            $this->myDbId = $this->generateUniqueIdentifier();
            $this->getCreateDataBase($ob, 'Packages', $this->myDbId, $this);
        }else if(Route::currentRouteName() === 'editTest' && request()->route('id') === 'PackagesCultures'){
            request()->validate([
            'id' => ['required', Rule::in(isset($ob['Packages'])?array_keys($ob['Packages']):null)],
            'name' => ['required', 'min:3'],
            'shortcut' => ['required', 'min:3'],
            'price' => ['required', 'integer'],
            'input-output-lab' => ['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['SelectTestBox']))],
            ], [
                'name.required' => $this->error1,
                'name.min' => $this->error2,
                'shortcut.required' =>$this->error9,
                'shortcut.min' => $this->error10,
                'price.required' => $this->error3,
                'price.integer' => $ob[$ob['Setting']['Language']]['Error']['PackagesPriceInvalid'],
                'input-output-lab.required' => $this->error4,
                'input-output-lab.in' => $ob[$ob['Setting']['Language']]['Error']['PackagesInputOutputLabInvalid'],
                'id.required'=> $ob[$ob['Setting']['Language']]['Error']['PackagesIdRequired'],
                'id.in'=> $ob[$ob['Setting']['Language']]['Error']['PackagesIdInvalid'],
            ]);
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Message']['PackagesEdit'];
            $this->getEditDataBase($ob, 'Packages', $this);
        }else if(Route::currentRouteName() === 'createTest' && request()->route('id') === 'TheCultures'){
            request()->validate([
            'name' => ['required', 'min:3'],
            'shortcut' => ['required', 'min:3'],
            'price' => ['required', 'integer'],
            'input-output-lab' => ['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['SelectTestBox']))],
            ], [
                'name.required' => $this->error1,
                'name.min' => $this->error2,
                'shortcut.required' =>$this->error9,
                'shortcut.min' => $this->error10,
                'price.required' => $this->error3,
                'price.integer' => $ob[$ob['Setting']['Language']]['Error']['CulturesPriceInvalid'],
                'input-output-lab.required' => $this->error4,
                'input-output-lab.in' => $ob[$ob['Setting']['Language']]['Error']['CulturesInputOutputLabInvalid'],
            ]);
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Message']['CulturesAdd'];
            $this->myDbId = $this->generateUniqueIdentifier();
            $this->getCreateDataBase($ob, 'Cultures', $this->myDbId, $this);
        }else if(Route::currentRouteName() === 'editTest' && request()->route('id') === 'TheCultures'){
            request()->validate([
            'id' => ['required', Rule::in(isset($ob['Cultures'])?array_keys($ob['Cultures']):null)],
            'name' => ['required', 'min:3'],
            'shortcut' => ['required', 'min:3'],
            'price' => ['required', 'integer'],
            'input-output-lab' => ['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['SelectTestBox']))],
            ], [
                'name.required' => $this->error1,
                'name.min' => $this->error2,
                'shortcut.required' =>$this->error9,
                'shortcut.min' => $this->error10,
                'price.required' => $this->error3,
                'price.integer' => $ob[$ob['Setting']['Language']]['Error']['CulturesPriceInvalid'],
                'input-output-lab.required' => $this->error4,
                'input-output-lab.in' => $ob[$ob['Setting']['Language']]['Error']['CulturesInputOutputLabInvalid'],
                'id.required'=> $ob[$ob['Setting']['Language']]['Error']['CulturesIdRequired'],
                'id.in'=> $ob[$ob['Setting']['Language']]['Error']['CulturesIdInvalid'],
            ]);
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Message']['CulturesEdit'];
            $this->getEditDataBase($ob, 'Cultures', $this);
        }else if(Route::currentRouteName() === 'TestCultures' && request()->route('id') === 'AllTestCultures'){
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['Title']['DeleteTest'], 
            $ob[$ob['Setting']['Language']]['Label']['DeleteTest'], 
            $ob[$ob['Setting']['Language']]['Button']['DeleteTest'], 
            route('deleteItem', 'Test'), 
            $ob[$ob['Setting']['Language']]['TableInfo'], 
            $ob[$ob['Setting']['Language']]['Title']['AllTestCultures'], 
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'], 
            $ob[$ob['Setting']['Language']]['Html']['Direction'], 
            $ob['Branch']?$ob['Branch']:Rays::find(request()->session()->get('userLogout'))['Branch'], 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Title']['CreateTest'],
            $ob[$ob['Setting']['Language']]['Title']['EditTest'],
            $ob[$ob['Setting']['Language']]['Button']['CreateTest'],
            $ob[$ob['Setting']['Language']]['Button']['AddTest'],
            $ob[$ob['Setting']['Language']]['Button']['EditTest'],
            $ob[$ob['Setting']['Language']]['Table']['TestId'],
            $ob[$ob['Setting']['Language']]['Table']['TestEdit']);
            $this->table8 = $ob[$this->language]['Table']['TestName'];
            $this->table9 = $ob[$this->language]['Table']['TestPrice'];
            $this->table10 = $ob[$this->language]['Table']['TestInputOutput'];
            $this->table12 = $ob[$this->language]['Table']['TestShortcut'];
            $this->label3 = $ob[$this->language]['Label']['TestName'];
            $this->label4 = $ob[$this->language]['Label']['TestPrice'];
            $this->label5 = $ob[$this->language]['Label']['TestInputOutLab'];
            $this->label7 = $ob[$this->language]['Label']['TestShortcut'];
            $this->inputOutPut = $ob[$this->language]['SelectTestBox'];
            $this->selectBox1 = $ob[$this->language]['SelectBox']['TestInputOutLab'];
            $this->hint1 = $ob[$this->language]['Hint']['TestName'];
            $this->hint2 = $ob[$this->language]['Hint']['TestPrice'];
            $this->hint3 = $ob[$this->language]['Hint']['TestShortcut'];
            $this->arr1 = isset($ob['Test']) ? Test::fromArray($ob['Test'], $ob[$ob['Setting']['Language']]['SelectTestBox']) : array();
        }else if(Route::currentRouteName() === 'TestCultures' && request()->route('id') === 'PackagesCultures'){
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['Title']['DeletePackages'], 
            $ob[$ob['Setting']['Language']]['Label']['DeletePackages'], 
            $ob[$ob['Setting']['Language']]['Button']['DeletePackages'], 
            route('deleteItem', 'Packages'), 
            $ob[$ob['Setting']['Language']]['TableInfo'], 
            $ob[$ob['Setting']['Language']]['Title']['PackagesCultures'], 
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'], 
            $ob[$ob['Setting']['Language']]['Html']['Direction'], 
            $ob['Branch']?$ob['Branch']:Rays::find(request()->session()->get('userLogout'))['Branch'], 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Title']['CreatePackages'],
            $ob[$ob['Setting']['Language']]['Title']['EditPackages'],
            $ob[$ob['Setting']['Language']]['Button']['CreatePackages'],
            $ob[$ob['Setting']['Language']]['Button']['AddPackages'],
            $ob[$ob['Setting']['Language']]['Button']['EditPackages'],
            $ob[$ob['Setting']['Language']]['Table']['PackagesId'],
            $ob[$ob['Setting']['Language']]['Table']['PackagesEdit']);
            $this->table8 = $ob[$this->language]['Table']['PackagesName'];
            $this->table9 = $ob[$this->language]['Table']['PackagesPrice'];
            $this->table10 = $ob[$this->language]['Table']['PackagesInputOutput'];
            $this->table12 = $ob[$this->language]['Table']['PackagesShortcut'];
            $this->label3 = $ob[$this->language]['Label']['PackagesName'];
            $this->label4 = $ob[$this->language]['Label']['PackagesPrice'];
            $this->label5 = $ob[$this->language]['Label']['PackagesInputOutLab'];
            $this->label7 = $ob[$this->language]['Label']['PackagesShortcut'];
            $this->inputOutPut = $ob[$this->language]['SelectTestBox'];
            $this->selectBox1 = $ob[$this->language]['SelectBox']['TestInputOutLab'];
            $this->hint1 = $ob[$this->language]['Hint']['PackagesName'];
            $this->hint2 = $ob[$this->language]['Hint']['PackagesPrice'];
            $this->hint3 = $ob[$this->language]['Hint']['PackagesShortcut'];
            $this->arr1 = isset($ob['Packages']) ? Packages::fromArray($ob['Packages'], $ob[$ob['Setting']['Language']]['SelectTestBox']) : array();
        }else //if(Route::currentRouteName() === 'TestCultures' && request()->route('id') === 'TheCultures')
        {
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['Title']['DeleteCultures'], 
            $ob[$ob['Setting']['Language']]['Label']['DeleteCultures'], 
            $ob[$ob['Setting']['Language']]['Button']['DeleteCultures'], 
            route('deleteItem', 'Cultures'), 
            $ob[$ob['Setting']['Language']]['TableInfo'], 
            $ob[$ob['Setting']['Language']]['Title']['TheCultures'], 
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'], 
            $ob[$ob['Setting']['Language']]['Html']['Direction'], 
            $ob['Branch']?$ob['Branch']:Rays::find(request()->session()->get('userLogout'))['Branch'], 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Title']['CreateCultures'],
            $ob[$ob['Setting']['Language']]['Title']['EditCultures'],
            $ob[$ob['Setting']['Language']]['Button']['CreateCultures'],
            $ob[$ob['Setting']['Language']]['Button']['AddCultures'],
            $ob[$ob['Setting']['Language']]['Button']['EditCultures'],
            $ob[$ob['Setting']['Language']]['Table']['CulturesId'],
            $ob[$ob['Setting']['Language']]['Table']['CulturesEdit']);
            $this->table8 = $ob[$this->language]['Table']['CulturesName'];
            $this->table9 = $ob[$this->language]['Table']['CulturesPrice'];
            $this->table10 = $ob[$this->language]['Table']['CulturesInputOutput'];
            $this->table12 = $ob[$this->language]['Table']['CulturesShortcut'];
            $this->label3 = $ob[$this->language]['Label']['CulturesName'];
            $this->label4 = $ob[$this->language]['Label']['CulturesPrice'];
            $this->label5 = $ob[$this->language]['Label']['CulturesInputOutLab'];
            $this->label7 = $ob[$this->language]['Label']['CulturesShortcut'];
            $this->inputOutPut = $ob[$this->language]['SelectTestBox'];
            $this->selectBox1 = $ob[$this->language]['SelectBox']['TestInputOutLab'];
            $this->hint1 = $ob[$this->language]['Hint']['CulturesName'];
            $this->hint2 = $ob[$this->language]['Hint']['CulturesPrice'];
            $this->hint3 = $ob[$this->language]['Hint']['CulturesShortcut'];
            $this->arr1 = isset($ob['Cultures']) ? Cultures::fromArray($ob['Cultures'], $ob[$ob['Setting']['Language']]['SelectTestBox']) : array();
        }
    }
    public function index($id){
        return view('admin.test_cultures.all_test_cultures',[
                'lang'=> $this,
                'logOut'=>route('admin.logout'),
                'active'=>'TestCultures',
                'activeItem'=>$id,        
        ]);
    }
    public function action($myId = null){
        return isset($this->successfully1)?back()->with('success', $this->successfully1):back();
    }
    public function getMyObject(){
        return array('Name'=>request()->input('name'), 'Shortcut'=>request()->input('shortcut'), 'Price'=>request()->input('price'), 'InputOutputLab'=>request()->input('input-output-lab'), 'Id'=>isset($this->myDbId) ? $this->myDbId : request()->input('id'));
    }
}
