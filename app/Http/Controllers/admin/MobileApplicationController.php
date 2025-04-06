<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\language\admin\mobile_application\TipsAndOffer;
use App\language\admin\mobile_application\StaticPage;
use App\language\admin\mobile_application\Sliders;
class MobileApplicationController extends Controller
{
    public function index($id){
        $lang = $this->initLanguage($id);
        if($id === 'TipsAndOffer'){
            return view('admin.mobile_application.tips_and_offer',[
                'lang'=> $lang,
                'active'=>'MobileApplication',
                'activeItem'=>'TipsAndOffer'
            ]);
        }
        else if($id === 'StaticPage'){
            return view('admin.mobile_application.static_page',[
                'lang'=> $lang,
                'active'=>'MobileApplication',
                'activeItem'=>'StaticPage'
            ]);
        }
        else if($id === 'Sliders'){
            return view('admin.mobile_application.sliders',[
                'lang'=> $lang,
                'active'=>'MobileApplication',
                'activeItem'=>'Sliders'
            ]);
        }else
            abort(404);
    }
    private function initLanguage($id){
        switch ($id) {
            case'TipsAndOffer':        
                return new TipsAndOffer();
            case'StaticPage':
                return new StaticPage();
            case'Sliders':
                return new Sliders();
            default :
                return null;
        }
    }
}
