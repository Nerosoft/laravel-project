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
        return view('patent.our_branches',[
            'lang'=> $lang,
            'logOut'=>route('logoutPatent'),
            'active'=>'PatentOurBranches'
        ]);
    }
}
