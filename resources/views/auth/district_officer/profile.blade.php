@extends('main')

@section('title', '| View Info')

@section('content')
    <div class="row">
        @if (session('success'))
            <div id="mydiv" class="profile_info_added"></div>
        @endif
        @if (session('exist'))
            <div id="mydiv" class="head_exist"></div>
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
        <div class="row">
            @if($district_profile_check > 0)
            <div class="col-md-8 col-xs-12 col-md-offset-2">
                <div class="white-box">
                    <!-- .tabs -->
                    <ul class="nav nav-tabs tabs customtab">
                        <li class="active tab">
                            <a href="#profile" data-toggle="tab"> <span class="visible-xs"><i
                                            class="fa fa-user"></i></span> <span class="hidden-xs">Profile</span> </a>
                        </li>
                        <li class="tab">
                            <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i
                                            class="fa fa-cog"></i></span> <span class="hidden-xs">Edit Detail</span>
                            </a>
                        </li>
                    </ul>
                    <!-- /.tabs -->
                    <div class="tab-content">

                        <div class="tab-pane active" id="profile">
                            <div class="row">
                                <div class="col-md-3 col-xs-6 b-r"><strong>Firstname</strong>
                                    <br>
                                    <p class="text-muted">{{$district_profile->firstname}}</p>
                                </div>
                                <div class="col-md-3 col-xs-6 b-r"><strong>Lastname</strong>
                                    <br>
                                    <p class="text-muted">{{$district_profile->lastname}}</p>
                                </div>
                                <div class="col-md-3 col-xs-6 b-r"><strong>Mobile</strong>
                                    <br>
                                    <p class="text-muted">{{$district_profile->phone}}</p>
                                </div>
                                <div class="col-md-3 col-xs-6"><strong>Email</strong>
                                    <br>
                                    <p class="text-muted">{{$district_profile->email}}</p>
                                </div>
                            </div>
                            <hr>
                            <strong>Location</strong>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="text-muted" style="padding-top: 10px;">
                                      Region: {{\App\Region::where("id",$district_profile->region_id)->pluck("name")->first()}}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted" style="padding-top: 10px;">
                                      District: {{\App\District::where("id",$district_profile->district_id)->pluck("name")->first()}}
                                    </p>
                                </div>
                            </div>
                            <hr/>
                            <h3>Bio:</h3>
                            <p>
                                {!!$district_profile->bio  !!}
                            </p>


                        </div>
                        <!-- /.tabs2 -->
                        <!-- .tabs3 -->
                        <div class="tab-pane" id="settings">
                            {!! Form::model($district_profile, ['route' => ['edit_profile_district', $district_profile->id],'method' => 'PUT','class' => 'form-horizontal form-material'],['data-parsley-validate' => '']) !!}

                            <div class="form-group">
                                <label for="firstname" class="col-md-12">Firstname</label>
                                <div class="col-md-12">
                                    {{ Form::text('firstname',null, array('class' => 'form-control form-control-line','id'=>'firstname')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lastname" class="col-md-12">Lastname</label>
                                <div class="col-md-12">
                                    {{ Form::text('lastname',null, array('class' => 'form-control form-control-line','id'=>'lastname')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="col-md-12">Phone</label>
                                <div class="col-md-12">
                                    {{ Form::text('phone',null, array('class' => 'form-control form-control-line','id'=>'phone')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    {{ Form::email('email',null, array('class' => 'form-control form-control-line','id'=>'email')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Select Region</label>
                                <div class="col-sm-12">
                                    <select id="region" class="form-control form-control-line"  name="region_id" required>
                                        <option value=""> -- Default -- </option>
                                        @foreach(\App\Region::all() as $region)
                                            <option value="{{$region->id}}"> {{ucfirst($region->name)}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Select District</label>
                                <div class="col-sm-12">
                                    <select id="district" class="form-control form-control-line" name="district_id" required>
                                        <option value=""> -- Default -- </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bio" class="col-md-12">Bio</label>
                                <div class="col-md-12">
                                    {{ Form::textarea('bio',null, array('class' => 'form-control form-control-line','id'=>'bio')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success">Update Profile</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <!-- /.tabs3 -->
                    </div>
                </div>
            </div>
                @else
                <div class="col-md-8 col-xs-12 col-md-offset-2">
                    <div class="white-box">
                        <!-- .tabs -->
                        <h3>ADD PROFILE DETAILS</h3>
                        <form class="form-horizontal form-material" action="{{route('profile_add_disctrict')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-md-12">Firstname</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Enter Firstname" name="firstname"
                                           class="form-control form-control-line" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Lastname</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Enter Firstname" name="lastname"
                                           class="form-control form-control-line" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Phone</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Enter Your Phone" name="phone"
                                           class="form-control form-control-line" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input type="email" placeholder="Enter your email"
                                           class="form-control form-control-line" name="email"
                                           id="example-email" required></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Select Region</label>
                                <div class="col-sm-12">
                                    <select id="region" class="form-control form-control-line"  name="region_id" required>
                                        <option value=""> -- Default -- </option>
                                        @foreach(\App\Region::all() as $region)
                                        <option value="{{$region->id}}"> {{ucfirst($region->name)}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Select District</label>
                                <div class="col-sm-12">
                                    <select id="district" class="form-control form-control-line" name="district_id" required>
                                        <option value=""> -- Default -- </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Bio</label>
                                <div class="col-md-12">
                                    <textarea class="form-control form-control-line" name="bio" required></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success">Add Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>

    </div>

@endsection