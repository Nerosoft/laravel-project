<?php
namespace App\Http\Controllers\doctor;
use App\Http\Controllers\Controller;
use App\language\doctor\TechnicalSupports;
class TechnicalSupportsController extends Controller
{
    public function setupLanguage(){
        return new TechnicalSupports();
    }
    public function index(){
        $lang = $this->setupLanguage();
        $lang->myMenuApp['TechnicalSupports']['active'] = 'my_active';
        return view('doctor.technical_supports',[
            'lang'=> $lang,
             'logOut'=>route('logoutDoctor')
        ]);
    }
}
