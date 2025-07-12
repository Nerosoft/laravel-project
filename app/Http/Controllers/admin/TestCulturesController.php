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
use App\instance\admin\Branch;

class TestCulturesController extends Page implements LangObject
{
    public function __construct(){
        $ob = Rays::find(request()->session()->get('userId'));
        $this->error1 = $ob[$ob['Setting']['Language']][request()->route('id')]['NameRequired'];
        $this->error2 = $ob[$ob['Setting']['Language']][request()->route('id')]['NameInvalid'];
        $this->error9 = $ob[$ob['Setting']['Language']][request()->route('id')]['ShortcutRequired'];
        $this->error10 = $ob[$ob['Setting']['Language']][request()->route('id')]['ShortcutInvalid'];
        $this->error3 = $ob[$ob['Setting']['Language']][request()->route('id')]['PriceRequired'];
        $this->error4 = $ob[$ob['Setting']['Language']][request()->route('id')]['InputOutputLabRequired'];
        if(Route::currentRouteName() === 'createTest'){
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
                'price.integer' => $ob[$ob['Setting']['Language']][request()->route('id')]['PriceInvalid'],
                'input-output-lab.required' => $this->error4,
                'input-output-lab.in' => $ob[$ob['Setting']['Language']][request()->route('id')]['InputOutputLabInvalid'],
            ]);
            $this->successfully1 = $ob[$ob['Setting']['Language']][request()->route('id')]['Add'];
            $this->myDbId = $this->generateUniqueIdentifier();
            $this->getCreateDataBase($ob, request()->route('id'), $this->myDbId, $this);
            
        }else if(Route::currentRouteName() === 'editTest' && $ob[request()->route('id')]){
            request()->validate([
            'id' => ['required', Rule::in(array_keys($ob[request()->route('id')]))],
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
                'price.integer' => $ob[$ob['Setting']['Language']][request()->route('id')]['PriceInvalid'],
                'input-output-lab.required' => $this->error4,
                'input-output-lab.in' => $ob[$ob['Setting']['Language']][request()->route('id')]['InputOutputLabInvalid'],
                'id.required'=> $ob[$ob['Setting']['Language']][request()->route('id')]['IdIsReq'],
                'id.in'=> $ob[$ob['Setting']['Language']][request()->route('id')]['IdIsInv'],
            ]);
            $this->successfully1 = $ob[$ob['Setting']['Language']][request()->route('id')]['Edit'];
            $this->getEditDataBase($ob, request()->route('id'), $this);
            
        }else{
            parent::__construct(request()->route('id'), $ob, $ob[request()->route('id')]?Test::fromArray(array_reverse($ob[request()->route('id')]), $ob[$ob['Setting']['Language']]['SelectTestBox']):array());
            $this->table8 = $ob[$this->language][request()->route('id')]['TableName'];
            $this->table9 = $ob[$this->language][request()->route('id')]['TablePrice'];
            $this->table10 = $ob[$this->language][request()->route('id')]['TableInputOutput'];
            $this->table12 = $ob[$this->language][request()->route('id')]['TableShortcut'];
            $this->label3 = $ob[$this->language][request()->route('id')]['LabelName'];
            $this->label4 = $ob[$this->language][request()->route('id')]['LabelPrice'];
            $this->label5 = $ob[$this->language][request()->route('id')]['LabelInputOutLab'];
            $this->label7 = $ob[$this->language][request()->route('id')]['LabelShortcut'];
            $this->inputOutPut = $ob[$this->language]['SelectTestBox'];
            $this->selectBox1 = $ob[$this->language][request()->route('id')]['InputOutLab'];
            $this->hint1 = $ob[$this->language][request()->route('id')]['HintName'];
            $this->hint2 = $ob[$this->language][request()->route('id')]['HintPrice'];
            $this->hint3 = $ob[$this->language][request()->route('id')]['HintShortcut'];
            $this->successfully1 = $ob[$this->language][request()->route('id')]['LoadMessage'];
        }
    }
    public function index($id){
        return view('admin.test_cultures.all_test_cultures',[
                'lang'=> $this,
                'active'=>'TestCultures',
                'activeItem'=>$id,        
        ]);
    }
    public function action(){
        return back()->with('success', $this->successfully1);
    }
    public function getMyObject(){
        return array('Name'=>request()->input('name'), 'Shortcut'=>request()->input('shortcut'), 'Price'=>request()->input('price'), 'InputOutputLab'=>request()->input('input-output-lab'), 'Id'=>isset($this->myDbId) ? $this->myDbId : request()->input('id'));
    }
}
