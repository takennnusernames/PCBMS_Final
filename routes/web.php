<?php

use App\Models\Log;
use App\Models\Record;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;

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

Route::middleware(['admin'])->group(function () {


    Route::get('/', [AdminController::class, 'dashboard_view']);

    Route::get('/suppliers', [AdminController::class, 'suppliers_view']);

    Route::get('/products', [AdminController::class, 'products_view']);

    Route::get('/product/{id}', [AdminController::class, 'product_view']);

    Route::get('/add_employee', [AdminController::class, 'add_employee_view']);

    Route::get('/employees', [AdminController::class, 'employees_view']);


    Route::post('/addEmployee', [EmployeeController::class, 'addEmployee']);

    Route::post('edit_employee', [EmployeeController::class, 'editEmployee']);

    Route::delete('delete_employee/{id}', [EmployeeController::class, 'deleteEmployee']);

    Route::get('/fetch-employee/{id}', [EmployeeController::class, 'fetchEmployee']);

    Route::post('/add_product', [ProductController::class, 'add_product']);

    Route::get('/edit_product_view/{id}', [ProductController::class, 'editProductView']);

    Route::post('/edit_product', [ProductController::class, 'editProduct']);

    Route::delete('/delete_product/{id}', [ProductController::class, 'deleteProduct']);

    Route::get('/fetch-data/{id}', [SupplierController::class, 'fetchData']);

    Route::get('/fetch-suppliers', [SupplierController::class, 'fetchSuppliers']);

    Route::post('/add_supplier', [SupplierController::class, 'add_supplier']);

    Route::post('/edit_supplier', [SupplierController::class, 'edit_supplier']);

    Route::delete('/delete_supplier/{id}', [SupplierController::class, 'delete_supplier']);

    Route::get('/pos', function () {
        return view('point_of_sales/pos', ['products' => Product::with('supplier')->get()]);
    });

    Route::get('/logs', function () {
        return view('admin_pages/logs_pages/logs', ['logs' => Log::with('user')->get()]);
    });

    Route::get('/dtr', function() {
        return view('admin_pages/logs_pages/dtr', ['records' => Record::with('user')->get()]);
    });

    Route::get('/email', function(){
        return view('email/stock_request');
    });

    Route::post('/order', [ProductController::class, 'orderProduct']);
});

Route::middleware(['cashier'])->group(function () {
    Route::get('/pos-cashier', function () {
        return view('point_of_sales/pos_cashier', ['products' => Product::with('supplier')->get()]);
    });
});

Route::middleware(['auth'])->group(function () {

    Route::get('/fetch-product/{id}', [ProductController::class, 'fetchProduct']);

    Route::get('/fetch-productCode/{code}', [ProductController::class, 'fetchProductCode']);

    Route::post('/save_reciept', [TransactionController::class, 'saveTransaction']);

    Route::get('/sales', [TransactionController::class, 'readTransaction']);

    Route::get('/transaction-{id}', [TransactionController::class, 'viewTransaction']);

    Route::get('/search', [ProductController::class, 'searchProduct']);

    Route::post('/logout', [LoginController::class, 'logout']);
});

Route::get('/login', function () {
    return view('login_page');
})->name('login')->middleware('guest');

Route::post('/authenticate', [LoginController::class, 'authenticate']);
