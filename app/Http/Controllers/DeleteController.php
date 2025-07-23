<?php
namespace App\Http\Controllers;
use App\Models\Rays;
use Illuminate\Validation\Rule;
use App\language\share\Page;
use App\Http\interface\ValidRull;
class DeleteController extends Page implements ValidRull
{

    public function initValid(){
       
    }
    public function initValidRull(){
        $this->successfully1 = $this->ob[$this->ob['Setting']['Language']][request()->route('id')]['Delete'];
        return Rule::in($this->ob[request()->route('id')]?array_keys($this->ob[request()->route('id')]):null);
    }
    public function __construct(){
        $this->ob = Rays::find(request()->session()->get('userId'));
        parent::__construct($this, request()->route('id'), $this->ob);
    }
    public function action($id){
        request()->validate($this->roll, $this->message);
        $this->getDeleteDatabade($this->ob, request()->route('id'));
        return back()->with('success', $this->successfully1);
    }
}