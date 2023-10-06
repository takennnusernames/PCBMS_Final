<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function fetchEmployee($id){
        $employee = Employee::find($id);
        return response()->json(['data' => $employee]);
    }

    public function addEmployee(Request $request) {
        // dd($request);
        if($request->MiddleName == null)
        {
            $name =  $request->FirstName . " " . $request->LastName;
        }
        else
        {
            $name =  $request->FirstName . " " . $request->MiddleName . " " . $request->LastName;
        }

        $formFields = [
            'name' => $name,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role
        ];

        Employee::create($formFields);

        $password = $request->FirstName . '123';
        $user = [
            'name' => $name,
            'email' => $request->email,
            'password' => $password 
        ];

        User::create($user);

        return back()->with('message', 'Employee Added');
    }

    public function editEmployee(Request $request) {
        $employee = Employee::find($request->id);

        if($request->MiddleName == null)
        {
            $name =  $request->FirstName . " " . $request->LastName;
        }
        else
        {
            $name =  $request->FirstName . " " . $request->MiddleName . " " . $request->LastName;
        }

        $formFields = [
            'name' => $name,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role
        ];

        $employee->update($formFields);

        return back()->with('message', 'Employee Data Updated');
    }

    public function deleteEmployee($id){
        $employee = Employee::find($id);

        if($employee){
            $employee->delete();
        }

        return back()->with('message', 'Employee Data Deleted');
    }
}
