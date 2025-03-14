<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\language\admin\ClearCache;
class ClearCacheController extends Controller
{
    public function setupLanguage(){
        return new ClearCache();
    }
    public function index(){
        $lang = $this->setupLanguage();
        $lang->myMenuApp['ClearCache']['active'] = 'my_active';
        return view('admin.clear_cache',[
            'lang'=> $lang,            
        ]);
    }

}
