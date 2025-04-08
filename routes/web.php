<?php                                           //ROUTE
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\patent\RaysController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ReceptionController;
use App\Http\Controllers\admin\MedicalReportsController;
use App\Http\Controllers\admin\TestCulturesController;
use App\Http\Controllers\admin\PriceListController;
use App\Http\Controllers\admin\ContractsController;
use App\Http\Controllers\admin\UserRolesController;
use App\Http\Controllers\admin\HREmployeesController;
use App\Http\Controllers\admin\SalaryDetailsController;
use App\Http\Controllers\admin\InventoryController;
use App\Http\Controllers\admin\AccountingController;
use App\Http\Controllers\admin\ReportingController;
use App\Http\Controllers\admin\SafeTransfersController;
use App\Http\Controllers\admin\MobileApplicationController;
use App\Http\Controllers\admin\NotificationsController;
use App\Http\Controllers\admin\HomeVisitsController;
use App\Http\Controllers\admin\WhatsappController;
use App\Http\Controllers\admin\BranchesController;
use App\Http\Controllers\admin\BranchesCustodyController;
use App\Http\Controllers\admin\SettingAppController;
use App\Http\Controllers\admin\ChatController;
use App\Http\Controllers\admin\TranslationsController;
use App\Http\Controllers\admin\ActivityLogsController;
use App\Http\Controllers\admin\ClearCacheController;

use App\Http\Middleware\IsLogin;
use App\Http\Middleware\EnsureTestValid;
use App\Http\Middleware\Auth;
use Illuminate\Http\Request;
use App\Models\Rays;
//patent
use App\Http\Controllers\patent\PatentReportsController;
use App\Http\Controllers\patent\TestsLibraryController;
use App\Http\Controllers\patent\PatentHomeVisitController;
use App\Http\Controllers\patent\PatentOurBranchesController;
//doctor
use App\Http\Controllers\doctor\DoctorDashboardController;
use App\Http\Controllers\doctor\DoctorInvoicesController;
use App\Http\Controllers\doctor\DoctorMedicalReportsController;
use App\Http\Controllers\doctor\TechnicalSupportsController;
use App\Http\Controllers\doctor\TheClearCacheController;
use App\Http\Controllers\doctor\TheDoctorReportController;

