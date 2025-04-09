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
            return view('admin.salary_details.salary',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'SalaryDetails',
                'activeItem'=>'Salary'
            ]);
        }
        else if($id === 'ThInventory'){
            return view('admin.salary_details.th_inventory',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'SalaryDetails',
                'activeItem'=>'ThInventory' 
            ]);
        }
        else if($id === 'ThSuppliers'){
            return view('admin.salary_details.th_suppliers',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'SalaryDetails',
                'activeItem'=>'ThSuppliers'
            ]);
        }
        else if($id === 'ThProducts'){
            return view('admin.salary_details.th_products',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'SalaryDetails',
                'activeItem'=>'ThProducts'
            ]);
        }
        else if($id === 'ThFixedAssets'){
            return view('admin.salary_details.th_fixed_assets',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'SalaryDetails',
                'activeItem'=>'ThFixedAssets'
            ]);
        }
        else if($id === 'ThPurchases'){
            return view('admin.salary_details.th_purchases',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'SalaryDetails',
                'activeItem'=>'ThPurchases'
            ]);
        }
        else if($id === 'ThAdjustments'){
            return view('admin.salary_details.th_adjustments',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'SalaryDetails',
                'activeItem'=>'ThAdjustments' 
            ]);
        }
        else if($id === 'ThTransfers'){
            return view('admin.salary_details.th_transfers',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'SalaryDetails',
                'activeItem'=>'ThTransfers'
            ]);
        }else
            abort(404);
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
