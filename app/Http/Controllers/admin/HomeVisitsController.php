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
            $View = view('admin.home_visits.home_visit',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'Bookings'){
            $View = view('admin.home_visits.bookings',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'Prescriptions'){
            $View = view('admin.home_visits.prescriptions',[
                'lang'=> $lang,
                
            ]);
        }else
            abort(404);
        $lang->myMenuApp['HomeVisits']['active'] = 'my_active';
        $lang->myMenuApp['HomeVisits']['items'][$id]['active'] = 'my_active';
        return $View;
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
