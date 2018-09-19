<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

//User Routes
Route::get('/','UserController@index')->name('homepage');
Route::get('/test','UserController@test')->name('test');

Auth::routes();

//Admin Routes
Route::resource('admin','AdminController');
Route::get('/User/Profile/View','AdminHeadMasterManageController@show')->name('profile_user_view');
Route::delete('/User/Profile/Delete/{id}','AdminUserManageController@delete_profile_user')->name('delete_profile_user');
Route::get('/Users/Add','AdminUserManageController@index')->name('add_user');
Route::get('/Admin/Profile','AdminController@admin_profile')->name('admin_profile');
Route::post('/Admin/Profile/Add','AdminController@profile_add_admin')->name('profile_add_admin');
Route::put('/Admin/Profile/Edit/{id}','AdminController@edit_profile_admin')->name('edit_profile_admin');
Route::get('/Users/All/View','AdminUserManageController@view_users')->name('view_user');
Route::get('/Users/All/View/{id}','AdminUserManageController@view_users_category')->name('view_user_category');
Route::post('/Users/Save','AdminUserManageController@store_users')->name('add_new_user');
Route::put('/Users/Edit/{id}',[
    'uses' => 'AdminUserManageController@edit_users',
    'as' => 'edit_users'
]);



//import users admin routes
Route::get('importExport', 'MaatwebsiteDemoController@importExport');
Route::get('downloadExcel/{type}', 'MaatwebsiteDemoController@downloadExcel');
Route::post('importExcel', 'MaatwebsiteDemoController@importExcel')->name('import_users');

//District Officer Routes
Route::get('district_officer','DistrictEducationOfficerController@index');
Route::get('district_officer/profile','DistrictEducationOfficerController@district_profile')->name('district_profile');
Route::put('district_officer/profile/Edit/{id}','DistrictEducationOfficerController@edit_profile_district')->name('edit_profile_district');
Route::post('district_officer/profile/add','DistrictEducationOfficerController@profile_add_disctrict')->name('profile_add_disctrict');
Route::get('District_Officer/Profile/View','DistrictEducationOfficerController@district_officer_profile')->name('district_officer_profile');
Route::get('DistrictOfficer/View/{id}/School/{name}',
    [
        'uses'=>'DistrictEducationOfficerController@school_view',
        'as'=>'district_view_school'
    ]);


//Head Master Routes
Route::get('headmaster','HeadMasterController@index');
Route::get('/Class/Select','HeadMasterController@get_classes');
Route::get('/Headmaster/Profile/View','HeadMasterController@head_master_profile')->name('head_master_profile');
Route::put('/Headmaster/Profile/Edit/{id}','HeadMasterController@edit_profile_head_master')->name('edit_profile_head_master');
Route::post('/Headmaster/Profile/Add','HeadMasterController@profile_add_head_master')->name('profile_add_head_master');
Route::get('/Class/Select/Data','HeadMasterController@get_classe');
Route::get('/Category/Select','HeadMasterController@get_category');
Route::get('/Category/Select/Data','HeadMasterController@get_categ');
Route::get('/Headmaster/Schoolmanage','HeadMasterController@add_school')->name('schoolmanage');
Route::get('/Headmaster/Teachers/Add','HeadMasterController@add_new_teacher')->name('add_new_teacher');
Route::get('/Headmaster/Teachers/View','HeadMasterController@view_all_teachers')->name('view_all_teachers');
Route::delete('/Headmaster/Teachers/Delete/{id}','HeadMasterController@teacher_delete')->name('teacher_delete');
Route::get('/Headmaster/School/Requirements','HeadMasterController@school_requirements')->name('school_requirements');
Route::get('/Headmaster/Requirements/View/All','HeadMasterController@view_school_requirements')->name('view_school_requirements');
Route::delete('/Headmaster/Schoolmanage/Delete/{id}','HeadMasterController@delete_school')->name('delete_school');
Route::put('/Headmaster/Schoolmanage/Edit/{id}','HeadMasterController@edit_school')->name('edit_school');
Route::resource('schooladd','SchoolProfileManageController');
Route::get('Headmaster/School/Requirements','HeadMasterController@add_school_requirement')->name('add_school_requirement');
Route::resource('schoolinfo','SchoolInfoController');
Route::post('/Headmaster/Teacher/Save','HeadMasterController@add_teachers')->name('add_teachers');
Route::post('/Headmaster/Requirement/Save','HeadMasterController@add_all_school_requirement')->name('add_all_school_requirement');
Route::post('/Headmaster/Total/Save','HeadMasterController@add_users_total')->name('add_users_total');
Route::get('/api/dropdown',function (){
    $id = Input::get('option');

    $models = \App\District::where('region_id',$id)->get();

    return response()->json($models);
});
Route::get('/api/drop',function (){
    $id = Input::get('option');

    $models = \App\Ward::where('district_id',$id)->get();

    //$models->links('name','id');
    //$models
    //return Response::make($models);

        //

    return response()->json($models);
});

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
