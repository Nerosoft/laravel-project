<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\language\admin\medical_reports\AllMedicalReports;
use App\language\admin\medical_reports\DoneReports;
use App\language\admin\medical_reports\PendingReports;
use App\language\admin\medical_reports\UnsigendReports;
use App\language\admin\medical_reports\SendToLab;
use App\language\admin\medical_reports\SampleStatus;
class MedicalReportsController extends Controller
{
    public function index($id){
        $lang = $this->initLanguage($id);
        if($id === 'AllMedicalReports'){
            return view('admin.medical_reports.allMedicalReports',[
                'lang'=> $lang,
                'active'=>'MedicalReports',
                'activeItem'=>'AllMedicalReports'
            ]);
        }
        else if($id === 'DoneReports'){
            return view('admin.medical_reports.doneReports',[
                'lang'=> $lang,
                'active'=>'MedicalReports',
                'activeItem'=>'DoneReports'
            ]);
        }
        else if($id === 'PendingReports'){
            return view('admin.medical_reports.pendingReports',[
                'lang'=> $lang,
                'active'=>'MedicalReports',
                'activeItem'=>'PendingReports'
            ]);
        }
        else if($id === 'UnsigendReports'){
            return view('admin.medical_reports.unsigendReports',[
                'lang'=> $lang,
                'active'=>'MedicalReports',
                'activeItem'=>'UnsigendReports'
            ]);
        }
        else if($id === 'SendToLab'){
            return view('admin.medical_reports.SendToLab',[
                'lang'=> $lang,
                'active'=>'MedicalReports',
                'activeItem'=>'SendToLab'
            ]);
        }
        else if($id === 'SampleStatus'){
            return view('admin.medical_reports.sampleStatus',[
                'lang'=> $lang,
                'active'=>'MedicalReports',
                'activeItem'=>'SampleStatus'
            ]);
        }else
            abort(404);
    }
    private function initLanguage($id){
        switch ($id) {
            case 'AllMedicalReports':
                return new AllMedicalReports();
            case 'DoneReports':
                return new DoneReports();
            case 'PendingReports':
                return new PendingReports();
            case 'UnsigendReports':
                return new UnsigendReports();
            case 'SendToLab':
                return new SendToLab();
            case 'SampleStatus':
                return new SampleStatus();
            default :
                return null;
        }
    }
}
