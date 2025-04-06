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
            return view('admin.reporting.contracts_reports',[
                'lang'=> $lang,
                'active'=>'Reporting',
                'activeItem'=>'ContractsReports'
            ]);
        }
        else if($id === 'DelayedMoney'){
            return view('admin.reporting.delayed_money',[
                'lang'=> $lang,
                'active'=>'Reporting',
                'activeItem'=>'DelayedMoney'
            ]);
        }
        else if($id === 'AccountingReport'){
            return view('admin.reporting.accounting_report',[
                'lang'=> $lang,
                'active'=>'Reporting',
                'activeItem'=>'AccountingReport'
            ]);
        }
        else if($id === 'NormalDoctorReport'){
            return view('admin.reporting.normal_doctor_report',[
                'lang'=> $lang,
                'active'=>'Reporting',
                'activeItem'=>'NormalDoctorReport'
            ]);
        }
        else if($id === 'AllDoctorReport'){
            return view('admin.reporting.all_doctor_report',[
                'lang'=> $lang,
                'active'=>'Reporting',
                'activeItem'=>'AllDoctorReport'
            ]);
        }
        else if($id === 'DoctorReport'){
            return view('admin.reporting.doctor_report',[
                'lang'=> $lang,
                'active'=>'Reporting',
                'activeItem'=>'DoctorReport'
            ]);
        }
        else if($id === 'SupplierReport'){
            return view('admin.reporting.supplier_report',[
                'lang'=> $lang,
                'active'=>'Reporting',
                'activeItem'=>'SupplierReport'
            ]);
        }
        else if($id === 'PurchasesReport'){
            return view('admin.reporting.purchases_report',[
                'lang'=> $lang,
                'active'=>'Reporting',
                'activeItem'=>'PurchasesReport'
            ]);
        }
        else if($id === 'InventoryReport'){
            return view('admin.reporting.inventory_report',[
                'lang'=> $lang,
                'active'=>'Reporting',
                'activeItem'=>'InventoryReport'
            ]);
        }
        else if($id === 'ProductsReport'){
            return view('admin.reporting.products_report',[
                'lang'=> $lang,
                'active'=>'Reporting',
                'activeItem'=>'ProductsReport'
            ]);
        }
        else if($id === 'WorkloadMonthly'){
            return view('admin.reporting.workload_monthly',[
                'lang'=> $lang,
                'active'=>'Reporting',
                'activeItem'=>'WorkloadMonthly'
            ]);
        }
        else if($id === 'WorkloadDaily'){
            return view('admin.reporting.workload_daily',[
                'lang'=> $lang,
                'active'=>'Reporting',
                'activeItem'=>'WorkloadDaily'
            ]);
        }
        else if($id === 'TestesBranchReport'){
            return view('admin.reporting.testes_branch_report',[
                'lang'=> $lang,
                'active'=>'Reporting',
                'activeItem'=>'TestesBranchReport'
            ]);
        }
        else if($id === 'ExpensesReport'){
            return view('admin.reporting.expenses_report',[
                'lang'=> $lang,
                'active'=>'Reporting',
                'activeItem'=>'ExpensesReport'
            ]);
        }
        else if($id === 'CustodyReport'){
            return view('admin.reporting.custody_report',[
                'lang'=> $lang,
                'active'=>'Reporting',
                'activeItem'=>'CustodyReport'
            ]);
        }
        else if($id === 'ContractReport'){
            return view('admin.reporting.contract_report',[
                'lang'=> $lang,
                'active'=>'Reporting',
                'activeItem'=>'ContractReport'
            ]);
        }
        else if($id === 'EmployeesReport'){
            return view('admin.reporting.employees_report',[
                'lang'=> $lang,
                'active'=>'Reporting',
                'activeItem'=>'EmployeesReport'
            ]);
        }
        else if($id === 'RaysReport'){
            return view('admin.reporting.rays_report',[
                'lang'=> $lang,
                'active'=>'Reporting',
                'activeItem'=>'RaysReport'
            ]);
        }
        else if($id === 'RaysCategoriesReport'){
            return view('admin.reporting.rays_categories_report',[
                'lang'=> $lang,
                'active'=>'Reporting',
                'activeItem'=>'RaysCategoriesReport'
            ]);
        }
        else if($id === 'SafeTransferReport'){
            return view('admin.reporting.safe_Transfer_report',[
                'lang'=> $lang,
                'active'=>'Reporting',
                'activeItem'=>'SafeTransferReport'
            ]);
        }else
            abort(404);
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
