<?php

namespace App\Http\Controllers\patent;
use App\Http\Controllers\Controller;
use App\language\patent\TestsLibrary;
class TestsLibraryController extends Controller
{
    public function setupLanguage(){
        return new TestsLibrary();
    }
    public function index(){
        $lang = $this->setupLanguage();
        $lang->myMenuApp['TestsLibrary']['active'] = 'my_active';
        return view('patent.tests_library',[
            'lang'=> $lang,
             'logOut'=>route('logoutPatent')
        ]);
    }
}
