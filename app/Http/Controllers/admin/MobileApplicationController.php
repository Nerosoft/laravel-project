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
            $view = view('admin.mobile_application.tips_and_offer',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'StaticPage'){
            $view = view('admin.mobile_application.static_page',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'Sliders'){
            $view = view('admin.mobile_application.sliders',[
                'lang'=> $lang,
            ]);
        }else
            abort(404);
        $lang->myMenuApp['MobileApplication']['active'] = 'my_active';
        $lang->myMenuApp['MobileApplication']['items'][$id]['active'] = 'my_active';
        return $view;
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
