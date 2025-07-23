<?php
namespace App\Http\Controllers;
use App\Models\Rays;
use Illuminate\Validation\Rule;
use App\language\share\Page;
use App\Http\interface\ValidRull;
use App\Http\interface\ActionInit2;
class DeleteController extends Page implements ActionInit2, ValidRull
{

    public function initValid(){
    }
    public function initValidRull(){
        $this->successfully1 = $this->ob[$this->ob['Setting']['Language']][request()->route('id')]['Delete'];
        array_push($this->roll['id'], Rule::in($this->ob[request()->route('id')]?array_keys($this->ob[request()->route('id')]):null));
        request()->validate($this->roll, $this->message);
    }
    public function __construct(){
        $this->ob = Rays::find(request()->session()->get('userId'));
        parent::__construct($this, request()->route('id'), $this->ob);
    }
    public function action($id){
        $this->getDeleteDatabade($this->ob, request()->route('id'));
        return back()->with('success', $this->successfully1);
    }
}