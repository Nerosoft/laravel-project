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
            $view = view('admin.inventory.suppliers',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'Products'){
            $view = view('admin.inventory.products',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'FixedAssets'){
            $view = view('admin.inventory.fixed_assets',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'Purchases'){
            $view = view('admin.inventory.purchases',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'Adjustments'){
            $view = view('admin.inventory.adjustments',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'Transfers'){
            $view = view('admin.inventory.transfers',[
                'lang'=> $lang,
                
            ]);
        }else
            abort(404);
        $lang->myMenuApp['Inventory']['active'] = 'my_active';
        $lang->myMenuApp['Inventory']['items'][$id]['active'] = 'my_active';
        return $view;
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
