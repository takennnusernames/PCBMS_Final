<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $date;
    protected $time;

    public function __construct()
    {
        $this->date = Carbon::now()->toDateString();
        $this->time = Carbon::now()->toTimeString();
    }
    
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
        ];

        Employee::create($formFields);

        $password = $request->FirstName . '123';
        $user = [
            'name' => $name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $password 
        ];

        User::create($user);

        $logFields = [
            'user_id' => auth()->user()->id,
            'activity' => 'Employee "' . $name . '" added',
            'log_date' => $this->date,
            'log_time' => $this->time
        ];

        Log::create($logFields);

        return redirect('/employees')->with('message', 'Employee Added');
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

        $logFields = [
            'user_id' => auth()->user()->id,
            'activity' => 'Employee "' . $name . '" updated',
            'log_date' => $this->date,
            'log_time' => $this->time
        ];

        Log::create($logFields);

        return back()->with('message', 'Employee Data Updated');
    }

    public function deleteEmployee($id){
        $employee = Employee::find($id);

        
        $logFields = [
            'user_id' => auth()->user()->id,
            'activity' => 'Employee "' . $employee->name . '" deleted',
            'log_date' => $this->date,
            'log_time' => $this->time
        ];

        if($employee){
            $employee->delete();
        }

        Log::create($logFields);

        return back()->with('message', 'Employee Data Deleted');
    }
}
