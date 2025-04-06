<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\language\admin\Chat;
class ChatController extends Controller
{
    public function setupLanguage(){
        return new Chat();
    }
    public function index(){
        $lang = $this->setupLanguage();
        return view('admin.chat',[
            'lang'=> $lang,
            'active'=>'Chat'            
        ]);
    }
}
