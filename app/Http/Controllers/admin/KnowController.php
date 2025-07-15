<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Rays;
use Illuminate\Validation\Rule;
use App\Http\interface\LangObject;
use App\language\share\Page;
use App\instance\admin\reception\MyKnows;

class KnowController extends Page implements LangObject
{
    public function __construct(){
        $this->ob = Rays::find(request()->session()->get('userId'));
        $this->error1 = $this->ob[$this->ob['Setting']['Language']]['Knows']['KnowsNameRequired'];
        $this->error2 = $this->ob[$this->ob['Setting']['Language']]['Knows']['KnowsNameInvalid'];
        if(Route::currentRouteName() === 'createKnows' || Route::currentRouteName() === 'editKnows'){
            $this->roll = [
                'name' => ['required', 'min:3'],
            ];
            $this->message = [
                'name.required' => $this->error1,
                'name.min' => $this->error2,
            ];
        }else{
            parent::__construct(route('deleteItem', 'Knows'), 'Knows', $this->ob, $this->ob['Knows']?MyKnows::fromArray(array_reverse($this->ob['Knows'])):array());
            $this->table8 = $this->ob[$this->language]['Knows']['TableKnowsName'];
            $this->label3 = $this->ob[$this->language]['Knows']['LabelKnowsName'];
            $this->hint1 = $this->ob[$this->language]['Knows']['HintKnowsName'];
            $this->successfully1 = $this->ob[$this->language]['Knows']['LoadMessage'];
        }
    }
    public function makeAddKnow(){
        $this->getCreateDataBase($this->ob, 'Knows', $this->generateUniqueIdentifier(), $this);
        return back()->with('success', $this->ob[$this->ob['Setting']['Language']]['Knows']['KnowsAdd']);
    }
    public function makeEditKnow(){
        $this->roll['id'] = ['required', Rule::in($this->ob['Knows']?array_keys($this->ob['Knows']):null)];
        $this->message['id.required'] = $this->ob[$this->ob['Setting']['Language']]['Knows']['IdIsReq'];
        $this->message['id.in'] = $this->ob[$this->ob['Setting']['Language']]['Knows']['IdIsInv'];
        $this->getEditDataBase($this->ob, 'Knows', $this);
        return back()->with('success',  $this->ob[$this->ob['Setting']['Language']]['Knows']['KnowsEdit']);
    }
    public function index(){
        return view('admin.contracts.knows',[
            'lang'=> $this,
            'active'=>'Knows',
        ]);
    }
    public function getMyObject(){
        request()->validate($this->roll, $this->message);
        return array('Name'=>request()->input('name'));
    }
}
