<?php

namespace App\Http\Controllers;

use App\DistrictOfficerProfile;
use App\SchoolRequirements;
use App\SchoolUserTotal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Session;

class DistrictEducationOfficerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('district');
    }
    public function index()
    {

        $restoration = DB::table('schools')
         ->select('schools.school_name',DB::raw('SUM(school_requirements.amount_needed - school_requirements.amount_available) as total'))
        ->join("school_requirements", "schools.id", "=", "school_requirements.school_id")
        ->groupBy("schools.school_name","school_requirements.school_id")
       ->get();

                //dd($restoration);
        return view('auth.district_officer.index',compact('restoration'));
    }
    public function district_officer_profile()
    {
        $district_profile_check = DistrictOfficerProfile::where("user_id",Auth::user()->id)->count();
        $district_profile = DistrictOfficerProfile::where("user_id",Auth::user()->id)->first();
        return view('auth.district_officer.profile',compact('district_profile','district_profile_check'));
    }
    public function profile_add_disctrict(Request $request)
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

        $add_profile = new DistrictOfficerProfile();
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
    public function edit_profile_district(Request $request,$id)
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

        $edit_profile =  DistrictOfficerProfile::find($id);
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

    public function school_view($id,$name){
        $duplicateRecords = DB::table('school_requirements')
            ->select('kidato_id')
            ->groupBy('kidato_id')
            ->get();

        $requirements = SchoolRequirements::where('school_id',$id)->get();
        $requirements_total = SchoolUserTotal::where('school_id',$id)->get();
        if ($requirements->count() > 0){
            foreach ($requirements as $requirement){
                $data_school = $requirement->school_id;
            }
        }else{
            $data_school = 0;
        }

        // SchoolUserTotal::where('school_id',$id)->get();

        $school_staffs = DB::select("Select school_id,sum(male_total) as sum_male,sum(female_total) as sum_female from school_user_totals WHERE requirement_category_id = 1 AND school_id = ? GROUP BY school_id",[$id]);
        $school_students = DB::select("Select school_id,sum(male_total) as sum_male,sum(female_total) as sum_female from school_user_totals WHERE requirement_category_id = 2 AND school_id = ? GROUP BY school_id",[$id]);

        //dd();
        //Students Total
        $male_students = array();
        $female_students = array();
        foreach ($school_students as $school_student){
            $male_students[] = $school_student->sum_male;
        }
        foreach ($school_students as $school_student){
            $female_students[] = $school_student->sum_female;
        }

        if (sizeof($school_students) != 0){
            $students_total = $male_students[0] + $female_students[0];
        }else{
            $students_total = 0;
        }


        //Staffs Total
        $male_staffs = array();
        $female_staffs = array();
        foreach ($school_staffs as $school){
            $male_staffs[] = $school->sum_male;
        }
        foreach ($school_staffs as $schoo){
            $female_staffs[] = $schoo->sum_female;
        }
        if (sizeof($school_staffs) != 0){
            $staffs_total = $male_staffs[0] + $female_staffs[0];
        }else{
            $staffs_total = 0;
        }



        //dd($staffs_total);

        return view('auth.district_officer.view_school',compact('requirements_total','students_total','staffs_total','data_school','requirements','duplicateRecords','id'));
    }
}
