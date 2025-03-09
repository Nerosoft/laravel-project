<?php
namespace App\Http\Controllers\doctor;
use App\Http\Controllers\Controller;
use App\language\doctor\TheDoctorReport;
class TheDoctorReportController extends Controller
{
    public function setupLanguage(){
        return new TheDoctorReport();
    }
    public function index(){
        $lang = $this->setupLanguage();
        $lang->myMenuApp['TheDoctorReport']['active'] = 'my_active';
        return view('doctor.the_doctor_report',[
            'lang'=> $lang,
             'logOut'=>route('logoutDoctor')
        ]);
    }
}
