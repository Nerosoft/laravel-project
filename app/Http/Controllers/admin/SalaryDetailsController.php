<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\language\admin\salary_details\Salary;
use App\language\admin\salary_details\ThInventory;
use App\language\admin\salary_details\ThSuppliers;
use App\language\admin\salary_details\ThProducts;
use App\language\admin\salary_details\ThFixedAssets;
use App\language\admin\salary_details\ThPurchases;
use App\language\admin\salary_details\ThAdjustments;
use App\language\admin\salary_details\ThTransfers;
class SalaryDetailsController extends Controller
{
    public function index($id){
        $lang = $this->initLanguage($id);
        if($id === 'Salary'){
            $view = view('admin.salary_details.salary',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'ThInventory'){
            $view = view('admin.salary_details.th_inventory',[
                'lang'=> $lang, 
            ]);
        }
        else if($id === 'ThSuppliers'){
            $view = view('admin.salary_details.th_suppliers',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'ThProducts'){
            $view = view('admin.salary_details.th_products',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'ThFixedAssets'){
            $view = view('admin.salary_details.th_fixed_assets',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'ThPurchases'){
            $view = view('admin.salary_details.th_purchases',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'ThAdjustments'){
            $view = view('admin.salary_details.th_adjustments',[
                'lang'=> $lang, 
            ]);
        }
        else if($id === 'ThTransfers'){
            $view = view('admin.salary_details.th_transfers',[
                'lang'=> $lang,
            ]);
        }else
            abort(404);
        $lang->myMenuApp['SalaryDetails']['active'] = 'my_active';
        $lang->myMenuApp['SalaryDetails']['items'][$id]['active'] = 'my_active';
        return $view;
    }
    private function initLanguage($id){
        switch ($id) {
            case'Salary':
                return new Salary();
            case'ThInventory':
                return new ThInventory();
            case'ThSuppliers':
                return new ThSuppliers();
            case'ThProducts':
                return new ThProducts();
            case'ThFixedAssets':
                return new ThFixedAssets();
            case'ThPurchases':
                return new ThPurchases();
            case'ThAdjustments':
                return new ThAdjustments();
            case'ThTransfers':
                return new ThTransfers();
            default :
                return null;
        }
    }
}
