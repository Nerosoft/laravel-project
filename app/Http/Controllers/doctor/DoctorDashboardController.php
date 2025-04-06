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
        return view('doctor.doctor_dashboard',[
            'lang'=> $lang,
            'logOut'=>route('logoutDoctor'),
            'active'=>'DoctorDashboard'
        ]);
    }
}
