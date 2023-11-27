<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Record;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    protected $date;
    protected $time;

    public function __construct()
    {
        $this->date = Carbon::now()->toDateString();
        $this->time = Carbon::now()->toTimeString();
    }

    public function authenticate(Request $request){

        $formFields = $request->validate([
            'email' => ['required', 'email',],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();
            if (auth()->check() && auth()->user()->isCashier())
            {
                $recordFields = [
                    'user_id' => auth()->user()->id,
                    'activity' => 'User "' . auth()->user()->id . '" Logged in',
                    'log_date' => $this->date,
                    'log_time' => $this->time
                ];
        
                Record::create($recordFields);
                return redirect('/pos-cashier')->with('Message', 'Session Started');
            }
            else
            {
                $recordFields = [
                    'user_id' => auth()->user()->id,
                    'activity' => 'Admin "' . auth()->user()->id . '" Logged in',
                    'log_date' => $this->date,
                    'log_time' => $this->time
                ];
        
                Record::create($recordFields);
                return redirect('/')->with('Message', 'You are now logged in!');
            }
        }
        
        return back()->with('error', 'Invalid Credentials')->onlyInput('email');
    }

    public function logout(Request $request){
        $recordFields = [
            'user_id' => auth()->user()->id,
            'activity' => 'User "' . auth()->user()->id . '" Logged out',
            'log_date' => $this->date,
            'log_time' => $this->time
        ];

        Record::create($recordFields);

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('message', 'You have been logged out');
    }
}
