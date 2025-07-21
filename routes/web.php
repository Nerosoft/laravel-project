<?php                                           //ROUTE
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\KnowController;
use App\Http\Controllers\admin\PatientController;
use App\Http\Controllers\admin\SystemLangController;
use App\Http\Controllers\admin\LangController;
use App\Http\Controllers\auth\LoginAdminController;
use App\Http\Controllers\auth\RegisterAdminController;
use App\Http\Controllers\auth\ChangeLanguageController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ReceptionController;
use App\Http\Controllers\admin\TestCulturesController;
use App\Http\Controllers\admin\ContractsController;

use App\Http\Controllers\admin\BranchesController;
use App\Http\Controllers\DeleteController;
use App\instance\admin\Branch;

use App\Http\Middleware\IsLogin;
use App\Http\Middleware\Auth;
use Illuminate\Http\Request;
use App\Models\Rays;


Route::controller(ChangeLanguageController::class)->group(function () {
    Route::post('/branchMain', 'makeChangeBranch')->name('branchMain')->middleware(IsLogin::class.':admin');
    Route::post('/language', 'makeChangeAuthLang')->name('language.changeLanguage')->middleware(Auth::class.':admin');
    Route::post('/changeLanguage', 'makeChangeMyLanguage')->name('language.change')->middleware(IsLogin::class.':admin');
    Route::post('/deleteLanguage', 'makeDeleteMyLanguage')->name('language.delete')->middleware(IsLogin::class.':admin');

});
Route::controller(LoginAdminController::class)->group(function () {
    Route::get('/admin/login', 'index')->middleware(Auth::class.':admin');
    Route::get('/admin/{id?}/login', 'index')->middleware(Auth::class.':admin');
    Route::post('/loginUser', 'makeLogin')->name('loginUser.loginUser')->middleware(Auth::class.':admin');
});
Route::controller(RegisterAdminController::class)->group(function () {
    Route::get('/admin/register', 'index')->middleware(Auth::class.':admin');
    Route::get('/admin/{id?}/register', 'index')->middleware(Auth::class.':admin');
    Route::post('/register', 'makeRegister')->name('register.registerUser')->middleware(Auth::class.':admin');
});
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', 'index')->name('Home')->middleware(IsLogin::class.':admin');
});
Route::controller(SystemLangController::class)->group(function () {
    Route::get('/system/language/{lang?}/{id?}', 'index')->name('SystemLang')->middleware(IsLogin::class.':admin');
    Route::post('/edit/{lang?}/{id?}/{name?}/{item?}', 'makeEditLanguage')->name('edit.editAllLanguage')->middleware(IsLogin::class.':admin');
});
Route::controller(LangController::class)->group(function () {
    Route::get('/ChangeLanguage', 'index')->name('ChangeLanguage')->middleware(IsLogin::class.':admin');
    Route::post('/newLanguage', 'makeAddLanguage')->name('lang.createLanguage')->middleware(IsLogin::class.':admin');
    Route::post('/copyLanguage', 'makeCopyLanguage')->name('language.copy')->middleware(IsLogin::class.':admin');
});
//all route admin
//Reception
Route::controller(ReceptionController::class)->group(function () {
    Route::get('/reception', 'index')->name('Receipt')->middleware(IsLogin::class.':admin');
    Route::post('/createPatientServices', 'makeAddReceipt')->name('createPatientServices')->middleware(IsLogin::class.':admin');
    Route::post('/editPatientServices', 'makeEditReceipt')->name('editPatientServices')->middleware(IsLogin::class.':admin');
});
Route::controller(PatientController::class)->group(function () {
    Route::get('/patent', 'index')->name('Patent')->middleware(IsLogin::class.':admin');
    Route::post('/createPatent', 'makeAddPatent')->name('createPatent')->middleware(IsLogin::class.':admin');
    Route::post('/editPatent', 'makeEditPatent')->name('editPatent')->middleware(IsLogin::class.':admin');
});
//TestCultures
Route::controller(TestCulturesController::class)->group(function () {
    Route::get('/testCultures/{id?}', 'index')->name('TestCultures')->middleware(IsLogin::class.':test');
    Route::post('/createTest/{id?}', 'makeAddTest')->name('createTest')->middleware(IsLogin::class.':test');
    Route::post('/editTest/{id?}', 'makeEditTest')->name('editTest')->middleware(IsLogin::class.':test');
});
//Contracts
Route::controller(ContractsController::class)->group(function () {
    Route::get('/mycontracts', 'index')->name('Contracts')->middleware(IsLogin::class.':admin');
    Route::post('/createContract', 'makeAddContracts')->name('createContract')->middleware(IsLogin::class.':admin');
    Route::post('/editContract', 'makeEditContracts')->name('editContract')->middleware(IsLogin::class.':admin');
});
Route::controller(KnowController::class)->group(function () {
    Route::get('/myknow', 'index')->name('Knows')->middleware(IsLogin::class.':admin');
    Route::post('/createKnows', 'makeAddKnow')->name('createKnows')->middleware(IsLogin::class.':admin');
    Route::post('/editKnows', 'makeEditKnow')->name('editKnows')->middleware(IsLogin::class.':admin');
});
//Branches
Route::controller(BranchesController::class)->group(function () {
    Route::get('/branches', 'index')->name('Branches')->middleware(IsLogin::class.':admin');
    Route::post('/addBranchRays', 'makeAddBranch')->name('addBranchRays')->middleware(IsLogin::class.':admin');
    Route::post('/editBranchRays', 'makeEditBranch')->name('editBranchRays')->middleware(IsLogin::class.':admin');
});
Route::controller(DeleteController::class)->group(function () {
    Route::post('/deleteItem/{id?}', 'action')->name('deleteItem')->middleware(IsLogin::class.':admin');
});
//all logout admin and doctor and admin
Route::controller(LogoutController::class)->group(function () {
    Route::get('/admin/logout', 'logoutAdmin')->name('admin.logout')->middleware(IsLogin::class.':admin');
});
//make variable names and ar view and setup app importaint.
//make button create test and save in all branch or chose option branch to add test value