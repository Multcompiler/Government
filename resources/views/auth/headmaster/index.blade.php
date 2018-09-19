
@extends('main')

@section('title', '| Home')

@section('content')
    <div class="row">

        <div class="col-lg-6 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Teachers</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash"></div>
                    </li>
                    <li class="text-right">
                        <i class="ti-arrow-up text-success"></i>
                        <span class="counter text-success">{{$staffs_total}}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Students</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash2"></div>
                    </li>
                    <li class="text-right">
                        <i class="ti-arrow-up text-purple"></i>
                        <span class="counter text-purple">
                            {{$students_total}}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 ">
            <div class="white-box analytics-info text-center">
                <h2>Welcome to Government Requirement Collection for Secondary Schools</h2>
                <h2>Head Master</h2>
                <small>Management of school properties and staffs.</small>
            </div>
        </div>

    </div>
@endsection