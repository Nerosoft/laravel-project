<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\interface\LangObject;
use App\Http\interface\ActionInit;
use App\Http\interface\ValidRull;
use App\language\share\Page;
use App\instance\admin\reception\MyKnows;
use App\Models\Rays;
use Illuminate\Validation\Rule;

class KnowController extends Page implements LangObject, ActionInit, ValidRull
{
    public function getData(){
        return $this->ob['Knows']?MyKnows::fromArray(array_reverse($this->ob['Knows'])):array();
    }
    public function initView(){
        $this->table8 = $this->ob[$this->language]['Knows']['TableKnowsName'];
        $this->label3 = $this->ob[$this->language]['Knows']['LabelKnowsName'];
        $this->hint1 = $this->ob[$this->language]['Knows']['HintKnowsName'];
    }
    public function initValid(){
        $this->roll['name'] = ['required', 'min:3'];
        $this->message['name.required'] = $this->error1;
        $this->message['name.min'] = $this->error2;
    }
    public function initValidRull(){
        array_push($this->roll['id'], Rule::in($this->ob['Knows']?array_keys($this->ob['Knows']):null));
    }
    public function __construct(){
        $this->ob = Rays::find(request()->session()->get('userId'));
        $this->error1 = $this->ob[$this->ob['Setting']['Language']]['Knows']['KnowsNameRequired'];
        $this->error2 = $this->ob[$this->ob['Setting']['Language']]['Knows']['KnowsNameInvalid'];
        parent::__construct($this, 'Knows', $this->ob);
    }
    public function makeAddKnow(){
        $this->getCreateDataBase($this->ob, 'Knows', $this->generateUniqueIdentifier(), $this);
        return back()->with('success', $this->successfulyMessage);
    }
    public function makeEditKnow(){
        $this->getEditDataBase($this->ob, 'Knows', $this);
        return back()->with('success', $this->ob[$this->ob['Setting']['Language']]['Knows']['MessageModelEdit']);
    }
    public function index(){
        return view('admin.contracts.knows',[
            'lang'=> $this,
            'active'=>'Knows',
        ]);
    }
    public function getMyObject($id = null){
        request()->validate($this->roll, $this->message);
        return array('Name'=>request()->input('name'));
    }
}
