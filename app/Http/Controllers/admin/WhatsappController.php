<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\language\admin\Whatsapp;
class WhatsappController extends Controller
{
    public function setupLanguage(){
        return new Whatsapp();
    }
    public function index(){
        $lang = $this->setupLanguage();
        $lang->myMenuApp['Whatsapp']['active'] = 'my_active';
        return view('admin.whatsapp',[
            'lang'=> $lang,            
        ]);
    }
}