Route::controller(UserController::class)->group(function () {
    //all get
    //admin register and login
    Route::get('/admin/register', 'index')->middleware(Auth::class.':admin');
    Route::get('/admin/login', 'login')->middleware(Auth::class.':admin');
    Route::get('/admin/{id?}/login', 'login')->middleware(Auth::class.':admin');
    Route::get('/admin/{id?}/register', 'index')->middleware(Auth::class.':admin');
    //Doctor login
    Route::get('/doctor/login', 'doctor')->middleware(Auth::class.':doctor');
    Route::get('/doctor/{id?}/login', 'doctor')->middleware(Auth::class.':doctor');
    //patent login
    Route::get('/login', 'patent')->middleware(Auth::class.':patent');
    Route::get('/{id?}/login', 'patent')->middleware(Auth::class.':patent');
    //all post
    Route::post('/loginUser', 'loginUser')->name('loginUser.loginUser')->middleware(Auth::class.':admin');
    Route::post('/loginPatent', 'loginPatent')->name('loginPatent')->middleware(Auth::class.':patent');
    Route::post('/loginDoctor', 'loginDoctor')->name('loginDoctor')->middleware(Auth::class.':doctor');
    Route::post('/register', 'registerUser')->name('register.registerUser')->middleware(Auth::class.':admin');
    //dont use auth her
    Route::post('/language/{id}', 'changeLanguage')->name('language.changeLanguage');
});
Route::controller(DoctorDashboardController::class)->group(function () {
    Route::get('/doctor', 'index')->name('DoctorDashboard')->middleware(IsLogin::class.':doctor');
    Route::get('{id?}/doctor', 'index')->middleware(IsLogin::class.':doctor');
});
Route::controller(DoctorInvoicesController::class)->group(function () {
    Route::get('/doctor/doctorInvoices', 'index')->name('DoctorInvoices')->middleware(IsLogin::class.':doctor');
});
Route::controller(TheDoctorReportController::class)->group(function () {
    Route::get('/doctor/theDoctorReport', 'index')->name('TheDoctorReport')->middleware(IsLogin::class.':doctor');
});
Route::controller(TheClearCacheController::class)->group(function () {
    Route::get('/doctor/theClearCache', 'index')->name('TheClearCache')->middleware(IsLogin::class.':doctor');
});
Route::controller(TechnicalSupportsController::class)->group(function () {
    Route::get('/doctor/technicalSupports', 'index')->name('TechnicalSupports')->middleware(IsLogin::class.':doctor');
});
Route::controller(DoctorMedicalReportsController::class)->group(function () {
    Route::get('/medicalReports/{id}', 'index')->name('DoctorMedicalReports')->middleware(IsLogin::class.':doctor');
});
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', 'index')->name('Home')->middleware(IsLogin::class.':admin');
    Route::get('{id?}/admin', 'index')->middleware(IsLogin::class.':admin');
});
Route::controller(LanguageController::class)->group(function () {
    Route::get('/language/{lang}/{id?}', 'index')->name('Setting')->middleware(IsLogin::class.':admin');
    Route::post('/edit/{lang?}/{id?}/{name?}/{item?}', 'editAllLanguage')->name('edit.editAllLanguage')->middleware(IsLogin::class.':admin');
    Route::post('/changeLanguage', 'changeLanguage')->name('language.change')->middleware(IsLogin::class.':admin');
    Route::post('/copyLanguage', 'copyLanguage')->name('language.copy')->middleware(IsLogin::class.':admin');
    Route::post('/deleteLanguage', 'deleteLanguage')->name('language.delete')->middleware(IsLogin::class.':admin');
});
//all route admin
//Reception
Route::post('/submit-form', [ReceptionController::class, 'submitForm'])->name('form.submit');
Route::controller(ReceptionController::class)->group(function () {
    Route::get('/reception/{id?}', 'index')->name('Reception')->middleware(IsLogin::class.':admin');
    Route::post('/createPatent', 'createPatent')->name('createPatent')->middleware(IsLogin::class.':admin');
    Route::post('/editPatent', 'editPatent')->name('editPatent')->middleware(IsLogin::class.':admin');
    Route::post('/deletePatent', 'deletePatent')->name('deletePatent')->middleware(IsLogin::class.':admin');
    Route::post('/createKnows', 'createKnows')->name('createKnows')->middleware(IsLogin::class.':admin');
    Route::post('/editKnows', 'editKnows')->name('editKnows')->middleware(IsLogin::class.':admin');
    Route::post('/deleteKnows', 'deleteKnows')->name('deleteKnows')->middleware(IsLogin::class.':admin');
    Route::post('/createPatientServices', 'createPatientServices')->name('createPatientServices')->middleware(IsLogin::class.':admin');
    Route::post('/editPatientServices', 'editPatientServices')->name('editPatientServices')->middleware(IsLogin::class.':admin');
    Route::post('/deletePatientServices', 'deletePatientServices')->name('deletePatientServices')->middleware(IsLogin::class.':admin');
});
//MedicalReports
Route::controller(MedicalReportsController::class)->group(function () {
    Route::get('/medical_reports/{id?}', 'index')->name('MedicalReports')->middleware(IsLogin::class.':admin');
});
//TestCultures
Route::controller(TestCulturesController::class)->group(function () {
    Route::get('/testCultures/{id?}', 'index')->name('TestCultures')->middleware(IsLogin::class.':admin');
    Route::post('/createTest/{id?}', 'createTest')->name('createTest')->middleware([IsLogin::class.':admin', EnsureTestValid::class]);
    Route::post('/editTest/{id?}', 'editTest')->name('editTest')->middleware([IsLogin::class.':admin', EnsureTestValid::class]);
    Route::post('/deleteTest/{id?}', 'deleteTest')->name('deleteTest')->middleware([IsLogin::class.':admin', EnsureTestValid::class]);
    Route::post('/createCurrentOffers', 'createCurrentOffers')->name('createCurrentOffers')->middleware(IsLogin::class.':admin');
    Route::post('/editCurrentOffers', 'editCurrentOffers')->name('editCurrentOffers')->middleware(IsLogin::class.':admin');
    Route::post('/deleteCurrentOffers', 'deleteCurrentOffers')->name('deleteCurrentOffers')->middleware(IsLogin::class.':admin');
});
//PriceList
Route::controller(PriceListController::class)->group(function () {
    Route::get('/priceList/{id?}', 'index')->name('PriceList')->middleware(IsLogin::class.':admin');
});
//Contracts
Route::controller(ContractsController::class)->group(function () {
    Route::get('/contracts/{id?}', 'index')->name('Contracts')->middleware(IsLogin::class.':admin');
    Route::post('/createContract', 'createContract')->name('createContract')->middleware(IsLogin::class.':admin');
    Route::post('/editContract', 'editContract')->name('editContract')->middleware(IsLogin::class.':admin');
    Route::post('/deleteContract', 'deleteContract')->name('deleteContract')->middleware(IsLogin::class.':admin');
});
//UserRoles
Route::controller(UserRolesController::class)->group(function () {
    Route::get('/userRoles/{id?}', 'index')->name('UserRoles')->middleware(IsLogin::class.':admin');
});
//HREmployees
Route::controller(HREmployeesController::class)->group(function () {
    Route::get('/hrEmployees/{id?}', 'index')->name('HREmployees')->middleware(IsLogin::class.':admin');
});
//SalaryDetails
Route::controller(SalaryDetailsController::class)->group(function () {
    Route::get('/salaryDetails/{id?}', 'index')->name('SalaryDetails')->middleware(IsLogin::class.':admin');
});
//Inventory
Route::controller(InventoryController::class)->group(function () {
    Route::get('/inventory/{id?}', 'index')->name('Inventory')->middleware(IsLogin::class.':admin');
});
//Accounting
Route::controller(AccountingController::class)->group(function () {
    Route::get('/accounting/{id?}', 'index')->name('Accounting')->middleware(IsLogin::class.':admin');
});
//Reporting
Route::controller(ReportingController::class)->group(function () {
    Route::get('/reporting/{id?}', 'index')->name('Reporting')->middleware(IsLogin::class.':admin');
});
//SafeTransfers
Route::controller(SafeTransfersController::class)->group(function () {
    Route::get('/safeTransfers/{id?}', 'index')->name('SafeTransfers')->middleware(IsLogin::class.':admin');
});
//MobileApplication
Route::controller(MobileApplicationController::class)->group(function () {
    Route::get('/mobileApplication/{id?}', 'index')->name('MobileApplication')->middleware(IsLogin::class.':admin');
});
//Notifications
Route::controller(NotificationsController::class)->group(function () {
    Route::get('/notifications/{id?}', 'index')->name('Notifications')->middleware(IsLogin::class.':admin');
});
//HomeVisits
Route::controller(HomeVisitsController::class)->group(function () {
    Route::get('/homeVisits/{id?}', 'index')->name('HomeVisits')->middleware(IsLogin::class.':admin');
});
//PatentReports
Route::controller(PatentReportsController::class)->group(function () {
    Route::get('/reports', 'index')->name('PatentReports')->middleware(IsLogin::class.':patent');
});
//TestsLibrary
Route::controller(TestsLibraryController::class)->group(function () {
    Route::get('/testslibrary', 'index')->name('TestsLibrary')->middleware(IsLogin::class.':patent');
});
//PatentHomeVisit
Route::controller(PatentHomeVisitController::class)->group(function () {
    Route::get('/homevisit', 'index')->name('PatentHomeVisit')->middleware(IsLogin::class.':patent');
});
//PatentOurBranches
Route::controller(PatentOurBranchesController::class)->group(function () {
    Route::get('/ourbranches', 'index')->name('PatentOurBranches')->middleware(IsLogin::class.':patent');
});
//Whatsapp
Route::controller(WhatsappController::class)->group(function () {
    Route::get('/whatsapp', 'index')->name('Whatsapp')->middleware(IsLogin::class.':admin');    
});
//Branches
Route::controller(BranchesController::class)->group(function () {
    Route::get('/branches', 'index')->name('Branches')->middleware(IsLogin::class.':admin');
    Route::post('/addBranchRays', 'newBranchRays')->name('addBranchRays')->middleware(IsLogin::class.':admin');
    Route::post('/editBranchRays', 'editBranchRays')->name('editBranchRays')->middleware(IsLogin::class.':admin');
    Route::post('/deleteBranchRays', 'deleteBranchRays')->name('deleteBranchRays')->middleware(IsLogin::class.':admin');
});
//BranchesCustody
Route::controller(BranchesCustodyController::class)->group(function () {
    Route::get('/branchesCustody', 'index')->name('BranchesCustody')->middleware(IsLogin::class.':admin');
});
//SettingApp
Route::controller(SettingAppController::class)->group(function () {
    Route::get('/settingApp', 'index')->name('SettingApp')->middleware(IsLogin::class.':admin');
});
//Chat
Route::controller(ChatController::class)->group(function () {
    Route::get('/chat', 'index')->name('Chat')->middleware(IsLogin::class.':admin');
});
//Translations
Route::controller(TranslationsController::class)->group(function () {
    Route::get('/translations', 'index')->name('Translations')->middleware(IsLogin::class.':admin');
});
//ActivityLogs
Route::controller(ActivityLogsController::class)->group(function () {
    Route::get('/activityLogs', 'index')->name('ActivityLogs')->middleware(IsLogin::class.':admin');
});
//ClearCache
Route::controller(ClearCacheController::class)->group(function () {
    Route::get('/clearCache', 'index')->name('ClearCache')->middleware(IsLogin::class.':admin');
});
//all logout admin and doctor and admin
Route::controller(LogoutController::class)->group(function () {
    Route::get('/logout', 'logoutPatent')->name('logoutPatent')->middleware(IsLogin::class.':patent');
    Route::get('/doctor/logout', 'logoutDoctor')->name('logoutDoctor')->middleware(IsLogin::class.':doctor');
    Route::get('/admin/logout', 'logoutAdmin')->name('admin.logout')->middleware(IsLogin::class.':admin');
});
Route::get('/{id}/branchMain', function ($id) {
    $model = Rays::find($id);
    if($model && $model->_id === $id || $model && $model->AppId === request()->session()->get('userLogout') && $model->_id === $id){
        request()->session()->put('userId', $id);
        return back();  
    }
    else{
        $model = Rays::find(request()->session()->get('userId'));
        return back()->withErrors($model[$model['Setting']['Language']]['Error']['BranchInvalid']);
    }
})->name('branchMain')->middleware(IsLogin::class.':admin');

Route::get('/test', function () {
    return view('test');
});
//Dashboard
Route::controller(RaysController::class)->group(function () {
    Route::get('/{id?}', 'index')->name('PatentDashboard')->middleware(IsLogin::class.':patent');
});
//make variable names and ar view and setup app importaint.
//make button create test and save in all branch or chose option branch to add test value