<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin_pages/index');
});

Route::get('/suppliers', [AdminController::class, 'suppliers_view']);

Route::get('/products', [AdminController::class, 'products_view']);

Route::get('/product/{id}', [AdminController::class, 'product_view']);

Route::post('/add_product', [ProductController::class, 'add_product']);

Route::get('/fetch-data/{id}', [SupplierController::class, 'fetchData']);

Route::get('/fetch-suppliers', [SupplierController::class, 'fetchSuppliers']);

Route::post('/add_supplier', [SupplierController::class, 'add_supplier']);

Route::post('/edit_supplier', [SupplierController::class, 'edit_supplier']);

Route::delete('/delete_supplier/{id}', [SupplierController::class, 'delete_supplier']);

Route::get('/employees', function () {
    return view('admin_pages/employees');
});

Route::get('/sales', function () {
    return view('admin_pages/sales');
});

Route::get('/logs', function () {
    return view('admin_pages/logs');
});