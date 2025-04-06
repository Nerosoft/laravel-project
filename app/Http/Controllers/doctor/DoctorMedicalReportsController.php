<?php

namespace App\Http\Controllers\doctor;
use App\Http\Controllers\Controller;
use App\language\doctor\doctor_medical_reports\TheAllMedicalReports;
use App\language\doctor\doctor_medical_reports\TheDoneReports;
use App\language\doctor\doctor_medical_reports\ThePendingReports;
use App\language\doctor\doctor_medical_reports\TheUnsignedReports;
class DoctorMedicalReportsController extends Controller
{
    public function index($id){
        $lang = $this->initLanguage($id);
        if($id === 'TheAllMedicalReports'){
            return view('doctor.doctor_medical_reports.the_all_medical_reports',[
                'lang'=> $lang,
                'logOut'=>route('logoutDoctor'),
                'active'=>'DoctorMedicalReports',
                'activeItem'=>'TheAllMedicalReports'
            ]);
        }
        else if($id === 'TheDoneReports'){
            return view('doctor.doctor_medical_reports.the_done_reports',[
                'lang'=> $lang,
                'logOut'=>route('logoutDoctor'),
                'active'=>'DoctorMedicalReports',
                'activeItem'=>'TheDoneReports'
            ]);
        }
        else if($id === 'ThePendingReports'){
            return view('doctor.doctor_medical_reports.the_pending_reports',[
                'lang'=> $lang,
                'logOut'=>route('logoutDoctor'),
                'active'=>'DoctorMedicalReports',
                'activeItem'=>'ThePendingReports'
            ]);
        }
        else if($id === 'TheUnsignedReports'){
            return view('doctor.doctor_medical_reports.the_unsigned_reports',[
                'lang'=> $lang,
                'logOut'=>route('logoutDoctor'),
                'active'=>'DoctorMedicalReports',
                'activeItem'=>'TheUnsignedReports'
            ]);
        }else
            abort(404);
    }
    private function initLanguage($id){
        switch ($id) {
            case'TheAllMedicalReports':
                return new TheAllMedicalReports();
            case'TheDoneReports':
                return new TheDoneReports();
            case'ThePendingReports':
                return new ThePendingReports();
            case'TheUnsignedReports':
                return new TheUnsignedReports();
            default :
                return null;
        }
    }
}
