@extends('main')

@section('title', '| Home')

@section('content')
    <div class="row">
        @if (session('success_teacher_deleted'))
            <div id="mydiv" class="success_teacher_deleted"></div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Errors!</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">
                            <span class="visible-xs"><i class="ti-home"></i></span>
                            <span class="hidden-xs"> School Requirements</span>
                        </a>
                    </li>
                    @if($data_school != 0)
                    <li role="presentation" class="">
                        <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="ti-user"></i></span>
                            <span class="hidden-xs">Teachers Total</span>
                        </a>
                    </li>
                        <li role="presentation" class="">
                        <a href="#student" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="ti-user"></i></span>
                            <span class="hidden-xs">Students Total</span>
                        </a>
                    </li>
                   @endif
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="col-sm-12">

                            <div class="white-box">
                                @if($data_school == 0)
                                    <h2 class="m-b-0 text-center" style="text-transform: uppercase;">Add School Requirements first</h2>

                                @else
                                    <h2 class="m-b-0 text-center" style="text-transform: uppercase;">{{\App\School::where("id",$data_school)->pluck("school_name")->first()}} SCHOOL</h2>

                                    @for ($i = 0; $i < $duplicateRecords->count();$i++)


                                        <h2 class="box-title m-b-0">{{\App\Kidato::where("id",$duplicateRecords[$i]->kidato_id)->pluck('class_name')->first()}}</h2>
                                        <hr>
                                        @foreach($requirements as $requirement)
                                            @if($requirement->kidato_id == $duplicateRecords[$i]->kidato_id)

                                                <div class="row">
                                                    <div class="col-md-3 col-xs-6 b-r"><strong>Category</strong>
                                                        <br>
                                                        <p class="text-muted">{{\App\Category::where("id",$requirement->requirement_category_id)->pluck("category_name")->first()}}</p>
                                                    </div>

                                                    <div class="col-md-3 col-xs-6 b-r"><strong>Description</strong>
                                                        <br>
                                                        <p class="text-muted">{{$requirement->category_name}}</p>
                                                    </div>

                                                    <div class="col-md-2 col-xs-6 b-r"><strong>Amount Available</strong>
                                                        <br>
                                                        <p class="text-muted">{{$requirement->amount_available}}</p>
                                                    </div>
                                                    <div class="col-md-2 col-xs-6 b-r"><strong>Amount Needed</strong>
                                                        <br>
                                                        <p class="text-muted">{{$requirement->amount_needed}}</p>
                                                    </div>
                                                    <div class="col-md-2 col-xs-6"><strong>Date</strong>
                                                        <br>
                                                        <p class="text-muted">{{date('Y-M-d',strtotime($requirement->created_at))}}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endif
                                        @endforeach
                                    @endfor
                                @endif

                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <div class="col-sm-12">
                            <div class="white-box">

                                <h2 class="m-b-0 text-center" style="text-transform: uppercase;">{{\App\School::where("id",$data_school)->pluck("school_name")->first()}} SCHOOL</h2>

                                @for ($i = 0; $i < $duplicateRecords->count();$i++)


                                    <h2 class="box-title m-b-0">{{\App\Kidato::where("id",$duplicateRecords[$i]->kidato_id)->pluck('class_name')->first()}}</h2>
                                    <hr>
                                    @foreach($requirements_total as $requirement)
                                        @if($requirement->kidato_id == $duplicateRecords[$i]->kidato_id)
                                            @if(\App\UserSchool::where("id",$requirement->requirement_category_id)->pluck("user_category")->first() == "Teachers")
                                            <div class="row">
                                                <div class="col-md-3 col-xs-6 b-r"><strong>Category</strong>
                                                    <br>
                                                    <p class="text-muted">{{\App\UserSchool::where("id",$requirement->requirement_category_id)->pluck("user_category")->first()}}</p>
                                                </div>

                                                <div class="col-md-3 col-xs-6 b-r"><strong>Male Total</strong>
                                                    <br>
                                                    <p class="text-muted">{{$requirement->male_total}}</p>
                                                </div>

                                                <div class="col-md-3 col-xs-6 b-r"><strong>Female Total</strong>
                                                    <br>
                                                    <p class="text-muted">{{$requirement->female_total}}</p>
                                                </div>
                                                <div class="col-md-3 col-xs-6"><strong>Date</strong>
                                                    <br>
                                                    <p class="text-muted">{{date('Y-M-d',strtotime($requirement->created_at))}}</p>
                                                </div>

                                            </div>
                                            <hr>
                                           @endif
                                        @endif
                                    @endforeach
                                @endfor
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="student">
                        <div class="col-sm-12">
                            <div class="white-box">

                                <h2 class="m-b-0 text-center" style="text-transform: uppercase;">{{\App\School::where("id",$data_school)->pluck("school_name")->first()}} SCHOOL</h2>

                                @for ($i = 0; $i < $duplicateRecords->count();$i++)


                                    <h2 class="box-title m-b-0">{{\App\Kidato::where("id",$duplicateRecords[$i]->kidato_id)->pluck('class_name')->first()}}</h2>
                                    <hr>
                                    @foreach($requirements_total as $requirement)
                                        @if($requirement->kidato_id == $duplicateRecords[$i]->kidato_id)

                                            @if(\App\UserSchool::where("id",$requirement->requirement_category_id)->pluck("user_category")->first() == "Students")

                                                <div class="row">
                                                    <div class="col-md-3 col-xs-6 b-r"><strong>Category</strong>
                                                        <br>
                                                        <p class="text-muted">
                                                            {{\App\UserSchool::where("id",$requirement->requirement_category_id)->pluck("user_category")->first()}}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-3 col-xs-6 b-r"><strong>Male Total</strong>
                                                        <br>
                                                        <p class="text-muted">{{$requirement->male_total}}</p>
                                                    </div>
                                                    <div class="col-md-3 col-xs-6 b-r"><strong>Female Total</strong>
                                                        <br>
                                                        <p class="text-muted">{{$requirement->female_total}}</p>
                                                    </div>
                                                    <div class="col-md-3 col-xs-6"><strong>Date</strong>
                                                        <br>
                                                        <p class="text-muted">{{date('Y-M-d',strtotime($requirement->created_at))}}</p>
                                                    </div>

                                                </div>
                                                <hr>
                                            @endif
                                        @endif
                                    @endforeach
                                @endfor
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection