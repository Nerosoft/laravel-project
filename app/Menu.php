<?php

namespace App;
use App\MenuItem;
class Menu
{
    private $Home;
    private $SystemLang;
    private $ChangeLanguage;
    private $Reception;
    private $TestCultures;
    private $Contracts;
    private $Branches;
    /**
     * Create a new class instance.
     */
    public function __construct($menu, $state = null, $CutomLang = null, $MyLanguage = null)
    {
        if($state === 'Language'){
            $this->Home = $menu['Home'];
            $this->SystemLang = $menu['SystemLang'];
            foreach ($MyLanguage as $key => $value)
                $this->CustomMenu[$key] = new MenuItem($value, $CutomLang);
        }
        else{
            // $this->Setting = new MenuItem($menu['Setting']['Name'],  $menu['Setting']['Item']);
            $this->ChangeLanguage = $menu['ChangeLanguage'];
            $this->SystemLang = $menu['SystemLang'];
            $this->Home = $menu['Home'];
            $this->Reception = new MenuItem($menu['Reception']['Name'], $menu['Reception']['Item']);
            $this->TestCultures = new MenuItem($menu['TestCultures']['Name'], $menu['TestCultures']['Item']);
            $this->Contracts = new MenuItem($menu['Contracts']['Name'], $menu['Contracts']['Item']);
            $this->Branches = $menu['Branches'];
        }
    }
    public function getMenu(){
        return array_filter(get_object_vars($this), function ($value) {
            return !is_null($value);
        });
    }
    public function getIconByKey($key){
        if($key === 'Setting')
                return 'bi bi-gear';
        else if($key === 'ChangeLanguage')
            return 'bi bi-globe-asia-australia';
        else if($key === 'Home')
            return 'bi bi-box-arrow-left';
        else if($key === 'Reception')
            return 'bi bi-person-video';
        else if($key === 'Vault')
            return 'bi bi-lock';
        else if($key === 'Invoices')
            return 'bi bi-file-earmark-text';
        else if($key === 'PatientRegisteration')
            return 'bi bi-person-add';
        else if($key === 'Retrieved')
            return 'bi bi-file-earmark-arrow-up';
        else if($key === 'Patients')
            return 'bi bi-people-fill';
        else if($key === 'Prefix')
            return 'bi bi-box-arrow-up';
        else if($key === 'Knows')
            return 'bi bi-lightbulb';
        else if($key === 'MedicalReports')
            return 'bi bi-file-earmark-medical';
        else if($key === 'AllMedicalReports')
            return 'bi bi-file-earmark-medical';
        else if($key === 'DoneReports')
            return 'bi bi-clipboard-check';
        else if($key === 'PendingReports')
            return 'bi bi-clock';
        else if($key === 'UnsigendReports')
            return 'bi bi-clipboard-x';
        else if($key === 'SendToLab')
            return 'bi bi-eyedropper';
        else if($key === 'SampleStatus')
            return 'bi bi-activity';
        else if($key === 'TestCultures')
            return 'bi bi-pencil-square';
        else if($key === 'Categories')
            return 'bi bi-list-ul';
        else if($key === 'AllTestCultures')
            return 'bi bi-pencil-square';
        else if($key === 'SampleTypes')
            return 'bi bi-gender-trans';
        else if($key === 'TheCultures')
            return 'bi bi-globe';
        else if($key === 'CultureOptions')
            return 'bi bi-globe2';
        else if($key === 'Antibiotics')
            return 'bi bi-capsule';
        else if($key === 'PackagesCultures')
            return 'bi bi-box';
        else if($key === 'ExtraService')
            return 'bi bi-telephone';
        else if($key === 'CurrentOffers')
            return 'bi bi-percent';
        else if($key === 'PriceList')
            return 'bi bi-list';
        else if($key === 'Test')
            return 'bi bi-pencil';
        else if($key === 'CulturesPrice')
            return 'bi bi-globe';
        else if($key === 'Packages')
            return 'bi bi-box';
        else if($key === 'PricesList')
            return 'bi bi-list-ul';
        else if($key === 'Contracts')
            return 'bi bi-pencil';
        else if($key === 'Governments')
            return 'bi bi-bank';
        else if($key === 'TheContracts')
            return 'bi bi-pencil';
        else if($key === 'PackagesContracts')
            return 'bi bi-box';
        else if($key === 'PricesListContracts')
            return 'bi bi-list-ul';
        else if($key === 'Labs')
            return 'bi bi-eyedropper';
        else if($key === 'LabsOut')
            return 'bi bi-eyedropper';
        else if($key === 'Doctors')
            return 'bi bi-person';
        else if($key === 'UserRoles')
            return 'bi bi-people';
        else if($key === 'Roles')
            return 'bi bi-gear';
        else if($key === 'User')
            return 'bi bi-person';
        else if($key === 'HREmployees')
            return 'bi bi-person';
        else if($key === 'Employees')
            return 'bi bi-person';
        else if($key === 'Violations')
            return 'bi bi-exclamation-triangle';
        else if($key === 'Vocations')
            return 'bi bi-tools';
        else if($key === 'Incentives')
            return 'bi bi-currency-dollar';
        else if($key === 'Deductions')
            return 'bi bi-scissors';
        else if($key === 'Attendance')
            return 'bi bi-person-fill-check';
        else if($key === 'Shifts')
            return 'bi bi-clock';
        else if($key === 'SalaryDetails')
            return 'bi bi-currency-dollar';
        else if($key === 'Salary')
            return 'bi bi-currency-dollar';
        else if($key === 'ThInventory')
            return 'bi bi-boxes';
        else if($key === 'ThSuppliers')
            return 'bi bi-cart4';
        else if($key === 'ThProducts')
            return 'bi bi-box2';
        else if($key === 'ThFixedAssets')
            return 'bi bi-building-check';
        else if($key === 'ThPurchases')
            return 'bi bi-cart4';
        else if($key === 'ThAdjustments')
            return 'bi bi-sliders';
        else if($key === 'ThTransfers')
            return 'bi bi-arrow-left-right';
        else if($key === 'Inventory')
            return 'bi bi-boxes';
        else if($key === 'Suppliers')
            return 'bi bi-cart4';
        else if($key === 'Products')
            return 'bi bi-box2';
        else if($key === 'FixedAssets')
            return 'bi bi-building-check';
        else if($key === 'Purchases')
            return 'bi bi-cart4';
        else if($key === 'Adjustments')
            return 'bi bi-sliders';
        else if($key === 'Transfers')
            return 'bi bi-arrow-left-right';
        else if($key === 'Accounting')
            return 'bi bi-calculator';
        else if($key === 'PaymentMethods')
            return 'bi bi-pencil';
        else if($key === 'ExpenseCategories')
            return 'bi bi-currency-dollar';
        else if($key === 'ViewExpenses')
            return 'bi bi-currency-dollar';
        else if($key === 'Expenses')
            return 'bi bi-currency-dollar';
        else if($key === 'Reporting')
            return 'bi bi-bar-chart-line';
        else if($key === 'ContractsReports')
            return 'bi bi-pen';
        else if($key === 'DelayedMoney')
            return 'bi bi-currency-dollar';
        else if($key === 'AccountingReport')
            return 'bi bi-calculator';
        else if($key === 'NormalDoctorReport')
            return 'bi bi-person';
        else if($key === 'AllDoctorReport')
            return 'bi bi-person';
        else if($key === 'DoctorReport')
            return 'bi bi-person';
        else if($key === 'SupplierReport')
            return 'bi bi-cart4';
        else if($key === 'PurchasesReport')
            return 'bi bi-cart4';
        else if($key === 'InventoryReport')
            return 'bi bi-boxes';
        else if($key === 'ProductsReport')
            return 'bi bi-box2';
        else if($key === 'WorkloadMonthly')
            return 'bi bi-lightning';
        else if($key === 'WorkloadDaily')
            return 'bi bi-lightning';
        else if($key === 'TestesBranchReport')
            return 'bi bi-hospital';
        else if($key === 'ExpensesReport')
            return 'bi bi-currency-dollar';
        else if($key === 'CustodyReport')
            return 'bi bi-person-arms-up';
        else if($key === 'ContractReport')
            return 'bi bi-pen';
        else if($key === 'EmployeesReport')
            return 'bi bi-person';
        else if($key === 'RaysReport')
            return 'bi bi-sun';
        else if($key === 'RaysCategoriesReport')
            return 'bi bi-sun';
        else if($key === 'SafeTransferReport')
            return 'bi bi-clipboard2-check';
        else if($key === 'SafeTransfers')
            return 'bi bi-clipboard2-check';
        else if($key === 'RejectedTransfers')
            return 'bi bi-clipboard-x';
        else if($key === 'TransferToOwner')
            return 'bi bi-clipboard2-pulse';
        else if($key === 'AllTransfers')
            return 'bi bi-clipboard-data';
        else if($key === 'MobileApplication')
            return 'bi bi-phone';
        else if($key === 'TipsAndOffer')
            return 'bi bi-lightbulb';
        else if($key === 'StaticPage')
            return 'bi bi-file-text';
        else if($key === 'Sliders')
            return 'bi bi-sliders';
        else if($key === 'Notifications')
            return 'bi bi-bell';
        else if($key === 'Notification')
            return 'bi bi-bell';
        else if($key === 'CreateNotifications')
            return 'bi bi-bell';
        else if($key === 'Whatsapp')
            return 'bi bi-whatsapp';
        else if($key === 'HomeVisits')
            return 'bi bi-house';
        else if($key === 'HomeVisit')
            return 'bi bi-house';
        else if($key === 'Bookings')
            return 'bi bi-calendar2-check';
        else if($key === 'Prescriptions')
            return 'bi bi-capsule';
        else if($key === 'Branches')
            return 'bi bi-hospital';
        else if($key === 'BranchesCustody')
            return 'bi bi-building';
        else if($key === 'SettingApp')
            return 'bi bi-gear';
        else if($key === 'Chat')
            return 'bi bi-chat';
        else if($key === 'Translations')
            return 'bi bi-translate';
        else if($key === 'ActivityLogs')
            return 'bi bi-clock-history';
        else if($key === 'ClearCache')
            return 'bi bi-trash3';
        else if($key === 'PatentDashboard')
            return 'bi bi-house-door';
        else if($key === 'PatentReports')
            return 'bi bi-pen';
        else if($key === 'TestsLibrary')
            return 'bi bi-pencil-square';
        else if($key === 'PatentHomeVisit')
            return 'bi bi-house';
        else if($key === 'PatentOurBranches')
            return 'bi bi-hospital';
        else if($key === 'DoctorDashboard')
            return 'bi bi-house-door';
        else if($key === 'DoctorInvoices')
            return 'bi bi-file-earmark-text';
        else if($key === 'DoctorMedicalReports')
            return 'bi bi-file-earmark-medical';
        else if($key === 'TheAllMedicalReports')
            return 'bi bi-file-earmark-medical';
        else if($key === 'TheDoneReports')
            return 'bi bi-clipboard-check';
        else if($key === 'ThePendingReports')
            return 'bi bi-clock';
        else if($key === 'TheUnsignedReports')
            return 'bi bi-clipboard-x';
        else if($key === 'TheDoctorReport')
            return 'bi bi-file-earmark-medical';
        else if($key === 'TheClearCache')
            return 'bi bi-trash3';
        else if($key === 'TechnicalSupports')
            return 'bi bi-headset';
        else if($key === 'Direction')
            return 'bi bi-arrow-left-right';
        else if($key === 'Label')
            return 'bi bi-file-richtext';
        else if($key === 'Title')
            return 'bi bi-globe-asia-australia';
        else if($key === 'Hint')
            return 'bi bi-lightbulb-fill';
        else if($key === 'SelectBox')
            return 'bi bi-cart4';
        else if($key === 'Button')
            return 'bi bi-fonts';
        else if($key === 'AllNamesLanguage')
            return 'bi bi-globe-europe-africa';
        else if($key === 'Menu')
            return 'bi bi-menu-button-fill';
        else if($key === 'Error')
            return 'bi bi-clipboard2-x-fill';
        else if($key === 'Message')
            return 'bi bi-clipboard2-check-fill';
        else if($key === 'Table')
            return 'bi bi-table';
        else if($key === 'Model')
            return 'bi bi-layout-text-sidebar';
        else if($key === 'Html')
            return 'bi bi-table';
        else if($key === 'AllLanguage')
            return 'bi bi-globe-americas';
        else if($key === 'CheckBox')
            return 'bi bi-clipboard2-check';
        else if($key === 'MenuAdmin')
            return 'bi bi-clipboard2-check';
        else if($key === 'CutomLang')
            return 'bi bi-clipboard2-check';
        else if($key === 'TitleCustomLang')
            return 'bi bi-clipboard2-check';
        else if($key === 'TableInfo')
            return 'bi bi-clipboard2-check';
        else if($key === 'AppSettingAdmin')
            return 'bi bi-clipboard2-check';
        else if($key === 'AppSettingPatient')
            return 'bi bi-clipboard2-check';
        else if($key === 'AppSettingDoctor')
            return 'bi bi-clipboard2-check';
        else if($key === 'SelectTestBox')
            return 'bi bi-clipboard2-check';
        else if($key === 'SelectOfferBox')
            return 'bi bi-clipboard2-check';
        else if($key === 'SelectBranchBox')
            return 'bi bi-clipboard2-check';
        else if($key === 'SelectNationalityBox')
            return 'bi bi-clipboard2-check';
        else if($key === 'SelectGenderBox')
            return 'bi bi-clipboard2-check';
        else if($key === 'PaymentMethodBox')
            return 'bi bi-clipboard2-check';
        else
            return 'bi bi-clipboard2-check';
    }
}
