<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\language\menu\AdminTopMenu;
use App\Models\Rays;
use App\Menu;
class AdminController extends AdminTopMenu
{   
    public function __construct(){
        $ob = Rays::find(request()->session()->get('userId'));
        //get title
        parent::__construct($ob['Setting']['Language'],
        $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
        $ob[$ob['Setting']['Language']]['Html']['Direction'],
        $ob['Branch']?$ob['Branch']:Rays::find(request()->session()->get('userLogout'))['Branch'],
        $ob[$ob['Setting']['Language']]['Title']['AdminUser'],
        new Menu($ob[$ob['Setting']['Language']]['Menu'], 'Admin'));
        //init label
        $this->label3 = $ob[$ob['Setting']['Language']]['Label']['TotalVaul'];
        $this->label4 = $ob[$ob['Setting']['Language']]['Label']['ReceivedCach'];
        $this->label5 = $ob[$ob['Setting']['Language']]['Label']['ReceivedVisa'];
        $this->label6 = $ob[$ob['Setting']['Language']]['Label']['Custody'];
        $this->label7 = $ob[$ob['Setting']['Language']]['Label']['Expenses'];
        $this->label8 = $ob[$ob['Setting']['Language']]['Label']['Safe'];
        $this->label9 = $ob[$ob['Setting']['Language']]['Label']['DashboardHeader'];
        //init button
        $this->button1 = $ob[$ob['Setting']['Language']]['Button']['DisplayTotalVaul'];
        $this->button2 = $ob[$ob['Setting']['Language']]['Button']['DisplayReceivedCach'];
        $this->button3 = $ob[$ob['Setting']['Language']]['Button']['DisplayReceivedVisa'];
        $this->button4 = $ob[$ob['Setting']['Language']]['Button']['DisplayCustody'];
        $this->button5 = $ob[$ob['Setting']['Language']]['Button']['DisplayExpenses'];
        $this->button6 = $ob[$ob['Setting']['Language']]['Button']['DisplaySafe'];
    }

    public function index(){
        return view('admin.user', [
            'lang'=> $this,
            'active'=>'Home',
            'logOut'=>route('admin.logout')
        ]);
    }
}
