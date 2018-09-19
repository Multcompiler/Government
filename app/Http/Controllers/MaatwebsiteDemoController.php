<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class MaatwebsiteDemoController extends Controller
{
    public function importExport()

    {

        return view('importExport');

    }

    public function downloadExcel($type)

    {

        $data = User::get()->toArray();

        return Excel::create('all_users_details', function($excel) use ($data) {

            $excel->sheet('mySheet', function($sheet) use ($data)

            {

                $sheet->fromArray($data);

            });

        })->download($type);

    }

    public function importExcel(Request $request)

    {

        if($request->hasFile('import_file')){

            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                $reg_data = User::all();
                foreach ($reg_data as $data_value){
                    $reg_number_array[] = $data_value->email;
                }
                //  dd($email_array);

                foreach ($reader->toArray() as $key => $row) {
                    if (in_array($row['email'], $reg_number_array)){
                        continue;
                    }else{
                        $data['firstname'] = $row['firstname'];
                        $data['lastname'] = $row['lastname'];
                        $data['phone'] = $row['phone'];
                        $data['email'] = $row['email'];
                        $data['gender'] = $row['gender'];
                        $data['role_id'] = $row['role_id'];
                        $data['password'] = Hash::make($row['password']);

                        $reg_number_array[] = $row['email'];

                        if(!empty($data)) {
                            DB::table('users')->insert($data);

                            Session::flash('success_import', 'Users Records successfully Uploaded.!!!');
                        }
                    }



                }
            });
        }



        return back();
    }

}
