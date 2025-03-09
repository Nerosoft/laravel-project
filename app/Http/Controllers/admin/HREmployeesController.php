<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\language\admin\hr_employees\Employees;
use App\language\admin\hr_employees\Violations;
use App\language\admin\hr_employees\Vocations;
use App\language\admin\hr_employees\Incentives;
use App\language\admin\hr_employees\Deductions;
use App\language\admin\hr_employees\Attendance;
use App\language\admin\hr_employees\Shifts;
class HREmployeesController extends Controller
{
    public function index($id){
        $lang = $this->initLanguage($id);
        if($id === 'Employees'){
            $view = view('admin.hr_employees.employees',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'Violations'){
            $view = view('admin.hr_employees.violations',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'Vocations'){
            $view = view('admin.hr_employees.vocations',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'Incentives'){
            $view = view('admin.hr_employees.incentives',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'Deductions'){
            $view = view('admin.hr_employees.deductions',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'Attendance'){
            $view = view('admin.hr_employees.attendance',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'Shifts'){
            $view = view('admin.hr_employees.shifts',[
                'lang'=> $lang,
                
            ]);
        }else
            abort(404);
        $lang->myMenuApp['HREmployees']['active'] = 'my_active';
        $lang->myMenuApp['HREmployees']['items'][$id]['active'] = 'my_active';
        return $view;
    }
    private function initLanguage($id){
        switch ($id) {
            case'Employees':
                return new Employees();
            case'Violations':
                return new Violations();
            case'Vocations':
                return new Vocations();
            case'Incentives':
                return new Incentives();
            case'Deductions':
                return new Deductions();
            case'Attendance':
                return new Attendance();
            case'Shifts':
                return new Shifts();
            default :
                return null;
        }
    }
}
