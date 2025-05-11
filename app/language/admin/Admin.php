<?php

namespace App\language\admin;
use App\Models\Rays;
use App\language\menu\AdminTopMenu;
use App\Menu;
class Admin extends AdminTopMenu
{
    /**
     * Create a new class instance.
    */
    public $label3;
    public $label4;
    public $label5;
    public $label6;
    public $label7;
    public $label8;
    public $label9;
    //-------------
    public $button1;
    public $button2;
    public $button3;
    public $button4;
    public $button5;
    public $button6;
    public function __construct()
    {
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
}
