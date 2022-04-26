<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Users\AdminController;
use App\Http\Controllers\Users\CashierController;
use App\Http\Controllers\Users\OwnerController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/track-laundry', 'trackLaundry')->name('track.laundry');
    Route::get('/contact', 'contact')->name('contact');
});

Auth::routes(['register' => false, 'reset' => false, 'verify' => false, 'confirm' => false]);

Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::get('/resetPassword/{id}', 'resetPassword')->name('users.resetPassword');
    Route::put('/resetPassword/{id}/reset', 'reset')->name('users.reset');
});

Route::prefix('users')->name('users.')->group(function(){
    Route::resource('/admin', AdminController::class);
    Route::controller(AdminController::class)->group(function () {
        Route::put('/admin/{id}/changeProfile', 'updateProfile')->name('admin.updateProfile');
        Route::post('/admin/{id}/deleteProfil', 'deleteProfile')->name('admin.deleteProfile');
    });

    Route::resource('/cashier', CashierController::class);
    Route::controller(CashierController::class)->group(function () {
        Route::put('/cashier/{id}/changeProfile', 'updateProfile')->name('cashier.updateProfile');
        Route::post('/cashier/{id}/deleteProfil', 'deleteProfile')->name('cashier.deleteProfile');
    });

    Route::resource('/owner', OwnerController::class);
    Route::controller(OwnerController::class)->group(function () {
        Route::put('/owner/{id}/changeProfile', 'updateProfile')->name('owner.updateProfile');
        Route::post('/owner/{id}/deleteProfil', 'deleteProfile')->name('owner.deleteProfile');
    });
});

Route::resource('/members', MemberController::class);
Route::controller(MemberController::class)->group(function () {
    // Route::put('/members/{id}/delete', 'destroy')->name('members.delete');
    Route::put('/members/{id}/changeProfile', 'updateProfile')->name('members.updateProfile');
    Route::post('/members/{id}/deleteProfile', 'deleteProfile')->name('members.deleteProfile');
});

Route::middleware(['role:owner'])->group(function () {
    Route::resource('/outlet', OutletController::class, ['except' => ['create', 'store', 'show', 'destroy']]);
    Route::controller(OutletController::class)->group(function () {
        Route::put('/outlet/{id}/changeProfile', 'updateProfile')->name('outlet.updateProfile');
        Route::post('/outlet/{id}/deleteProfil', 'deleteProfile')->name('outlet.deleteProfile');
    });
});

Route::resource('/packages',  PackageController::class, ['except' => ['show']]);
Route::resource('/transactions', TransactionController::class);
Route::controller(TransactionController::class)->group(function () {
    Route::post('/transactions/addPackageItem', 'addPackageItem')->name('transactions.addPackageItem');
    Route::delete('/transactions/{id}/deletePackageItem', 'deletePackageItem')->name('transactions.deletePackageItem');
    Route::get('/transactions/{transaction}/print', 'printInvoice')->name('transactions.printInvoice');
});

Route::controller(ReportController::class)->group(function () {
    Route::get('/reports', 'index')->name('reports.index');
    Route::get('/reports/transaction/excel', 'excelReportTransaction')->name('reports.excel.transaction');
    Route::get('/reports/member/excel', 'excelReportMember')->name('reports.excel.member');
    Route::get('/reports/user/admin/excel', 'excelReportUserAdmin')->name('reports.excel.users.admin');
    Route::get('/reports/user/cashier/excel', 'excelReportUserCashier')->name('reports.excel.users.cashier');
    Route::get('/reports/user/owner/excel', 'excelReportUserOwner')->name('reports.excel.users.owner');
});
