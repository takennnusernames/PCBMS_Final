<?php

namespace App\Http\Controllers;

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
        return view('admin_pages/products', ['products' => Product::with('supplier')->get()]);
    }

    public function product_view($id){
        // dd(Product::find($id));
        return view('admin_pages/product', ['product' => Product::find($id) ]);
    }
}
