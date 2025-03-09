<?php

namespace App\Http\Controllers\doctor;
use App\Http\Controllers\Controller;
use App\language\doctor\DoctorInvoices;
class DoctorInvoicesController extends Controller
{
    public function setupLanguage(){
        return new DoctorInvoices();
    }
    public function index(){
        $lang = $this->setupLanguage();
        $lang->myMenuApp['DoctorInvoices']['active'] = 'my_active';
        return view('doctor.doctor_invoices',[
            'lang'=> $lang,
             'logOut'=>route('logoutDoctor')
        ]);
    }
}
