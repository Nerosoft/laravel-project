<?php
namespace App\Http\Controllers;
use App\Models\Rays;
use Illuminate\Validation\Rule;
use App\language\share\Page;
class DeleteController extends Page
{
    public function __construct(){
        $this->ob = Rays::find(request()->session()->get('userId'));
        parent::__construct(request()->route('id'), $this->ob);
        $this->successfully1 = $this->ob[$this->ob['Setting']['Language']][request()->route('id')]['Delete'];
        array_push($this->roll['id'], Rule::in($this->ob[request()->route('id')]?array_keys($this->ob[request()->route('id')]):null));
    }
    public function action($id){
        request()->validate($this->roll, $this->message);
        $this->getDeleteDatabade($this->ob, request()->route('id'));
        return back()->with('success', $this->successfully1);
    }
}