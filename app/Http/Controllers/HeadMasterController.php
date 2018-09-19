<?php

namespace App\Http\Controllers;

use App\Category;
use App\District;
use App\HeadMasterProfile;
use App\Kidato;
use App\Region;
use App\School;
use App\SchoolRequirements;
use App\SchoolUserTotal;
use App\Study;
use App\Teacher;
use App\UserSchool;
use App\Ward;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class HeadMasterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('headmaster');
    }

    public function index(){

         $school = School::where('user_id',Auth::user()->id)->first();
        if ($school != null){
            $teachers = Teacher::where("school_id",$school->id)->count();
        }
        else{
            $teachers = 0;
        }

       // dd($school->id);
        $school_staffs = DB::select("Select school_id,sum(male_total) as sum_male,sum(female_total) as sum_female from school_user_totals WHERE requirement_category_id = 1 AND user_id = ?  GROUP BY school_id",[Auth::user()->id]);
        $school_students = DB::select("Select school_id,sum(male_total) as sum_male,sum(female_total) as sum_female from school_user_totals WHERE requirement_category_id = 2 AND user_id = ?  GROUP BY school_id",[Auth::user()->id]);


        $male_students = 0;
            $female_students = 0;
        foreach ($school_students as $std){
            if($std->school_id == $school->id){
                $male_students += $std->sum_male;
                $female_students += $std->sum_female;
            }
        }


        if (sizeof($school_students) != 0){
            $students_total = $male_students + $female_students;
        }else{
            $students_total = 0;
        }

        $male_staffs = 0;
        $female_staffs = 0;
        foreach ($school_staffs as $std){
            if($std->school_id == $school->id){
                $male_staffs += $std->sum_male;
                $female_staffs += $std->sum_female;
            }
        }

        if (sizeof($school_staffs) != 0){
            $staffs_total = $male_staffs + $female_staffs;
        }else{
            $staffs_total = 0;
        }

        return view('auth.headmaster.index',compact('teachers','students_total','staffs_total'));
    }
    public function get_classes(){

        $data = Kidato::all();

        return Response::json($data);
    }
    public function get_classe(){

        $data = Kidato::all();

        return Response::json($data);
    }

    public function get_category(){

        $data2 = Category::all();

        return Response::json($data2);
    }
    public function get_categ(){

        $data3 = UserSchool::all();

        return Response::json($data3);
    }
    public function add_school_requirement(){
        $school = School::where('user_id',Auth::user()->id)->first();
        $school_check = School::where('user_id',Auth::user()->id)->count();
        return view('auth.headmaster.requirements.add_requirement',compact('school','school_check'));
    }
    public function add_new_teacher(){
        $school_info_check = School::where("user_id",Auth::user()->id)->count();
        if($school_info_check > 0){
            $school_info = School::where("user_id",Auth::user()->id)->first();
        }
        $kidato = Kidato::all();
        $masomo = Study::all();
        $check_school = School::where('user_id',Auth::user()->id)->count();
        if ($check_school > 0){
            $school_name = School::where('user_id',Auth::user()->id)->first();
        }

        return view('auth.headmaster.teachers.index',compact('masomo','school_name','kidato','school_info','school_info_check'));
    }

    public function add_school()
    {
        $school_info_check = School::where("user_id",Auth::user()->id)->count();
        if($school_info_check > 0){
            $school_info = School::where("user_id",Auth::user()->id)->first();
        }

        $region = Region::all();
        $ward = Ward::all();
        $district = District::all();
        return view('auth.headmaster.school.index',compact('school_info_check','school_info'))
            ->withWard($ward)
            ->withRegion($region)
            ->withDistrict($district);
    }
    public function edit_school(Request $request,$id)
    {
        $this->validate($request, [
            'school_name' => 'required',
            'region_id' => 'required',
            'district_id' => 'required',
            'ward_id' => 'required',
            'phone' => 'required',
            'box' => 'required',
        ]);

        $user_update   = School::find($id);


        $user_update->school_name = $request->school_name;
        $user_update->region_id = $request->region_id;
        $user_update->district_id = $request->district_id;
        $user_update->ward_id = $request->ward_id;
        $user_update->phone = $request->phone;
        $user_update->box = $request->box;
        $user_update->save();

        $request->session()->flash('school_info_updated','Profile Picture Successfully Updated');

        return redirect()->back();

    }
    public function delete_school($id)
    {
        School::find($id)->delete();

        Session::flash('success_school_deleted','Profile Picture Successfully Updated');

        return redirect()->back();
    }
    public function teacher_delete($id)
    {
        $val = Teacher::find($id);
        $val->study()->detach();
        $val->kidato()->detach();
        $val->delete();

        Session::flash('success_teacher_deleted','Teacher Successfully Deleted');
        return redirect()->back();
    }
    public function school_requirements()
    {
        $schools = School::where('user_id',Auth::user()->id)->get();
        return view('auth.headmaster.manage.index',compact('schools'));
    }
    public function view_school_requirements()
    {
        $duplicateRecords = DB::table('school_requirements')
            ->select('kidato_id')
            ->groupBy('kidato_id')
            ->get();

        $requirements = SchoolRequirements::where('posted_user_id',Auth::user()->id)->get();
        $requirements_total = SchoolUserTotal::where('user_id',Auth::user()->id)->get();
        if ($requirements->count() > 0){
            foreach ($requirements as $requirement){
                $data_school = $requirement->school_id;
            }
        }else{
            $data_school = 0;
        }

        return view('auth.headmaster.requirements.view_requirements',compact('requirements','requirements_total','duplicateRecords','data_school'));
    }
    public function view_all_teachers()
    {
        $schools_check = School::where('user_id',Auth::user()->id)->count();
        if ($schools_check > 0){
            $schools = School::where('user_id',Auth::user()->id)->first();
            $teachers = Teacher::where('school_id',$schools->id)->get();
        }
        return view('auth.headmaster.teachers.view_teachers',compact('schools','teachers','schools_check'));
    }
    public function add_teachers(Request $request)
    {
        $this->validate($request, array(
            'school_id' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'phone' => 'required',
        ));

        $add_teacher = new Teacher();
        $add_teacher->school_id = $request->school_id;
        $add_teacher->firstname = $request->firstname;
        $add_teacher->lastname = $request->lastname;
        $add_teacher->gender = $request->gender;
        $add_teacher->phone = $request->phone;
        $add_teacher->save();

        $add_teacher->study()->sync($request->studies,false);
        $add_teacher->kidato()->sync($request->kidato,false);

        $request->session()->flash('success_teacher_added','Teacher Successful Added');

        return redirect()->back();
    }
    public function add_all_school_requirement(Request $request)
    {
        $this->validate($request, array(
            'school_id' => 'required',
            'kidato_id' => 'required',
            'requirement_category_id' => 'required',
            'category_name' => 'required',
            'amount_available' => 'required',
            'amount_needed' => 'required',
        ));
        $input = Input::all();
        $condition = $input['category_name'];

        $user_id = array();
        $user_id[0] = Auth::user()->id;

        for($i= 0; $i < count($condition); $i++){
        $add_teacher = new SchoolRequirements();
        $add_teacher->posted_user_id = $user_id[0];
        $add_teacher->school_id = $input['school_id'][0];
        $add_teacher->kidato_id = $input['kidato_id'][$i];
        $add_teacher->requirement_category_id = $input['requirement_category_id'][$i];
        $add_teacher->category_name = $input['category_name'][$i];
        $add_teacher->amount_available = $input['amount_available'][$i];
        $add_teacher->amount_needed = $input['amount_needed'][$i];
        $add_teacher->save();
}
        $request->session()->flash('success_requirement_added','Teacher Successful Added');

        return redirect()->back();
    }
    public function add_users_total(Request $request)
    {
        $this->validate($request, array(
            'school_id' => 'required',
            'kidato_id' => 'required',
            'requirement_category_id' => 'required',
            'male_total' => 'required',
            'female_total' => 'required',
        ));
        $input = Input::all();
        $condition = $input['requirement_category_id'];

        $user_id = array();
        $user_id[0] = Auth::user()->id;

        for($i= 0; $i < count($condition); $i++){
        $add_teacher = new SchoolUserTotal();
        $add_teacher->user_id = $user_id[0];
        $add_teacher->school_id = $input['school_id'][0];
        $add_teacher->kidato_id = $input['kidato_id'][$i];
        $add_teacher->requirement_category_id = $input['requirement_category_id'][$i];
        $add_teacher->male_total = $input['male_total'][$i];
        $add_teacher->female_total = $input['female_total'][$i];
        $add_teacher->save();
}
        $request->session()->flash('success_requirement_added','User Total Successful Added');

        return redirect()->back();
    }

    public function head_master_profile()
    {
        $district_profile_check = HeadMasterProfile::where("user_id",Auth::user()->id)->count();
        $district_profile = HeadMasterProfile::where("user_id",Auth::user()->id)->first();
        return view('auth.headmaster.profile',compact('district_profile','district_profile_check'));
    }

    public function profile_add_head_master(Request $request)
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

        $add_profile = new HeadMasterProfile();
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
    public function edit_profile_head_master(Request $request,$id)
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

        $edit_profile =  HeadMasterProfile::find($id);
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
