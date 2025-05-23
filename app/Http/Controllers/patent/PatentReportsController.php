<?php

namespace App\Http\Controllers\patent;
use App\Http\Controllers\Controller;
use App\language\patent\Reports;
class PatentReportsController extends Controller
{
    public function setupLanguage(){
        return new Reports();
    }
    public function index(){
        $lang = $this->setupLanguage();
        return view('patent.Reports',[
            'lang'=> $lang,
            'logOut'=>route('logoutPatent'),
            'active'=>'PatentReports'
        ]);
    }
}
