<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\language\menu\AdminTopMenu;
use App\Models\Rays;
use App\Menu;
use App\instance\admin\Branch;

class AdminController extends AdminTopMenu
{   
    public function __construct(){
        $ob = Rays::find(request()->session()->get('userId'));      
        if($ob['Branch'])
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeBranch($ob['Branch'], $ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            $ob[$ob['Setting']['Language']]['Admin']['AdminUser'],
            new Menu($ob[$ob['Setting']['Language']]['Menu']));
        else if(Rays::find(request()->session()->get('userLogout'))['Branch'])
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeBranch(Rays::find(request()->session()->get('userLogout'))['Branch'], $ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            $ob[$ob['Setting']['Language']]['Admin']['AdminUser'],
            new Menu($ob[$ob['Setting']['Language']]['Menu']));
        else
            parent::__construct($ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['AppSettingAdmin'],
            $ob[$ob['Setting']['Language']]['Html']['Direction'],
            Branch::makeMainBranch($ob[$ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']), 
            $ob[$ob['Setting']['Language']]['Admin']['AdminUser'],
            new Menu($ob[$ob['Setting']['Language']]['Menu']));
        //init label
        $this->label3 = $ob[$this->language]['Admin']['TotalVaul'];
        $this->label4 = $ob[$this->language]['Admin']['ReceivedCach'];
        $this->label5 = $ob[$this->language]['Admin']['ReceivedVisa'];
        $this->label6 = $ob[$this->language]['Admin']['Custody'];
        $this->label7 = $ob[$this->language]['Admin']['Expenses'];
        $this->label8 = $ob[$this->language]['Admin']['Safe'];
        $this->label9 = $ob[$this->language]['Admin']['DashboardHeader'];
        //init button
        $this->button1 = $ob[$this->language]['Admin']['DisplayTotalVaul'];
        $this->button2 = $ob[$this->language]['Admin']['DisplayReceivedCach'];
        $this->button3 = $ob[$this->language]['Admin']['DisplayReceivedVisa'];
        $this->button4 = $ob[$this->language]['Admin']['DisplayCustody'];
        $this->button5 = $ob[$this->language]['Admin']['DisplayExpenses'];
        $this->button6 = $ob[$this->language]['Admin']['DisplaySafe'];
    }

    public function index(){
        return view('admin.user', [
            'lang'=> $this,
            'active'=>'Home',
        ]);
    }
}
