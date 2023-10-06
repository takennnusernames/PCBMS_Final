<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function add_product(Request $request){
        // dd($request);
        $price = $request->srp + ($request->srp * ($request->appreiation/100));
        $formFields = [
            'supplier_id' => $request->supplier,
            'name' => $request->name,
            'description' => $request->description,
            'unit' => $request->unit,
            'srp' => $request->srp,
            'appreciation' => $request->appreiation,
            'code' => "1234112312",
            'price' => $price
        ];

        if($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('product_samples', 'public');
        }

        $validator = Validator::make($formFields, [
            'supplier_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'unit' => 'required',
            'srp' => 'required',
            'appreciation' => 'required',
            'code' => 'required',
            'image' => 'image|mimes:jpeg,png,gif|max:2048|dimensions:min_width=100,min_height=100',
        ]);

        if ($validator->fails()) {
            // Validation failed, handle the error
            $errorMessage = 'Failed in adding data';
            $validationErrors = $validator->errors()->all();
            $combinedErrorMessage = $errorMessage . '<br>' . implode('<br>', $validationErrors);
        
            return redirect()->back()
                ->with('error', $combinedErrorMessage)
                ->withInput();
        }

        Product::create($formFields);

        return back()->with('message', 'Product Added');
    }

    
}
