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
            $view = view('doctor.doctor_medical_reports.the_all_medical_reports',[
                'lang'=> $lang,
                'logOut'=>route('logoutDoctor')
            ]);
        }
        else if($id === 'TheDoneReports'){
            $view = view('doctor.doctor_medical_reports.the_done_reports',[
                'lang'=> $lang,
                'logOut'=>route('logoutDoctor')
            ]);
        }
        else if($id === 'ThePendingReports'){
            $view = view('doctor.doctor_medical_reports.the_pending_reports',[
                'lang'=> $lang,
                'logOut'=>route('logoutDoctor')
            ]);
        }
        else if($id === 'TheUnsignedReports'){
            $view = view('doctor.doctor_medical_reports.the_unsigned_reports',[
                'lang'=> $lang,
                'logOut'=>route('logoutDoctor')
            ]);
        }else
            abort(404);
        $lang->myMenuApp['DoctorMedicalReports']['active'] = 'my_active';
        $lang->myMenuApp['DoctorMedicalReports']['items'][$id]['active'] = 'my_active';
        return $view;
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
