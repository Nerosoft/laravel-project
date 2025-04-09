<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\language\admin\home_visits\HomeVisit;
use App\language\admin\home_visits\Bookings;
use App\language\admin\home_visits\Prescriptions;
class HomeVisitsController extends Controller
{
    public function index($id){
        $lang = $this->initLanguage($id);
        if($id === 'HomeVisit'){
            return view('admin.home_visits.home_visit',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'HomeVisits',
                'activeItem'=>'HomeVisit'
            ]);
        }
        else if($id === 'Bookings'){
            return view('admin.home_visits.bookings',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'HomeVisits',
                'activeItem'=>'Bookings'
            ]);
        }
        else if($id === 'Prescriptions'){
            return view('admin.home_visits.prescriptions',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'HomeVisits',
                'activeItem'=>'Prescriptions'
            ]);
        }else
            abort(404);
    }
    private function initLanguage($id){
        switch ($id) {
            case'HomeVisit':        
                return new HomeVisit();
            case'Bookings':
                return new Bookings();
            case'Prescriptions':
                return new Prescriptions();
            default :
                return null;
        }
    }
}
