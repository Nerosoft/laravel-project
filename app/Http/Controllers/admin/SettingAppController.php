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
        $lang->myMenuApp['SettingApp']['active'] = 'my_active';
        return view('admin.setting_app',[
            'lang'=> $lang,            
        ]);
    }
}
