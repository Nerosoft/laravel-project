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
        $lang->myMenuApp['BranchesCustody']['active'] = 'my_active';
        return view('admin.branches_custody',[
            'lang'=> $lang,
        ]);
    }
}
