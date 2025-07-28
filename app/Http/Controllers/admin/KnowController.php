<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\interface\LangObject;
use App\Http\interface\ValidRule;
use App\Http\interface\PageTable;
use App\language\share\Page;
use App\instance\admin\reception\MyKnows;
use App\Models\Rays;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

class KnowController extends Page implements LangObject, ValidRule, PageTable
{
    public function getDataBase(){
        return $this->ob;
    }
    public function getTableData(){
        return $this->getDataBase()['Knows']?MyKnows::fromArray(array_reverse($this->getDataBase()['Knows'])):array();
    }
    public function getRouteDelete(){
        return route('deleteItem', 'Knows');
    }

    public function initView(){
        $this->table8 = $this->getDataBase()[$this->language]['Knows']['TableKnowsName'];
        $this->label3 = $this->getDataBase()[$this->language]['Knows']['LabelKnowsName'];
        $this->hint1 = $this->getDataBase()[$this->language]['Knows']['HintKnowsName'];
    }
    public function initValid(){
        $this->roll['name'] = ['required', 'min:3'];
        $this->message['name.required'] = $this->error1;
        $this->message['name.min'] = $this->error2;
    }
    public function __construct(){
        $this->ob = Rays::find(request()->session()->get('userId'));
        $this->error1 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Knows']['KnowsNameRequired'];
        $this->error2 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Knows']['KnowsNameInvalid'];
        parent::__construct($this, 'Knows');
    }
    public function makeAddKnow(){
        $this->getCreateDataBase($this->getDataBase(), 'Knows', $this->generateUniqueIdentifier(), $this);
        return back()->with('success', $this->successfulyMessage);
    }
    public function getValidRule(){
        array_push($this->roll['id'], Rule::in(array_keys((array)$this->getDataBase()['Knows'])));
        $this->initValid();
    }
    public function makeEditKnow(){
        $this->getEditDataBase($this->getDataBase(), 'Knows', $this);
        return back()->with('success', $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Knows']['MessageModelEdit']);
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
