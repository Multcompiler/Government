@extends('main')

@section('title', '| Home')

@section('content')
    <style type="text/css">
        .show{
            display: block;
        }
        .hide{
            display: none;
        }
    </style>
    <div class="row">
        @if (session('success_form'))
            <div id="mydiv" class="user_added"></div>
        @endif
        @if (session('success_import'))
            <div id="mydiv" class="user_imported"></div>
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

        <div class="col-md-3">
            <div class="white-box analytics-info text-center">
                <button  onclick="myFunctionForm()" class="btn btn-block btn-outline btn-rounded btn-default">User Form Add</button>
                <button  onclick="myFunctionImport()" class="btn btn-block btn-outline btn-rounded btn-default">User Excel Import</button>
            </div>

        </div>
        <div class="col-md-8">
            <div id="form-add" class="white-box analytics-info text-center hide">
                <h2>Register New User</h2>
                <form class="form-horizontal new-lg-form" method="POST" action="{{ route('add_new_user') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }} ">
                        <div class="col-xs-12">
                            <div class="col-xs-6">
                                <input class="form-control" name="firstname" value="{{ old('firstname') }}" type="text" required=""
                                       placeholder="FirstName">
                            </div>

                        <div class="col-xs-6">
                                <input class="form-control" name="lastname" value="{{ old('lastname') }}" type="text" required=""
                                       placeholder="LastName">
                        </div>
                    </div>
                    </div>
                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }} ">
                        <div class="col-xs-12">
                            <input class="form-control" name="phone" value="{{ old('phone') }}" type="text" required=""
                                   placeholder="Phone"></div>
                        @if ($errors->has('phone'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select class="form-control" name="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} ">
                        <div class="col-xs-12">
                            <input class="form-control" name="email" value="{{ old('email') }}" type="text" required=""
                                   placeholder="Email"></div>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select class="form-control" name="role_id">
                                @foreach($requests as $data)
                                        <option value="{{$data->id}}">{{ucfirst($data->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <input class="form-control" name="password" type="password" required=""
                                   placeholder="Password"></div>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                                    type="submit">Register
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
            <div class="col-md-8" >
                <div id="import-add" class="white-box analytics-info text-center hide">
                    <h2>Import Users</h2>
                    <a href="{{ URL::to('downloadExcel/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>

                    <a href="{{ URL::to('downloadExcel/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>

                    <a href="{{ URL::to('downloadExcel/csv') }}"><button class="btn btn-success">Download CSV</button></a>

                    <form class="form-horizontal new-lg-form" method="POST" action="{{ route('import_users') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-sm-12">File upload</label>
                        <div class="col-sm-12">
                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="import_file"> </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-primary btn-block">Upload</button>
                        </div>
                    </div>
                    </form>

                </div>
            </div>

    </div>

@endsection