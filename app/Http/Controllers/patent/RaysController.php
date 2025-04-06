<?php
namespace App\Http\Controllers\patent;
use App\Http\Controllers\Controller;
use App\language\patent\Dashboard;
class RaysController extends Controller
{
    public function setupLanguage(){
        return new Dashboard();
    }
    public function index(){
        $lang = $this->setupLanguage();
        return view('patent.dashboard',[
            'lang'=> $lang,
            'logOut'=>route('logoutPatent'),
            'active'=>'PatentDashboard'
        ]);
    }
}