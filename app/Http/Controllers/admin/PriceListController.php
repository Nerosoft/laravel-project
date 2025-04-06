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
            return view('admin.price_list.test',[
                'lang'=> $lang,
                'active'=>'PriceList',
                'activeItem'=>'Test'
            ]);
        }
        else if($id === 'CulturesPrice'){
            return view('admin.price_list.cultures_price',[
                'lang'=> $lang,
                'active'=>'PriceList',
                'activeItem'=>'CulturesPrice'
            ]);
        }
        else if($id === 'Packages'){
            return view('admin.price_list.packages',[
                'lang'=> $lang,
                'active'=>'PriceList',
                'activeItem'=>'Packages'
            ]);
        }
        else if($id === 'PricesList'){
            return view('admin.price_list.prices_list',[
                'lang'=> $lang,
                'active'=>'PriceList',
                'activeItem'=>'PricesList'    
            ]);
        }else
            abort(404);
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
