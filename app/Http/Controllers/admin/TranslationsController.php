<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\language\admin\Translations;
class TranslationsController extends Controller
{
    public function setupLanguage(){
        return new Translations();
    }
    public function index(){
        $lang = $this->setupLanguage();
        return view('admin.translations',[
            'lang'=> $lang,
            'logOut'=>route('admin.logout'),
            'active'=>'Translations'           
        ]);
    }
}
