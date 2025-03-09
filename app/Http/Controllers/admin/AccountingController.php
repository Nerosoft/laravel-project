<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use App\language\admin\accounting\PaymentMethods;
use App\language\admin\accounting\ExpenseCategories;
use App\language\admin\accounting\ViewExpenses;
use App\language\admin\accounting\Expenses;
class AccountingController extends Controller
{
    public function index($id){
        $lang = $this->initLanguage($id);
        if($id === 'PaymentMethods'){
            $view = view('admin.accounting.payment_methods',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'ExpenseCategories'){
            $view = view('admin.accounting.expense_categories',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'ViewExpenses'){
            $view = view('admin.accounting.view_expenses',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'Expenses'){
            $view = view('admin.accounting.expenses',[
                'lang'=> $lang,   
            ]);
        }else
            abort(404);
        $lang->myMenuApp['Accounting']['active'] = 'my_active';
        $lang->myMenuApp['Accounting']['items'][$id]['active'] = 'my_active';
        return $view;
    }
    private function initLanguage($id){
        switch ($id) {
            case'PaymentMethods':      
                return new PaymentMethods();
            case'ExpenseCategories':
                return new ExpenseCategories();
            case'ViewExpenses':
                return new ViewExpenses();
            case'Expenses':
                return new Expenses();
            default :
                return null;
        }
    }
}
