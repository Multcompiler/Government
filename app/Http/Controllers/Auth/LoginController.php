<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();


        $this->clearLoginAttempts($request);

        if(Auth::user()->status == 'active'){
            if($this->guard()->user()->role['name'] == 'admin'){
                return redirect('admin');
            }
            elseif($this->guard()->user()->role['name'] == 'district_officer'){
                return redirect('district_officer');
            }
            elseif($this->guard()->user()->role['name'] == 'headmaster'){
                return redirect('headmaster');
            }

        }
        elseif(Auth::user()->status == 'inactive'){
            $request->session()->invalidate();
            Session::flash('approval','Wait for Admin Approval');
            return redirect('login');
        }
        elseif(Auth::user()->status == 'disabled'){
            $request->session()->invalidate();
            Session::flash('fail','Your Account Its Temporary Locked. Contact the Administrator for Assistance');
            return redirect('login');
        }
        else{
            $request->session()->invalidate();
            Session::flash('success','Wait For Admin Approval');
            return redirect('login');
        }

    }
}
