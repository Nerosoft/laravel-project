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
            return view('admin.accounting.payment_methods',[
                'lang'=> $lang,
                'active'=>'Accounting',
                'activeItem'=>'PaymentMethods'
            ]);
        }
        else if($id === 'ExpenseCategories'){
            return view('admin.accounting.expense_categories',[
                'lang'=> $lang,
                'active'=>'Accounting',
                'activeItem'=>'ExpenseCategories'
            ]);
        }
        else if($id === 'ViewExpenses'){
            return view('admin.accounting.view_expenses',[
                'lang'=> $lang,
                'active'=>'Accounting',
                'activeItem'=>'ViewExpenses'
            ]);
        }
        else if($id === 'Expenses'){
            return view('admin.accounting.expenses',[
                'lang'=> $lang,
                'active'=>'Accounting',
                'activeItem'=>'Expenses'   
            ]);
        }else
            abort(404);
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
