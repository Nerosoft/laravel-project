<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\language\admin\inventory\Suppliers;
use App\language\admin\inventory\Products;
use App\language\admin\inventory\FixedAssets;
use App\language\admin\inventory\Purchases;
use App\language\admin\inventory\Adjustments;
use App\language\admin\inventory\Transfers;
class InventoryController extends Controller
{
    public function index($id){
        $lang = $this->initLanguage($id);
        if($id === 'Suppliers'){
            return view('admin.inventory.suppliers',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'Inventory',
                'activeItem'=>'Suppliers'
            ]);
        }
        else if($id === 'Products'){
            return view('admin.inventory.products',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'Inventory',
                'activeItem'=>'Products'
            ]);
        }
        else if($id === 'FixedAssets'){
            return view('admin.inventory.fixed_assets',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'Inventory',
                'activeItem'=>'FixedAssets'
            ]);
        }
        else if($id === 'Purchases'){
            return view('admin.inventory.purchases',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'Inventory',
                'activeItem'=>'Purchases'
            ]);
        }
        else if($id === 'Adjustments'){
            return view('admin.inventory.adjustments',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'Inventory',
                'activeItem'=>'Adjustments'
            ]);
        }
        else if($id === 'Transfers'){
            return view('admin.inventory.transfers',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'Inventory',
                'activeItem'=>'Transfers'
            ]);
        }else
            abort(404);
    }
    private function initLanguage($id){
        switch ($id) {
            case'Suppliers':      
                return new Suppliers();
            case'Products':
                return new Products();
            case'FixedAssets':
                return new FixedAssets();
            case'Purchases':
                return new Purchases();
            case'Adjustments':
                return new Adjustments();
            case'Transfers':
                return new Transfers();
            default :
                return null;
        }
    }
}
