<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\interface\LangObject;
use App\language\share\Page;
use Illuminate\Support\Facades\Route;
use App\Http\interface\ActionInit;
use App\Http\interface\ValidRull;
use App\instance\admin\test_cultures\Test;
use App\Models\Rays;

class TestCulturesController extends Page implements LangObject, ActionInit, ValidRull
{
    public function getData(){
        return $this->ob[request()->route('id')]?Test::fromArray(array_reverse($this->ob[request()->route('id')]), $this->ob[$this->ob['Setting']['Language']]['SelectTestBox']):array();
    }
    public function initView(){
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
    }
    public function initValid(){
        $this->roll['name'] = ['required', 'min:3'];
        $this->roll['shortcut'] = ['required', 'min:3'];
        $this->roll['price'] = ['required', 'integer'];
        $this->roll['input-output-lab'] = ['required', Rule::in(array_keys($this->ob[$this->ob['Setting']['Language']]['SelectTestBox']))];
        $this->message['name.required'] = $this->error1;
        $this->message['name.min'] = $this->error2;
        $this->message['shortcut.required'] = $this->error9;
        $this->message['shortcut.min'] = $this->error10;
        $this->message['price.required'] = $this->error3;
        $this->message['price.integer'] = $this->ob[$this->ob['Setting']['Language']][request()->route('id')]['PriceInvalid'];
        $this->message['input-output-lab.required.required'] = $this->error4;
        $this->message['input-output-lab.in'] = $this->ob[$this->ob['Setting']['Language']][request()->route('id')]['InputOutputLabInvalid'];
    }
    public function initValidRull(){
        array_push($this->roll['id'], Rule::in($this->ob[request()->route('id')]?array_keys($this->ob[request()->route('id')]):null));
    }
    public function __construct(){
        $this->ob = Rays::find(request()->session()->get('userId'));
        $this->error1 = $this->ob[$this->ob['Setting']['Language']][request()->route('id')]['NameRequired'];
        $this->error2 = $this->ob[$this->ob['Setting']['Language']][request()->route('id')]['NameInvalid'];
        $this->error9 = $this->ob[$this->ob['Setting']['Language']][request()->route('id')]['ShortcutRequired'];
        $this->error10 = $this->ob[$this->ob['Setting']['Language']][request()->route('id')]['ShortcutInvalid'];
        $this->error3 = $this->ob[$this->ob['Setting']['Language']][request()->route('id')]['PriceRequired'];
        $this->error4 = $this->ob[$this->ob['Setting']['Language']][request()->route('id')]['InputOutputLabRequired'];
        parent::__construct($this, request()->route('id'), $this->ob);
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
        return back()->with('success', $this->successfulyMessage);
    }
    public function makeEditTest($id){
        $this->getEditDataBase($this->ob, $id, $this);
        return back()->with('success', $this->ob[$this->ob['Setting']['Language']][$id]['MessageModelEdit']);
    }
    public function getMyObject($myDbId = null){
        request()->validate($this->roll, $this->message);
        return array('Name'=>request()->input('name'), 'Shortcut'=>request()->input('shortcut'), 'Price'=>request()->input('price'), 'InputOutputLab'=>request()->input('input-output-lab'), 'Id'=>$myDbId?$myDbId:request()->input('id'));
    }
}
