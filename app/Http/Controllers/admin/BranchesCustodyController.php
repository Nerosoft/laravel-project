<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\language\admin\BranchesCustody;
class BranchesCustodyController extends Controller
{
    public function setupLanguage(){
        return new BranchesCustody();
    }
    public function index(){
        $lang = $this->setupLanguage();
        return view('admin.branches_custody',[
            'lang'=> $lang,
            'active'=>'BranchesCustody',
            'logOut'=>route('admin.logout')
        ]);
    }
}
