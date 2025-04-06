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
            return view('admin.hr_employees.employees',[
                'lang'=> $lang,
                'active'=>'HREmployees',
                'activeItem'=>'Employees'
            ]);
        }
        else if($id === 'Violations'){
            return view('admin.hr_employees.violations',[
                'lang'=> $lang,
                'active'=>'HREmployees',
                'activeItem'=>'Violations'
            ]);
        }
        else if($id === 'Vocations'){
            return view('admin.hr_employees.vocations',[
                'lang'=> $lang,
                'active'=>'HREmployees',
                'activeItem'=>'Vocations'
            ]);
        }
        else if($id === 'Incentives'){
            return view('admin.hr_employees.incentives',[
                'lang'=> $lang,
                'active'=>'HREmployees',
                'activeItem'=>'Incentives'
            ]);
        }
        else if($id === 'Deductions'){
            return view('admin.hr_employees.deductions',[
                'lang'=> $lang,
                'active'=>'HREmployees',
                'activeItem'=>'Deductions'
            ]);
        }
        else if($id === 'Attendance'){
            return view('admin.hr_employees.attendance',[
                'lang'=> $lang,
                'active'=>'HREmployees',
                'activeItem'=>'Attendance'
            ]);
        }
        else if($id === 'Shifts'){
            return view('admin.hr_employees.shifts',[
                'lang'=> $lang,
                'active'=>'HREmployees',
                'activeItem'=>'Shifts'
            ]);
        }else
            abort(404);
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
