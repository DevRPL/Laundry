<?php

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


Route::redirect('/', '/login')->name('home');

Auth::routes();

Route::get('/logout', 'AuthController@logout')->name('logout');
    
Route::group(['prefix' => 'master', 'namespace' => 'Master', 'middleware' => ['auth'], 'as' => 'master.'], function () {
    Route::resource('users', 'UserController');
            
    Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');
    Route::resource('customers', 'CustomerController');
    Route::resource('cabangs', 'BranchController');
    Route::resource('pakets', 'LaundryPackageController');
    Route::resource('transaksis', 'TransactionController');
    Route::put('update-status-transaksi/{id}', 'TransactionController@updateStatus')
        ->name('update.status.transaction');
    Route::get('employees', 'UserController@getEmployee')->name('employees.index');
    Route::get('transaksis/gets/{id}', 'TransactionController@get');
    Route::get('transaksis/getPackage/{id}', 'TransactionController@getPackage');
    Route::get('transaksis/print-invoice/{id}', 'TransactionController@printInvoice')
        ->name('generateInvoice.print');
    Route::get('laporan', 'ReportController@reportDataOrder')
        ->name('reports.getReportDataOrder');
    Route::get('exportEntryOrder', 'ReportController@exportEntryOrder')
        ->name('exportEntryOrder.excel');
});