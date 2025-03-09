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
        $lang->myMenuApp['Home']['active'] = 'my_active';
        return view('admin.user', [
            'lang'=> $lang,
        ]);
    }
}
