<?php
namespace App\Http\Controllers\patent;
use App\Http\Controllers\Controller;
use App\language\patent\OurBranches;
class PatentOurBranchesController extends Controller
{
    public function setupLanguage(){
        return new OurBranches();
    }
    public function index(){
        $lang = $this->setupLanguage();
        $lang->myMenuApp['PatentOurBranches']['active'] = 'my_active';
        return view('patent.our_branches',[
            'lang'=> $lang,
             'logOut'=>route('logoutPatent')
        ]);
    }
}
