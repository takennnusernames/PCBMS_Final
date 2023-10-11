<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

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
            'appreciation' => $request->appreciation,
            'code' => "1234112312"
        ];

        if($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('product_samples', 'public');
        }

        $validator = Validator::make($formFields, [
            'supplier_id' => 'required',
            'name' => [
                'required',
                Rule::unique('products')->where(function ($query) use ($formFields) {
                    return $query->where('supplier_id', $formFields['supplier_id']);
                }),
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'description' => 'required',
            'unit' => 'required',
            'srp' => ['required','regex:/^\d+$/'],
            'appreciation' => ['required','regex:/^(?:\d{1,2}|100)$/'],
            'code' => 'required'
        ],[
            'name.unique' => 'A product with the same name and supplier already exists',
            'name.regex' => 'Invalid Product name',
            'srp.regex' => 'Invalid Price'
        ]);

        
        if ($validator->fails()) {
            // Validation failed, handle the error
            $validationErrors = $validator->errors()->all();
            $combinedErrorMessage = implode('<br>', $validationErrors);
        
            return redirect()->back()
                ->with('error', $combinedErrorMessage)
                ->withInput();
        }
        $price = $request->srp + ($request->srp * ($request->appreiation/100));
        $formFields['price'] = $price;
        Product::create($formFields);

        return back()->with('message', 'Product Added');
    }

    public function editProductView($id){
        return view('admin_pages/product_pages/edit_product', ['product' => Product::with('supplier')->find($id) ]);
    }

    public function editProduct(Request $request){
        // dd($request);
        $product = Product::find($request->id);

        $formFields = [
            'id' => $request->id,
            'supplier_id' => $request->supplier_id,
            'name' => $request->name,
            'description' => $request->description,
            'unit' => $request->unit,
            'srp' => $request->srp,
            'appreciation' => $request->appreciation,
            'qty' => $request->qty,
            'restock' => $request->restock
        ];
        $validator = Validator::make($formFields, [
            'supplier_id' => 'required',
            'name' => [
                'required',
                Rule::unique('products')->where(function ($query) use ($formFields) {
                    return $query->where('supplier_id', $formFields['supplier_id'])
                        ->where('id', '<>', $formFields['id']); // Exclude the current record's ID
                })->ignore($formFields['id']), // Make sure to ignore the current record by ID
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'description' => 'required',
            'unit' => 'required',
            'srp' => ['required','regex:/^\d+$/'],
            'appreciation' => ['required','regex:/^(?:\d{1,2}|100)$/'],
            'qty' => 'regex:/^\d+$/',
            'restock' => ['date', 'before_or_equal:' . Carbon::now()->format('Y-m-d')]
        ],[
            'name.unique' => 'A product with the same name and supplier already exists',
            'name.regex' => 'Invalid Product name',
            'srp.regex' => 'Invalid Price'
        ]);

        
        if ($validator->fails()) {
            // Validation failed, handle the error
            $validationErrors = $validator->errors()->all();
            $combinedErrorMessage = implode('<br>', $validationErrors);
        
            return redirect()->back()
                ->with('error', $combinedErrorMessage)
                ->withInput();
        }
        $price = $request->srp + ($request->srp * ($request->appreciation/100));
        $formFields['price'] = $price;

        $product->update($formFields);

        return back()->with('message', 'Product Updated');
    }
}
