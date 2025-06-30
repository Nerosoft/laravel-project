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
        $this->error1 = $ob[$ob['Setting']['Language']][request()->route('id') === 'AllTestCultures'?'Test':(request()->route('id') === 'PackagesCultures'?'Packages':'Cultures')][request()->route('id') === 'AllTestCultures'?'TestNameRequired':(request()->route('id') === 'PackagesCultures'?'PackagesNameRequired':'CulturesNameRequired')];
        $this->error2 = $ob[$ob['Setting']['Language']][request()->route('id') === 'AllTestCultures'?'Test':(request()->route('id') === 'PackagesCultures'?'Packages':'Cultures')][request()->route('id') === 'AllTestCultures'?'TestNameInvalid':(request()->route('id') === 'PackagesCultures'?'PackagesNameInvalid':'CulturesNameInvalid')];
        $this->error9 = $ob[$ob['Setting']['Language']][request()->route('id') === 'AllTestCultures'?'Test':(request()->route('id') === 'PackagesCultures'?'Packages':'Cultures')][request()->route('id') === 'AllTestCultures'?'TestShortcutRequired':(request()->route('id') === 'PackagesCultures'?'PackagesShortcutRequired':'CulturesShortcutRequired')];
        $this->error10 = $ob[$ob['Setting']['Language']][request()->route('id') === 'AllTestCultures'?'Test':(request()->route('id') === 'PackagesCultures'?'Packages':'Cultures')][request()->route('id') === 'AllTestCultures'?'TestShortcutInvalid':(request()->route('id') === 'PackagesCultures'?'PackagesShortcutInvalid':'CulturesShortcutInvalid')];
        $this->error3 = $ob[$ob['Setting']['Language']][request()->route('id') === 'AllTestCultures'?'Test':(request()->route('id') === 'PackagesCultures'?'Packages':'Cultures')][request()->route('id') === 'AllTestCultures'?'TestPriceRequired':(request()->route('id') === 'PackagesCultures'?'PackagesPriceRequired':'CulturesPriceRequired')];
        $this->error4 = $ob[$ob['Setting']['Language']][request()->route('id') === 'AllTestCultures'?'Test':(request()->route('id') === 'PackagesCultures'?'Packages':'Cultures')][request()->route('id') === 'AllTestCultures'?'TestInputOutputLabRequired':(request()->route('id') === 'PackagesCultures'?'PackagesInputOutputLabRequired':'CulturesInputOutputLabRequired')];
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
                'price.integer' => $ob[$ob['Setting']['Language']]['Test']['TestPriceInvalid'],
                'input-output-lab.required' => $this->error4,
                'input-output-lab.in' => $ob[$ob['Setting']['Language']]['Test']['TestInputOutputLabInvalid'],
            ]);
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Test']['TestAdd'];
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
                'price.integer' => $ob[$ob['Setting']['Language']]['Test']['TestPriceInvalid'],
                'input-output-lab.required' => $this->error4,
                'input-output-lab.in' => $ob[$ob['Setting']['Language']]['Test']['TestInputOutputLabInvalid'],
                'id.required'=> $ob[$ob['Setting']['Language']]['Test']['TestIdRequired'],
                'id.in'=> $ob[$ob['Setting']['Language']]['Test']['TestIdInvalid'],
            ]);
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Test']['TestEdit'];
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
                'price.integer' => $ob[$ob['Setting']['Language']]['Packages']['PackagesPriceInvalid'],
                'input-output-lab.required' => $this->error4,
                'input-output-lab.in' => $ob[$ob['Setting']['Language']]['Packages']['PackagesInputOutputLabInvalid'],
            ]);
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Packages']['PackagesAdd'];
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
                'price.integer' => $ob[$ob['Setting']['Language']]['Packages']['PackagesPriceInvalid'],
                'input-output-lab.required' => $this->error4,
                'input-output-lab.in' => $ob[$ob['Setting']['Language']]['Packages']['PackagesInputOutputLabInvalid'],
                'id.required'=> $ob[$ob['Setting']['Language']]['Packages']['PackagesIdRequired'],
                'id.in'=> $ob[$ob['Setting']['Language']]['Packages']['PackagesIdInvalid'],
            ]);
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Packages']['PackagesEdit'];
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
                'price.integer' => $ob[$ob['Setting']['Language']]['Cultures']['CulturesPriceInvalid'],
                'input-output-lab.required' => $this->error4,
                'input-output-lab.in' => $ob[$ob['Setting']['Language']]['Cultures']['CulturesInputOutputLabInvalid'],
            ]);
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Cultures']['CulturesAdd'];
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
                'price.integer' => $ob[$ob['Setting']['Language']]['Cultures']['CulturesPriceInvalid'],
                'input-output-lab.required' => $this->error4,
                'input-output-lab.in' => $ob[$ob['Setting']['Language']]['Cultures']['CulturesInputOutputLabInvalid'],
                'id.required'=> $ob[$ob['Setting']['Language']]['Cultures']['CulturesIdRequired'],
                'id.in'=> $ob[$ob['Setting']['Language']]['Cultures']['CulturesIdInvalid'],
            ]);
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Cultures']['CulturesEdit'];
            $this->getEditDataBase($ob, 'Cultures', $this);
        }else if(request()->route('id') === 'AllTestCultures'){
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['Test']['TitleDeleteTest'], 
            $ob[$ob['Setting']['Language']]['Test']['LabelDeleteTest'], 
            $ob[$ob['Setting']['Language']]['Test']['ButtonDeleteTest'], 
            route('deleteItem', 'Test'), 
            $ob[$ob['Setting']['Language']]['TableInfo'], 
            $ob[$ob['Setting']['Language']]['Test']['Test'], 
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'], 
            $ob[$ob['Setting']['Language']]['Html']['Direction'], 
            $ob['Branch']?$ob['Branch']:Rays::find(request()->session()->get('userLogout'))['Branch'], 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Test']['TitleCreateTest'],
            $ob[$ob['Setting']['Language']]['Test']['TitleEditTest'],
            $ob[$ob['Setting']['Language']]['Test']['ButtonCreateTest'],
            $ob[$ob['Setting']['Language']]['Test']['ButtonAddTest'],
            $ob[$ob['Setting']['Language']]['Test']['ButtonEditTest'],
            $ob[$ob['Setting']['Language']]['Test']['TableTestId'],
            $ob[$ob['Setting']['Language']]['Test']['TableTestEdit']);
            $this->table8 = $ob[$this->language]['Test']['TableTestName'];
            $this->table9 = $ob[$this->language]['Test']['TableTestPrice'];
            $this->table10 = $ob[$this->language]['Test']['TableTestInputOutput'];
            $this->table12 = $ob[$this->language]['Test']['TableTestShortcut'];
            $this->label3 = $ob[$this->language]['Test']['LabelTestName'];
            $this->label4 = $ob[$this->language]['Test']['LabelTestPrice'];
            $this->label5 = $ob[$this->language]['Test']['LabelTestInputOutLab'];
            $this->label7 = $ob[$this->language]['Test']['LabelTestShortcut'];
            $this->inputOutPut = $ob[$this->language]['SelectTestBox'];
            $this->selectBox1 = $ob[$this->language]['Test']['TestInputOutLab'];
            $this->hint1 = $ob[$this->language]['Test']['HintTestName'];
            $this->hint2 = $ob[$this->language]['Test']['HintTestPrice'];
            $this->hint3 = $ob[$this->language]['Test']['HintTestShortcut'];
            $this->arr1 = isset($ob['Test']) ? Test::fromArray($ob['Test'], $ob[$ob['Setting']['Language']]['SelectTestBox']) : array();
        }else if(request()->route('id') === 'PackagesCultures'){
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['Packages']['TitleDeletePackages'], 
            $ob[$ob['Setting']['Language']]['Packages']['LabelDeletePackages'], 
            $ob[$ob['Setting']['Language']]['Packages']['ButtonDeletePackages'], 
            route('deleteItem', 'Packages'), 
            $ob[$ob['Setting']['Language']]['TableInfo'], 
            $ob[$ob['Setting']['Language']]['Packages']['Packages'], 
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'], 
            $ob[$ob['Setting']['Language']]['Html']['Direction'], 
            $ob['Branch']?$ob['Branch']:Rays::find(request()->session()->get('userLogout'))['Branch'], 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Packages']['TitleCreatePackages'],
            $ob[$ob['Setting']['Language']]['Packages']['TitleEditPackages'],
            $ob[$ob['Setting']['Language']]['Packages']['ButtonCreatePackages'],
            $ob[$ob['Setting']['Language']]['Packages']['ButtonAddPackages'],
            $ob[$ob['Setting']['Language']]['Packages']['ButtonEditPackages'],
            $ob[$ob['Setting']['Language']]['Packages']['TablePackagesId'],
            $ob[$ob['Setting']['Language']]['Packages']['TablePackagesEdit']);
            $this->table8 = $ob[$this->language]['Packages']['TablePackagesName'];
            $this->table9 = $ob[$this->language]['Packages']['TablePackagesPrice'];
            $this->table10 = $ob[$this->language]['Packages']['TablePackagesInputOutput'];
            $this->table12 = $ob[$this->language]['Packages']['TablePackagesShortcut'];
            $this->label3 = $ob[$this->language]['Packages']['LabelPackagesName'];
            $this->label4 = $ob[$this->language]['Packages']['LabelPackagesPrice'];
            $this->label5 = $ob[$this->language]['Packages']['LabelPackagesInputOutLab'];
            $this->label7 = $ob[$this->language]['Packages']['LabelPackagesShortcut'];
            $this->inputOutPut = $ob[$this->language]['SelectTestBox'];
            $this->selectBox1 = $ob[$this->language]['Packages']['PackagesInputOutLab'];
            $this->hint1 = $ob[$this->language]['Packages']['HintPackagesName'];
            $this->hint2 = $ob[$this->language]['Packages']['HintPackagesPrice'];
            $this->hint3 = $ob[$this->language]['Packages']['HintPackagesShortcut'];
            $this->arr1 = isset($ob['Packages']) ? Packages::fromArray($ob['Packages'], $ob[$ob['Setting']['Language']]['SelectTestBox']) : array();
        }else //if(Route::currentRouteName() === 'TestCultures' && request()->route('id') === 'TheCultures')
        {
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['Cultures']['TitleDeleteCultures'], 
            $ob[$ob['Setting']['Language']]['Cultures']['LabelDeleteCultures'], 
            $ob[$ob['Setting']['Language']]['Cultures']['ButtonDeleteCultures'], 
            route('deleteItem', 'Cultures'), 
            $ob[$ob['Setting']['Language']]['TableInfo'], 
            $ob[$ob['Setting']['Language']]['Cultures']['Cultures'], 
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'], 
            $ob[$ob['Setting']['Language']]['Html']['Direction'], 
            $ob['Branch']?$ob['Branch']:Rays::find(request()->session()->get('userLogout'))['Branch'], 
            new Menu($ob[$ob['Setting']['Language']]['Menu']),
            $ob[$ob['Setting']['Language']]['Cultures']['TitleCreateCultures'],
            $ob[$ob['Setting']['Language']]['Cultures']['TitleEditCultures'],
            $ob[$ob['Setting']['Language']]['Cultures']['ButtonCreateCultures'],
            $ob[$ob['Setting']['Language']]['Cultures']['ButtonAddCultures'],
            $ob[$ob['Setting']['Language']]['Cultures']['ButtonEditCultures'],
            $ob[$ob['Setting']['Language']]['Cultures']['TableCulturesId'],
            $ob[$ob['Setting']['Language']]['Cultures']['TableCulturesEdit']);
            $this->table8 = $ob[$this->language]['Cultures']['TableCulturesName'];
            $this->table9 = $ob[$this->language]['Cultures']['TableCulturesPrice'];
            $this->table10 = $ob[$this->language]['Cultures']['TableCulturesInputOutput'];
            $this->table12 = $ob[$this->language]['Cultures']['TableCulturesShortcut'];
            $this->label3 = $ob[$this->language]['Cultures']['LabelCulturesName'];
            $this->label4 = $ob[$this->language]['Cultures']['LabelCulturesPrice'];
            $this->label5 = $ob[$this->language]['Cultures']['LabelCulturesInputOutLab'];
            $this->label7 = $ob[$this->language]['Cultures']['LabelCulturesShortcut'];
            $this->inputOutPut = $ob[$this->language]['SelectTestBox'];
            $this->selectBox1 = $ob[$this->language]['Cultures']['CulturesInputOutLab'];
            $this->hint1 = $ob[$this->language]['Cultures']['HintCulturesName'];
            $this->hint2 = $ob[$this->language]['Cultures']['HintCulturesPrice'];
            $this->hint3 = $ob[$this->language]['Cultures']['HintCulturesShortcut'];
            $this->arr1 = isset($ob['Cultures']) ? Cultures::fromArray($ob['Cultures'], $ob[$ob['Setting']['Language']]['SelectTestBox']) : array();
        }
    }
    public function index($id){
        return view('admin.test_cultures.all_test_cultures',[
                'lang'=> $this,
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
