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
            $view = view('admin.medical_reports.allMedicalReports',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'DoneReports'){
            $view = view('admin.medical_reports.doneReports',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'PendingReports'){
            $view = view('admin.medical_reports.pendingReports',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'UnsigendReports'){
            $view = view('admin.medical_reports.unsigendReports',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'SendToLab'){
            $view = view('admin.medical_reports.SendToLab',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'SampleStatus'){
            $view = view('admin.medical_reports.sampleStatus',[
                'lang'=> $lang,
            ]);
        }else
            abort(404);
        $lang->myMenuApp['MedicalReports']['active'] = 'my_active';
        $lang->myMenuApp['MedicalReports']['items'][$id]['active'] = 'my_active';
        return $view;
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
