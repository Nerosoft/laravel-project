<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\language\admin\Admin;
class AdminController extends Controller
{   
    public function setupLanguage(){
        return new Admin();
    }
    public function index(){
        $lang = $this->setupLanguage();
        return view('admin.user', [
            'lang'=> $lang,
            'active'=>'Home'
        ]);
    }
}
