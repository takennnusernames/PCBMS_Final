<?php

namespace App\Http\Controllers;

use console;
use FFI\CData;
use Carbon\Carbon;
use App\Models\Log;
use App\Models\Product;
use App\Mail\StockOrder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Environment\Console as EnvironmentConsole;

class ProductController extends Controller
{
    protected $date;
    protected $time;

    public function __construct()
    {
        $this->date = Carbon::now()->toDateString();
        $this->time = Carbon::now()->toTimeString();
    }
    
    public function add_product(Request $request){
        // dd($request);

        $code = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);

        // Check for code uniqueness
        while (Product::where('code', $code)->exists()) {
            $code = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        }
        
        $formFields = [
            'supplier_id' => $request->supplier,
            'name' => $request->name,
            'description' => $request->description,
            'unit' => $request->unit,
            'srp' => $request->srp,
            'appreciation' => $request->appreciation,
            'code' => $code
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
            'code' => 'required|unique:products'
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

        $logFields = [
            'user_id' => auth()->user()->id,
            'activity' => 'Product "' . $request->name . '" added',
            'log_date' => $this->date,
            'log_time' => $this->time
        ];

        Log::create($logFields);

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

        $logFields = [
            'user_id' => auth()->user()->id,
            'activity' => 'Product "' . $product->code . '" updated',
            'log_date' => $this->date,
            'log_time' => $this->time
        ];

        Log::create($logFields);

        return redirect('/products')->with('message', 'Product Updated');
    }

    public function deleteProduct($id){

        $product = Product::find($id);

        
        $logFields = [
            'user_id' => auth()->user()->id,
            'activity' => 'Product "' . $product->code . '" updated',
            'log_date' => $this->date,
            'log_time' => $this->time
        ];

        if($product){
            $product->delete();
        }

        Log::create($logFields);

        return back()->with('message', 'Product Data Deleted');
    }

    public function fetchProduct($id){
        $product = Product::with('supplier')->find($id);
        return response()->json(['data' => $product]);
    }

    public function fetchProductCode($code){
        $product = Product::where('code', $code)->first();
        return response()->json(['data' => $product]);
    }

    public function searchProduct(Request $request){
        $keyword = $request->input('keyword');

        // Perform the search on your database table
        $results = Product::where('code', 'like', '%' . $keyword . '%')
        ->orWhere('name', 'like', '%' . $keyword . '%')
        ->get();

        return response()->json($results);
    }

    public function orderProduct(Request $request){
        // dd($request);
        $orderRequestData = [
            'name' => $request->product, 
            'quantity' => $request->qty, 
            'unit'=> $request->unit
        ];
    
        Mail::to($request->supplier)->send(new StockOrder($orderRequestData));
    
        // ... rest of your order request processing logic ...
    
        return redirect('/products')->with('email', 'Restock Request Sent');
    }
}
