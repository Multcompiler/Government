<?php

namespace App\Http\Controllers;

use App\HeadMasterProfile;
use App\Role;
use App\School;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminHeadMasterManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headname = User::all();
        $schools = School::all();

        $schoolinfo = HeadMasterProfile::all();
        return view('auth.admin.headmaster.index')->withHeadname($headname)->withSchools($schools);
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
        $this->validate($request, array(
            'head_name' => 'required',
            'school' => 'required',
        ));

        $head_assign = new HeadMasterProfile;
        $check_head_exist = HeadMasterProfile::where('user_id',$request->head_name)->get();
        $check_school_exist = HeadMasterProfile::where('school_id',$request->school)->get();
        if ($check_head_exist -> count() > 0){
            $request->session()->flash('exist','Fail');
            return redirect()->back();
        }elseif ($check_school_exist -> count() > 0){
            $request->session()->flash('exist','Fail');
            return redirect()->back();
        }
        else{
            $head_assign->user_id = $request->head_name;
            $head_assign->profile_image = "-";
            $head_assign->school_id = $request->school;
            $head_assign->save();
            $request->session()->flash('success_assigned','Comment Successfull Posted');

            return redirect()->back();
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_details = User::find($id);
      //  dd($users);

        $profile = HeadMasterProfile::where('user_id',$user_details->id)->get();
        $profile_count = $profile->count();

            return view('auth.admin.headmaster.show')
                ->withUser_details($user_details)
                ->with('profile',$profile)
                ->with('profile_count',$profile_count);


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
        $check = User::find($request->headmaster);

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
        $val = User::find($id);

        $profile = HeadMasterProfile::where('user_id',$val->id)->get()->first();
        if($profile-> count() > 0){
            $profile->delete();
        }
        $val->delete();

        Session::flash('success_deleted','User Successfully Deleted');
        return redirect()->back();
    }
}
