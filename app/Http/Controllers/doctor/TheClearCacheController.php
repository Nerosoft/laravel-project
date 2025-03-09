<?php

namespace App\Http\Controllers\doctor;
use App\Http\Controllers\Controller;
use App\language\doctor\TheClearCache;
class TheClearCacheController extends Controller
{
    public function setupLanguage(){
        return new TheClearCache();
    }
    public function index(){
        $lang = $this->setupLanguage();
        $lang->myMenuApp['TheClearCache']['active'] = 'my_active';
        return view('doctor.the_Clear_Cache',[
            'lang'=> $lang,
             'logOut'=>route('logoutDoctor')
        ]);
    }
}
