<?php
namespace App\Http\Controllers\patent;
use App\Http\Controllers\Controller;
use App\language\patent\HomeVisit;
class PatentHomeVisitController extends Controller
{
    public function setupLanguage(){
        return new HomeVisit();
    }
    public function index(){
        $lang = $this->setupLanguage();
        $lang->myMenuApp['PatentHomeVisit']['active'] = 'my_active';
        return view('patent.home_visit',[
            'lang'=> $lang,
            'logOut'=>route('logoutPatent')
        ]);
    }
}
