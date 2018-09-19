@extends('main')

@section('title', '| Home')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="white-box analytics-info text-center">
                <div class="lg-content" style="height: 570px;">
                    <h2 style="text-transform: uppercase;">Government Requirement Collection for Secondary Schools</h2>
                    <img src="{{asset('images/logo_home.jpg')}}">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="white-box analytics-info" style="height: 630px;">
                <h3 class="box-title m-b-0 text-center" style="padding-bottom: 20px;">Register</h3>
                @if (session('success'))
                    <div id="mydiv" class="success_register"></div>
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

                <form class="form-horizontal new-lg-form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }} ">
                        <div class="col-xs-12">
                            <input class="form-control" name="firstname" value="{{ old('firstname') }}" type="text" required=""
                                   placeholder="Name"></div>
                        @if ($errors->has('firstname'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }} ">
                        <div class="col-xs-12">
                            <input class="form-control" name="lastname" value="{{ old('lastname') }}" type="text" required=""
                                   placeholder="Lastname"></div>
                        @if ($errors->has('lastname'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                        @endif
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
                            <select class="form-control" name="category">
                                @foreach($requests as $data)
                                    @if($data->name != 'admin')
                                        <option value="{{\Illuminate\Support\Facades\Crypt::encrypt($data->id)}}">{{ucfirst($data->name)}}</option>
                                    @endif
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
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" name="password_confirmation" type="password" required=""
                                   placeholder="Confirm Password"></div>

                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                                    type="submit">Register
                            </button>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Already have an account? <a href="/login" class="text-danger m-l-5"><b>Sign In</b></a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection