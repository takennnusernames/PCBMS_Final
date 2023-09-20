<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function add_product(Request $request){
        // dd($request);
        $formFields = [
            'supplier_id' => $request->supplier,
            'name' => $request->name,
            'description' => $request->description,
            'unit' => $request->unit,
            'srp' => $request->srp,
            'price' => $request->price,
            'code' => "1234112312"
        ];

        if($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('product_samples', 'public');
        }

        Product::create($formFields);

        return back()->with('message', 'Product Added');
    }

    
}
