<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    //
    public function add_supplier(Request $request){
        // dd($request);
        if($request->acronym == null){
            $acronym = " ";
        }
        else{
            $acronym = $request->acronym;
        }

        $formFields = [
            'Company Name' => $request->companyName,
            'Company Acronym' => $acronym,
            'Address' => $request->address,
            'Contact Person' => $request->contactPerson,
            'Contact Number' => $request->contactNumber,
            'Email Address' => $request->email
        ];

        $validator = Validator::make($formFields, [
            'Company Name' => 'required|unique:suppliers',
            'Company Acronym' => 'required',
            'Address' => 'required',
            'Contact Person' => 'required',
            'Contact Number' => ['required', 'regex:/^(?:\+639\d{9}|09\d{9})$/'],
            'Email Address' => 'required|email',
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
        
        Supplier::create($formFields);

        return back()->with('message', 'Supplier Data Added');
    }
    
    public function edit_supplier(Request $request){
        // dd($request->id);
        $supplier = Supplier::find($request->id);

        if($request->acronym == null){
            $acronym = " ";
        }
        else{
            $acronym = $request->acronym;
        }
        $formFields = [
            'Company Name' => $request->companyName,
            'Company Acronym' => $acronym,
            'Address' => $request->address,
            'Contact Person' => $request->contactPerson,
            'Contact Number' => $request->contactNumber,
            'Email Address' => $request->email
        ];

        $validator = Validator::make($formFields, [
            'Company Name' => 'required|unique:suppliers,Company Name,' . $request->id,
            'Company Acronym' => 'required',
            'Address' => 'required',
            'Contact Person' => 'required',
            'Contact Number' => ['required', 'regex:/^(?:\+639\d{9}|09\d{9})$/'],
            'Email Address' => 'required|email',
        ]);
        
        

        if ($validator->fails()) {
            // Validation failed, handle the error
            $errorMessage = 'Failed in editing data';
            $validationErrors = $validator->errors()->all();
            $combinedErrorMessage = $errorMessage . '<br>' . implode('<br>', $validationErrors);
        
            return redirect()->back()
                ->with('error', $combinedErrorMessage)
                ->withInput();
        }
        
        $supplier->update($formFields);

        return back()->with('message', 'Supplier Data Updated');
    }

    public function delete_supplier($id){
        // dd($id);
        $supplier = Supplier::find($id);

        if($supplier){
            $supplier->delete();
        }

        return back()->with('message', 'Supplier Data Deleted');
    }

    public function fetchData($id){
        $supplier = Supplier::find($id);
        error_log(json_encode($supplier));
        return response()->json(['data' => $supplier]);
    }

    public function fetchSuppliers(){
        $suppliers = Supplier::all();
        return response()->json(['data' => $suppliers]);
    }
}
