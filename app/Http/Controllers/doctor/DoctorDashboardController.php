<?php

namespace App\Http\Controllers\doctor;
use App\Http\Controllers\Controller;
use App\language\doctor\DoctorDashboard;
class DoctorDashboardController extends Controller
{
    public function setupLanguage(){
        return new DoctorDashboard();
    }
    public function index(){
        $lang = $this->setupLanguage();
        $lang->myMenuApp['DoctorDashboard']['active'] = 'my_active';
        return view('doctor.doctor_dashboard',[
            'lang'=> $lang,
             'logOut'=>route('logoutDoctor')
        ]);
    }
}
