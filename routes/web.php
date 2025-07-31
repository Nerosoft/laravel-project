<?php                                           //ROUTE
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\SystemLangController;
use App\Http\Controllers\admin\LangController;
use App\Http\Controllers\auth\LoginAdminController;
use App\Http\Controllers\auth\RegisterAdminController;
use App\Http\Controllers\auth\ChangeLanguageController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\TestCulturesController;

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
    Route::post('/deleteBranch', 'makeDeleteMyBranch')->name('branch.delete')->middleware(IsLogin::class.':admin');
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
//TestCultures
Route::controller(TestCulturesController::class)->group(function () {
    Route::get('/testCultures/{id?}', 'index')->name('TestCultures')->middleware(IsLogin::class.':test');
    Route::post('/createTest/{id?}', 'makeAddTest')->name('createTest')->middleware(IsLogin::class.':test');
    Route::post('/editTest/{id?}', 'makeEditTest')->name('editTest')->middleware(IsLogin::class.':test');
});
//Branches
Route::controller(BranchesController::class)->group(function () {
    Route::get('/branches', 'index')->name('Branches')->middleware(IsLogin::class.':admin');
    Route::post('/addBranchRays', 'makeAddBranch')->name('addBranchRays')->middleware(IsLogin::class.':admin');
    Route::post('/editBranchRays', 'makeEditBranch')->name('editBranchRays')->middleware(IsLogin::class.':admin');
});
Route::controller(DeleteController::class)->group(function () {
    Route::post('/deleteItem/{id?}', 'action')->name('deleteItem')->middleware(IsLogin::class.':test');
});
//all logout admin and doctor and admin
Route::controller(LogoutController::class)->group(function () {
    Route::get('/admin/logout', 'logoutAdmin')->name('admin.logout')->middleware(IsLogin::class.':admin');
});
//make variable names and ar view and setup app importaint.
//make button create test and save in all branch or chose option branch to add test value