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
        $this->ob = Rays::find(request()->session()->get('userId'));
        $this->error1 = $this->ob[$this->ob['Setting']['Language']][request()->route('id')]['NameRequired'];
        $this->error2 = $this->ob[$this->ob['Setting']['Language']][request()->route('id')]['NameInvalid'];
        $this->error9 = $this->ob[$this->ob['Setting']['Language']][request()->route('id')]['ShortcutRequired'];
        $this->error10 = $this->ob[$this->ob['Setting']['Language']][request()->route('id')]['ShortcutInvalid'];
        $this->error3 = $this->ob[$this->ob['Setting']['Language']][request()->route('id')]['PriceRequired'];
        $this->error4 = $this->ob[$this->ob['Setting']['Language']][request()->route('id')]['InputOutputLabRequired'];
        if(Route::currentRouteName() === 'createTest' || Route::currentRouteName() === 'editTest'){
            $this->roll = [
                'name' => ['required', 'min:3'],
                'shortcut' => ['required', 'min:3'],
                'price' => ['required', 'integer'],
                'input-output-lab' => ['required', Rule::in(array_keys($this->ob[$this->ob['Setting']['Language']]['SelectTestBox']))],
            ];
            $this->message = [
                'name.required' => $this->error1,
                'name.min' => $this->error2,
                'shortcut.required' =>$this->error9,
                'shortcut.min' => $this->error10,
                'price.required' => $this->error3,
                'price.integer' => $this->ob[$this->ob['Setting']['Language']][request()->route('id')]['PriceInvalid'],
                'input-output-lab.required' => $this->error4,
                'input-output-lab.in' => $this->ob[$this->ob['Setting']['Language']][request()->route('id')]['InputOutputLabInvalid'],
            ];
            
        }else{
            parent::__construct(route('deleteItem', request()->route('id')), request()->route('id'), $this->ob, $this->ob[request()->route('id')]?Test::fromArray(array_reverse($this->ob[request()->route('id')]), $this->ob[$this->ob['Setting']['Language']]['SelectTestBox']):array());
            $this->table8 = $this->ob[$this->language][request()->route('id')]['TableName'];
            $this->table9 = $this->ob[$this->language][request()->route('id')]['TablePrice'];
            $this->table10 = $this->ob[$this->language][request()->route('id')]['TableInputOutput'];
            $this->table12 = $this->ob[$this->language][request()->route('id')]['TableShortcut'];
            $this->label3 = $this->ob[$this->language][request()->route('id')]['LabelName'];
            $this->label4 = $this->ob[$this->language][request()->route('id')]['LabelPrice'];
            $this->label5 = $this->ob[$this->language][request()->route('id')]['LabelInputOutLab'];
            $this->label7 = $this->ob[$this->language][request()->route('id')]['LabelShortcut'];
            $this->inputOutPut = $this->ob[$this->language]['SelectTestBox'];
            $this->selectBox1 = $this->ob[$this->language][request()->route('id')]['InputOutLab'];
            $this->hint1 = $this->ob[$this->language][request()->route('id')]['HintName'];
            $this->hint2 = $this->ob[$this->language][request()->route('id')]['HintPrice'];
            $this->hint3 = $this->ob[$this->language][request()->route('id')]['HintShortcut'];
            $this->successfully1 = $this->ob[$this->language][request()->route('id')]['LoadMessage'];
        }
    }
    public function index($id){
        return view('admin.test_cultures.all_test_cultures',[
                'lang'=> $this,
                'active'=>'TestCultures',
                'activeItem'=>$id,        
        ]);
    }
    public function makeAddTest($id){
        $this->getCreateDataBase($this->ob, $id, $this->generateUniqueIdentifier(), $this);
        return back()->with('success', $this->ob[$this->ob['Setting']['Language']][$id]['Add']);
    }
    public function makeEditTest($id){
        $this->roll['id'] = ['required', Rule::in($this->ob[$id]?array_keys($this->ob[$id]):null)];
        $this->message['id.required'] = $this->ob[$this->ob['Setting']['Language']][request()->route('id')]['IdIsReq'];
        $this->message['id.in'] = $this->ob[$this->ob['Setting']['Language']][request()->route('id')]['IdIsInv'];
        $this->getEditDataBase($this->ob, $id, $this);
        return back()->with('success', $this->ob[$this->ob['Setting']['Language']][$id]['Edit']);
    }
    public function getMyObject(){
        request()->validate($this->roll, $this->message);
        return array('Name'=>request()->input('name'), 'Shortcut'=>request()->input('shortcut'), 'Price'=>request()->input('price'), 'InputOutputLab'=>request()->input('input-output-lab'), 'Id'=>isset($this->myDbId) ? $this->myDbId : request()->input('id'));
    }
}
