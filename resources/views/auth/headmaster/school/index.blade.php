@extends('main')

@section('title', '| Home')

@section('content')

    <div class="row">
        @if (session('school_info_updated'))
            <div id="mydiv" class="school_info_updated"></div>
        @endif
        @if (session('exist'))
            <div id="mydiv" class="head_exist"></div>
        @endif
        <div class="col-md-12">
            @if($school_info_check > 0)
                <div class="col-md-offset-2 white-box" style="max-width: 900px;">
                    <ul class="nav nav-tabs tabs customtab">

                        <li class="tab">
                            <a href="#profile" data-toggle="tab"> <span class="visible-xs"><i
                                            class="fa fa-user"></i></span> <span class="hidden-xs">School Profile Information</span>
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane active" id="profile">
                            <div class="row">
                                <div class="col-md-3 col-xs-6 b-r"><strong>School Name</strong>
                                    <br>
                                    <p class="text-muted">{{$school_info->school_name}}</p>
                                </div>
                                <div class="col-md-3 col-xs-6 b-r"><strong>Region</strong>
                                    <br>
                                    <p class="text-muted">{{\App\Region::where('id',$school_info->region_id)->pluck('name')->first()}}</p>
                                </div>
                                <div class="col-md-3 col-xs-6 b-r"><strong>Disrict</strong>
                                    <br>
                                    <p class="text-muted">{{\App\District::where('id',$school_info->district_id)->pluck('name')->first()}}</p>
                                </div>
                                <div class="col-md-3 col-xs-6"><strong>Ward</strong>
                                    <br>
                                    <p class="text-muted">{{\App\Ward::where('id',$school_info->ward_id)->pluck('name')->first()}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 col-xs-6 b-r"><strong>HeadMaster</strong>
                                    <br>
                                    <p class="text-muted">
                                        {{\App\User::find($school_info->region_id)->pluck('firstname')->first()}}
                                        {{\App\User::find($school_info->region_id)->pluck('lastname')->first()}}
                                    </p>
                                </div>
                                <div class="col-md-4 col-xs-6 b-r"><strong>Phone</strong>
                                    <br>
                                    <p class="text-muted">{{$school_info->phone}}</p>
                                </div>
                                <div class="col-md-4 col-xs-6 b-r"><strong>Box</strong>
                                    <br>
                                    <p class="text-muted">P.o Box {{$school_info->box}}</p>
                                </div>

                            </div>
                            <hr>
                            <div class="text-right">
                                <button type="submit" class="btn btn-info waves-effect waves-light m-t-10"
                                        data-toggle="modal" data-target="#myModal">Edit Information
                                </button>
                                <button type="submit" class="btn btn-info waves-effect waves-light m-t-10"
                                        data-toggle="modal" data-target="#myModal1">Delete
                                </button>
                            </div>


                            <div id="myModal1" class="modal fade" tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                ×
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">Delete School Profile</h4></div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this School Profile ? </p>

                                        </div>
                                        <div class="modal-footer">
                                            {!! Form::open(['route' => ['delete_school', $school_info->id],'method' => 'DELETE'],['data-parsley-validate' => '']) !!}
                                            <button type="submit" class="btn btn-primary">Delete</button>
                                            {!! Form::close() !!}
                                        </div>


                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- sample modal content -->
                            <div id="myModal" class="modal fade" tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                ×
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">Edit School Profile</h4></div>
                                        <div class="modal-body">
                                            {!! Form::model($school_info, ['route' => ['edit_school', $school_info->id],'method' => 'PUT'],['data-parsley-validate' => '']) !!}

                                            <div class="modal-body">

                                                <div class="input-group col-md-12">
                                                    <label for="email" class="control-label">School Name:</label>
                                                    {{ Form::text('school_name',null, array('class' => 'form-control','id'=>'email')) }}
                                                </div>
                                                <br/>
                                                <div class="input-group col-md-12">
                                                    <label for="" class="control-label">Region:</label>
                                                    <select name="region_id" class="form-control" required>
                                                        <option value=""> -- Default --</option>
                                                            @foreach($region as $reg)
                                                            <option value="{{$reg->id}}"> {{$reg->name}}  </option>
                                                            @endforeach

                                                    </select>
                                                </div>
                                                <br/>
                                                <div class="input-group col-md-12">
                                                    <label for="" class="control-label">District:</label>
                                                    <select name="district_id" class="form-control" required>
                                                        <option value=""> -- Default --</option>
                                                        @foreach($district as $dist)
                                                            <option value="{{$dist->id}}"> {{$dist->name}}  </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <br/>
                                                <div class="input-group col-md-12">
                                                    <label for="" class="control-label">Ward:</label>
                                                    <select name="ward_id" class="form-control" required>
                                                        <option value=""> -- Default --</option>
                                                        @foreach($ward as $wrd)
                                                            <option value="{{$wrd->id}}"> {{$wrd->name}}  </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <br/>
                                                <div class="input-group col-md-12">
                                                    <label for="email" class="control-label">Phone:</label>
                                                    {{ Form::text('phone',null, array('class' => 'form-control','id'=>'email')) }}
                                                </div>
                                                <br/>
                                                <div class="input-group col-md-12">
                                                    <label for="email" class="control-label">Box:</label>
                                                    {{ Form::text('box',null, array('class' => 'form-control','id'=>'email')) }}
                                                </div>
                                                <br/>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">Save changes
                                                </button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                        </div>
                    </div>
                </div>
            @else
                <div class="register-box" style="padding-top: 0;">
                    <div class="">
                        @if (session('success_school_deleted'))
                            <div id="mydiv" class="success_school_deleted"></div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-ban"></i> Errors!</h4>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <form id="msform" name="myForm" action="{{route('schooladd.store')}}" method="post">
                        {{ csrf_field() }}
                        <!-- progressbar -->
                            <ul id="eliteregister">
                                <li class="active">School Name</li>
                                <li>School Location</li>
                                <li>School Contacts</li>
                            </ul>
                            <!-- fieldsets -->
                            <fieldset>
                                <h2 class="fs-title">School Name</h2>
                                <h3 class="fs-subtitle">Step 1</h3>
                                <div class="required">
                                    <input type="text" name="school_name" placeholder="School Name"/>
                                </div>


                                <input type="button" name="next" class="next action-button" value="Next"/>
                            </fieldset>
                            <fieldset>
                                <h2 class="fs-title">School Location</h2>
                                <h3 class="fs-subtitle">Step 2</h3>
                                <div class="required">
                                    <select id="region" name="region" required>
                                        <option>Select A Region</option>
                                        @foreach($region as $rg)
                                            <option value="{{$rg->id}}">{{$rg->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="required">
                                    <select id="district" name="district">
                                        <option>Please choose Region First</option>
                                    </select>
                                </div>

                                <div class="required">
                                    <select id="ward" name="ward">
                                        <option>Please choose District First</option>
                                    </select>
                                </div>

                                <input type="button" name="previous" class="previous action-button" value="Previous"/>
                                <input type="button" name="next" class="next action-button" value="Next"/>
                            </fieldset>
                            <fieldset>
                                <h2 class="fs-title">School Contacts</h2>
                                <h3 class="fs-subtitle">Step 3</h3>
                                <div class="required">
                                    <input type="text" name="phone" placeholder="Phone Number"/>
                                </div>
                                <div class="required">
                                    <input type="text" name="box" placeholder="P.O Box"/>
                                </div>

                                <input type="button" name="previous" class="previous action-button" value="Previous"/>
                                <input type="submit" name="submit" class="submit action-button" id="verify"
                                       value="Submit"/>
                            </fieldset>
                        </form>

                        <div class="clear"></div>
                    </div>
                </div>
            @endif

        </div>

    </div>
@endsection