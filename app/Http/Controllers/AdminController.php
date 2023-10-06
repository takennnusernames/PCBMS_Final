<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function suppliers_view()
    {
        return view('admin_pages/suppliers', ['suppliers' => Supplier::all()]);
    }
    public function products_view()
    {
        return view('admin_pages/product_pages/products', ['products' => Product::with('supplier')->get()]);
    }

    public function product_view($id){
        // dd(Product::find($id));
        return view('admin_pages/product_pages/product', ['product' => Product::with('supplier')->find($id) ]);
    }

    public function add_employee_view(){
        // dd(Product::find($id));
        return view('admin_pages/employee_pages/add_employee');
    }

    public function employees_view() {
        return view('admin_pages/employee_pages/employees', ['employees' => Employee::all()]);
    }
}
