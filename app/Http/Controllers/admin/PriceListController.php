<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\language\admin\price_list\Test;
use App\language\admin\price_list\CulturesPrice;
use App\language\admin\price_list\Packages;
use App\language\admin\price_list\PricesList;
class PriceListController extends Controller
{
    public function index($id){
        $lang = $this->initLanguage($id);
        if($id === 'Test'){
            $view = view('admin.price_list.test',[
                'lang'=> $lang, 
            ]);
        }
        else if($id === 'CulturesPrice'){
            $view = view('admin.price_list.cultures_price',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'Packages'){
            $view = view('admin.price_list.packages',[
                'lang'=> $lang,  
            ]);
        }
        else if($id === 'PricesList'){
            $view = view('admin.price_list.prices_list',[
                'lang'=> $lang,     
            ]);
        }else
            abort(404);
        $lang->myMenuApp['PriceList']['active'] = 'my_active';
        $lang->myMenuApp['PriceList']['items'][$id]['active'] = 'my_active';
        return $view;
    }
    private function initLanguage($id){
        switch ($id) {
            case'Test':
                return new Test();
            case'CulturesPrice':
                return new CulturesPrice();
            case'Packages':
                return new Packages();
            case'PricesList':
                return new PricesList();
            default :
                return null;
        }
    }
}
