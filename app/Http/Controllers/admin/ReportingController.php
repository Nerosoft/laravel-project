<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\language\admin\reporting\ContractsReports;
use App\language\admin\reporting\DelayedMoney;
use App\language\admin\reporting\AccountingReport;
use App\language\admin\reporting\NormalDoctorReport;
use App\language\admin\reporting\AllDoctorReport;
use App\language\admin\reporting\DoctorReport;
use App\language\admin\reporting\SupplierReport;
use App\language\admin\reporting\PurchasesReport;
use App\language\admin\reporting\InventoryReport;
use App\language\admin\reporting\ProductsReport;
use App\language\admin\reporting\WorkloadMonthly;
use App\language\admin\reporting\WorkloadDaily;
use App\language\admin\reporting\TestesBranchReport;
use App\language\admin\reporting\ExpensesReport;
use App\language\admin\reporting\CustodyReport;
use App\language\admin\reporting\ContractReport;
use App\language\admin\reporting\EmployeesReport;
use App\language\admin\reporting\RaysReport;
use App\language\admin\reporting\RaysCategoriesReport;
use App\language\admin\reporting\SafeTransferReport;
class ReportingController extends Controller
{
    public function index($id){
        $lang = $this->initLanguage($id);
        if($id === 'ContractsReports'){
            $view = view('admin.reporting.contracts_reports',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'DelayedMoney'){
            $view = view('admin.reporting.delayed_money',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'AccountingReport'){
            $view = view('admin.reporting.accounting_report',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'NormalDoctorReport'){
            $view = view('admin.reporting.normal_doctor_report',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'AllDoctorReport'){
            $view = view('admin.reporting.all_doctor_report',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'DoctorReport'){
            $view = view('admin.reporting.doctor_report',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'SupplierReport'){
            $view = view('admin.reporting.supplier_report',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'PurchasesReport'){
            $view = view('admin.reporting.purchases_report',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'InventoryReport'){
            $view = view('admin.reporting.inventory_report',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'ProductsReport'){
            $view = view('admin.reporting.products_report',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'WorkloadMonthly'){
            $view = view('admin.reporting.workload_monthly',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'WorkloadDaily'){
            $view = view('admin.reporting.workload_daily',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'TestesBranchReport'){
            $view = view('admin.reporting.testes_branch_report',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'ExpensesReport'){
            $view = view('admin.reporting.expenses_report',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'CustodyReport'){
            $view = view('admin.reporting.custody_report',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'ContractReport'){
            $view = view('admin.reporting.contract_report',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'EmployeesReport'){
            $view = view('admin.reporting.employees_report',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'RaysReport'){
            $view = view('admin.reporting.rays_report',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'RaysCategoriesReport'){
            $view = view('admin.reporting.rays_categories_report',[
                'lang'=> $lang,
                
            ]);
        }
        else if($id === 'SafeTransferReport'){
            $view = view('admin.reporting.safe_Transfer_report',[
                'lang'=> $lang,
                
            ]);
        }else
            abort(404);
        $lang->myMenuApp['Reporting']['active'] = 'my_active';
        $lang->myMenuApp['Reporting']['items'][$id]['active'] = 'my_active';
        return $view;
    }
    private function initLanguage($id){
        switch ($id) {
            case'ContractsReports':      
                return new ContractsReports();
            case'DelayedMoney':
                return new DelayedMoney();
            case'AccountingReport':
                return new AccountingReport();
            case'NormalDoctorReport':
                return new NormalDoctorReport();
            case'AllDoctorReport':
                return new AllDoctorReport();
            case'DoctorReport':
                return new DoctorReport();
            case'SupplierReport':
                return new SupplierReport();
            case'PurchasesReport':
                return new PurchasesReport();
            case'InventoryReport':
                return new InventoryReport();
            case'ProductsReport':
                return new ProductsReport();
            case'WorkloadMonthly':
                return new WorkloadMonthly();
            case'WorkloadDaily':
                return new WorkloadDaily();
            case'TestesBranchReport':
                return new TestesBranchReport();
            case'ExpensesReport':
                return new ExpensesReport();
            case'CustodyReport':
                return new CustodyReport();
            case'ContractReport':
                return new ContractReport();
            case'EmployeesReport':
                return new EmployeesReport();
            case'RaysReport':
                return new RaysReport();
            case'RaysCategoriesReport':
                return new RaysCategoriesReport();
            case'SafeTransferReport':
                return new SafeTransferReport();
            default :
                return null;
        }
    }
}
