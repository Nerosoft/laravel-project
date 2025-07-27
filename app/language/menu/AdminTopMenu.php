<?php

namespace App\language\menu;
use App\Models\Rays;
use App\Menu;
use App\instance\admin\Branch;
use App\Http\interface\DbRays;
use App\language\share\InitPage;
class AdminTopMenu extends InitPage
{
    /**
     * Create a new class instance.
    */
    protected function __construct(DbRays $ob, $state){
        parent::__construct($ob->getDataBase()['Setting']['Language'], 
        $ob->getDataBase()[$ob->getDataBase()['Setting']['Language']][$state]['Title'],
        $ob->getDataBase()[$ob->getDataBase()['Setting']['Language']]['Html']['Direction']);
        $this->selectBox3 = $ob->getDataBase()[$this->language]['AppSettingAdmin']['BranchesCompany'];
        $this->title101 = $ob->getDataBase()[$this->language]['AppSettingAdmin']['Offcanvas'];
        $this->label1 = $ob->getDataBase()[$this->language]['AppSettingAdmin']['Logout'];
        $this->label2 = $ob->getDataBase()[$this->language]['AppSettingAdmin']['AdminDashboard'];
        $this->myMenuApp =  new Menu($ob, $state, $this->language);
        $this->MyBranch = Rays::find(request()->session()->get('userLogout'))['Branch']?Branch::makeBranch(Rays::find(request()->session()->get('userLogout'))['Branch'],$ob->getDataBase()[$ob->getDataBase()['Setting']['Language']]['AppSettingAdmin']['BranchMain']):Branch::makeMainBranch($ob->getDataBase()[$ob->getDataBase()['Setting']['Language']]['AppSettingAdmin']['BranchMain']);
    }
}
