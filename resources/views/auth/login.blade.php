

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
                    <h3 class="box-title m-b-0 text-center" style="padding-bottom: 20px;">Log In</h3>
                    @if (session('success'))
                        <div id="mydiv" class="success_register"></div>
                    @elseif (session('approval'))
                        <div id="mydiv" class="wait_confirm"></div>
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
                    <form class="form-horizontal new-lg-form" id="loginform" method="post" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group  m-t-20{{ $errors->has('email') ? ' has-error' : '' }}{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <label>Email Address</label>
                                <input class="form-control" type="text" required="" placeholder="Username"name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <label>Password</label>
                                <input class="form-control" type="password" required="" placeholder="Password" name="password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="checkbox checkbox-info pull-left p-t-0">
                                    <input id="checkbox-signup" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="checkbox-signup"> Remember me </label>
                                </div>
                                <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a> </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>
                    </form>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="form-horizontal" id="recoverform" action="{{route('password.email')}}">
                        {{ csrf_field() }}

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>Recover Password</h3>
                                <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" name="email" value="{{ $email or old('email') }}" placeholder="Email">
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection