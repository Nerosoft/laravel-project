<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\language\menu\AdminTopMenu;
use App\Models\Rays;
use App\Http\interface\DbRays;

class AdminController extends AdminTopMenu implements DbRays
{   
    public function __construct(){
        $this->ob = Rays::find(request()->session()->get('userId'));
        parent::__construct($this, 'Admin');
        //init label
        $this->label3 = $this->getDataBase()[$this->language]['Admin']['TotalVaul'];
        $this->label4 = $this->getDataBase()[$this->language]['Admin']['ReceivedCach'];
        $this->label5 = $this->getDataBase()[$this->language]['Admin']['ReceivedVisa'];
        $this->label6 = $this->getDataBase()[$this->language]['Admin']['Custody'];
        $this->label7 = $this->getDataBase()[$this->language]['Admin']['Expenses'];
        $this->label8 = $this->getDataBase()[$this->language]['Admin']['Safe'];
        $this->label9 = $this->getDataBase()[$this->language]['Admin']['DashboardHeader'];
        //init button
        $this->button1 = $this->getDataBase()[$this->language]['Admin']['DisplayTotalVaul'];
        $this->button2 = $this->getDataBase()[$this->language]['Admin']['DisplayReceivedCach'];
        $this->button3 = $this->getDataBase()[$this->language]['Admin']['DisplayReceivedVisa'];
        $this->button4 = $this->getDataBase()[$this->language]['Admin']['DisplayCustody'];
        $this->button5 = $this->getDataBase()[$this->language]['Admin']['DisplayExpenses'];
        $this->button6 = $this->getDataBase()[$this->language]['Admin']['DisplaySafe'];
    }
    public function getDataBase(){
        return $this->ob;
    }
    public function index(){
        return view('admin.user', [
            'lang'=> $this,
            'active'=>'Home',
        ]);
    }
}
