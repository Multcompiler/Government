<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class AdminUserManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function index(){
        $requests = Role::all();
        return view('auth.admin.user.index',compact('requests'));
    }
    public function view_users(){
        $users = User::all();
        $roles = Role::all();
        return view('auth.admin.user.view_users',compact('users','roles'));
    }
    public function store_users(Request $request){
        $this->validate($request, array(
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'email' => 'required|email:unique',
            'role_id' => 'required',
            'password' => 'required',
        ));

        $add_user = new User();
        $add_user->firstname = $request->firstname;
        $add_user->lastname = $request->lastname;
        $add_user->phone = $request->phone;
        $add_user->gender = $request->gender;
        $add_user->email = $request->email;
        $add_user->role_id = $request->role_id;
        $add_user->password = Hash::make($request->password);
        $add_user->save();

        $request->session()->flash('success_form','New User Successful Added');

        return redirect()->back();
    }

    public function view_users_category($id)
    {
        $data = User::where('role_id',$id)
            ->get();

        return Response::json($data);
    }
    public function delete_profile_user($id)
    {
        User::find($id)->delete();

        Session::flash('success_user_deleted','wewe');

        return redirect()->back();
    }
    public function edit_users(Request $request,$id)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'status' => 'required',
            'email' => 'required',
            'user_id' => 'required',
        ]);

        $user_update   = User::where('id',$request->user_id)->get()->first();

            $user_update->firstname = $request->firstname;
            $user_update->lastname = $request->lastname;
            $user_update->gender = $request->gender;
            $user_update->phone = $request->phone;
            $user_update->status = $request->status;
            $user_update->email = $request->email;

            $user_update->save();

            $request->session()->flash('success_user_update','Profile Picture Successfully Updated');

            return redirect()->back();
        }

}
