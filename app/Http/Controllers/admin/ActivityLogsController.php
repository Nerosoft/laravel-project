<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\language\admin\ActivityLogs;
class ActivityLogsController extends Controller
{
    public function setupLanguage(){
        return new ActivityLogs();
    }
    public function index(){
        $lang = $this->setupLanguage();
        return view('admin.activity_logs',[
            'lang'=> $lang,
            'active'=>'ActivityLogs'
        ]);
    }
}
