<?php

namespace App\Http\Controllers;

use App\AdminProfile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $check = User::find($id);

        if($check->status == 'active'){
            $check->status = 'inactive';
        }
        elseif ($check->status == 'inactive') {
            $check->status = 'active';
        }

        $check->save();


        $request->session()->flash('success','Access Successfully Changed');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function admin_profile()
    {
        $district_profile_check = AdminProfile::where("user_id",Auth::user()->id)->count();
        $district_profile = AdminProfile::where("user_id",Auth::user()->id)->first();
        return view('auth.admin.profile',compact('district_profile','district_profile_check'));
    }

    public function profile_add_admin(Request $request)
    {
        $this->validate($request, array(
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'region_id' => 'required',
            'district_id' => 'required',
            'bio' => 'required',
        ));

        $add_profile = new AdminProfile();
        $add_profile->user_id =  Auth::user()->id;
        $add_profile->firstname =  $request->firstname;
        $add_profile->lastname = $request->lastname;
        $add_profile->phone = $request->phone;
        $add_profile->email = $request->email;
        $add_profile->region_id = $request->region_id;
        $add_profile->district_id = $request->district_id;
        $add_profile->bio = $request->bio;
        $add_profile->save();

        Session::flash('success','Profile Information Successful Added');
        return redirect()->back();
    }
    public function edit_profile_admin(Request $request,$id)
    {
        $this->validate($request, array(
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'region_id' => 'required',
            'district_id' => 'required',
            'bio' => 'required',
        ));

        $edit_profile =  AdminProfile::find($id);
        $edit_profile->user_id =  Auth::user()->id;
        $edit_profile->firstname =  $request->firstname;
        $edit_profile->lastname = $request->lastname;
        $edit_profile->phone = $request->phone;
        $edit_profile->email = $request->email;
        $edit_profile->region_id = $request->region_id;
        $edit_profile->district_id = $request->district_id;
        $edit_profile->bio = $request->bio;
        $edit_profile->save();

        Session::flash('success','Profile Information Successful Added');
        return redirect()->back();
    }
}
