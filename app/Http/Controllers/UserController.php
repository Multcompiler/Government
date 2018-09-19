<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function index(){
        if(Auth::check() && Auth::user()->role['name'] == 'admin'){
            return redirect('admin');
        }
        elseif(Auth::check() && Auth::user()->role['name'] == 'headmaster'){
            return redirect('headmaster');
        }
        elseif(Auth::check() && Auth::user()->role['name'] == 'district_officer'){
            return redirect('district_officer');
        }
        else{
            return view('index');
        }
    }
    public function test(){
        return view('welcome');
    }
}
