<?php
namespace App\Http\Controllers;
use App\Models\Rays;
use Illuminate\Validation\Rule;
use App\language\share\Page;
use App\Http\interface\ValidRule;
class DeleteController extends Page implements ValidRule
{
    public function getDataBase(){
        return $this->ob;
    }
    public function getValidRule(){
        array_push($this->roll['id'], Rule::in($this->getDataBase()[request()->route('id')]?array_keys($this->getDataBase()[request()->route('id')]):null));
    }
    public function __construct(){
        $this->ob = Rays::find(request()->session()->get('userId'));
        parent::__construct($this, request()->route('id'));
        $this->successfully1 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][request()->route('id')]['Delete'];
    }
    public function action($id){
        request()->validate($this->roll, $this->message);
        $this->getDeleteDatabade($this->getDataBase(), request()->route('id'));
        return back()->with('success', $this->successfully1);
    }
}