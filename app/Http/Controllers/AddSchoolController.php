<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AddSchoolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('headmaster');
    }
    public  function store(Request $request){
        $this->validate($request, array(
            'school_name' => 'required',
            'region' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'phone' => 'required',
            'box' => 'required',
        ));

            $school = new School;
            $school->school_name =  $request->school_name;
            $school->region_id = $request->region;
            $school->district_id = $request->district;
            $school->ward_id = $request->ward;
            $school->phone = $request->phone;
            $school->box = $request->box;
            $school->save();

        Session::flash('success','Wait For Admin Approval');
        return redirect()->back();

    }
}
