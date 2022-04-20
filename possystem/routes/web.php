<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('supplier', App\Http\Controllers\SupplierController::class);
Route::get('api/supplier', [App\Http\Controllers\SupplierController::class, 'api']);

Route::resource('product', App\Http\Controllers\ProductController::class);
Route::get('api/product', [App\Http\Controllers\ProductController::class, 'api']);

Route::resource('customer', App\Http\Controllers\CustomerController::class);
Route::get('api/customer', [App\Http\Controllers\CustomerController::class, 'api']);

Route::resource('po', App\Http\Controllers\PurchaseOrderController::class);
Route::resource('so', App\Http\Controllers\SalesOrderController::class);

Route::get('so/ajax/{product_id}', [App\Http\Controllers\SalesOrderController::class, 'get_product']);
Route::get('so/ajax/{product_id}', [App\Http\Controllers\PurchaseOrderController::class, 'get_product']);

Route::post('cetak-so', [App\Http\Controllers\CetakOrderController::class, 'cetakSO']);
Route::post('cetak-po', [App\Http\Controllers\CetakOrderController::class, 'cetakPO']);
