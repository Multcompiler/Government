

@extends('main')

@section('title', '| Home')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="white-box analytics-info text-center">
                <div class="lg-content" style="height: 500px;">
                    <h2 style="text-transform: uppercase;">Government Requirement Collection for Secondary Schools</h2>
                    <img src="{{asset('images/logo_home.jpg')}}">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="white-box analytics-info">
                <div class="white-box" style="height: 480px;">
                    <h3 class="box-title m-b-0 text-center">Register</h3>
                    <form class="form-horizontal new-lg-form" id="loginform" action="{{ route('register') }}">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} ">
                            <div class="col-xs-12">
                                <input class="form-control" name="name" value="{{ old('name') }}" type="text" required="" placeholder="Name"> </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} ">
                            <div class="col-xs-12">
                                <input class="form-control" name="email" value="{{ old('email') }}" type="text" required="" placeholder="Email"> </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <input class="form-control" name="password" type="password" required="" placeholder="Password"> </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" name="password_confirmation" type="password" required="" placeholder="Confirm Password"> </div>

                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Register</button>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                <p>Already have an account? <a href="/login" class="text-danger m-l-5"><b>Sign In</b></a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection