<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\language\admin\SettingApp;
class SettingAppController extends Controller
{
    public function setupLanguage(){
        return new SettingApp();
    }
    public function index(){
        $lang = $this->setupLanguage();
        return view('admin.setting_app',[
            'lang'=> $lang,
            'logOut'=>route('admin.logout'),
            'active'=>'SettingApp'            
        ]);
    }
}
